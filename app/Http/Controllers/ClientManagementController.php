<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientManagementController extends Controller
{
    //ADD NEW CLIENT MODULE
    public function callAddNewClientTemplate(Request $request)
    {
        $getCTList = DB::table('tbl_ct_info')->where('is_delete','=', 0)->select('pk_ct_info_id', 'ct_name')->get();
        $c_count = DB::table('tbl_clients_info')->count(); 
        return view('ClientManagement.AddNewClient', compact('getCTList','c_count'));
    }

    public function getAjaxServiceGroup(Request $req){        
        $getServiceGroupList = DB::table('tbl_service_group')->where('is_delete','=', 0)->select('pk_service_group_id', 'service_grp_name')->get();
        return response()->json(array('getServiceGroupList' => $getServiceGroupList));
    }

    //SAVE NEW CLIENT
    public function storeNewClient(Request $request)
    {
        //dd($_REQUEST);
        $c_view_clientID = $request->get('d_view_client_id');
        $c_name = $request->get('d_clnt_Name');
        $c_contact = $request->get('d_clnt_contact');
        $c_email = $request->get('d_clnt_email');
        $dob = $request->get('d_clnt_dob');
        $c_dob = date('Y-d-m',strtotime($dob));    
        $c_age = $request->get('d_clnt_age');        
        $c_gender = $request->get('d_clnt_gender');
        $c_address = $request->get('d_clnt_address');
        $c_city = $request->get('d_clnt_city');
        $c_state = $request->get('d_clnt_state');
        $c_country = $request->get('d_clnt_country');
        $c_health = $request->get('d_clnt_health');
        $c_kin_name = $request->get('d_clnt_next_of_kin_name');
        $c_kin_number = $request->get('d_clnt_next_of_kin_number');
        $c_kin_email = $request->get('d_clnt_next_of_kin_email');
        $c_ct = $request->get('d_clnt_CT');
        $c_rec_balance = $request->get('d_clnt_receive_balance');
        if ($c_rec_balance == '') {
            $c_rec_balance = 0;
        }
        $c_clnt_paymode = $request->get('d_clnt_paymode');
        
        $c_service_group = $request->get('d_services_group');       
        $c_service_name = $request->get('d_services_name');
        $c_service_arrTask = $request->get('arrTask');        
        $c_service_time_allocate = $request->get('d_services_time_allocate');
        $c_service_date = $request->get('d_date_new_service');       
        $c_service_task_desc = $request->get('d_service_task_desc');
       
       

        $data = array();
        $len = count($c_service_group);
        for ($i = 0; $i < $len; $i++) {
            
            $data[$i]['c_service_group'] = $c_service_group[$i];
            $data[$i]['c_service_name'] = $c_service_name[$i];
            $data[$i]['c_service_arrTask'] = $c_service_arrTask[$i];
            $data[$i]['c_service_time_allocate']= $c_service_time_allocate[$i];
            $data[$i]['c_service_date'] = date('Y-m-d',strtotime(str_replace('/','-',$c_service_date[$i])));
            $data[$i]['c_service_task_desc']= $c_service_task_desc[$i];
        }  
       
        $checkClient = DB::table('tbl_clients_info')->where('client_email', $c_email)->first();
        if (!$checkClient) {
            $clientID = DB::table('tbl_clients_info')->insertGetId([
                'client_name' => $c_name,
                'client_view_id' => $c_view_clientID,             
                'client_contact_no' => $c_contact,
                'client_email' => $c_email,
                'client_dob' => $c_dob,
                'client_age' => $c_age,
                'client_gender' => $c_gender,
                'client_address' => $c_address,
                'client_city' => $c_city,
                'client_state' => $c_state,
                'client_country' => $c_country,
                'health_conditions' => $c_health,
                'kin_name' => $c_kin_name,
                'kin_phone_no' => $c_kin_number,
                'kin_email' => $c_kin_email,
                'fk_ct_id' => $c_ct,
                'received_amount' => $c_rec_balance,
                'client_payment_mode' => $c_clnt_paymode
            ]);
            
            foreach ($data as $c_data) {
                DB::table('tbl_client_services')->insertGetId([
                    'fk_client_id' => $clientID,
                    'fk_service_grp_id' => $c_data['c_service_group'],
                    'fk_service_id' => $c_data['c_service_name'],
                    'fk_task_id' => $c_data['c_service_arrTask'],
                    'allocated_time' => $c_data['c_service_time_allocate'],
                    'service_date' => $c_data['c_service_date'],
                    'client_description' => $c_data['c_service_task_desc'],
                ]);
            }           
           

            $res = 1;
        } else {
            $res = 0;
        }
        return response()->json(array('res' => $res));

    }
    function generate_numbers($start, $count, $digits) {
        $result = str_pad($start, $digits, "0", STR_PAD_LEFT);
        return $result;
    }
    
    //GET SERVICE LIST FROM GROUP
    public function get_service_List_from_group(Request $request)
    {
        $groupID = $request->get('groupID');
        $serviceList = DB::table('tbl_services')->where('is_delete','=', 0)->where('fk_service_grp_id', '=', $groupID)->get();
        return response()->json(array('serviceList' => $serviceList));
    }

    //GET TASK LIST FROM SERVICE
    public function get_task_List_from_service(Request $request)
    {
        $serviceID = $request->get('serviceID');
        $taskList = DB::table('tbl_task')->where('fk_services_id', '=', $serviceID)->where('is_delete','=', 0)->get();
        return response()->json(array('taskList' => $taskList));
    }

    /* LISTING PAGE */

    public function get_listing_template(Request $req)
    {
        $query = $req->get('pageLength_val');
        if ($query == "") {
            $query = 10;
        }
        $getClientData = DB::table('tbl_clients_info')->where('is_delete','=',0)->orderBy('pk_client_id', 'DESC')->paginate($query);
        return view('ClientManagement.Listing_client_management', compact('getClientData', 'query'));
    }    
    public function paginate_data(Request $req)
    {
        $profileDropFilter = $req->get('profileDropFilter');
        $assigedDropFilter = $req->get('assigedDropFilter');
        $keyword = $req->get('keyword');
        $query = $req->get('pageLength_val');

        if ($query == "") {
            $query = 10;
        }

        $getClientDatakeyword = DB::table('tbl_clients_info');

        if ($keyword != '') {
            $getClientDatakeyword->where('tbl_clients_info.client_name', 'like', '%' . $keyword . '%');
        }

        if($assigedDropFilter != ''){
            if($assigedDropFilter == 'assigned'){
                $getClientDatakeyword->where('tbl_clients_info.fk_ct_id', '=', 1);
            }
            if($assigedDropFilter == 'unassigned'){
                $getClientDatakeyword->where('tbl_clients_info.fk_ct_id', '=', 0);
            }
        }
        
        if($profileDropFilter != ''){
            if($profileDropFilter == 'active'){
                $getClientDatakeyword->where('tbl_clients_info.is_active', '=', 1);
            }
            if($profileDropFilter == 'inactive'){
                $getClientDatakeyword->where('tbl_clients_info.is_active', '=', 0);
            }
        }
        
        $getClientData = $getClientDatakeyword->where('is_delete','=',0)->orderBy('pk_client_id', 'DESC')->paginate($query);

        if ($req->ajax()) {
            return view('ClientManagement.ListingClientManagementPpartial', compact('getClientData', 'query'))->render();
        }

    } 

    //UPDATE CLIENT PROFILE STATUS FROM LISTING PAGE
    public function updateClientProfileStatus(Request $req){        
        $clientID = $req->get('clientID');
        $chkStatus = $req->get('status');
        if($chkStatus == 'active'){
            $status = 1;
        }
        if($chkStatus == 'inactive'){
            $status = 0;
        }        
       
        DB::table('tbl_clients_info')
                    ->where('pk_client_id', $clientID)
                    ->update(array('is_active' => $status));

        return response()->json(array('clientID' => $clientID,'chkStatus' => $chkStatus));
    }

    //FILTER LISTING DATA
    public function filterClientData(Request $req){
        $profileDropFilter = $req->get('profileDropFilter');
        $assigedDropFilter = $req->get('assigedDropFilter');
        $keyword = $req->get('keyword');
        $query = $req->get('pageLength_val');

        if ($query == "") {
            $query = 10;
        }

        $getClientDatakeyword = DB::table('tbl_clients_info');

        if ($keyword != '') {
            $getClientDatakeyword->where('tbl_clients_info.client_name', 'like', '%' . $keyword . '%');
        }

        if($assigedDropFilter != ''){
            if($assigedDropFilter == 'assigned'){
                $getClientDatakeyword->where('tbl_clients_info.fk_ct_id', '!=', 0);
            }
            if($assigedDropFilter == 'unassigned'){
                $getClientDatakeyword->where('tbl_clients_info.fk_ct_id', '=', 0);
            }
        }
        
        if($profileDropFilter != ''){
            if($profileDropFilter == 'active'){
                $getClientDatakeyword->where('tbl_clients_info.is_active', '=', 1);
            }
            if($profileDropFilter == 'inactive'){
                $getClientDatakeyword->where('tbl_clients_info.is_active', '=', 0);
            }
        }
        
        $getClientData = $getClientDatakeyword->where('is_delete','=',0)->orderBy('pk_client_id', 'DESC')->paginate($query);

        if ($req->ajax()) {
            return view('ClientManagement.ListingClientManagementPpartial', compact('getClientData', 'query'))->render();
        }
    }

    //VIEW CLIENT DATA
    public function viewClientData(Request $req){       
        $clientID = $req->id;
        $getCTList = DB::table('tbl_ct_info')->select('pk_ct_info_id', 'ct_name')->get();        
        $ClientData = DB::table('tbl_clients_info')->where('tbl_clients_info.pk_client_id', '=', $clientID)->get();
        if($ClientData[0]->fk_ct_id != 0){            
            $getClientData = DB::table('tbl_clients_info')
                            ->join('tbl_ct_info', 'tbl_ct_info.pk_ct_info_id','=', 'tbl_clients_info.fk_ct_id')                                                    
                            ->where('tbl_clients_info.pk_client_id', '=', $clientID)->get();
        }else{            
            $getClientData = DB::table('tbl_clients_info')->where('tbl_clients_info.pk_client_id', '=', $clientID)->get();
        }
        
        $getAllocatedServices = DB::table('tbl_client_services')                            
                ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_client_services.fk_service_grp_id')
                ->where('tbl_client_services.fk_client_id','=',$clientID)                
                ->get();        
        foreach($getAllocatedServices as $ser){           
            $total_count_task = count(explode(',',$ser->fk_task_id));            
            $ser->task_count = $total_count_task;            
        }      
        //dd($getAllocatedServices);
        return view('ClientManagement.clientManagementView', compact('getClientData','getCTList','getAllocatedServices'));
    }
   
    //UPDATE PROFILE STATUS FROM VIEW CLIENT MANAGEMENT PAGE
    public function viewUpdateProfileStatus(Request $req){             
        $clientID = $req->get('clientID');
        $chkStatus = $req->get('status');
        if($chkStatus == 'active'){
            $status = 1;
        }
        if($chkStatus == 'inactive'){
            $status = 0;
        }        
       
        DB::table('tbl_clients_info')
                    ->where('pk_client_id', $clientID)
                    ->update(array('is_active' => $status));
        return response()->json(array('clientID' => $clientID,'chkStatus' => $chkStatus));
    }

    //ASSIGN CT FORM VIEW CLIENT PAGE
    public function viewAssignCT(Request $req){
        $clientID = $req->get('clientID');
        $ctID = $req->get('ctID');         
        $ctName = DB::table('tbl_ct_info')->where('pk_ct_info_id','=', $ctID)->select('ct_name')->get();    
        DB::table('tbl_clients_info')
                    ->where('pk_client_id', $clientID)
                    ->update(array('fk_ct_id' => $ctID));

        return response()->json($ctName[0]);
    }

    //EDIT CLEINT
    public function editClientData(Request $req){        
        $clientID = $req->id;
        $getCTList = DB::table('tbl_ct_info')->where('is_delete','=', 0)->select('pk_ct_info_id', 'ct_name')->get();             
        $ClientData = DB::table('tbl_clients_info')
                ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_clients_info.pk_client_id')
                ->join('tbl_client_services','tbl_client_services.pk_client_services_id','=','tbl_clients_info.pk_client_id')
                ->where('tbl_clients_info.pk_client_id', '=', $clientID)->get();

        $getServiceGroupList = DB::table('tbl_service_group')->where('is_delete','=', 0)->select('pk_service_group_id', 'service_grp_name')->get();       
        
        return view('ClientManagement.editClient',compact('ClientData','getCTList','getServiceGroupList'));
    }

    //UPDATE CLIENT
    public function updateClient(Request $request){  

        $clientID = $request->get('d_clientID');
        $c_name = $request->get('d_clnt_Name');
        $c_contact = $request->get('d_clnt_contact');
        //$c_email = $request->get('d_clnt_email');
        $dob = $request->get('d_clnt_dob');
        $c_dob = date('Y-d-m',strtotime($dob));
        $c_age = $request->get('d_clnt_age');
        $c_gender = $request->get('d_clnt_gender');
        $c_address = $request->get('d_clnt_address');
        $c_city = $request->get('d_clnt_city');
        $c_state = $request->get('d_clnt_state');
        $c_country = $request->get('d_clnt_country');
        $c_health = $request->get('d_clnt_health');
        $c_kin_name = $request->get('d_clnt_next_of_kin_name');
        $c_kin_number = $request->get('d_clnt_next_of_kin_number');
        $c_kin_email = $request->get('d_clnt_next_of_kin_email');
        $c_ct = $request->get('d_clnt_CT');        
        
        DB::table('tbl_clients_info')
            ->where('pk_client_id','=', $clientID)
            ->update([
                'client_name' => $c_name,                            
                'client_contact_no' => $c_contact,  
                //'client_email' => $c_email,              
                'client_dob' => $c_dob,
                'client_age' => $c_age,
                'client_gender' => $c_gender,
                'client_address' => $c_address,
                'client_city' => $c_city,
                'client_state' => $c_state,
                'client_country' => $c_country,
                'health_conditions' => $c_health,
                'kin_name' => $c_kin_name,
                'kin_phone_no' => $c_kin_number,
                'kin_email' => $c_kin_email,
                'fk_ct_id' => $c_ct,                
            ]);

        return response()->json(array('res' => 1));
    }

    //DELETE CLIENT
    public function deleteClient(Request $req){
        $clientID = $req->get('clientID');
        DB::table('tbl_clients_info')
            ->where('pk_client_id','=', $clientID)
            ->update([
                'is_delete' => 1,
            ]);
        DB::table('tbl_client_services')
            ->where('fk_client_id','=', $clientID)
            ->update([
                'is_delete' => 1,
            ]);
        return response()->json(1);
    }
}
