<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;


class SettingsController extends Controller
{
    public function index()
    {
    	return view('admin.settings');
    }
    public function updateProfile(Request $request){
    	$this->validate($request,[
         'name' => 'required',
         'email' => 'required|email',
         'image' => 'required|image'
    	]);

    	$image = $request->file('image');
    	$slug = str_slug($request->name);
    	$user = User::findOrFail(Auth::id());

    	if(isset($image)){
            //make unique name image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!storage::disk('public')->exists('profile')){
                storage::disk('public')->makeDirectory('profile');
            }
            //Delete Old Post Image
            if(storage::disk('public')->exists('profile/'.$user->image)){
                storage::disk('public')->delete('profile/'.$user->image);
            }
            $profile = Image::make($image)->resize(500,500)->save($imageName, 90);
            Storage::disk('public')->put('profile/'.$imageName,$profile);
        }else{
            $imageName = $user->image;
        }
        $user->name = $request->name;
        $user->email  = $request->email;
        $user->image = $imageName;
        $user->about  = $request->about;        
        $user->save();     

        Toastr::success('User Profile Successfully Updated:', 'success');
        return redirect()->back(); 
    }
    public function updatePassword(Request $request){
        $this->validate($request,[
         'old_password' => 'required',
         'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword)){
            if(!Hash::check($request->password,$hashedPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('User Password Successfully Updated:', 'success');
                Auth::logout();
                return redirect()->back(); 
            }else{
                Toastr::error('New Password not matched with confirm password:', 'Error');
                return redirect()->back(); 
            }
        }else{
                Toastr::error('Current Password is not matched::', 'Error');
                return redirect()->back(); 
        }

    }
}
