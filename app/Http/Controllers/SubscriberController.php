<?php

namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use App\Subscriber;
class SubscriberController extends Controller
{
    public function store(Request $request)
    {
    	//return $request->all();
    	$this->validate($request,[
          'email' =>'required|email|unique:subscribers'
    	]);

    	$subscriber = new Subscriber();
    	$subscriber->email = $request->email;
    	$subscriber->save();
    	Toastr::success('You have Successfully Added to Our Subscriber List:', 'success');
    	return redirect()->back();

    }
}
