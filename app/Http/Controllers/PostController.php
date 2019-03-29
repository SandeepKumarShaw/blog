<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
	public function index(){
		$posts = Post::latest()->paginate(6);
		return view('posts', compact('posts'));
	}
    public function details($slug){
    	$post = Post::where('slug', $slug)->first();
    	$randomposts = Post::all()->random(3);
    	return view('post', compact('post','randomposts'));

    }
}
