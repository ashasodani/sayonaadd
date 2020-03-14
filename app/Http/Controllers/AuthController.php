<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
 
class AuthController extends Controller
{
 
    public function index()
    {
        return view('Login.login');
    }  
 
    // public function registration()
    // {
    //     return view('registration');
    // }
     
    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
		
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
			return redirect()->intended('all_admin_users');
			// if(Auth()->user()->role == 'admin'){
			// 	return redirect()->intended('admindashboard');
			// }
   //          if(Auth()->user()->role == 'user'){
			// 	return redirect()->intended('dashboard');
			// }
        }
		return redirect()->back()->with('message', 'Opps! You have entered invalid credentials!');
    }
 
  //   public function postRegistration(Request $request)
  //   {  
  //       request()->validate([
		// 'fname'=>'required',
		// 'lname'=>'required',
  //       'username' => 'required|unique:users',
  //       'email' => 'required|email|unique:users',
  //       'password' => 'required|confirmed|min:6',
		// 'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
		// 'password_confirmation' => 'required|min:6',
		// 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
  //       ]);
         
  //       $data = $request->all();
 
  //       $check = $this->create($data);
       
  //       //return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
		// return redirect()->back()->with('message', 'Great! You have successfully registered');
  //   }
     
 //    public function dashboard()
 //    {
 
 //      if(Auth::check()){
 //        return view('dashboard');
 //      }       
	//    return redirect()->back()->with('message', 'Opps! You do not have access');
 //    }
	// public function admindashboard()
 //    {
 
 //      if(Auth::check()){
 //        return view('admindashboard');
 //      }       
	//    return redirect()->back()->with('message', 'Opps! You do not have access');
 //    }
 
  //   public function create(array $data)
  //   {
  //     return User::create([
		// 'fname' => $data['fname'],
		// 'lname' => $data['lname'],
  //       'username' => $data['username'],
  //       'email' => $data['email'],
  //       'password' => Hash::make($data['password']),
		// 'phone' => $data['phone'],		
  //     ]);
  //   }
     
  //   public function logout() {
  //       Session::flush();
  //       Auth::logout();
  //       return Redirect('login');
  //   }
}