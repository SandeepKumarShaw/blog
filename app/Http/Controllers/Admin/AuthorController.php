<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use App\Post;
use App\Comment;
class AuthorController extends Controller
{
    public function index(){
    	$authors = User::authors()
			        ->withCount('posts')
			        ->withCount('comments')
			        ->withCount('favorite_posts')
			    	->get();
	    return view('admin.authors', compact('authors'));		    	
    }
    public function destroy($id){
    	$author = User::findOrFail($id)->delete();
    	Toastr::success('Author Successfully Deleted:', 'success');
        return redirect()->route('admin.author.index');
    }
}
