<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function details($slug){
    	$post = Post::where('slug', $slug)->first();
    	$randomposts = Post::all()->random(3);
    	return view('post', compact('post','randomposts'));

    }
}
