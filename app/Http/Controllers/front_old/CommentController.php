<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image, File;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {

    }

    public function add(Request $request){

        $object = new Comment();
        $object->body = $request->comment;
        $object->user_id = auth()->guard('user')->user()->id;
        $object->commentable_id = $request->post_id;
        $object->commentable_type = 'App\Post';
        $object->save();    
        
        $data['record'] = $object;
        return view('front.comments.ajax-add',$data);
        
    }

}
