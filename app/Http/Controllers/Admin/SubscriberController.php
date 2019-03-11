<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Subscriber;
class SubscriberController extends Controller
{
    public function index(){
    	$subscribers = Subscriber::latest()->get();
    	return view('admin.subscriber',compact('subscribers'));
    }
    public function destroy($id){
    	Subscriber::findOrFail($id)->delete();
    	Toastr::success('Subscriber Successfully deleted:', 'success');
    	return redirect()->back();
    }
}
