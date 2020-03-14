<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class ManageVisitController extends Controller {

    public function index() {
        $clienct_name_list = DB::table('tbl_clients_info')->where('is_delete', '=', 0)->get();
        return view('ManageVisit.manage_visit', compact('clienct_name_list'));
        //Manage visit index
    }

    public function create() {
        $c_name_ct = DB::table('tbl_ct_info')->where('is_delete', '=', 0)->get();
        return view('ManageVisit.manage_visit_add', compact('c_name_ct'));
    }

    public function get_service(Request $req) {
        $ct_id = $_REQUEST['ct_name'];
        $ct_service = DB::table('tbl_ct_info')
                        ->select('fk_service_grp_ids')
                        ->where('pk_ct_info_id')->first();

        $ct_blockout_time = DB::table('tbl_setting')->value('ct_blockout_time');

        return response()->json(array('getServiceGroupList' => $getServiceGroupList, 'ct_blockout_time' => $ct_blockout_time));
    }

    public function get_client(Request $request) {
        
        $ct_blockout_time = DB::table('tbl_setting')->value('ct_blockout_time');
        $ct_group = $_REQUEST['ct_name'];
        //$client1 = DB::table('tbl_clients_info')->where('fk_ct_id', $ct_group)->where('is_delete', '=', 0)->get();
        $client1 = $admin_data_as = DB::table('tbl_clients_info')
                        ->where('is_delete', 0)
                        ->where(function($que) use ($ct_group) {
                            $que->Where('fk_ct_id', 'like', '%,' . $ct_group . ',%')
                            ->orWhere('fk_ct_id', 'like', $ct_group . ',%')
                            ->orWhere('fk_ct_id', 'like', '%,' . $ct_group)
                            ->orWhere('fk_ct_id', 'like', '%' . $ct_group)
                            ->orWhere('fk_ct_id', $ct_group);
                        })->get();

        $client = '';
        if (count($client1) > 0) {
            $client = $client1;
        }
        $ct_service = '';
        $ct_service1 = DB::table('tbl_ct_info')
                        ->select('fk_service_grp_ids')
                        ->where('pk_ct_info_id', $ct_group)->where('is_delete', 0)->first();
        if ($ct_service1 != '' || $ct_service1 != null) {
            $ct_service = $ct_service1;
        }

        $service_string = $ct_service->fk_service_grp_ids;
        $getarray = explode(',', $service_string);
        $service_grp_array = array();
        foreach ($getarray as $get) {
            $getservices = DB::table('tbl_service_group')
                    ->select('service_grp_name', 'pk_service_group_id')
                    ->where('pk_service_group_id', $get)
                    ->where('is_delete', 0)
                    ->first();
            if ($getservices != '' || $getservices != null) {
                array_push($service_grp_array, $getservices);
            }
        }



        


        return response()->json(array('client_name' => $client, 'getServiceGroupList' => $service_grp_array, 'ct_blockout_time' => $ct_blockout_time));
    }
    public function get_times(Request $request){
        //Disable times array start
        //dd($_REQUEST);
        $ct_group = $_REQUEST['ct_name'];
        $visit_date = \Carbon\Carbon::parse($_REQUEST['visit_date_s'])->format('Y-m-d');
        $check_alredy_visit = DB::table('tbl_visits')
                ->select('pk_visits_id')
                ->where('fk_ct_id', $ct_group)
                ->where('visit_date', $visit_date)
                ->where('visit_status','!=','Completed')
                ->where('is_delete', 0)
                ->get();


        if (count($check_alredy_visit) > 0) {
            $visit_ids = array();

            foreach ($check_alredy_visit as $check_already) {

                $check_already->pk_visits_id;
                array_push($visit_ids, $check_already);
            }





            $collect = array();
            $collect_end = array();
            $disable_start = array();
            $as_notavl = array();
            $as_block_array = array();
            $as_merger_array = array();
            $as_dattimearray = array();
            $startTime = date("Y-m-d H:i:s");

            foreach ($visit_ids as $visit) {
                $fk_visit_id = DB::table('tbl_visit_detail')
                        ->select('end_time', 'start_time')
                        ->where('fk_visit_id', $visit->pk_visits_id)
                        ->where('is_delete', 0)
                        ->get();


                foreach ($fk_visit_id as $data) {
                    $start_t = $data->start_time;
                    $end_t_m = $data->end_time;
                    array_push($disable_start, $start_t, $end_t_m);
                    array_push($collect_end, $end_t_m);
                    $end_t = $data->end_time;
                    $cenvertedTime1 = date('Y-m-d H:i ', strtotime('+30 minutes', strtotime($end_t)));
                    $end_thirty_tt = date("h:i A", strtotime($cenvertedTime1));

                    while ($start_t < $end_thirty_tt) {

                        array_push($as_notavl, $start_t);
                        $cenvertedTime = date('Y-m-d H:i ', strtotime('+15 minutes', strtotime($start_t)));
                        $start_t = date("h:i A", strtotime($cenvertedTime));
                    }

                    //                   
                }
            }


            $disable_times = array_chunk($disable_start, 2);
            $disable_time_array = $disable_times;
            $all_end_times = $collect_end;
            $notavail = $as_notavl;
        } else {
            $disable_time_array = "";
            $all_end_times = "";
            $notavail = "";
        }
       
        
        //Disable time array end
        return response()->json(array('disable_timet' => $disable_time_array, 'all_end_times' => $all_end_times, 'not_aval' => $notavail));
    }

    public function manage_get_services($srv_group) {
        $services1 = DB::table('tbl_services')->where('fk_service_grp_id', $srv_group)->where('is_delete', '=', 0)->get();
        if (count($services1) > 0) {
            $services = $services1;
        }
        return response()->json(array('clone_service' => $services));
    }

    public function manage_task($srv_name) {
        $task1 = DB::table('tbl_task')->where('fk_services_id', $srv_name)->where('is_delete', '=', 0)->get();
        if (count($task1) > 0) {
            $task = $task1;
        }
        return response()->json($task);
    }

    public function manage_task_desc($task) {
        $m_task_desc1 = DB::table('tbl_task')->where('pk_task_id', $task)->where('is_delete', '=', 0)->get();
        if (count($m_task_desc1) > 0) {
            $m_task_desc = $m_task_desc1;
        }
        return response()->json($m_task_desc);
    }

    public function manage_clone_service($clone_service_group) {
        $clone_service1 = DB::table('tbl_services')->where('fk_service_grp_id', $clone_service_group)->where('is_delete', '=', 0)->get();
        if (count($clone_service1) > 0) {
            $clone_service = $clone_service1;
        }
        return response()->json(array('clone_service' => $clone_service));
    }

    public function manage_clone_task($clone_service_name) {
        $clone_task1 = DB::table('tbl_task')->where('fk_services_id', $clone_service_name)->where('is_delete', '=', 0)->get();
        if (count($clone_task1) > 0) {
            $clone_task = $clone_task1;
        }
        return response()->json(array('clone_task' => $clone_task));
    }

    public function clone_manage_desc($c_task) {
        $c_task_desc = DB::table('tbl_task')->where('pk_task_id', $c_task)->where('is_delete', '=', 0)->get();
        return response()->json($c_task_desc);
    }

    public function manage_visit_store_save(Request $request) {

        $update_id = $_REQUEST['updateid'];
        $c_name = $_REQUEST['ct_group'];
        $client_name = $_REQUEST['client_name'];
        $date = $_REQUEST['visit_date'];

        $service_grp = $_REQUEST['service_group_arr'];

        $service_name = $_REQUEST['services_name_arr'];

        $start_time = $_REQUEST['start_time_arr'];
        $end_time = $_REQUEST['end_time_arr'];


        $task_list = $_REQUEST['task_arr'];
        $new_task_name = $_REQUEST['new_task_name_arr'];
        $task_desc = $_REQUEST['new_task_desc_arr'];
        $duration = $_REQUEST['duration_arr'];
        $visit_date_v = \Carbon\Carbon::parse($date)->format('Y-m-d');
        //check already data start
        
         $get_visit_exists = DB::table('tbl_visits')
                    ->join('tbl_visit_detail', 'tbl_visit_detail.fk_visit_id', '=', 'tbl_visits.pk_visits_id')
//                  ->where('fk_ct_id', $c_name)
                    ->where('tbl_visits.visit_date',$visit_date_v)
                    ->where('tbl_visits.is_delete',0)
                    ->where('tbl_visit_detail.is_delete',0)
                    ->select('tbl_visit_detail.start_time','tbl_visit_detail.end_time')
                    ->get();
//    $is_any_visit_exists = 0;
    $error_d = false;
    if(count($get_visit_exists)> 0){
        $exists_visit_time_arr = array();
        $index = 0;
        foreach($get_visit_exists as $exist_visit_t){
           $exists_visit_time_arr[$index]['start_time'] = $visit_date_v.' '.$exist_visit_t->start_time;
           $exists_visit_time_arr[$index]['end_time']= $visit_date_v.' '.$exist_visit_t->end_time;
           $index++;
        }
        if(!empty($exists_visit_time_arr)){
            foreach($exists_visit_time_arr as $exists_visit_time){
                foreach($data_time as $selected_time){
                   /*check selected time already selected or not */
                    if((strtotime($selected_time['start_time'])0 <= strtotime($exists_visit_time['start_time']) && strtotime($selected_time['end_time']) >= strtotime($exists_visit_time['end_time'])))
                    {
                        $error_d = true;
                        dd('Outside');
                    }
                    if((strtotime($selected_time['start_time']) <= strtotime($exists_visit_time['start_time'])) &&
                            (strtotime($selected_time['end_time']) <= strtotime($exists_visit_time['end_time']) &&  strtotime($selected_time['end_time']) > strtotime($exists_visit_time['start_time'])     ))
                    {
                        $error_d = true;
                         dd('Outside Inside');
                    }
                    if((strtotime($selected_time['start_time']) >= strtotime($exists_visit_time['start_time']) && strtotime($selected_time['start_time']) < strtotime($exists_visit_time['end_time'])  ) &&
                            (strtotime($selected_time['end_time']) >= strtotime($exists_visit_time['end_time'])))
                    {
                        $error_d = true;
                        dd('Inside Outside');
                    }
                    if((strtotime($selected_time['start_time']) >= strtotime($exists_visit_time['start_time']) && strtotime($selected_time['end_time']) <= strtotime($exists_visit_time['end_time']))   ){
                       $error_d = true;
                       dd('Inside');
                    }
                }
            }
        }
    }
//dd($error_d);





 
        

        //check already data end
        if ($error_d == false) {

            if ($update_id == 0) {

                //This is for insert start

                $digits = 4;
                $otp = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

                $fk_visits = DB::table('tbl_visits')->insertGetId([
                    'fk_ct_id' => $c_name,
                    'fk_client_id' => $client_name,
                    'visit_date' => date('Y-m-d', strtotime($date)),
                    'otp' => $otp
                ]);
                $size = sizeof($service_grp);

                $data = array();
                for ($i = 0; $i < $size; $i++) {

                    $data[$i]['service_grp'] = $service_grp[$i];
                    $data[$i]['service_name'] = $service_name[$i];
                    $data[$i]['task_list'] = $task_list[$i];
                    $data[$i]['task_desc'] = $task_desc[$i];
                    $data[$i]['new_task_name'] = $new_task_name[$i];
                    $data[$i]['start_time'] = $start_time[$i];
                    $data[$i]['end_time'] = $end_time[$i];
                    $data[$i]['duration'] = $duration[$i];
                }


                foreach ($data as $value) {
                    $duration = 0;
                    if ($value['duration'] != '') {
                        $duration = $value['duration'];
                    }
                    DB::table('tbl_visit_detail')->insert([
                        'fk_visit_id' => $fk_visits,
                        'fk_service_grp_id' => $value['service_grp'],
                        'fk_service_id' => $value['service_name'],
                        'fk_task_id' => $value['task_list'],
                        'task_description' => $value['task_desc'],
                        'start_time' => $value['start_time'],
                        'end_time' => $value['end_time'],
                        'duration' => $duration
                    ]);

                    if ($value['task_list'] == 'other_task') {
                        $new_task_id = DB::table('tbl_task')->insertGetId([
                            'fk_service_grp_id' => $value['service_grp'],
                            'fk_services_id' => $value['service_name'],
                            'task_name' => $value['new_task_name'],
                            'task_description' => $value['task_desc']
                        ]);

                        $addnewtaskid = DB::table('tbl_visit_detail')
                                ->where('fk_task_id', 'other_task')
                                ->where('fk_visit_id', $fk_visits)
                                ->update([
                            'fk_task_id' => $new_task_id
                        ]);
                    }
                }
                return response()->json(1);
                $request->session()->flash('manage_visit', 'Visit Inserted Successfully !');
                //This is for insert end
            } else {

                //dd($_REQUEST);
                $check_in_up = $_REQUEST['new_check_in_up_arr'];
                $primary_ids = $_REQUEST['primary_ids_arr'];
                //This is for update start

                $size = sizeof($service_grp) ? sizeof($service_grp) : 0;
                if ($size > 0) {
                    
                }
                $already_exist_visits = DB::table('tbl_visit_detail')
                        ->where('fk_visit_id', $update_id)
                        ->where('is_delete', 0)
                        ->get();

                foreach ($already_exist_visits as $already_visit_has) {
                    $allready = $already_visit_has->pk_visit_detail_id;
                    if (!in_array($allready, $primary_ids)) {
                        $already_module_exist = DB::table('tbl_visit_detail')
                                ->where('pk_visit_detail_id', $already_visit_has->pk_visit_detail_id)
                                ->update(['is_delete' => 1]);
                    }
                }

                $data = array();


                for ($i = 0; $i < $size; $i++) {
                    $data[$i]['service_grp'] = $service_grp[$i];
                    $data[$i]['service_name'] = $service_name[$i];
                    $data[$i]['task_list'] = $task_list[$i];
                    $data[$i]['task_desc'] = $task_desc[$i];
                    $data[$i]['new_task_name'] = $new_task_name[$i];
                    $data[$i]['start_time'] = $start_time[$i];
                    $data[$i]['end_time'] = $end_time[$i];
                    $data[$i]['check_in_up'] = $check_in_up[$i];
                    $data[$i]['primary_ids'] = $primary_ids[$i];
                    $data[$i]['duration'] = $duration[$i];
                }




                foreach ($data as $values) {
                    $duration_a = 0;
                    if ($values['duration'] != '') {
                        $duration_a = $values['duration'];
                    }

                    if ($values['check_in_up'] == 'update') {

                        DB::table('tbl_visit_detail')
                                ->where('fk_visit_id', $update_id)
                                ->where('pk_visit_detail_id', $values['primary_ids'])
                                ->update([
                                    'fk_service_grp_id' => $values['service_grp'],
                                    'fk_service_id' => $values['service_name'],
                                    'fk_task_id' => $values['task_list'],
                                    'task_description' => $values['task_desc'],
                                    'start_time' => $values['start_time'],
                                    'end_time' => $values['end_time'],
                                    'duration' => $values['duration']
                        ]);
                        if ($values['task_list'] == 'other_task') {
                            $new_task_id_up = DB::table('tbl_task')->insertGetId([
                                'fk_service_grp_id' => $values['service_grp'],
                                'fk_services_id' => $values['service_name'],
                                'task_name' => $values['new_task_name'],
                                'task_description' => $values['task_desc']
                            ]);
                            $addnewtaskid_up = DB::table('tbl_visit_detail')
                                    ->where('fk_task_id', 'other_task')
                                    ->where('fk_visit_id', $update_id)
                                    ->update([
                                'fk_task_id' => $new_task_id_up
                            ]);
                        }
                    } else {
                        //else start

                        DB::table('tbl_visit_detail')->insert([
                            'fk_visit_id' => $update_id,
                            'fk_service_grp_id' => $values['service_grp'],
                            'fk_service_id' => $values['service_name'],
                            'fk_task_id' => $values['task_list'],
                            'task_description' => $values['task_desc'],
                            'start_time' => $values['start_time'],
                            'end_time' => $values['end_time'],
                            'duration' => $duration_a,
                        ]);
                        if ($values['task_list'] == 'other_task') {
                            $new_task_id = DB::table('tbl_task')->insertGetId([
                                'fk_service_grp_id' => $values['service_grp'],
                                'fk_services_id' => $values['service_name'],
                                'task_name' => $values['new_task_name'],
                                'task_description' => $values['task_desc']
                            ]);
                            $addnewtaskid = DB::table('tbl_visit_detail')
                                    ->where('fk_task_id', 'other_task')
                                    ->where('fk_visit_id', $update_id)
                                    ->update([
                                'fk_task_id' => $new_task_id
                            ]);
                        }



                        //else end
                    }
                }

                return response()->json(1);
                $request->session()->flash('manage_visit', 'Visit Updated Successfully !');
                //This is for update end
            }
       } else {
           return response()->json(0);
       }
    }

    public function partial_managevisit(Request $request) {

        $items = $request->input('items') == null ? 10 : $request->input('items');
        $search_clientid = $request->input('search_clientid') == null ? '' : $request->input('search_clientid');
        $search_status = $request->input('search_status') == null ? '' : $request->input('search_status');
        $search_ct = $request->input('search_cts') == null ? '' : $request->input('search_cts');
        $enable_time = $request->input('enable_time') == null ? '' : $request->input('enable_time');
        $enabledate_value = $request->input('enabledate_value') == null ? '' : $request->input('enabledate_value');




        $manage_detail1 = DB::table('tbl_visit_detail')
                ->join('tbl_visits', 'tbl_visit_detail.fk_visit_id', '=', 'tbl_visits.pk_visits_id')
                ->join('tbl_service_group', 'tbl_service_group.pk_service_group_id', '=', 'tbl_visit_detail.fk_service_grp_id')
                ->join('tbl_ct_info', 'tbl_ct_info.pk_ct_info_id', '=', 'tbl_visits.fk_ct_id')
                ->join('tbl_clients_info', 'tbl_clients_info.pk_client_id', '=', 'tbl_visits.fk_client_id')
                ->select('tbl_visit_detail.fk_visit_id', DB::raw('group_concat(tbl_service_group.service_grp_name) as names'), 'tbl_visits.fk_ct_id', 'tbl_ct_info.ct_name', 'tbl_ct_info.ct_contact_info', 'tbl_visits.fk_client_id', 'tbl_visits.visit_date', 'tbl_visits.visit_status', 'tbl_visit_detail.start_time', 'tbl_visit_detail.fk_service_grp_id', 'tbl_visits.pk_visits_id', 'tbl_clients_info.client_name', 'tbl_clients_info.client_contact_no', 'tbl_clients_info.client_view_id'
                )
                //->where('tbl_service_group.is_delete',0)
                ->where('tbl_visits.is_delete', 0)
                ->orderBy('tbl_visits.created_at', 'DESC');


        if ($search_clientid != '') {
            $manage_detail1->where('tbl_visits.fk_client_id', $search_clientid);
        }
        if ($search_status != '') {
            $manage_detail1->where('tbl_visits.visit_status', $search_status);
        }
        if ($search_ct != '') {

            $manage_detail1->where('tbl_ct_info.ct_name', 'LIKE', "%{$search_ct}%");
        }
        if ($enable_time != '') {
            if ($enable_time == 'down_time') {
                $manage_detail1->orderBy('tbl_visit_detail.start_time', 'DESC');
            } else {
                $manage_detail1->orderBy('tbl_visit_detail.start_time', 'ASC');
            }
        }
        if ($enabledate_value != '') {
            if ($enabledate_value == 'down_date') {
                $manage_detail1->orderBy('tbl_visits.visit_date', 'DESC');
            } else {
                $manage_detail1->orderBy('tbl_visits.visit_date', 'ASC');
            }
        }


        $manage_detail = $manage_detail1->groupBy('tbl_visit_detail.fk_visit_id')//->get();
                ->paginate($items);





        $view_services = view('ManageVisit/PartialManageVisite', compact('items', 'manage_detail'));
        $view_services = $view_services->render();
        return response()->json(['html' => $view_services]);
    }

    public function edit_manage_visit(Request $request) {

        $id = $_GET['id'];

        $visit_data = DB::table('tbl_visits')->where('pk_visits_id', $id)->get();
        $client_id = $visit_data[0]->fk_client_id;
        $ct_id = $visit_data[0]->fk_ct_id;
        $visit_status = $visit_data[0]->visit_status;
        $visit_date = $visit_data[0]->visit_date;
        $visit_id = $visit_data[0]->pk_visits_id;

        $client_list = DB::table('tbl_clients_info')->where('pk_client_id', $client_id)->get();


        $all_c_name = DB::table('tbl_ct_info')->where('pk_ct_info_id', $ct_id)->get();

        $get_data = DB::table('tbl_visit_detail')
                ->where('tbl_visit_detail.fk_visit_id', $id)
                ->where('is_delete', 0)
                ->get();

        foreach ($visit_data as $visit) {
            $related_client = array();
            $get_client = DB::table('tbl_clients_info')
                            ->where('is_delete', 0)
                            ->where(function($que) use ($ct_id) {
                                $que->Where('fk_ct_id', 'like', '%,' . $ct_id . ',%')
                                ->orWhere('fk_ct_id', 'like', $ct_id . ',%')
                                ->orWhere('fk_ct_id', 'like', '%,' . $ct_id)
                                ->orWhere('fk_ct_id', 'like', '%' . $ct_id)
                                ->orWhere('fk_ct_id', $ct_id);
                            })->get();
        }
        array_push($related_client, $get_client);




        $count = 1;
        foreach ($get_data as $value) {
            $service_group = DB::table('tbl_service_group')->where('pk_service_group_id', $value->fk_service_grp_id)->get();
            $value->service_group_name = $service_group[0]->service_grp_name;

            $service_name = DB::table('tbl_services')->where('pk_services_id', $value->fk_service_id)->get();
            $value->service_name = $service_name[0]->service_name;





            $ct_service = DB::table('tbl_ct_info')
                            ->select('fk_service_grp_ids')
                            ->where('pk_ct_info_id', $ct_id)->first();
            $service_string = $ct_service->fk_service_grp_ids;
            $getarray = explode(',', $service_string);



            $relatedservicegroup = array();
            foreach ($getarray as $get) {
                $getservices1 = DB::table('tbl_service_group')
                        ->select('service_grp_name', 'pk_service_group_id')
                        ->where('pk_service_group_id', $get)
                        ->where('is_delete', 0)
                        ->first();
                if ($getservices1 != '' || $getservices1 != null) {
                    array_push($relatedservicegroup, $getservices1);
                }
            }



            $relatedservice = DB::table('tbl_services')->where('fk_service_grp_id', $value->fk_service_grp_id)->where('is_delete', 0)->get();
            if (count($relatedservice) > 0) {
                $relatedservice = $relatedservice;
            }

            $related_task = DB::table('tbl_task')->where('fk_services_id', $value->fk_service_id)->where('is_delete', 0)->get();
            if (count($related_task) > 0) {
                $related_task = $related_task;
            }
            $value->relatedservice_name = $relatedservice;
            $value->relatedtask_name = $related_task;
            $value->relatedservicegroup = $relatedservicegroup;


            $task_name = DB::table('tbl_task')->where('pk_task_id', $value->fk_task_id)->where('is_delete', 0)->get();
            if (count($task_name) > 0) {
                $task_name = $task_name;
                $value->task_name = $task_name[0]->task_name;
            }


            $value->checkinup = 'update';
            $value->divids = $count++;

            //time array start
            $start = '00:00';
            $end = '23:45';
            $interval = '15 mins';
            $format = '12';
            $startTime = strtotime($start);
            $endTime = strtotime($end);
            $returnTimeFormat = ($format == '12') ? 'h:i A' : 'H:i A';

            $current = time();
            $addTime = strtotime('+' . $interval, $current);
            $diff = $addTime - $current;

            $times = array();
            while ($startTime < $endTime) {
                $times[] = date($returnTimeFormat, $startTime);
                $startTime += $diff;
            }
            $times[] = date($returnTimeFormat, $startTime);

            $value->timearray = $times;
         
        }


        $ct_block_time = DB::table('tbl_setting')->value('ct_blockout_time');
        return view('ManageVisit.edit_manage_visits', compact('get_data', 'visit_id', 'client_id', 'ct_id', 'visit_status', 'visit_date', 'all_c_name', 'client_list', 'ct_block_time', 'related_client'));
    }

    public function visit_delete(Request $request) {

        $visit_delete_id = $_REQUEST['delete_id'];
        $delete_visits = DB::table('tbl_visits')
                ->where('pk_visits_id', $visit_delete_id)
                ->update(['is_delete' => 1]);
        $visit_delete_details = DB::table('tbl_visit_detail')
                ->where('fk_visit_id', $visit_delete_id)
                ->update(['is_delete' => 1]);
        $request->session()->flash('manage_visit', 'Visit Deleted Successfully !');
        return response(1);
    }

    public function view_manage_visit(Request $request) {
        $view_id = $_GET['id'];
        




        $get_visit_data = DB::table('tbl_visits')
                ->where('pk_visits_id', $view_id)
                ->first();
        

        $ct_id = $get_visit_data->fk_ct_id;

        $client_id = $get_visit_data->fk_client_id;

        $get_ct_data = DB::table('tbl_ct_info')
                ->where('pk_ct_info_id', $ct_id)
                ->first();
        


        $get_client_data = DB::table('tbl_clients_info')
                ->where('pk_client_id', $client_id)
                //->where('is_delete', 0)
                ->first();
        if($get_client_data==null){
            $get_client_data='';
        }
        
       



        $get_visit_detail_data = DB::table('tbl_visit_detail')
                ->where('fk_visit_id', $view_id)
                ->get();




        $total_duration = 0;


        foreach ($get_visit_detail_data as $visit_detail) {
            $service_grp_names = DB::table('tbl_service_group')
                    ->where('pk_service_group_id', $visit_detail->fk_service_grp_id)
                    //->where('is_delete', 0)
                    ->value('service_grp_name');



            $visit_detail->Service_grp = $service_grp_names;

            $service_names = DB::table('tbl_services')
                    ->where('pk_services_id', $visit_detail->fk_service_id)
                    //->where('is_delete', 0)
                    ->value('service_name');



            $visit_detail->service_name = $service_names;

            $task_name = DB::table('tbl_task')
                    ->where('pk_task_id', $visit_detail->fk_task_id)
                    //->where('is_delete', 0)
                    ->value('task_name');

            $visit_detail->task_name = $task_name;
            if ($visit_detail->duration != '' || $visit_detail->duration != null) {
                $total_duration += $visit_detail->duration;
            }
        }

        $seconds = ($total_duration * 3600);

        $hours = floor($total_duration);
        $seconds -= $hours * 3600;
        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;
        $dec_to_hours = $hours . ":" . $minutes;
        $size = sizeof($get_visit_detail_data);
        $start_time_visit = $get_visit_detail_data[0]->start_time;
        $end_time_visit = $get_visit_detail_data[$size - 1]->end_time;
        
        //calculate time for completed visit//
        $hours='';
        $get_time=DB::table('tbl_ct_working_detail')
                ->where('fk_visit_id',$view_id)
                ->value('worked_hrs');
        if($get_time!=''){
        
            $conver_mins=floor($get_time*60);
            $hours = floor($conver_mins / 60).' Hours '.($conver_mins -   floor($conver_mins / 60) * 60).' Minutes';
        }
        
        


        return view('ManageVisit.view_manage_visit', compact('get_visit_data', 'get_ct_data', 'get_client_data', 'get_visit_detail_data', 'start_time_visit', 'end_time_visit', 'total_duration', 'dec_to_hours','hours'));
    }

    public function visit_detail_delete(Request $request) {
        $visit_detail_id = $_REQUEST['delete_visit_detail_id'];
        $visit_delete_details = DB::table('tbl_visit_detail')
                ->where('pk_visit_detail_id', $visit_detail_id)
                ->update(['is_delete' => 1]);
        $request->session()->flash('manage_visit', 'Deleted Successfully From Visit !');
        return response(1);
    }

    public function check_visit(Request $request) {

        $ct_id = $_REQUEST['ct_name'];

        $visit_date = \Carbon\Carbon::parse($_REQUEST['visit_date_s'])->format('Y-m-d');


        $check_alredy_visit = DB::table('tbl_visits')
                ->select('pk_visits_id')
                ->where('fk_ct_id', $ct_id)
                ->where('visit_date', $visit_date)
                ->get();
        if (count($check_alredy_visit) > 0) {
            $visit_ids = array();

            foreach ($check_alredy_visit as $check_already) {

                $check_already->pk_visits_id;
                array_push($visit_ids, $check_already);
            }



            $collect = array();
            $collect_start = array();
            $disable_start = array();
            $startTime = date("Y-m-d H:i:s");

            foreach ($visit_ids as $visit) {
                $fk_visit_id = DB::table('tbl_visit_detail')
                                ->select('end_time', 'start_time')
                                ->where('fk_visit_id', $visit->pk_visits_id)->get();
                foreach ($fk_visit_id as $data) {
                    $start_t = $data->start_time;
                    $end_t = $data->end_time;

                    while ($start_t <= $end_t) {

                        array_push($disable_start, $start_t);
                        $cenvertedTime = date('Y-m-d H:i ', strtotime('+15 minutes', strtotime($start_t)));
                        $start_t = date("h:i A", strtotime($cenvertedTime));
                    }

                    //                   
                }
            }

            $res = $disable_start;
        } else {
            $res = 1;
        }
        return response()->json($res);
    }

    public function get_block_out(Request $request) {
        //get blockout time of all//
        $visit_date_u = $_REQUEST['visit_date'];
        $ct_id = $_REQUEST['ct_id'];
        $visit_id = $_REQUEST['visit_id'];
        $visit_date = \Carbon\Carbon::parse($visit_date_u)->format('Y-m-d');

        $check_alredy_visit_data = DB::table('tbl_visits')
                ->select('pk_visits_id')
                ->where('fk_ct_id', $ct_id)
                ->where('visit_date', $visit_date)
                ->where('visit_status','!=','Completed')
                ->where('is_delete', 0)
                ->get();
        $ct_block_time = DB::table('tbl_setting')->value('ct_blockout_time');


        if (count($check_alredy_visit_data) > 0) {
            $visit_ids_e = array();

            foreach ($check_alredy_visit_data as $check_already) {

                $check_already->pk_visits_id;
                array_push($visit_ids_e, $check_already);
            }
            $collect_end_e = array();
            $block_times = array();


            foreach ($visit_ids_e as $visit) {
                $fk_visit_id = DB::table('tbl_visit_detail')
                        ->select('end_time', 'start_time')
                        ->where('fk_visit_id', $visit->pk_visits_id)
                        ->where('is_delete', 0)
                        ->get();


                foreach ($fk_visit_id as $data) {
                    $start_t = $data->start_time;
                    $end_t_m = $data->end_time;
                    $cenvertedTime_e = date('Y-m-d H:i ', strtotime('+30 minutes', strtotime($end_t_m)));
                    $end_upto_b = date("h:i A", strtotime($cenvertedTime_e));
                    while ($end_t_m < $end_upto_b) {

                        array_push($block_times, $end_t_m);
                        $cenvertedTime = date('Y-m-d H:i ', strtotime('+15 minutes', strtotime($end_t_m)));
                        $end_t_m = date("h:i A", strtotime($cenvertedTime));
                    }

                    array_push($collect_end_e, $end_t_m);
                    //all disable time//
                }
            }
        }
        //check all disable time

        $check_alredy_visit_data_k = DB::table('tbl_visits')
                ->select('pk_visits_id')
                ->where('fk_ct_id', $ct_id)
                ->where('visit_date', $visit_date)
                ->where('pk_visits_id', '!=', $visit_id)
                ->where('is_delete', 0)
                ->get();

        $all_disable_time = array();

        if (count($check_alredy_visit_data_k) > 0) {
            $visit_ids_er = array();

            foreach ($check_alredy_visit_data_k as $check_already) {

                $check_already->pk_visits_id;
                array_push($visit_ids_er, $check_already);
            }



            foreach ($visit_ids_er as $visit) {
                $fk_visit_id_p = DB::table('tbl_visit_detail')
                        ->select('end_time', 'start_time')
                        ->where('fk_visit_id', $visit->pk_visits_id)
                        ->where('is_delete', 0)
                        ->get();


                foreach ($fk_visit_id_p as $data) {
                    $start_t = $data->start_time;
                    $end_t_m = $data->end_time;
                    //all disable time//
                    while ($start_t <= $end_t_m) {

                        array_push($all_disable_time, $start_t);
                        $cenvertedTime_p = date('Y-m-d H:i ', strtotime('+15 minutes', strtotime($start_t)));
                        $start_t = date("h:i A", strtotime($cenvertedTime_p));
                    }
                }
            }
        }



        return response()->json(array('block_times' => $block_times, 'all_disb_time' => $all_disable_time));
        //get blockout time for all end//
    }

}
