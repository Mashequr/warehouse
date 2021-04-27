<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewprofile()
    {
        return view('profile');
    }

    public function changeavatar(Request $request)
    {
        //dd($request->avatar->getClientOriginalName());
        try{
            $file = $request->avatar;
            $path = 'storage/avatar/';
            $filename = $path.$file->getClientOriginalName();
            DB::table('users')->where('email', Auth()->user()->email)->update(['avatar'=>$filename]);
            $file->move($path,$filename);
            return redirect(route('admin_profile'))->with('success','Avatar Changed Successfully');
        }
        catch(Exception $e)
        {
            dd($e);
            return redirect(route('admin_profile'))->with('failed','Operation Error!!!');
        }
    }

    public function changepassword(Request $request)
    {
        if($request->new_pass == $request->conf_pass)
        {
            if(Hash::check($request->curr_pass, Auth()->user()->password))
            {
                $new_pass = Hash::make($request->new_pass);
                DB::table('users')->where('email', Auth()->user()->email)->update(['password'=>$new_pass]);
                return redirect(route('admin_profile'))->with("success","Password Changed Successfully");
            }
            else
            {
                return redirect(route('admin_profile'))->with("failed","Incorrect Password !!!");
            }
        }
        else
        {
            return redirect(route('admin_profile'))->with("failed","Password Didn't Match");
        }
    }

}
