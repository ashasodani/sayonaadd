<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
// use App\Client; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
class UserLoginController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        $user_type = request('user_type');
        if($user_type == 'client')
        {
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                $user = Auth::user();
                $chk=DB::table('tbl_clients_info')->where('email',request('email'))->get();
                // dd($chk);
                if(count($chk)>0)
                {
                    $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                    $data[]=array('token' => $success['token'],'name' => $chk[0]->client_name,'email' => $chk[0]->email,'phone_no' =>$chk[0]->client_contact_no);
                    // $data=array('token' => $success['token']);
                    return array(['status_code' => 1, 'message' => 'User Login Successfully', 'data' => $data]);                     
                }
                else
                {
                    return array(['status_code' => 0, 'message' => 'User Credentials Incorrect']);
                }
                 // echo 'client user Auth success';
                
            }
            else if (Auth::attempt(['phone_no' => request('email'), 'password' => request('password')])) {
                $user = Auth::user();//dd($user);
                $chk=DB::table('tbl_clients_info')->where('client_contact_no',request('email'))->first();
                // dd($chk);
                if(count($chk)>0)
                {
                    
                    $success['token'] =  $user->createToken('MyApp')-> accessToken;
                    $data[]=array('token' => $success['token'],'name' => $chk[0]->client_name,'email' => $chk[0]->email,'phone_no' =>$chk[0]->client_contact_no);
                    return array(['status_code' => 1, 'message' => 'User Login Successfully', 'data' => $data]);                     
                }
                else
                {
                    return array(['status_code' => 0, 'message' => 'User Credentials Incorrect']);
                }
            }
            else{
                return array(['status_code' => 0, 'message' => 'User Credentials Incorrect']);
            }
        }   
        if($user_type == 'ct_user')
        { 
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                $user = Auth::user();
                $chk1=DB::table('tbl_ct_info')->where('ct_email',request('email'))->get();
                // dd($chk1);
                if(count($chk1)>0)
                {
                    
                    $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                    $data[]=array('token' => $success['token'],'name' => $chk1[0]->ct_name,'email' => $chk1[0]->ct_email,'phone_no' =>$chk1[0]->ct_contact_info);
                    return array(['status_code' => 1, 'message' => 'User Login Successfully', 'data' => $data]);     
                 }
                 else
                 {
                    return array(['status_code' => 0, 'message' => 'User Credentials Incorrect']);                     
                 }

            }
            else if (Auth::attempt(['phone_no' => request('email'), 'password' => request('password')])) {
// dd('5');
                $user = Auth::user();
                $chk1=DB::table('tbl_ct_info')->where('ct_contact_info',request('email'))->first();
                // dd($chk1);
                if(count($chk1)>0)
                {
                    $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                    $data=array('token' => $success['token']);
                    return array(['status_code' => 1, 'message' => 'User Login Successfully', 'data' => $data]);     
                 }
                 else
                 {
                    return array(['status_code' => 0, 'message' => 'User Credentials Incorrect']);                     
                 }
            }
            else{
                return array(['status_code' => 0, 'message' => 'User Credentials Incorrect']);
            }
           
        }
    }
}