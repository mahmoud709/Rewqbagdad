<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

use Illuminate\Support\Facades\Mail;
use App\Mail\AdminForgotPassword;
use Illuminate\Support\Facades\Cookie;

class AuthAdminController extends Controller
{

    public function __construct()
    {
        // $this->middleware('authadmin:home_show')->only('home');
        // $this->middleware('authadmin:error_403')->only('Error403');
    }

    public function home()
    {
        return view('admin.auth.home');
    }
    
    public function Error403(Request $request)
    {
        $url = $request->has('url')? $request->url : '';
        return view('admin.errors.403', compact('url'));
    }


    public function login()
    {
        if( auth('admin')->check() ):
            return redirect('/admin/home');
        endif;
        return view('admin.auth.login');
    }

    public function check(Request $request)
    {   
        // 
        $remembar = $request->remember ? true : false;
        if ( auth('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $remembar) ):
            $admin = Admin::where("email", $request->email)->first();
            auth('admin')->login($admin, $remembar);
            return redirect('/admin/home');
        endif;
        return back()->with('error', __('global.alert_error_login'));
    }

    public function ForgotPassword()
    {
        return view('admin.auth.forgot-password');
    }
    
    public function SendPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|max:100|exists:admins',
        ]);
        
        if (!Cookie::has('send-admin-pass') ) :
            Cookie::queue( Cookie::make('send-admin-pass', '', 1) );
        else:
            return back()->with('error', __('global.alert_wait_minute_to_send_another'));
        endif;
        $newPassword = rand(1234560, 6543210);
        $data = [
            'new_password'=> $newPassword,
            'is_admin'=> 'yes',
        ];
        Mail::to($request->email)->send(new AdminForgotPassword($data));

        Admin::where('email', $request->email)
        ->update([
            'password' => bcrypt($newPassword), 
        ]);
        return redirect('/admin/auth')->with('success', __('global.done_send_password'));
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect('/admin/auth');
    }

}
