<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ticket, App\Department, App\Issue, App\TicketAttachment, App\Notification;

class TicketController extends Controller
{
    public function index(Request $request)
    {
    	$query = Ticket::where('user_id',auth()->guard('user')->user()->id)->where('parent_id',0); 
        $recset = $query;
        $data['tickets'] = $recset->get(); 

        if($request->route('type')=='closed'){
            $query->where('status','Closed');         
        }
        else
        {
            $query->where('status','Open');
        }
        $data['records'] = $query->orderBy('id','desc')->get(); 

        $data['departments'] = Department::where('in_ticket',1)->listsTranslations('name')->pluck('name','id');
        $data['priorities']	= array('Urgent'=>'Urgent','High'=>'High');
    	return view('front.tickets.index',$data);
    }
    
    public function getIssues(Request $request){
        $data['issues'] = Issue::where('department_id',$request->departmentId)->listsTranslations('name')->pluck('name','id');
        return view('front.tickets.get_issues',$data);
    }

    public function create(Request $request){


        $this->validate($request, [
            'department'    => 'required',
            'title'         => 'required',           
            'priority'      => 'required',
            'issue'         => 'required',
            'message'       => 'required',
            'file.*'        => 'max:2000|mimes:png,jpg,gif,jpeg,pdf,rar,zip,txt',
            ],
            [
                'issue.required'    => 'Chose issue related to',
                'file.*.mimes'      => 'Uploaded file type must be .png, *.jpg, *.gif, *.jpeg, *.pdf, *rar, *.zip, *.txt',
                'file.*.max'        => 'Uploaded file size maximum 5MB allowed'
            ]
        );

        $ticketNo                   = date('mdyis').auth()->guard('user')->user()->id.mt_rand(1000,9999);
        $object = new Ticket;
        $object->title              = $request->title;
        $object->message            = $request->message;
        $object->user_id            = auth()->guard('user')->user()->id;
        $object->department_id      = $request->department;
        $object->priority           = $request->priority;
        $object->issue_id           = $request->issue;
        $object->status             = 'Open';
        $object->ticket_no          = $ticketNo;
        $object->save(); 

        // File Upload
        if($request->file('file')){
            foreach ($request->file('file') as $file) {
                $fileName  = $ticketNo.'-'.time().'-ticket' . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/tickets/'), $fileName);

                $ticketAttachment                = new TicketAttachment();
                $ticketAttachment->ticket_id     = $object->id;
                $ticketAttachment->file          = $fileName;
                $ticketAttachment->save();
            }            
        }

        $notification = new Notification();
        $notification->notificationable_id = $object->id;
        $notification->notificationable_type = 'Ticket';
        $notification->text = 'a new ticket has been posted';
        $notification->department_id = $request->department;
        $notification->added_by = auth()->guard('user')->user()->id;
        $notification->save();

        return \Redirect::back()->with('success', 'Ticket created successfully');
    }

    public function reply(Request $request){
        $this->validate($request, [
            'message' => 'required',
            'file.*'        => 'max:2000|mimes:png,jpg,gif,jpeg,pdf,rar,zip,txt'
            ],
            [
                'file.*.mimes'      => 'Uploaded file type must be .png, *.jpg, *.gif, *.jpeg, *.pdf, *rar, *.zip, *.txt',
                'file.*.max'        => 'Uploaded file size maximum 5MB allowed'
            ]            
        );
        $ticketId = decrypt($request->route('id'));
        $ticket   = Ticket::find($ticketId);
        $ticketNo = $ticket->ticket_no;

        $object = new Ticket;
        $object->parent_id          = $ticket->id;
        $object->message            = $request->message;
        $object->user_id            = auth()->guard('user')->user()->id;
        $object->department_id      = $ticket->department_id;
        $object->issue_id           = $ticket->issue_id;
        $object->ticket_no          = $ticketNo;
        $object->save(); 

        // File Upload
        if($request->file('file')){
            foreach ($request->file('file') as $file) {
                $fileName  = $ticketNo.'-'.time().'-ticket' . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/tickets/'), $fileName);

                $ticketAttachment                = new TicketAttachment();
                $ticketAttachment->ticket_id     = $object->id;
                $ticketAttachment->file          = $fileName;
                $ticketAttachment->save();
            }
        }

        $notification = new Notification();
        $notification->notificationable_id = $object->id;
        $notification->notificationable_type = 'Ticket';
        $notification->text = 'reply of ticket has been posted';
        $notification->department_id = $ticket->department_id;
        $notification->added_by = auth()->guard('user')->user()->id;
        $notification->save();

        return \Redirect::back()->with('success', 'Message posted successfully');
    }    

    public function viewTicket(Request $request){
        $data = array();
        $ticketId = decrypt($request->route('id'));
        $data['record'] = Ticket::find($ticketId);
        $data['tickets'] = Ticket::where('id',$ticketId)->orWhere('parent_id',$ticketId)->orderBy('id')->get();
        $data['backUrl'] = route('tickets');
        return view('front.tickets.view',$data);
    }

    public function closeTicket(Request $request){
        $ticketId = decrypt($request->route('id'));
        $ticket = Ticket::find($ticketId); 
        $ticket->status = 'Closed';
        $ticket->save();
        return \Redirect::back()->with('success', 'Your ticket closed successfully');
    }

    public function postedTickets(Request $request){
        $query = Ticket::where('department_id',auth()->guard('user')->user()->department_id)->where('parent_id',0); 
        $recset = $query;
        $data['tickets'] = $recset->get(); 

        if($request->route('type')=='closed'){
            $query->where('status','Closed');         
        }
        else
        {
            $query->where('status','Open');            
        }
        $data['records'] = $query->orderBy('id','desc')->get(); 

        $data['departments'] = Department::listsTranslations('name')->pluck('name','id');
        $data['priorities'] = array('Urgent'=>'Urgent','High'=>'High');
        return view('front.tickets.posted_tickets',$data);
    }

    public function viewPostedTicket(Request $request){
        $data = array();
        $ticketId = decrypt($request->route('id'));
        $data['record'] = Ticket::find($ticketId);
        $data['tickets'] = Ticket::where('id',$ticketId)->orWhere('parent_id',$ticketId)->orderBy('id')->get();
        $data['backUrl'] = route('posted_tickets');
        return view('front.tickets.view',$data);
    }



}