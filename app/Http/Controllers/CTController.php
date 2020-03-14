<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Illuminate\Support\Facades\Storage;

class CTController extends Controller {

    //display ct
    public function ct_management() {
        $perpage = isset($_GET['PerPage']) ? $_GET['PerPage'] : 10;
        $ct_all = DB::table('tbl_ct_info')
                ->where('is_delete','0')
                ->paginate($perpage);

        foreach ($ct_all as $key) {
            $tbl_clients_info = DB::table('tbl_clients_info')
                    ->where('fk_ct_id', $key->pk_ct_info_id)
                    ->count();
            $key->cnt_client = $tbl_clients_info;

            $grp_id = $key->fk_service_grp_ids;

            $grp = explode(',', $grp_id);

            $ct = [];
            foreach ($grp as $value) {
                $services = DB::table('tbl_service_group')
                        ->where('pk_service_group_id', $value)
                        ->first();
                // dd($services);
                $ct[$value] = $services->service_grp_name;
            }
            $key->grp_name = implode(',', $ct);
        }
        $services_grp = DB::table('tbl_service_group')
                ->get();

        return view('CTManagement/allct', compact('ct_all', 'perpage', 'services_grp'));
    }

    //display ct pagination
    public function FilterPaginationByAjaxct() {
        $perpage = isset($_GET['PerPage']) ? $_GET['PerPage'] : 10;
        $search = $_GET['search'];
        $sort_val = $_GET['sort_val'];

        if ($sort_val == 'Filter by CT Group') {

            $ct_all = DB::table('tbl_ct_info')
                    ->join('tbl_service_group', 'tbl_ct_info.fk_service_grp_ids', '=', 'tbl_service_group.pk_service_group_id')
                    ->where('tbl_ct_info.ct_name', 'LIKE', "%{$search}%")
                    ->where('tbl_ct_info.is_delete','0')
                    ->paginate($perpage);
        } else {
            $ct_all = DB::table('tbl_ct_info')
                    ->join('tbl_service_group', 'tbl_ct_info.fk_service_grp_ids', '=', 'tbl_service_group.pk_service_group_id')
                    ->where('tbl_ct_info.ct_name', 'LIKE', "%{$search}%")
                    ->where('tbl_service_group.service_grp_name', $sort_val)
                    ->where('tbl_ct_info.is_delete','0')
                    ->paginate($perpage);
        }
        foreach ($ct_all as $key) {
            $tbl_clients_info = DB::table('tbl_clients_info')
                    ->where('fk_ct_id', $key->pk_ct_info_id)
                    ->count();
            $key->cnt_client = $tbl_clients_info;
            $grp_id = $key->fk_service_grp_ids;
            $grp = explode(',', $grp_id);
            $ct = [];
            foreach ($grp as $value) {
                $services = DB::table('tbl_service_group')
                        ->where('pk_service_group_id', $value)
                        ->first();
                $ct[$value] = $services->service_grp_name;
            }
            $key->grp_name = implode(',', $ct);
        }
        // dd($ct_all);
        $view = view('CTManagement/partialallct', compact('ct_all', 'perpage'));
        $view = $view->render();
        return response()->json(['html' => $view]);
    }

    //allocated client pagination
    public function FilterPaginationAjaxclientlist() {
        $id = $_GET['id'];
        $perpage = isset($_GET['PerPage']) ? $_GET['PerPage'] : 1;
        $tbl_clients_infos = DB::table('tbl_clients_info')
                ->where('fk_ct_id', $id)
                ->paginate($perpage);
        $view = view('CTManagement/allocatedclient', compact('tbl_clients_infos', 'perpage'));
        $view = $view->render();
        return response()->json(['html' => $view]);
    }

    //visited client pagination
    public function FilterPaginationAjaxvisitclientlist() {
        $id = $_GET['id'];
        $perpage = isset($_GET['PerPage']) ? $_GET['PerPage'] : 1;
        $visited = DB::table('tbl_client_services')
                ->join('tbl_clients_info', 'tbl_clients_info.pk_client_id', '=', 'tbl_client_services.fk_client_id')
                ->join('tbl_service_group', 'tbl_service_group.pk_service_group_id', '=', 'tbl_client_services.fk_service_grp_id')
                ->where('tbl_clients_info.fk_ct_id', $id)
                ->paginate($perpage);
        foreach ($visited as $key) {
            $key->ser_cnt = DB::table('tbl_services')
                    ->where('fk_service_grp_id', $key->fk_service_grp_id)
                    ->count();

            $key->task_cnt = DB::table('tbl_task')
                    ->where('fk_service_grp_id', $key->fk_service_grp_id)
                    ->count();
        }
        $view = view('CTManagement/allocatedvisit', compact('visited', 'perpage'));
        $view = $view->render();
        return response()->json(['html' => $view]);
    }

    //add new ct view
    public function add_new_ct() {
        $services_grp = DB::table('tbl_service_group')
                ->get();
        return view('CTManagement/addct', compact('services_grp'));
    }

    //edit ct
    public function edit_ct() {
        $id = $_GET['id'];
        $perpage = isset($_GET['PerPage']) ? $_GET['PerPage'] : 1;
        $tbl_clients_infos = DB::table('tbl_clients_info')
                ->where('fk_ct_id', $id)
                ->paginate($perpage);

        $services = DB::table('tbl_ct_info')
                ->where('pk_ct_info_id', $id)
                ->first();

        $editid = $id;

        $DataForEdit = DB::table('tbl_ct_info')
                ->where('tbl_ct_info.pk_ct_info_id', $id)
                ->first();
        $admin_grp_id = $DataForEdit->fk_service_grp_ids;
        $DataForEdit->admin_grp_name = "";
        if (strpos($admin_grp_id, ',') !== false) {//dd('a');
            $all_admin_grp_id = explode(',', $admin_grp_id);
            $names = array();
            foreach ($all_admin_grp_id as $id) {
                $names[] = DB::table('tbl_service_group')
                        ->where('pk_service_group_id', $id)
                        ->value('service_grp_name');
            }
            $DataForEdit->admin_grp_name = implode(', ', $names);
        } else {
            $DataForEdit->admin_grp_name = DB::table('tbl_service_group')
                    ->where('pk_service_group_id', $admin_grp_id)
                    ->value('service_grp_name');
        }//dd($editid);
        $visited = DB::table('tbl_client_services')
                ->join('tbl_clients_info', 'tbl_clients_info.pk_client_id', '=', 'tbl_client_services.fk_client_id')
                ->join('tbl_service_group', 'tbl_service_group.pk_service_group_id', '=', 'tbl_client_services.fk_service_grp_id')
                ->where('tbl_clients_info.fk_ct_id', $editid)
                ->paginate($perpage);
        foreach ($visited as $key) {
            $key->ser_cnt = DB::table('tbl_services')
                    ->where('fk_service_grp_id', $key->fk_service_grp_id)
                    ->count();

            $key->task_cnt = DB::table('tbl_task')
                    ->where('fk_service_grp_id', $key->fk_service_grp_id)
                    ->count();
        }
        // dd($visited);
        $tbl_clients_info = DB::table('tbl_clients_info')
                ->where('fk_ct_id', $id)
                ->get();
        $cnt_client = count($tbl_clients_info);
        $ct_get = DB::table('tbl_ct_info')
                ->where('pk_ct_info_id', $editid)
                ->first();
        $ct_dob = date("m/d/Y", strtotime($ct_get->ct_dob));
        $services_grp = DB::table('tbl_service_group')
                ->get();

        $get_police_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'police')
                ->get();
        $get_training_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'training')
                ->get();
        $get_other_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'other')
                ->get();

        $admin_group_name = $DataForEdit->admin_grp_name;
        $admin_group_id = $DataForEdit->fk_service_grp_ids;
        return view('CTManagement/editct', compact('id', 'ct_get', 'ct_dob', 'cnt_client', 'services_grp', 'get_police_cer', 'get_training_cer', 'get_other_cer', 'tbl_clients_infos', 'perpage', 'id', 'visited', 'services', 'admin_group_name', 'admin_group_id'));
    }

    //save edited ct
    public function save_edited_ct(Request $req) {
        $name = $req->input('ct_name');
        $ct_contact_info = $req->input('ct_contact_info');
        $ct_email = $req->input('ct_email');
        $ct_dob = $req->input('ct_dob');
        $ct_age = $req->ct_age_new;
        $ct_dob = date("Y-m-d", strtotime($ct_dob));
        $ct_gender = $req->input('ct_gender');
        $fk_service_grp_ids = $req->fk_service_grp_ids;
        if ($fk_service_grp_ids != null) {
            $fk_service_grp_ids = implode(',', $fk_service_grp_ids);
        }
        $ct_address = $req->input('ct_address');
        $ct_city = $req->input('ct_city');
        $ct_state = $req->input('ct_state');
        $ct_country = $req->input('ct_country');
        $ct_salary = $req->input('ct_salary');
        $police_checkup_status = $req->input('police_checkup_status');
        $police_checkup_file = $req->file('police_checkup_file');
        $training_certi_status = $req->input('training_certi_status');
        $training_certi_file = $req->file('training_certi_file');
        $other_doc_sataus = $req->input('other_doc_sataus');
        $other_doc_file = $req->file('other_doc_file');
        $id = $req->input('id');
        if ($fk_service_grp_ids != null) {
            if (isset($_REQUEST['fk_service_grp_ids'])) {
                $user_group = '';
                foreach ($_REQUEST["fk_service_grp_ids"] as $row) {
                    $user_group .= $row . ', ';
                }
                $user_group = substr($user_group, 0, -2);
            }
            $fk_service_grp_ids = $user_group;
        }

        $ct_update = DB::table('tbl_ct_info')
                ->where('pk_ct_info_id', $id)
                ->update([
            'ct_name' => $name,
            'ct_contact_info' => $ct_contact_info,
            'ct_email' => $ct_email,
            'ct_dob' => $ct_dob,
            'ct_age' => $ct_age,
            'ct_gender' => $ct_gender,
            'fk_service_grp_ids' => $fk_service_grp_ids,
            'ct_address' => $ct_address,
            'ct_city' => $ct_city,
            'ct_state' => $ct_state,
            'ct_country' => $ct_country,
            'ct_salary' => $ct_salary,
            'police_checkup_status' => $police_checkup_status,
            'training_certi_status' => $training_certi_status,
            'other_doc_sataus' => $other_doc_sataus,
        ]);
        $get_police_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'police')
                ->get();

        $get_training_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'training')
                ->get();

        $get_other_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'other')
                ->get();
        if (count($get_police_cer) > 0) {
            
        }
        if (count($get_training_cer) > 0) {
            
        }
        if (count($get_other_cer) > 0) {
            
        }

        if ($police_checkup_file != null) {
            foreach ($police_checkup_file as $key) {
                if ($key != null) {
                    $image_p = $key;
                    $new_img_p = str_replace(' ', '_', $image_p->getClientOriginalName());

                    $police_img_name = time() . '_' . $new_img_p;
                    $image_p->move(public_path() . '/images/police_checkup_image/' . $id . '/', $police_img_name);
                    $image_info = filesize(public_path() . '/images/police_checkup_image/' . $id . '/' . $police_img_name);
                    $size = round($image_info / 1000) . ' kb';
                } else {
                    $police_img_name = '';
                }
                $ct_insert1 = DB::table('tbl_ct_upload_certificate')
                        ->insertGetId([
                    'fk_ct_info_id' => $id,
                    'file_type' => 'police',
                    'file_name' => $police_img_name,
                    'file_size' => $size
                ]);
            }
        }

        if ($training_certi_file != null) {
            foreach ($training_certi_file as $key1) {
                if ($key1 != null) {
                    $image_t = $key1;
                    $new_img_t = str_replace(' ', '_', $image_t->getClientOriginalName());
                    $training_img_name = time() . '_' . $new_img_t;
                    $image_t->move(public_path() . '/images/training_certificate_image/' . $id . '/', $training_img_name);
                    $image_info1 = filesize(public_path() . '/images/training_certificate_image/' . $id . '/' . $training_img_name);
                    $size1 = round($image_info1 / 1000) . ' kb';
                } else {
                    $training_img_name = null;
                }
                $ct_insert2 = DB::table('tbl_ct_upload_certificate')
                        ->insertGetId([
                    'fk_ct_info_id' => $id,
                    'file_type' => 'training',
                    'file_name' => $training_img_name,
                    'file_size' => $size1
                ]);
            }
        }
        if ($other_doc_file != null) {
            foreach ($other_doc_file as $key2) {
                if ($key2 != null) {
                    $image_t = $key2;
                    $new_img_d = str_replace(' ', '_', $image_t->getClientOriginalName());
                    $other_img_name = time() . '_' . $new_img_d;
                    $image_t->move(public_path() . '/images/other_document_image/' . $id . '/', $other_img_name);
                    $image_info2 = filesize(public_path() . '/images/other_document_image/' . $id . '/' . $other_img_name);
                    $size2 = round($image_info2 / 1000) . ' kb';
                } else {
                    $other_img_name = null;
                }
                $ct_insert3 = DB::table('tbl_ct_upload_certificate')
                        ->insertGetId([
                    'fk_ct_info_id' => $id,
                    'file_type' => 'other',
                    'file_name' => $other_img_name,
                    'file_size' => $size2
                ]);
            }
        }

        $res = 1;
        return response()->json($res);
    }

    //create new ct
    public function save_ct(Request $req) {
        $name = $req->input('ct_name');
        $ct_contact_info = $req->input('ct_contact_info');
        $ct_email = $req->input('ct_email');
        $ct_dob = $req->input('ct_dob');
        $ct_age = $req->ct_age_new;
        $ct_dob = date("Y-m-d", strtotime($ct_dob));
        $ct_gender = $req->input('ct_gender');
        $fk_service_grp_ids = $req->fk_service_grp_ids;
        $fk_service_grp_ids = implode(',', $fk_service_grp_ids);
        $ct_address = $req->input('ct_address');
        $ct_city = $req->input('ct_city');
        $ct_state = $req->input('ct_state');
        $ct_country = $req->input('ct_country');
        $ct_salary = $req->input('ct_salary');
        $police_checkup_status = $req->input('police_checkup_status');
        $police_checkup_file = $req->file('police_checkup_file');
        $training_certi_status = $req->input('training_certi_status');
        $training_certi_file = $req->file('training_certi_file');
        $other_doc_sataus = $req->input('other_doc_sataus');
        $other_doc_file = $req->file('other_doc_file');

        if (isset($_REQUEST['fk_service_grp_ids'])) {

            $user_group = '';
            foreach ($_REQUEST["fk_service_grp_ids"] as $row) {
                $user_group .= $row . ', ';
            }
            $user_group = substr($user_group, 0, -2);
        }
        $fk_service_grp_ids = $user_group;


        $checkClient = DB::table('tbl_ct_info')->where('ct_email', $ct_email)->first();
        if (!$checkClient) {

            $pass= '12345';
            $ct_insert = DB::table('tbl_ct_info')
                    ->insertGetId([
                'ct_name' => $name,
                'ct_contact_info' => $ct_contact_info,
                'ct_email' => $ct_email,
                'ct_dob' => $ct_dob,
                'ct_age' => $ct_age,
                'ct_gender' => $ct_gender,
                'fk_service_grp_ids' => $fk_service_grp_ids,
                'ct_address' => $ct_address,
                'ct_city' => $ct_city,
                'ct_state' => $ct_state,
                'ct_country' => $ct_country,
                'ct_salary' => $ct_salary,
                'police_checkup_status' => $police_checkup_status,
                'training_certi_status' => $training_certi_status,
                'other_doc_sataus' => $other_doc_sataus,
            ]);
                    $tbl_client_ct_info =DB::table('tbl_client_ct_info')
                    ->insertGetId([
                        'fk_ct_id' => $ct_insert,
                        'email' =>$ct_email,
                        'phone_no' => $ct_contact_info,
                        'password' => bcrypt($pass),
                        'user_type' => 'ct_user',
                        'is_deleted' => 0,

                ]);
            if ($police_checkup_file != null) {
                foreach ($police_checkup_file as $key) {
                    if ($key != null) {
                        $image_p = $key;
                        $new_img_p = str_replace(' ', '_', $image_p->getClientOriginalName());
                        $police_img_name = time() . '_' . $new_img_p;
                        $image_p->move(public_path() . '/images/police_checkup_image/' . $ct_insert . '/', $police_img_name);
                        $image_info = filesize(public_path() . '/images/police_checkup_image/' . $ct_insert . '/' . $police_img_name);
                        $size = round($image_info / 1000) . ' kb';
                    } else {
                        $police_img_name = '';
                    }
                    $ct_insert1 = DB::table('tbl_ct_upload_certificate')
                            ->insertGetId([
                        'fk_ct_info_id' => $ct_insert,
                        'file_type' => 'police',
                        'file_name' => $police_img_name,
                        'file_size' => $size
                    ]);
                }
            }
            if ($training_certi_file != null) {
                foreach ($training_certi_file as $key1) {
                    if ($key1 != null) {
                        $image_t = $key1;
                        $new_img_t = str_replace(' ', '_', $image_t->getClientOriginalName());
                        $training_img_name = time() . '_' . $new_img_t;
                        $image_t->move(public_path() . '/images/training_certificate_image/' . $ct_insert . '/', $training_img_name);
                        $image_info1 = filesize(public_path() . '/images/training_certificate_image/' . $ct_insert . '/' . $training_img_name);
                        $size1 = round($image_info1 / 1000) . ' kb';
                    } else {
                        $training_img_name = null;
                    }
                    $ct_insert2 = DB::table('tbl_ct_upload_certificate')
                            ->insertGetId([
                        'fk_ct_info_id' => $ct_insert,
                        'file_type' => 'training',
                        'file_name' => $training_img_name,
                        'file_size' => $size1
                    ]);
                }
            }
            if ($other_doc_file != null) {
                foreach ($other_doc_file as $key2) {
                    if ($key2 != null) {
                        $image_t = $key2;
                        $new_img_d = str_replace(' ', '_', $image_t->getClientOriginalName());
                        $other_img_name = time() . '_' . $new_img_d;
                        $image_t->move(public_path() . '/images/other_document_image/' . $ct_insert . '/', $other_img_name);
                        $image_info2 = filesize(public_path() . '/images/other_document_image/' . $ct_insert . '/' . $other_img_name);
                        $size2 = round($image_info1 / 1000) . ' kb';
                    } else {
                        $other_img_name = null;
                    }
                    $ct_insert3 = DB::table('tbl_ct_upload_certificate')
                            ->insertGetId([
                        'fk_ct_info_id' => $ct_insert,
                        'file_type' => 'other',
                        'file_name' => $other_img_name,
                        'file_size' => $size2
                    ]);
                }
            }
            $res = 1;
        } else {
            $res = 0;
        }


        return response()->json($res);
    }

    //delete certicate
    public function cerdelete() {
        $data_id = $_GET['id'];
        DB::table('tbl_ct_upload_certificate')->where('pk_ct_upd_id', '=', $data_id)->delete();
        $res = 1;
        return response()->json($res);
    }

    //view ct
    public function viewct() {
        $id = $_GET['id'];
        $perpage = isset($_GET['PerPage']) ? $_GET['PerPage'] : 1;
        $tbl_clients_infos = DB::table('tbl_clients_info')
                ->where('fk_ct_id', $id)
                ->paginate($perpage);


        $visited = DB::table('tbl_client_services')
                ->join('tbl_clients_info', 'tbl_clients_info.pk_client_id', '=', 'tbl_client_services.fk_client_id')
                ->join('tbl_service_group', 'tbl_service_group.pk_service_group_id', '=', 'tbl_client_services.fk_service_grp_id')
                ->where('tbl_clients_info.fk_ct_id', $id)
                ->paginate($perpage);
        foreach ($visited as $key) {
            $key->ser_cnt = DB::table('tbl_services')
                    ->where('fk_service_grp_id', $key->fk_service_grp_id)
                    ->count();

            $key->task_cnt = DB::table('tbl_task')
                    ->where('fk_service_grp_id', $key->fk_service_grp_id)
                    ->count();
        }

        $id = $_GET['id'];
        $get_ct = DB::table('tbl_ct_info')->where('pk_ct_info_id', $id)->first();
        $grp_id = $get_ct->fk_service_grp_ids;

        $grp = explode(',', $grp_id);

        $ct = [];
        foreach ($grp as $value) {
            $services = DB::table('tbl_service_group')
                    ->where('pk_service_group_id', $value)
                    ->first();
            $ct[$value] = $services->service_grp_name;
        }
        $key = implode(',', $ct);
        $ct_dob = date("d F Y", strtotime($get_ct->ct_dob));


        $get_police_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'police')
                ->get();
        // dd($get_police_cer);
        $get_training_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'training')
                ->get();
        $get_other_cer = DB::table('tbl_ct_upload_certificate')
                ->where('fk_ct_info_id', $id)
                ->where('file_type', 'other')
                ->get();

        return view('CTManagement/viewct', compact('get_ct', 'ct_dob', 'key', 'tbl_clients_infos', 'id', 'perpage', 'visited', 'get_police_cer', 'get_training_cer', 'get_other_cer'));
    }

    public function delete_ct() {
//        dd('a');
        $id = $_GET['id'];
        $get_ct = DB::table('tbl_ct_info')
                        ->where('pk_ct_info_id', $id)->get();
//        dd($get_ct);
        if (count($get_ct) > 0) {
            DB::table('tbl_ct_info')
                    ->where('pk_ct_info_id', $id)
                    ->update(['is_delete' => 1]);
                    $res = 1;
                    return response()->json($res);
            // return redirect('ct_management');
        }
    }
    public function delete_ct_allocate_client()
    {
        $id = $_GET['id'];
//        dd($id);
        $get_ct_client = DB::table('tbl_clients_info')
                        ->where('pk_client_id', $id)->get();
//        dd($get_ct_client);
        if (count($get_ct_client) > 0) {
            DB::table('tbl_clients_info')
                    ->where('pk_client_id', $id)
                    ->update(['fk_ct_id' => 0]);
                    $res = 1;
                    return response()->json($res);
            // return redirect('ct_management');
        }
    }
    public function delete_ct_allocate_visit()
    {
        $id = $_GET['id'];
//        dd($id);
        $get_ct_client = DB::table('tbl_clients_info')
                        ->where('pk_client_id', $id)->get();
//        dd($get_ct_client);
        if (count($get_ct_client) > 0) {
            DB::table('tbl_clients_info')
                    ->where('pk_client_id', $id)
                    ->update(['fk_ct_id' => 0]);
                    $res = 1;
                    return response()->json($res);
            // return redirect('ct_management');
        }
    }
}
