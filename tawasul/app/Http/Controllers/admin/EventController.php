<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Event;
use App\EventType;
use App\Language;
use App\EventImage;
use DB;
use Image;
use File;
use App\Notification;
use App\Feed;

class EventController extends Controller
{
    public $management = 'Event';
    public $breadcrumb;
    public $listMode = 'List';    
    public $createMode = 'Add';                                
    public $editMode = 'Edit';
    public $listUrl = 'event_list';

    public function __construct()
    {
        parent::__construct();
        $this->breadcrumb = $breadcrumb = [
                            'LISTPAGE' => 
                                [
                                    ['label' => 'List', 'url' => 'THIS']
                                ],
                            'CREATEPAGE' => 
                                [
                                    ['label' => $this->management.' '.$this->listMode, 'url' => \URL::route($this->listUrl)],
                                    ['label' => 'Create', 'url' => 'THIS']
                                ],                                 
                            'EDITPAGE' => 
                                [
                                    ['label' => $this->management.' '.$this->listMode, 'url' => \URL::route($this->listUrl)],
                                    ['label' => 'Edit', 'url' => 'THIS']
                                ]                                
                            ];

                            \View::share([
                                'management' => $this->management,
                                'breadcrumb' => $this->breadcrumb,
                            ]);

                            if(\Route::current()->getActionMethod()=='index'){
                                \View::share(['pageType' => $this->listMode]);                                
                            }elseif(\Route::current()->getActionMethod()=='add'){
                                \View::share(['pageType' => $this->createMode]); 
                            }elseif(\Route::current()->getActionMethod()=='edit'){
                                \View::share(['pageType' => $this->editMode]); 
                            }
    }

    public function index()
    {
    	$data['event_list'] = Event::get();
        
    	return view('admin.event.list',$data);
    }

    public function add()
    {
    	$data['eventtype_list'] = EventType::where('status','Active')->get();
    	return view('admin.event.add',$data);
    }


    public function store(Request $request)
    {
        
        $this->validate($request, [
                'event_image'   => 'max:2000',
                'event_image'   => 'dimensions:min_width=1250',
                'description.*' => 'required',
                'event_start_date' => 'required',
                'event_end_date' => 'required'
            ],
            [
                'event_image.max'           => 'Uploaded image size maximum 2MB allowed',
                'event_image.dimensions'    => 'Please select atleast 1250 pixel image',
                'description.en.required'   => 'Please enter event description for English',
                'description.ar.required'   => 'Please enter event description for Arabic'
            ]
        );

        $eventtype_id = $request->eventtype_id;
        $startDate      = $request->event_start_date;
        $endDate        = $request->event_end_date;

        $sDate = explode('-', $startDate) ;
        $startDate  = $sDate[2]."-".$sDate[1]."-".$sDate[0];
        $eDate = explode('-', $endDate);
        $endDate = $eDate[2]."-".$eDate[1]."-".$eDate[0];

        $start_time     = $request->start_time;
        $end_time       = $request->end_time;

        if(strtotime($startDate) > strtotime($endDate))
        {
            return \Redirect::Route('event_add')->withInput($request->input())->with('error', 'Event end date must be greater than start date');
        }
    
        if((strtotime($startDate) == strtotime($endDate)) && (strtotime($start_time) > strtotime($end_time)))
        {
            return \Redirect::Route('event_add')->withInput($request->input())->with('error', 'Event end time must be greater than start time');
        }

    	$event = new Event;
    	$event->type_id 	        = $eventtype_id;
        $event->user_id             = 1;
    	$event->status 		        = $request->status;
    	$event->event_start_date 	= $startDate;
        $event->event_end_date      = $endDate;
        $event->start_time          = $start_time;
        $event->end_time            = $end_time;
        $event->location            = $request->location;
        if($request->allday_event == 'Yes'){
            $event->allday_event       = $request->allday_event;
        }

    	//$event->save();
		foreach ($this->lang_locales as $locale) {
			$event->translateOrNew($locale->code)->name = $request->name[$locale->code];
			$event->translateOrNew($locale->code)->description = $request->description[$locale->code];
            $event->translateOrNew($locale->code)->short_description = $request->short_description[$locale->code];
		}
		$event->save();

        $notification = new Notification();
        $notification->notificationable_id = $event->id;
        $notification->notificationable_type = 'Event';
        $notification->text = 'a new event has been posted';
        $notification->added_by = 1;
        $notification->save();

    	if(Input::hasFile('event_image'))
        {
            $image = $request->file('event_image');
            //foreach ($imageArr as $key => $image) {            	
           
	            $imagename = mt_rand(1000,9999)."_".time().".".$image->getClientOriginalExtension();

	            $destinationPath = public_path('uploads/event_images');
	            $thumbPath = public_path('uploads/event_images/thumbnails');
                $listthumbPath = public_path('uploads/event_images/listthumb');
	            $detailsPath = public_path('uploads/event_images/details');
                $originalPath = public_path('uploads/event_images/original');

                $img = Image::make($image->getRealPath());
                $img->resize(1250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbPath.'/'.$imagename);               

                $img = Image::make($image->getRealPath());
                $img->resize(376, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($listthumbPath.'/'.$imagename); 

                $img = Image::make($image->getRealPath());
                $img->resize(1250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($detailsPath.'/'.$imagename); 

                $img = Image::make($image->getRealPath());
                $img->save($originalPath.'/'.$imagename);                                

	            //$image->move($destinationPath, $imagename);

	            $eventImage = new EventImage;
	            $eventImage->image_name = $imagename;
	            $eventImage->event_id = $event->id;
	            $eventImage->save();
        	//}
        }

        $feed = new Feed();
        $feed->user_id = 1;
        $feed->feedable_id = $event->id;
        $feed->type = 'Event';
        $feed->save();

    	return \Redirect::Route('event_list')->with('success', 'Event added successfully');

    }


    public function edit($id)
    {
		$data['eventtype_list'] = EventType::where('status','Active')->get();
    	$data['details'] = Event::find($id);
    	return view('admin.event.edit',$data);
    }

    public function update(Request $request,$id)
    {



        $this->validate($request, [
                'event_image'   => 'max:2000',
                'event_image'   => 'dimensions:min_width=1250',
                'description.*' => 'required',
                'event_start_date' => 'required',
                'event_end_date' => 'required'
            ],
            [
                'event_image.max'           => 'Uploaded image size maximum 2MB allowed',
                'event_image.dimensions'    => 'Please select atleast 1250 pixel image',
                'description.en.required'   => 'Please enter event description for English',
                'description.ar.required'   => 'Please enter event description for Arabic'
            ]
        );

        $eventtype_id   = $request->eventtype_id;
        $startDate      = $request->event_start_date;
        $endDate        = $request->event_end_date;
        $start_time     = $request->start_time;
        $end_time       = $request->end_time;

        $sDate = explode('-', $startDate) ;
        $startDate  = $sDate[2]."-".$sDate[1]."-".$sDate[0];
        $eDate = explode('-', $endDate);
        $endDate = $eDate[2]."-".$eDate[1]."-".$eDate[0];


        if(strtotime($startDate) > strtotime($endDate))
        {
            return \Redirect::Route('event_edit',$id)->with('error', 'Event end date must be greater than start date');
        }

        if((strtotime($startDate) == strtotime($endDate)) && (strtotime($start_time) > strtotime($end_time)))
        {
            return \Redirect::Route('event_edit',$id)->with('error', 'Event end time must be greater than start time');
        }
        
    	$event = Event::find($id);
    	$event->type_id 	       = $eventtype_id;
    	$event->status 		       = $request->status;
    	$event->event_start_date   = $startDate;
        $event->event_end_date     = $endDate;
        $event->start_time         = $start_time;
        $event->end_time           = $end_time;        
        $event->location           = $request->location;
        if($request->allday_event == 'Yes'){
            $event->allday_event       = $request->allday_event;
        }else
        {
            $event->allday_event       = 'No';
        }

    	$event->save();
		foreach ($this->lang_locales as $locale) {
			$event->translateOrNew($locale->code)->name = $request->name[$locale->code];
			$event->translateOrNew($locale->code)->description = $request->description[$locale->code];
            $event->translateOrNew($locale->code)->short_description = $request->short_description[$locale->code];
		}
		$event->save();

    	if(Input::hasFile('event_image'))
        {
            $image = $request->file('event_image');
            //foreach ($imageArr as $key => $image) {            	
           
	            $imagename = mt_rand(1000,9999)."_".time().".".$image->getClientOriginalExtension();

	            $destinationPath = public_path('uploads/event_images');
            
                $thumbPath = public_path('uploads/event_images/thumbnails');
                $listthumbPath = public_path('uploads/event_images/listthumb');
                $detailsPath = public_path('uploads/event_images/details');
                $originalPath = public_path('uploads/event_images/original');

                $img = Image::make($image->getRealPath());
                $img->resize(1250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbPath.'/'.$imagename);               

                $img = Image::make($image->getRealPath());
                $img->resize(376, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($listthumbPath.'/'.$imagename); 

                $img = Image::make($image->getRealPath());
                $img->resize(1250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($detailsPath.'/'.$imagename);  

                $img = Image::make($image->getRealPath());
                $img->save($originalPath.'/'.$imagename);                 

                $eventImage = EventImage::where('event_id', $event->id)->get();
                foreach ($eventImage as $key => $image) {
                    $file1 = 'uploads/event_images/'.$image->image_name;
                    $file2 = 'uploads/event_images/thumbnails/'.$image->image_name;
                    File::delete($file1, $file2);
                    $image->delete();
                }

	            $eventImage = new EventImage;
	            $eventImage->image_name = $imagename;
	            $eventImage->event_id = $event->id;
	            $eventImage->save();
        	//}
        }

    	return \Redirect::Route('event_list')->with('success', 'Event updated successfully');
    }

    public function delete($id)
    {
        $event = Event::find($id);
        $eventImage = EventImage::where('event_id', $id)->get();

		foreach ($eventImage as $key => $image) {			
		
        $file1 = 'uploads/event_images/'.$image->image_name;
        $file2 = 'uploads/event_images/thumbnails/'.$image->image_name;
        File::delete($file1, $file2);
        $image->delete();
        }
        $event->delete();
        return \Redirect::Route('event_list')->with('success', 'Record deleted successfully');   
    }

    public function delete_eventimage($id)
    {
    	$image = EventImage::find($id);
    	$file1 = 'uploads/event_images/'.$image->image_name;
        $file2 = 'uploads/event_images/thumbnails/'.$image->image_name;
        File::delete($file1, $file2);
        $image->delete();
        return \Redirect::Route('event_edit',$image->event_id)->with('success', 'Record deleted successfully');
    }
}
