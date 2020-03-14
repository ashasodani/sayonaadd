<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Response;
use Illuminate\Support\Facades\Input;
use Carbon;

class AdminUserController extends Controller {

    //Admin User group functions start
    public function admin_user_group(Request $request) {
        //$items = $request->items ?? 10;
        $items = 5;
        $modules = DB::table('tbl_modules')
                ->get();


        return view('AdminUserManagement/AdminUserGroup', compact('modules'));
    }

    public function partial_all_admin_user_module(Request $request) {
        $items = 5;
        if (isset($_REQUEST['page_length_grp'])) {
            $items = $_REQUEST['page_length_grp'];
        }

        $modules = DB::table('tbl_modules')
                ->get();

        $admin_user_groups = DB::table('tbl_admin_groups')
                ->join('tbl_modules', 'tbl_admin_groups.fk_module_id', '=', 'tbl_modules.pk_module_id')
                ->select(DB::raw('group_concat( DISTINCT tbl_modules.module_name) as names'), 'tbl_admin_groups.fk_group_id')
                ->where('tbl_admin_groups.is_delete', 0)
                ->groupBy('tbl_admin_groups.fk_group_id')
                ->orderBy('tbl_admin_groups.created_at');


        $admin_groups = $admin_user_groups->paginate($items);


        foreach ($admin_groups as $admin_group) {
            if ($admin_group->fk_group_id != 0) {
                //asha
                $count = 0;
                $all_admin_user = DB::table('tbl_admin_users')
                        ->where('tbl_admin_users.is_delete', 0)
                        ->get();

                foreach ($all_admin_user as $user) {
                    $getdata = $user->fk_admin_grp_name_id;
                    $getarray = explode(',', $getdata);
                    $group_ids = $admin_group->fk_group_id;
                    $findkey = array_search($group_ids, $getarray);
                    if ($findkey !== false) {
                        $count++;
                    }
                }
                //asha

                $group_name = DB::table('tbl_admin_grp_name')
                        ->where('pk_group_id', $admin_group->fk_group_id)
                        //->where('is_delete',0)
                        ->get();


                $admin_group->total_members = $count;
                $admin_group->group_name = $group_name[0]->group_name;
                $admin_group->pk_group_id = $group_name[0]->pk_group_id;
            }
        }
        $viewforpartial = view('AdminUserManagement/PartialAdminUserGrpModule', compact('modules', 'admin_groups', 'items'));
        $viewforpartial = $viewforpartial->render();
        return response()->json(['html' => $viewforpartial]);
    }

    public function save_admin_group(Request $request) {
        $id_value = $request->id_value;
        $modules_pks = $request->new_admin_grp_data[0];
        $modules_permission = $request->new_admin_grp_data[1];
        $group_name = $request->groupname;

        //This is for update start
        if ($id_value != 0) {
            $check_admin_group_name_update = DB::table('tbl_admin_grp_name')
                    ->where('group_name', $group_name)
                    ->where('pk_group_id', '!=', $id_value)
                    ->count();

            if ($check_admin_group_name_update > 0) {
                return response(0);
            } else {
                //else update start
                $size = sizeof($modules_pks) ? sizeof($modules_pks) : 0;
                if ($size > 0) {
                    $fk_group_id_update = DB::table('tbl_admin_grp_name')
                            ->where('pk_group_id', $id_value)
                            ->update([
                        'group_name' => $group_name
                    ]);
                    $already_module_exist = DB::table('tbl_admin_groups')
                            ->where('fk_group_id', $id_value)
                            ->where('is_delete', 0)
                            ->get();
                    foreach ($already_module_exist as $already_has) {
                        $allready = $already_has->fk_module_id;
                        if (!in_array($allready, $modules_pks)) {
                            $already_module_exist = DB::table('tbl_admin_groups')
                                    ->where('fk_group_id', $id_value)
                                    ->where('fk_module_id', $allready)
                                    ->update(['is_uncheck_module_id' => 1]);
                        }
                    }

                    for ($i = 0; $i < $size; $i++) {
                        $check_existing = DB::table('tbl_admin_groups')
                                ->where('fk_group_id', $id_value)
                                ->where('fk_module_id', $modules_pks[$i])
                                ->where('is_uncheck_module_id', 0)
                                ->count();

                        if ($check_existing > 0) {
                            DB::table('tbl_admin_groups')
                                    ->where('fk_group_id', $id_value)
                                    ->where('fk_module_id', $modules_pks[$i])
                                    ->update([
                                        'permission' => $modules_permission[$i]
                            ]);
                        } else {
                            DB::table('tbl_admin_groups')
                                    ->insertGetId([
                                        'fk_group_id' => $id_value,
                                        'fk_module_id' => $modules_pks[$i],
                                        'permission' => $modules_permission[$i]
                            ]);
                        }
                    }
                }
                //else update end
                $request->session()->flash('message', 'Admin Group Updated Successfully !');
                return response(1);
            }
        }
        //This is for update end
        //This is for insert start
        else {
            $check_admin_group_name = DB::table('tbl_admin_grp_name')
                    ->where('group_name', $group_name)
                    ->count();

            if ($check_admin_group_name > 0) {
                return response(0);
            } else {
                $size = sizeof($modules_permission) ? sizeof($modules_permission) : 0;

                if ($size > 0) {
                    $fk_group_id = DB::table('tbl_admin_grp_name')
                            ->insertGetId([
                        'group_name' => $group_name
                    ]);

                    for ($i = 0; $i < $size; $i++) {
                        $insert = DB::table('tbl_admin_groups')
                                ->insertGetId([
                            'fk_group_id' => $fk_group_id,
                            'fk_module_id' => $modules_pks[$i],
                            'permission' => $modules_permission[$i]
                        ]);
                    }
                }
                $request->session()->flash('message', 'Admin Group Created Successfully !');
                return response(1);
            }
        }
        //This is for insert end
    }

    public function admin_user_group_det($group_id) {
        $admin_group_info = DB::table('tbl_admin_grp_name')
                ->where('pk_group_id', $group_id)
                ->get();
        
        $admin_users_grp = DB::table('tbl_admin_grp_name')->get();

        $group_name = $admin_group_info[0]->group_name;
        $modules = DB::table('tbl_modules')
                ->get();
       
        //asha
        $count_det = 0;
        $all_admin_user_det = DB::table('tbl_admin_users')
                ->where('tbl_admin_users.is_delete', 0)
                ->get();

        foreach ($all_admin_user_det as $user) {
            $getdata = $user->fk_admin_grp_name_id;
            $getarray_det = explode(',', $getdata);

            $findkey = array_search($group_id, $getarray_det);
            if ($findkey !== false) {
                $count_det++;
            }
        }
        //asha


        $assigned_modules = DB::table('tbl_admin_groups')
                ->join('tbl_modules', 'tbl_admin_groups.fk_module_id', '=', 'tbl_modules.pk_module_id')
                ->select(DB::raw('group_concat( DISTINCT tbl_modules.module_name) as names'))
                ->where('fk_group_id', $group_id)
                ->get();

//                            dd($assigned_modules);
//        $assigned_admin_users=DB::table('tbl_admin_users')
//                            ->where('fk_admin_grp_name_id',$group_id)
//                            ->get();

        return view('AdminUserManagement/AdminUserGrpDetail', compact('admin_users_grp','group_id', 'admin_group_info', 'group_name', 'count_det', 'assigned_modules','modules'));
    }

    public function partialadmin_user_group_detail(Request $request) {
        $items = 1;
         if (isset($_REQUEST['page_length_detail_page'])) {
            $items = $_REQUEST['page_length_detail_page'];
        }
        $group_id_det = $_REQUEST['group_id'];

        $array_admin = [];
        $assigned_admin_users = DB::table('tbl_admin_users')
                ->where('is_delete', 0)
                ->get();


        foreach ($assigned_admin_users as $user) {
            $getdata = $user->fk_admin_grp_name_id;
            $getarray_det = explode(',', $getdata);
             $findkey = array_search($group_id_det, $getarray_det);
                    if ($findkey !== false) {
                         $admin_data_as = DB::table('tbl_admin_users')
                                ->whereRaw("find_in_set('" . $group_id_det . "',fk_admin_grp_name_id)")
                                ->where('is_delete', 0)
                                ->paginate($items);
                    }
           
            // if (in_array($group_id_det, $getarray_det)) {
            //     $admin_data_as = DB::table('tbl_admin_users')
            //                     ->whereRaw("find_in_set('" . $group_id_det . "',fk_admin_grp_name_id)")
            //                     ->where('is_delete', 0)
            //                     ->paginate($items);
            // }
        }
      
        $viewforpartial_detail = view('AdminUserManagement/PartialDetailAdminUserGrp', compact('admin_data_as', 'items'));
        $viewforpartial1 = $viewforpartial_detail->render();
        return response()->json(['html' => $viewforpartial1]);
    }

    public function edit_grp_admin_id_check(Request $request) {
        $edit_grp_admin_id = $_REQUEST['edit_grp_admin_id'];

        $admin_edit_data = DB::table('tbl_admin_groups')
                ->join('tbl_modules', 'tbl_admin_groups.fk_module_id', '=', 'tbl_modules.pk_module_id')
                ->join('tbl_admin_grp_name', 'tbl_admin_groups.fk_group_id', '=', 'tbl_admin_grp_name.pk_group_id')
                ->where('tbl_admin_groups.fk_group_id', $edit_grp_admin_id)
                ->where('tbl_admin_groups.is_uncheck_module_id', 0)
                ->get();

        return response()->json($admin_edit_data);
    }

    public function delete_admin_group_id(Request $request) {

        $delete_group_id = $_REQUEST['delete_grp_id'];
        $all_admin_user = DB::table('tbl_admin_users')
                ->where('tbl_admin_users.is_delete',0)
                ->get();

        foreach ($all_admin_user as $user) {
            $getdata = $user->fk_admin_grp_name_id;
            $getarray = explode(',', $getdata);

            $deleteKey = array_search($delete_group_id, $getarray);
            if ($deleteKey !== false) {
                unset($getarray[$deleteKey]);
                $update_again = implode(",", $getarray);
                DB::table('tbl_admin_users')
                        ->where('fk_admin_grp_name_id', $getdata)
                        ->update([
                            'fk_admin_grp_name_id' => $update_again
                ]);
            }
        }
        $setdeleteid=DB::table('tbl_admin_groups')
                    ->where('fk_group_id',$delete_group_id)
                    ->update(['is_delete'=>0]);
        return response()->json(1);
    }

    //Admin user group functions end
    //All admin user function start
    public function all_admin_users() {
        $grp_name[] = "";
        $admin_users_grp = DB::table('tbl_admin_grp_name')->get();
        $all_admin_user = DB::table('tbl_admin_users')
                ->where('is_delete', 0)
                ->orderBy('created_at', 'DESC')
                ->paginate(1);
        foreach ($all_admin_user as $all_uss) {
            $grp_name[$all_uss->pk_admin_users_id] = DB::table('tbl_admin_grp_name')
                    ->where('pk_group_id', $all_uss->fk_admin_grp_name_id)
                    ->value('group_name');
        }

        return view('AdminUserManagement/AllAdminUsers', compact('admin_users_grp', 'all_admin_user', 'grp_name'));
    }

    public function partial_all_admin_user(Request $request) {

        $items = '10';
        if (isset($_REQUEST['page_length_value'])) {
            $items = $_REQUEST['page_length_value'];
        }
        //$search_service_grp = $request->input('search_service_grp') == null ? '' : $request->input('search_service_grp');
        //$items = $request->items ?? $items_as;
        $all_admin_user_1 = DB::table('tbl_admin_users')
                ->where('is_delete', 0)
                ->orderBy('created_at', 'DESC');


        $all_admin_user = $all_admin_user_1->paginate($items);
        $grp_name[] = "";
        foreach ($all_admin_user as $all_uss) {
            $grp_name[$all_uss->pk_admin_users_id] = DB::table('tbl_admin_grp_name')
                    ->where('pk_group_id', $all_uss->fk_admin_grp_name_id)
                    ->value('group_name');

            if (strpos($all_uss->fk_admin_grp_name_id, ',') !== false) {
                $all_grp_name_ids = explode(',', $all_uss->fk_admin_grp_name_id);
                $names = array();
                foreach ($all_grp_name_ids as $id) {
                    $names[] = DB::table('tbl_admin_grp_name')
                            ->where('pk_group_id', $id)
                            ->value('group_name');
                }
                $grp_name[$all_uss->pk_admin_users_id] = implode(', ', $names);
            } else {
                $grp_name[$all_uss->pk_admin_users_id] = DB::table('tbl_admin_grp_name')
                        ->where('pk_group_id', $all_uss->fk_admin_grp_name_id)
                        ->value('group_name');
            }
        }

        $view1 = view('AdminUserManagement/PartialAdminUserGrp', compact('items', 'all_admin_user', 'grp_name'));
        $view1 = $view1->render();
        return response()->json(['html' => $view1]);
    }

    public function allusersave(Request $request) {
        // dd($_REQUEST['dob']);
        $edit_id = $_REQUEST['edit_id'];
        $returnMessage = "";


        if (isset($_REQUEST['admin_user_group'])) {
            $user_group = '';
            foreach ($_REQUEST["admin_user_group"] as $row) {
                $user_group .= $row . ', ';
            }
            $user_group = substr($user_group, 0, -2);
        }
//              $id = DB::table('testmultiple')->insertGetId(
//                ['selectframe' => $framework]);
//        }
        //return  response()->json(1);
        if ($edit_id == 0) {

            $pk_admin_users_id = DB::table('tbl_admin_users')->insertGetId([
                'fk_admin_grp_name_id' => $user_group,
                'admin_name' => $_REQUEST['admin_name'],
                'contact_number' => $_REQUEST['contact_number'],
                'address' => $_REQUEST['address'],
                'city' => $_REQUEST['admin_city'],
                'state' => $_REQUEST['admin_state'],
                'country' => $_REQUEST['admin_country'],
                'dob' => \Carbon\Carbon::parse($_REQUEST['dob'])->format('Y-m-d'),
                'age' => $_REQUEST['age'],
                'gender' => $_REQUEST['gender'],
                'is_delete' => 0
            ]);
            $returnMessage = "User Created Successfully!";
        } else {

            $pk_admin_users_id = DB::table('tbl_admin_users')->where('pk_admin_users_id', $edit_id)
                    ->update([
                'fk_admin_grp_name_id' => $user_group,
                'admin_name' => $_REQUEST['admin_name'],
                'contact_number' => $_REQUEST['contact_number'],
                'address' => $_REQUEST['address'],
                'city' => $_REQUEST['admin_city'],
                'state' => $_REQUEST['admin_state'],
                'country' => $_REQUEST['admin_country'],
                'dob' => \Carbon\Carbon::parse($_REQUEST['dob'])->format('Y-m-d'),
                'age' => $_REQUEST['age'],
                'gender' => $_REQUEST['gender'],
                'is_delete' => 0
            ]);
            $returnMessage = "User Updated Successfully!";
        }
        $request->session()->flash('add_admin_user', $returnMessage);
        return response()->json(1);
    }

    public function edit_admin_user_data(Request $request) {
        $editid = $_GET['edit_id'];
        $DataForEdit = DB::table('tbl_admin_users')
                ->where('tbl_admin_users.pk_admin_users_id', $editid)
                ->first();
        $admin_grp_id = $DataForEdit->fk_admin_grp_name_id;
        $DataForEdit->admin_grp_name = "";
        if (strpos($admin_grp_id, ',') !== false) {
            $all_admin_grp_id = explode(',', $admin_grp_id);
            $names = array();
            foreach ($all_admin_grp_id as $id) {
                $names[] = DB::table('tbl_admin_grp_name')
                        ->where('pk_group_id', $id)
                        ->value('group_name');
            }
            $DataForEdit->admin_grp_name = implode(', ', $names);
        } else {
            $DataForEdit->admin_grp_name = DB::table('tbl_admin_grp_name')
                    ->where('pk_group_id', $admin_grp_id)
                    ->value('group_name');
        }
        return response()->json($DataForEdit);
    }

    public function delete_admin_user_data(Request $request) {
        $delete_id = $_GET['delete_id'];
        $pk_admin_users_id_delete = DB::table('tbl_admin_users')
                ->where('pk_admin_users_id', $delete_id)
                ->update(['is_delete' => 1]);
        $returnMessage = "User Deleted Successfully!";
        $request->session()->flash('add_admin_user', $returnMessage);
        $returnMessage = "User Deleted Successfully!";
        $request->session()->flash('add_admin_user', $returnMessage);
        return response()->json(1);
    }

    public function view_admin_user_data(Request $request) {

        $view_id = $_GET['view_id'];
        $DataForEdit_v = DB::table('tbl_admin_users')
                ->where('tbl_admin_users.pk_admin_users_id', $view_id)
                ->first();
        $admin_grp_id_v = $DataForEdit_v->fk_admin_grp_name_id;
        $DataForEdit_v->admin_grp_name = "";
        if (strpos($admin_grp_id_v, ',') !== false) {
            $all_admin_grp_id = explode(',', $admin_grp_id_v);
            $names = array();
            foreach ($all_admin_grp_id as $id) {
                $names[] = DB::table('tbl_admin_grp_name')
                        ->where('pk_group_id', $id)
                        ->value('group_name');
            }
            $DataForEdit_v->admin_grp_name = implode(', ', $names);
        } else {
            $DataForEdit_v->admin_grp_name = DB::table('tbl_admin_grp_name')
                    ->where('pk_group_id', $admin_grp_id_v)
                    ->value('group_name');
        }
        return response()->json($DataForEdit_v);
    }
    
     public function edit_grp_admin_id_check_detail(Request $request) {
        $group_id_edit = $_REQUEST['group_id_edit'];

        $admin_edit_data1 = DB::table('tbl_admin_groups')
                ->join('tbl_modules', 'tbl_admin_groups.fk_module_id', '=', 'tbl_modules.pk_module_id')
                ->join('tbl_admin_grp_name', 'tbl_admin_groups.fk_group_id', '=', 'tbl_admin_grp_name.pk_group_id')
                ->where('tbl_admin_groups.fk_group_id', $group_id_edit)
                ->where('tbl_admin_groups.is_uncheck_module_id', 0)
                ->get();
       

        return response()->json($admin_edit_data1);
    }
    public function update_admin_grp_detail_page(Request $request){
        //This is for update start
         $id_value_det = $request->id_value_det;
          $modules_pks = $request->new_admin_grp_data[0];
        $modules_permission = $request->new_admin_grp_data[1];
        $group_name = $request->groupname;
        if ($id_value_det != 0) {
            $check_admin_group_name_update = DB::table('tbl_admin_grp_name')
                    ->where('group_name', $group_name)
                    ->where('pk_group_id', '!=', $id_value_det)
                    ->count();

            if ($check_admin_group_name_update > 0) {
                return response(0);
            } else {
                //else update start
                $size = sizeof($modules_pks) ? sizeof($modules_pks) : 0;
                if ($size > 0) {
                    $fk_group_id_update = DB::table('tbl_admin_grp_name')
                            ->where('pk_group_id', $id_value_det)
                            ->update([
                        'group_name' => $group_name
                    ]);
                    $already_module_exist = DB::table('tbl_admin_groups')
                            ->where('fk_group_id', $id_value_det)
                            ->where('is_delete', 0)
                            ->get();
                    foreach ($already_module_exist as $already_has) {
                        $allready = $already_has->fk_module_id;
                        if (!in_array($allready, $modules_pks)) {
                            $already_module_exist = DB::table('tbl_admin_groups')
                                    ->where('fk_group_id', $id_value_det)
                                    ->where('fk_module_id', $allready)
                                    ->update(['is_uncheck_module_id' => 1]);
                        }
                    }

                    for ($i = 0; $i < $size; $i++) {
                        $check_existing = DB::table('tbl_admin_groups')
                                ->where('fk_group_id', $id_value_det)
                                ->where('fk_module_id', $modules_pks[$i])
                                ->where('is_uncheck_module_id', 0)
                                ->count();

                        if ($check_existing > 0) {
                            DB::table('tbl_admin_groups')
                                    ->where('fk_group_id', $id_value_det)
                                    ->where('fk_module_id', $modules_pks[$i])
                                    ->update([
                                        'permission' => $modules_permission[$i]
                            ]);
                        } else {
                            DB::table('tbl_admin_groups')
                                    ->insertGetId([
                                        'fk_group_id' => $id_value_det,
                                        'fk_module_id' => $modules_pks[$i],
                                        'permission' => $modules_permission[$i]
                            ]);
                        }
                    }
                }
                //else update end
                $request->session()->flash('message1', 'Admin Group Updated Successfully !');
                return response(1);
            }
        }
        //This is for update end
    }

}
