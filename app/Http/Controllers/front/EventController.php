<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\EventType;
use App\User;
use App\UserFollower;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $today          = date('Y-m-d');
        $tomorrow       = date('Y-m-d', strtotime($today. '+ 1 days'));
        $weekStartDate  = date("Y-m-d H:i:s", strtotime('monday this week'));
        $weekEndDate    = date("Y-m-d 11:59:59", strtotime('sunday this week'));
        $firstDayMonth  = date('Y-m-01 00:00:00');
        $lastDayMonth   = date('Y-m-t 11:59:59');

        $eventDay = $request->route('eventDay');

        $fromDate   = $request->from;
        $toDate     = $request->end;

        $limit      = 3;
        $data['limit'] = $limit; 
        $data['eventDay'] = $eventDay;

        // if($request->route('username')!='' && $request->route('username')!= \Auth::guard('user')->user()->ad_username){
        //     $data['currentuser'] = User::where('ad_username', $request->route('username'))->first();
        //     $data['logedInUser'] = false;
        //     $data['isFollow'] = UserFollower::where('user_id',\Auth::guard('user')->user()->id)->where('follower_id', $data['currentuser']->id)->first();            
        // }else{
        //     $data['currentuser'] = User::find(\Auth::guard('user')->user()->id);
        //     $data['logedInUser'] = true;          
        // }

        $data['isSearch'] = 'No';
        if($fromDate != '' && $toDate != '')
        {
            $data['isSearch'] = 'Yes';
            $expFromDate = explode('-', $fromDate);
            $expToDate = explode('-', $toDate);
            $searchFromDate = $expFromDate[2]."-".$expFromDate[1]."-".$expFromDate[0];
            $searchToDate = $expToDate[2]."-".$expToDate[1]."-".$expToDate[0];

            $data['EventSearchDateList'] = Event::where('status','Active')->whereBetween('event_start_date',[$searchFromDate, $searchToDate])->get();
        }

       
        if($eventDay == 'today')
        {
    	   $data['eventList'] = Event::where('status','Active')->where('event_start_date', $today)->limit($limit)->offset('0')->get();   
        }
        if($eventDay == 'tomorrow')	
        $data['eventList'] = Event::where('status','Active')->where('event_start_date', $tomorrow)->orWhereRaw("'".$tomorrow."' BETWEEN event_start_date AND event_end_date")->limit($limit)->offset('0')->get();

        if($eventDay == 'week')
        $data['eventList'] = Event::where('status','Active')->whereBetween('event_start_date',[$weekStartDate, $weekEndDate])->orWhereBetween('event_end_date',[$weekStartDate, $weekEndDate])->orWhereRaw("'".$weekStartDate."' BETWEEN event_start_date AND event_end_date")->orderBy('event_start_date','ASC')->limit($limit)->offset('0')->get();

        if($eventDay == 'month')
        $data['eventList'] = Event::where('status','Active')->whereBetween('event_start_date',[$firstDayMonth, $lastDayMonth])->orWhereBetween('event_end_date',[$firstDayMonth, $lastDayMonth])->orWhereRaw("'".$firstDayMonth."' BETWEEN event_start_date AND event_end_date")->orderBy('event_start_date','ASC')->limit($limit)->offset('0')->get();

        return view('front.events.event_list',$data);
    }

    public function addEvent(){
        

        echo 'addEvent';
    	// if(auth()->guard('user')->user()->can('add-event')){
    	// 	echo 'ok';
    	// }else{
    	// 	return view('front.access_denied');
    	// }

    }

    public function calendar(request $request)
    {   
        if($request->route('username')!='' && $request->route('username')!= \Auth::guard('user')->user()->ad_username){
            $data['currentuser'] = User::where('ad_username', $request->route('username'))->first();
            $data['logedInUser'] = false;
            $data['isFollow'] = UserFollower::where('user_id',\Auth::guard('user')->user()->id)->where('follower_id', $data['currentuser']->id)->first();            
        }else{
            $data['currentuser'] = User::find(\Auth::guard('user')->user()->id);
            $data['logedInUser'] = true;       
        }

        $data['eventType'] = EventType::where('status','Active')->get();
        $data['eventList'] = Event::where('status','Active')->select('id','event_start_date','event_end_date','start_time','end_time','type_id','allday_event')->get();
        
        $data['userInfo'] = User::select('id','birth_day','birth_month','anniversary_day','anniversary_month','display_name')->where('status','Active')->get();
        return view('front.events.calendar',$data);
    }
	
    public function editEvent(){

        echo 'editEvent';

    }

    public function details(Request $request){
        $eventId = decrypt($request->route('id'));
        $data['record'] = Event::find($eventId);
        return view('front.events.details',$data);
    }

    public function ajax_event(Request $request)
    {

        $today          = date('Y-m-d');
        $tomorrow       = date('Y-m-d', strtotime($today. '+ 1 days'));
        $weekStartDate  = date("Y-m-d H:i:s", strtotime('monday this week'));
        $weekEndDate    = date("Y-m-d 11:59:59", strtotime('sunday this week'));
        $firstDayMonth  = date('Y-m-01 00:00:00');
        $lastDayMonth   = date('Y-m-t 11:59:59');

        $eventDay       = $request->post('event');
        $offset         = $request->post('offset');

        $fromDate   = $request->from;
        $toDate     = $request->end;

        $limit      = 3;
        $data['limit'] = $limit; 

        $data['isSearch'] = 'No';
        if($fromDate != '' && $toDate != '')
        {
            $data['isSearch'] = 'Yes';
            $expFromDate = explode('-', $fromDate);
            $expToDate = explode('-', $toDate);
            $searchFromDate = $expFromDate[2]."-".$expFromDate[1]."-".$expFromDate[0];
            $searchToDate = $expToDate[2]."-".$expToDate[1]."-".$expToDate[0];

            $data['EventSearchDateList'] = Event::where('status','Active')->whereBetween('event_start_date',[$searchFromDate, $searchToDate])->get();
        }      

        if($eventDay == 'today')
        {
            $data['eventList'] = Event::where('status','Active')->where('event_start_date', $today)->limit($limit)->offset($offset)->get();   
        }
        if($eventDay == 'tomorrow')   
        $data['eventList'] = Event::where('status','Active')->where('event_start_date', $tomorrow)->orWhereRaw("'".$tomorrow."' BETWEEN event_start_date AND event_end_date")->limit($limit)->offset($offset)->get();

        if($eventDay == 'week')
        $data['eventList'] = Event::where('status','Active')->whereBetween('event_start_date',[$weekStartDate, $weekEndDate])->orWhereBetween('event_end_date',[$weekStartDate, $weekEndDate])->orWhereRaw("'".$weekStartDate."' BETWEEN event_start_date AND event_end_date")->orderBy('event_start_date','ASC')->limit($limit)->offset($offset)->get();

        if($eventDay == 'month')
        $data['eventList'] = Event::where('status','Active')->whereBetween('event_start_date',[$firstDayMonth, $lastDayMonth])->orWhereBetween('event_end_date',[$firstDayMonth, $lastDayMonth])->orWhereRaw("'".$firstDayMonth."' BETWEEN event_start_date AND event_end_date")->orderBy('event_start_date','ASC')->limit($limit)->offset($offset)->get();
        if(count($data['eventList']) > 0)
        {
          echo view('front.events.event_list_ajax',$data);
        }
        else
        {
          echo "0";
        }
    }

}
