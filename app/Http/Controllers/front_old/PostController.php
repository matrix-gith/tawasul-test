<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image, File;
use App\Post, App\Feed;

class PostController extends Controller
{
    public function index()
    {

    }

    public function add(Request $request){

        $object = new Post();
        $object->text = $request->text;
        $object->user_id = auth()->guard('user')->user()->id;

        if($request->file('post_image'))
        {
            $image = $request->file('post_image');                   
            $imagename = auth()->guard('user')->user()->id.'_'.mt_rand(1000,9999)."_".time().".".$image->getClientOriginalExtension();
            $thumbPath = public_path('uploads/posts/thumbnails');
            $originalPath = public_path('uploads/posts/original');

            $img = Image::make($image->getRealPath());
            $img->resize(376, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath.'/'.$imagename);               

            $img = Image::make($image->getRealPath());
            $img->save($originalPath.'/'.$imagename);                                

            $object->image = $imagename;
        }

        $object->save();

        $feed = new Feed();
        $feed->user_id = auth()->guard('user')->user()->id;
        $feed->feedable_id = $object->id;
        $feed->type = 'Post';
        $feed->save();        
        
        $data['record'] = $object;
        return view('front.posts.ajax-post',$data);
        
    }

}
