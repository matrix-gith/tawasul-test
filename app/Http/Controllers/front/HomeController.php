<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;

use App\Department;
use App\DepartmentTranslation;
use App\Company;
use App\CompanyTranslation;
use App\GroupType;
use App\GroupTypeTranslation;
use App\Designation;
use App\DesignationTranslation;
use App\Feed;

use App\Notification, App\User, App\Event;
 

class HomeController extends Controller
{
    public function index()
    {
        // echo date('H:i:s');
        // echo time_elapsed_string('2017-10-24 11:10:56');
        // exit;

        //$u = User::find(673);
        //dd($u->tickets);

//         $notification = Notification::with(['tickets' => function ($query) {
//     $query->where('id', '22');
// },'events'])->get();
        // $data['department_id'] = 2;
        // $notification = Notification::where(function ($query) use ($data) {
        //         $query->where('notificationable_type', 'App\Ticket')->where('department_id',$data['department_id'])->with(['tickets']);
        //         })->orWhere(function ($query) {
        //             $query->where('notificationable_type', 'App\Event')->with(['events']);
        //         })->get();

        // echo '<pre/>'; 
        // dd($notification);

        // foreach ($notification as $key => $value) {
        //     //print_r($value->events);
        // }
        // exit;
       // $data['events'] = Event::orderBy('id','desc')->wherein('id',[20,21,27,28,34,33])->get();
        

//         $feeds = Feed::join('tickets', function($join)
//         {
//             $join->on('feeds.feedable_id', '=', 'tickets.id')
//                  ->where('feeds.type', 'Ticket');
//         })
//         ->join('events', function($join)
//         {
//             $join->on('feeds.feedable_id', '=', 'events.id')
//                  ->where('feeds.type', 'Event');
//         })->with('events')
//         ->get();

// echo '<pre/>';
//         foreach ($feeds as $key => $value) {
//             print_r($value->events);
//         }


        // $feeds = Feed::wherehas('tickets', function($query) {
        //     $query->where('feeds.type','Ticket')->with('tickets');
        // })
        // ->orwherehas('events', function($query) {
        //     $query->where('feeds.type','Event')->with('events');
        // })
        // ->get();

       //  $feeds = Feed::with(['tickets' => function($query) {
       //      $query->with('feeds');
       //  }])
       // // ->with(['events'])
       //  ->get();     
        

        $data['feeds'] = Feed::orderBy('id','desc')->get();

       // dd($feeds);

        //exit;


        $data['events'] = Event::orderBy('id','desc')->where('status','Active')->get();
    	return view('front.home',$data);
    }


    /////////////******************* Insert data from Api *******************************////////////

    public function saveDepartment()
    {
    	$response = Curl::to('http://api.dev.tawasul.shurooq.gov.ae/api/departments')
                        ->withData( array( 'key' => 'ADF767DGH' ) )
                        ->asJson()
                         ->get();
    

        foreach ($response as $key => $res) {
        	$departmentName  = $res->Department;
        
        	$departmentDetails = DepartmentTranslation::where('name', $departmentName )->get();

            if($departmentDetails->count() == 0)
            {
                $department        = new Department;
                

                $department->status = 'Active';
                $department->save();
                $department_id = $department->id;

                foreach ($this->lang_locales as $locale) {
                    $departmentDetails = new DepartmentTranslation;
                    $departmentDetails->department_id = $department->id;
                    $departmentDetails->locale = $locale->code;
                    $departmentDetails->name = $departmentName;
                    $departmentDetails->save();
                }
                                
            }
        }

    }

    public function saveCompany()
    {
    	$response = Curl::to('http://api.dev.tawasul.shurooq.gov.ae/api/companies')
                        ->withData( array( 'key' => 'ADF767DGH' ) )
                        ->asJson()
                         ->get();
    

        foreach ($response as $key => $res) {
        	$companyName     = $res->Company;
        
        	$CompanyDetails = CompanyTranslation::where('name', $companyName )->get();

            if($CompanyDetails->count() == 0)
            {
                $company        = new Company;            

                $company->status = 'Active';
                $company->save();
                $company_id = $company->id;

                foreach ($this->lang_locales as $locale) {
                    $CompanyDetails = new CompanyTranslation;
                    $CompanyDetails->company_id = $company->id;
                    $CompanyDetails->locale = $locale->code;
                    $CompanyDetails->name = $companyName;
                    $CompanyDetails->save();
                }
                
                
            }
        }

    }

    public function saveGroup()
    {
    	$response = Curl::to('http://api.dev.tawasul.shurooq.gov.ae/api/groups')
                        ->withData( array( 'key' => 'ADF767DGH' ) )
                        ->asJson()
                         ->get();
    

        foreach ($response as $key => $res) {
        	$groupName       = $res->Group;
        
        	$grouptypeDetails = GroupTypeTranslation::where('name', $groupName )->get();

            if($grouptypeDetails->count() == 0)
            {
               
                $grouptype        = new GroupType;               

                $grouptype->status = 'Active';
                $grouptype->save();
                $group_id = $grouptype->id;

                foreach ($this->lang_locales as $locale) {
                    $grouptypeDetails = new GroupTypeTranslation;
                    $grouptypeDetails->group_type_id = $grouptype->id;
                    $grouptypeDetails->locale = $locale->code;
                    $grouptypeDetails->name = $groupName;
                    $grouptypeDetails->save();
                }
                
                
            }
        }

    }

    public function saveDesignation()
    {
    	$response = Curl::to('http://api.dev.tawasul.shurooq.gov.ae/api/designations')
                        ->withData( array( 'key' => 'ADF767DGH' ) )
                        ->asJson()
                         ->get();
    

        foreach ($response as $key => $res) {
        	$designationName  = $res->Designation;
        
        	$designationDetails = DesignationTranslation::where('name', $designationName )->get();

            if($designationDetails->count() == 0)
            {
                $designation        = new Designation;
                

                $designation->status = 'Active';
                $designation->save();
                $designation_id = $designation->id;

                foreach ($this->lang_locales as $locale) {
                    $designationDetails = new DesignationTranslation;
                    $designationDetails->designation_id = $designation->id;
                    $designationDetails->locale = $locale->code;
                    $designationDetails->name = $designationName;
                    $designationDetails->save();
                }
                                
            }
        }

    }

    public function saveUser()
    {
    	$response = Curl::to('http://api.dev.tawasul.shurooq.gov.ae/api/allusers')
                        ->withData( array( 'key' => 'ADF767DGH' ) )
                        ->asJson()
                         ->get();
                     
        foreach ($response as $key => $res) {

    		$companyName     = $res->userCompany;
            $departmentName  = $res->userDepartment;
            $groupName       = $res->userGroup;
            $userEmail       = $res->userEmail;
            $display_name    = $res->displayName; 
            $userTitle       = $res->userTitle;   


            $CompanyDetails = CompanyTranslation::where('name', $companyName )->get();
          
            if($CompanyDetails->count() == 0)
            {
                $company        = new Company;
                


                $company->status = 'Active';
                $company->save();
                $company_id = $company->id;

                foreach ($this->lang_locales as $locale) {
                    $CompanyDetails = new CompanyTranslation;
                    $CompanyDetails->company_id = $company->id;
                    $CompanyDetails->locale = $locale->code;
                    $CompanyDetails->name = $companyName;
                    $CompanyDetails->save();
                }
                
                
            }
            else
            {
                $company_id = $CompanyDetails[0]->company_id;
            }
           

            $departmentDetails = DepartmentTranslation::where('name', $departmentName )->get();

            if($departmentDetails->count() == 0)
            {
                $department        = new Department;
                

                $department->status = 'Active';
                $department->save();
                $department_id = $department->id;

                foreach ($this->lang_locales as $locale) {
                    $departmentDetails = new DepartmentTranslation;
                    $departmentDetails->department_id = $department->id;
                    $departmentDetails->locale = $locale->code;
                    $departmentDetails->name = $departmentName;
                    $departmentDetails->save();
                }
                                
            }
            else
            {
                $department_id = $departmentDetails[0]->department_id;
            }


            $grouptypeDetails = GroupTypeTranslation::where('name', $groupName )->get();

            if($grouptypeDetails->count() == 0)
            {
               
                $grouptype        = new GroupType;               

                $grouptype->status = 'Active';
                $grouptype->save();
                $group_id = $grouptype->id;

                foreach ($this->lang_locales as $locale) {
                    $grouptypeDetails = new GroupTypeTranslation;
                    $grouptypeDetails->group_type_id = $grouptype->id;
                    $grouptypeDetails->locale = $locale->code;
                    $grouptypeDetails->name = $groupName;
                    $grouptypeDetails->save();
                }
                
                
            }
            else
            {
                
                $group_id = $grouptypeDetails[0]->group_type_id;
            }
            

            $expEmail = explode('@',$userEmail);
            $username = $expEmail[0];
            $userDetails = User::where('ad_username', $username )->get();
 			
 			//dd($userDetails);
            if($userDetails->count() == 0)
            {
	            $user = new User;
	            $user->ad_username = $username; 
	            $user->title       = $userTitle;
	            $user->email       = $userEmail;
	            //$user->password    = bcrypt($password);
	            $user->display_name = $display_name;
	            $user->group_id    = $group_id;
	            $user->company_id  = $company_id;
	            $user->department_id = $department_id;
	            $user->access_token  = \Hash::make(time());

	            $user->save();
        	}
        }
    }

    /////////////******************* Insert data from Api *******************************////////////

}
