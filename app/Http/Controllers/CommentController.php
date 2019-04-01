<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\User;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request, $post){
    	$this->validate($request,[
    		'comment' => 'required'            
    	]);
    	$comment = new Comment();
    	$comment->user_id = Auth::id();
    	$comment->post_id = $post;
    	$comment->comment = $request->comment;
    	$comment->save();
    	Toastr::success('Comment Successfully Publish:', 'success');
        return redirect()->back(); 
    }
}
