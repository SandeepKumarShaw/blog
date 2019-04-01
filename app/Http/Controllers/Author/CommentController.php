<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
    	$posts = Auth::user()->posts;
    	return view('author.comments',compact('posts'));
    }
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        Toastr::success('Comment Successfully Deleted','Success');
        return redirect()->back();
    }
}
