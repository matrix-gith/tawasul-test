<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\Department;
use App\DepartmentTranslation;
use App\Designation;
use App\DesignationTranslation;
use App\Company;
use App\CompanyTranslation;
use App\GroupType;
use App\GroupTypeTranslation;


use Ixudra\Curl\Facades\Curl;


class LoginController extends Controller
{

	public function index()
	{ 
        if(\Auth::guard('user')->check())
        {
            return \Redirect::Route('home');
        }
		return view('front.users.login');
	}


    public function userLogin(Request $request)
    {    	        
        // $response = Curl::to('http://api.dev.tawasul.shurooq.gov.ae/api/userinfo')
        // ->withData( array( 'key' => 'ADF767DGH', 'username' => 'a.shabeer', 'password' => 'abc' ) )
        // ->asJson()
        //  ->get();

        //$arr = json_decode($response);
        //echo $response[0]->displayName;
        //dd($response);

    	$Validator = Validator::make($request->all(),[
    			'username' 	=> 'required',
    			'password'	=> 'required'
    		]);

    	if($Validator->fails())
    	{
    		$request->session()->flash('err_msg','Username or password is wrong');
    		return \Redirect::Route('login')->withErrors($Validator);
    	}
    	else
    	{

            $username = $request->input('username');
            $password = $request->input('password');

            $response = Curl::to('http://api.dev.tawasul.shurooq.gov.ae/api/userinfo')
                        ->withData( array( 'key' => 'ADF767DGH', 'username' => $username, 'password' => $password ) )
                        ->asJson()
                         ->get();
         //echo $response;
         if($response == 'Invalid password' || $response == 'Username or password is wrong')
         {
            $request->session()->flash('err_msg','Invalid Username or Password');
                return \Redirect::Route('login');
         }

         $user = User::where('ad_username', $username)->first();
         
         if($user != NULL)
         {
            if($user->password == NULL )
            {
                $user->password    = $password;
                $user->save();
            }

            $auth = auth()->guard('user')->attempt([
                'email'     => $user->email,
                'password'  => $password
            ]);            

            if($auth)
            {

                if($user->first_time_login == 'Yes')
                {
                    
                    $user->first_time_login = 'No';
                    $user->save();
                   
                    return \Redirect::Route('afterlogin');
                }
                else
                {
                    return \Redirect::Route('home');    
                }

                
            }
            else
            {
                $request->session()->flash('err_msg','Invalid Username or Password');
                return \Redirect::Route('login');
            }
         }

         else
         {

            $companyName     = $response[0]->userCompany;
            $departmentName  = $response[0]->userDepartment;
            $groupName       = $response[0]->userGroup;
            $userEmail       = $response[0]->userEmail;
            $display_name    = $response[0]->displayName; 
            $userTitle       = $response[0]->userTitle;   

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

            $designationDetails = DesignationTranslation::where('name', $userTitle )->get();

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
                    $designationDetails->name = $userTitle;
                    $designationDetails->save();
                }
                                
            }
            else
            {
                $designation_id = $designationDetails[0]->designation_id;
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

            $user = new User;
            $user->ad_username = $username; 
            $user->title       = $userTitle;
            $user->email       = $userEmail;
            $user->password    = bcrypt($password);
            $user->display_name = $display_name;
            $user->group_id    = $group_id;
            $user->company_id  = $company_id;
            $user->department_id = $department_id;
            $user->designation_id = $designation_id;
            $user->access_token  = \Hash::make(time());

            $user->save();
            $user->attachRole(5);

            $auth = auth()->guard('user')->attempt([
                'email'     => $user->email,
                'password'  => $password
            ]);             

            if($auth)
            {
                //$user = \Auth::user();
                return \Redirect::Route('afterlogin');
            }

            
         }

    		
    	}
    }

public function logout()
    { 

        \Auth::guard('user')->logout();
        return \Redirect::Route('login');
    }
    
}
