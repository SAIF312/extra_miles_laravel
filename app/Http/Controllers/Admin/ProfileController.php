<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
// use Alert;


class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');

    }
    public function update(Request $request)
    {
        $run = '';

        if(isset($request->name)){
            $run = auth()->user();
            auth()->user()->update(['name'=>$request->name]);
        }
        // if(isset($request->l_name)){
        //     $run = auth()->user();
        //     auth()->user()->update(['l_name'=>$request->l_name]);
        // }
        // auth()->user()->update(['name'=>auth()->user()->f_name.' '.auth()->user()->l_name]);
        // if(isset($request->email)){
        //     $run = auth()->user();
        //     auth()->user()->update(['email'=>$request->email]);
        // }
        if($request->hasFile('image')){
            $file      = $request->file('image');
            $file_path = $request->file('image')->store('public/uploads');
            $file_path = Storage::url($file_path);
            $flag = auth()->user()->update(['profile_img_url' => $file_path]);
          
            // Alert::success('Success', 'Profile Successfully Updated');
            return redirect()->back();
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
}
