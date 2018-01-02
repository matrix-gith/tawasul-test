<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GroupUser;
use App\UserGroupUser;
use App\Language;


class GroupController extends Controller {
    public function index($keyword='',Request $request) {       
        $groups = array();
        if($keyword =='') {
            $keyword ='all';
        }       
        $data = array();  
        $user_id = \Auth::guard('user')->user()->id;      
        if($keyword=='all') {          
          // $groups = UserGroupUser::where('user_id',$user_id)->get();  
           
           $groups =UserGroupUser::select('ugu.group_id','grpusertr.group_user_id','ugu.user_id',
                                    'grpuser.department_id','grpuser.group_type_id',
                                    'grpuser.owner_id','grpusertr.group_name','grpusertr.group_description','grpusertr.locale','grpuser.cover_image','grpuser.created_at')
                            ->from('user_group_users as ugu') 
                            ->join('group_users as grpuser','grpuser.id', '=', 'ugu.group_id')
                            ->join('group_user_translations as grpusertr','grpusertr.group_user_id', '=', 'grpuser.id')
                            ->where('ugu.user_id',$user_id)->paginate(6);        
          
        }
        elseif($keyword=='global') {
             $groups =UserGroupUser::select('ugu.group_id','ugu.user_id',
                                    'grpuser.department_id','grpuser.group_type_id','grpusertr.group_user_id',
                                    'grpuser.owner_id','grpusertr.group_name','grpusertr.group_description','grpusertr.locale','grpuser.cover_image','grpuser.created_at')
                            ->from('user_group_users as ugu') 
                            ->join('group_users as grpuser','grpuser.id', '=', 'ugu.group_id')
                            ->join('group_user_translations as grpusertr','grpusertr.group_user_id', '=', 'grpuser.id')
                            ->where('ugu.user_id',$user_id)
                            ->where('grpuser.group_type_id',1)
                            ->paginate(6);    

        }
        elseif($keyword=='departmental') {
             $groups =UserGroupUser::select('ugu.group_id','ugu.user_id','grpusertr.group_user_id',
                                    'grpuser.department_id','grpuser.group_type_id',
                                    'grpuser.owner_id','grpusertr.group_name','grpusertr.group_description','grpusertr.locale','grpuser.cover_image','grpuser.created_at')
                            ->from('user_group_users as ugu') 
                            ->join('group_users as grpuser','grpuser.id', '=', 'ugu.group_id')
                            ->join('group_user_translations as grpusertr','grpusertr.group_user_id', '=', 'grpuser.id')
                            ->where('ugu.user_id',$user_id)
                            ->where('grpuser.group_type_id',2)
                            ->paginate(6);  

        }
        elseif($keyword=='own'){
            $groups =GroupUser::select(
                                    'grpuser.department_id','grpuser.group_type_id','grpuser.owner_id as user_id',
                                    'grpuser.owner_id','grpusertr.group_name','grpusertr.group_description','grpusertr.locale','grpuser.cover_image','grpuser.created_at','grpusertr.group_user_id as group_id')
                            ->from('group_users as grpuser')                             
                            ->join('group_user_translations as grpusertr','grpusertr.group_user_id', '=', 'grpuser.id')
                            ->where('grpuser.owner_id',$user_id)                            
                            ->paginate(6);  
           // $groups =GroupUser::where('owner_id',$user_id)->paginate(6);               
        }
        else{
             $groups =UserGroupUser::select('ugu.group_id','ugu.user_id','grpusertr.group_user_id',
                                    'grpuser.department_id','grpuser.group_type_id',
                                    'grpuser.owner_id','grpusertr.group_name','grpusertr.group_description','grpusertr.locale','grpuser.cover_image','grpuser.created_at')
                            ->from('user_group_users as ugu') 
                            ->join('group_users as grpuser','grpuser.id', '=', 'ugu.group_id')
                            ->join('group_user_translations as grpusertr','grpusertr.group_user_id', '=', 'grpuser.id')
                            ->where('ugu.user_id',$user_id)
                            ->where('grpuser.group_type_id',3)
                            ->paginate(6);    
        }

        //print_r($groups);die;
        $data['groups'] = $groups;
        $data['group_type'] = $keyword;
        if ($request->ajax()) { 

            return view('front.groups.data_group',$data);
            //$view = view('front.groups.data_group',$data)->render();
            //return response()->json(['html'=>$view]);
        }
        //print_r($data);
        $data['groups'] = [];
        return view('front.groups.group_list',$data);
    }

    public function details($groupid ,Request $request) {  
        $group_id = $this->decodeid($groupid);
        $data=array();
        $group_details=GroupUser::select('grpuser.department_id','grpuser.group_type_id','grpuser.owner_id','grpusertr.group_name','grpusertr.group_description','grpusertr.locale','grpuser.cover_image','grpuser.created_at')
        ->from('group_users as grpuser')
        ->join('group_user_translations as grpusertr','grpusertr.group_user_id', '=', 'grpuser.id')
        ->where('grpuser.id',$group_id)
        ->get();
       // print_r($group_details);die;
        //$group_details=GroupUser::find($group_id);
        $group_memebers = UserGroupUser::where('group_id',$group_id)->get(); 
        $data['group_details'] = $group_details;
        $data['group_memebers']= $group_memebers;
        return view('front.groups.group_details',$data);

    }
    public function add(Request $request) { 
    $data=array(); 
        return view('front.groups.group_add',$data);
    }
    public function decodeid($group_id)
    {       
         $var = base64_decode($group_id);
         $varnew = ( $var - 100 );
         return $varnew;
    }
   

}
