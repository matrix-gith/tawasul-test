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
        $weekStartDate  =  date("Y-m-d H:i:s", strtotime('monday this week'));
        $weekEndDate    =  date("Y-m-d 11:59:59", strtotime('sunday this week'));
        $firstDayMonth  = date('Y-m-01 00:00:00');
        $lastDayMonth   = date('Y-m-t 11:59:59');

        $fromDate   = $request->from;
        $toDate     = $request->end;

        if($request->route('username')!='' && $request->route('username')!= \Auth::guard('user')->user()->ad_username){
            $data['currentuser'] = User::where('ad_username', $request->route('username'))->first();
            $data['logedInUser'] = false;
            $data['isFollow'] = UserFollower::where('user_id',\Auth::guard('user')->user()->id)->where('follower_id', $data['currentuser']->id)->first();            
        }else{
            $data['currentuser'] = User::find(\Auth::guard('user')->user()->id);
            $data['logedInUser'] = true;          
        }

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

       

    	$data['eventList'] = Event::where('status','Active')->where('event_start_date', $today)->get();     	
        $data['tomorrowEventList'] = Event::where('status','Active')->where('event_start_date', $tomorrow)->get();
        $data['weekEventList'] = Event::where('status','Active')->whereBetween('event_start_date',[$weekStartDate, $weekEndDate])->get();

        $data['monthEventList'] = Event::where('status','Active')->whereBetween('event_start_date',[$firstDayMonth, $lastDayMonth])->get();

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

}
