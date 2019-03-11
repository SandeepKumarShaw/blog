<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'title' => 'required',
          'image' => 'required|mimes:jpeg,png,jpg,bmp',
          'categories' => 'required',
          'tags' => 'required',
          'body' => 'required'

        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            //make unique name image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!storage::disk('public')->exists('post')){
                storage::disk('public')->makeDirectory('post');
            }
            $postImage = Image::make($image)->resize(1600,1066)->save();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{
            $imageName = "default.png";
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug  = $slug;
        $post->image = $imageName;
        $post->body  = $request->body;
        if (isset($request->status)) {
             $post->status  = true;
        } else {
             $post->status  = false;
        }
        $post->is_approved  = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Post Successfully Save:', 'success');
        return redirect()->route('admin.post.index'); 
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
          'title' => 'required',
          'image' => 'image',
          'categories' => 'required',
          'tags' => 'required',
          'body' => 'required'

        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image)){
            //make unique name image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!storage::disk('public')->exists('post')){
                storage::disk('public')->makeDirectory('post');
            }
            //Delete Old Post Image
            if(storage::disk('public')->exists('post/'.$post->image)){
                storage::disk('public')->delete('post/'.$post->image);
            }

            $postImage = Image::make($image)->resize(1600,1066)->save();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{
            $imageName = $post->image;
        }
       
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug  = $slug;
        $post->image = $imageName;
        $post->body  = $request->body;
        if (isset($request->status)) {
             $post->status  = true;
        } else {
             $post->status  = false;
        }
        $post->is_approved  = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated:', 'success');
        return redirect()->route('admin.post.index'); 
    }
    public function pending(){
        $posts =Post::where('is_approved', false)->get();
        return view('admin.post.pending',compact('posts'));
    }
    public function approval($id){
        $post = Post::find($id);
        if($post->is_approved == false){
            $post->is_approved = true;
            $post->save();
            Toastr::success('Post Successfully Approved:', 'success');
        }else{
             Toastr::info('This Post is already Approved:', 'info');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //$post = Post::find($id);

        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        
        Toastr::success('Post Successfully Deleted:', 'success');
        return redirect()->route('admin.post.index');
    }
}