<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Illuminate\Support\Str;
use Session;

class LoginController extends Controller
{
    public function index()
    {
    	return view('Login.login');
    }
    public function check(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);  
        $data2 = session('email',$request->email);
        
        //$data = $request->session()->get('email');

        $email = $request->input('email');
        $password = md5($request->password);
        $e = DB::table('users')->value('email');
        $pass = DB::table('users')->value('password');
        if($email == $e && $password ==  $pass)
        {
            return redirect('all_admin_users')->with($data2);;
        }
        else
        {
            return redirect('/login');
        }
        //return response()->json(url($redirect));

    }
    public function forgot_password()
    {
        return view('Login.forgot_password');
    }
    public function verify_email(Request $request)
    {
        $user = DB::table('users')->where('email',$request->email)->first();
        //dd($user);
        if(count($user) == 0)
        {
            return redirect()->back()->with(['error' => 'Email Not Exists']);
        }       
    }
    public function sendEmail(Request $request)
    {
        $token = Str::random('40');
        $email = $request->email;
        $user = DB::table('users')->where('email',$request->email)->first();
        $user_mail = $user->email;
        if($email == $user_mail)
        {
        Mail::send(['html' => 'email'], [ 'token' => $token ], function ($message) use ($email) {
                $message->from('dipsha.kalariya@aliansoftware.com', 'Test Mail');
                $message->to($email)->subject('confirmation Mail');
            });
        return redirect()->back()->withErrors([ 'mail'=>'We send you confirmation link in your email please confirm it first' ]);
        }
        else
        {
            return redirect()->back()->withErrors([ 'error' => 'There is some problem ']);
        }
    }
}
