<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
//use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\DB;
use App\Client;

//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
//use App\User;
//use Illuminate\Support\Facades\Auth;
//use Validator;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
class LoginController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function login(){ 
        $check_request = DB::table('tbl_clients_info')
                ->where('client_email', request('email'))
                ->Orwhere('client_contact_no', request('email'))
                ->get();

        if (count($check_request) > 0) {//dd('a');
            if (Auth::attempt(['client_email' => request('email'), 'client_password' => request('password')])) {
                dd('a');
            }
            else
            {
                dd('g');
            }
        }
        
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
        $user = Auth::user();
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        dd($user);
        
        }
        
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $check_request = DB::table('tbl_clients_info')
                ->where('client_email', request('email'))
                ->Orwhere('client_contact_no', request('email'))
                ->get();
//        dd($check_request);
        if(count($check_request)>0)
        {
          return array(['status_code' => 1,
              'message' => 'User Login Successfully',
              'data' => array('token' => $success['token'])
              ]);
        }
//        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
//            $user = Auth::user(); 
//            dd($user);
//            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
//            return response()->json(['success' => $success], $this-> successStatus); 
//        } 
//        else{ 
//            return response()->json(['error'=>'Unauthorised'], 401); 
//        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

}