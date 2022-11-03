<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Hash;
Use Alert;



class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');

    }
    public function update(Request $request)
    {
        $run = '';
        // dd($request->all());
        if(isset($request->name)){
            $run = auth()->user();
            auth()->user()->update(['name'=>$request->name]);
        }
        if($request->hasFile('image')){
            $old_image = auth()->user()->profile_img_url;
           
            $file      = $request->file('image');
            // $file_path = Storage::put('public/uploads', $file);
            $file_path = $request->file('image')->store('public/uploads');
            $file_path = Storage::url($file_path);
            $flag = auth()->user()->update(['profile_img_url' => $file_path]);
          
            // Alert::success('Success', 'Profile Successfully Updated');
            // return redirect()->back();
            if($old_image != null && $flag){
                if(file_exists(public_path().$old_image)) unlink(public_path().$old_image);
            }
        }
        if($run){
            // Alert::success('Success', 'Profile Successfully Updated');
            return redirect()->back();

        }
        else{
            // Alert::info('info', 'Nothing to update');
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request)
    {
        $run = '';
        if(Hash::check( $request->old_password,  auth()->user()->password)){
            if($request->new_password != $request->password_confirmation ){
                Alert::error('Wrong info', 'confirm password does not match');
                return redirect()->back();
            }
            $run = auth()->user()->update(['password'=> Hash::make($request->new_password)]);
        }
        else{
            Alert::error('Wrong info', 'Old password mismatch');
            return redirect()->back();
        }
        if($run){
            Alert::success('Success', 'Profile Successfully Updated');
            return redirect()->back();
        }
        else{
            Alert::info('info', 'Nothing to update');
            return redirect()->back();
        }
    }
}
