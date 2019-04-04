<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        
        $comments = Comment::whereUserId(Auth::id())->get(); 
        return view('author.comments',compact('comments'));
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id == Auth::id())
        {
            $comment->delete();
            Toastr::success('Comment Successfully Deleted','Success');
        } else {
            Toastr::error('You are not authorized to delete this comment :(','Access Denied !!!');
        }
        return redirect()->back();
    }
}
