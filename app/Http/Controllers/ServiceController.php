<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function display_service_groups(Request $request)
    {
        $search_service_grp = $request->input('search_service_grp') == null ? '' : $request->input('search_service_grp');
        $items =10;
        $service_grps=DB::table('tbl_service_group')
            ->leftjoin('tbl_services','tbl_services.fk_service_grp_id','tbl_service_group.pk_service_group_id')
            ->select(DB::raw('count(tbl_services.fk_service_grp_id) as total_services'),'tbl_service_group.pk_service_group_id')
            ->where('tbl_service_group.service_grp_name','LIKE',"%{$search_service_grp}%")
            ->groupBy('tbl_service_group.pk_service_group_id')
            ->orderBy('tbl_service_group.created_at','DESC');

        $service_groups =$service_grps->paginate($items);
        foreach ($service_groups as $service_group)
        {

            $count_task=DB::table('tbl_task')
                ->where('tbl_task.fk_service_grp_id',$service_group->pk_service_group_id)
                ->where('tbl_task.is_delete',0)
                ->count();
            $service_group_name=DB::table('tbl_service_group')
                ->where('pk_service_group_id',$service_group->pk_service_group_id)
                ->get();

            $service_group->total_task=$count_task;
            $service_group->service_group_name=$service_group_name[0]->service_grp_name;
            $service_group->pk_service_group_id=$service_group_name[0]->pk_service_group_id;

        }

        return view('ServiceManagement/ServiceGroup',compact('items','service_groups'));
    }

    public function partial_service_grp(Request $request){
        
        $search_service_grp = $request->input('search_service_grp') == null ? '' : $request->input('search_service_grp');
        $items = $request->input('se_grp_page_length') == null ? 10 : $request->input('se_grp_page_length');
        //$items = $request->items ?? 2;
        $service_grps=DB::table('tbl_service_group')
            ->leftjoin('tbl_services','tbl_services.fk_service_grp_id','tbl_service_group.pk_service_group_id')
            ->select(DB::raw('count(tbl_services.fk_service_grp_id) as total_services'),'tbl_service_group.pk_service_group_id')
            ->where('tbl_service_group.service_grp_name','LIKE',"%{$search_service_grp}%")
            ->groupBy('tbl_service_group.pk_service_group_id')
            ->orderBy('tbl_service_group.created_at','DESC');

        $service_groups =$service_grps->paginate($items);
        foreach ($service_groups as $service_group)
        {

            $count_task=DB::table('tbl_task')
                ->where('tbl_task.fk_service_grp_id',$service_group->pk_service_group_id)
                ->where('tbl_task.is_delete',0)
                ->count();
            $service_group_name=DB::table('tbl_service_group')
                ->where('pk_service_group_id',$service_group->pk_service_group_id)
                ->get();

            $service_group->total_task=$count_task;
            $service_group->service_group_name=$service_group_name[0]->service_grp_name;
            $service_group->pk_service_group_id=$service_group_name[0]->pk_service_group_id;

        }
        $view1 = view('ServiceManagement/PartialServiceGroup', compact('items', 'service_groups'));
        $view1 = $view1->render();
        return response()->json(['html' => $view1]);
    }

    public function save_service_grp_name(Request $request)
    {
        $service_grp_name=$request->input('service_grp_name');
        $service_edit_id=$request->input('ser_edit_id');
        if($service_edit_id==0){
       

            DB::table('tbl_service_group')
                ->insert([
                   'service_grp_name'=>$service_grp_name,
                ]);
             $returnMessage="Service Group Created Successfully !";
        }
        else{
            DB::table('tbl_service_group')
                    ->where('pk_service_group_id',$service_edit_id)
                    ->update([
                        'service_grp_name'=>$service_grp_name,
                    ]);
            $returnMessage="Service Group Updated Successfully !";
        }
        

        $request->session()->flash('service_grp_name',$returnMessage);
        return response(1);
    }

    public function service_grp_detail($service_grp_id)
    {
        $service_grp_name=DB::table('tbl_service_group')
                                ->where('pk_service_group_id',$service_grp_id)
                                ->get();
        $service_task=DB::table('tbl_task')
                                ->where('tbl_task.fk_service_grp_id',$service_grp_id)
                                ->where('tbl_task.is_delete',0)
                                ->count();

        $total_services=DB::table('tbl_services')
                                ->where('fk_service_grp_id',$service_grp_id)
                                ->where('is_delete',0)
                                ->count();
        $service_details=DB::table('tbl_services')
                                ->where('fk_service_grp_id',$service_grp_id)
                                ->where('is_delete',0)
                                ->get();

        $task_details=[];
        foreach ($service_details as $service_detail)
        {
            $task_detail=DB::table('tbl_task')
                                ->where('fk_service_grp_id',$service_grp_id)
                                ->where('fk_services_id',$service_detail->pk_services_id)
                                ->get();
            $service_detail->accordion_name=str_replace(' ', '_', $service_detail->service_name);
            for($i=0;$i<sizeof($task_detail);$i++) {
                array_push($task_details, [
                    'task_name' => $task_detail[$i]->task_name,
                    'fk_services_id' => $task_detail[$i]->fk_services_id,
                    'descp' => $task_detail[$i]->task_description
                ]);
            }

        }

        return view('ServiceManagement/ServiceGroupDetail',compact('service_grp_name','service_task','total_services',
                                                                                 'task_details','service_details'));
    }



    public function services(Request $request)
    {
        $search_service_name = $request->input('search_service_name') == null ? '' : $request->input('search_service_name');
        $items = $request->items ?? 10;
        $services_grps=DB::table('tbl_service_group')
                    ->get();

        $services=DB::table('tbl_services')
                    ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_services.fk_service_grp_id')
                    ->select('tbl_services.*','tbl_service_group.*')
                    ->where('tbl_services.service_name','LIKE',"%{$search_service_name}%")
                    ->orderBy('tbl_services.created_at','DESC');

        $services_paginate=$services->paginate($items);
        foreach ($services_paginate as $service)
        {
            $task_count=DB::table('tbl_task')
                            ->where('tbl_task.fk_services_id',$service->pk_services_id)
                            ->count();
            $service->task_count=$task_count;
        }

        return view('ServiceManagement/Services',compact('services_grps','services_paginate','items'));
    }



    public function save_new_service(Request $request)
    {
        $services_update_id=$request->services_edit_id;
        
        $find_service=DB::table('tbl_services')
                        ->where('service_name',$request->servicename)
                        ->count();
        
        
        $findservice_while_update=DB::table('tbl_services')
                                ->where('service_name',$request->servicename)
                                ->where('pk_services_id', '!=' ,$services_update_id)
                                ->count();
       
        
        
       if($services_update_id==0){
            if($find_service==0)
            {
                DB::table('tbl_services')
                    ->insert([
                        'fk_service_grp_id'=>$request->service_grp,
                        'service_name'=>$request->servicename,
                        'hourly_rate'=>$request->hourlyrate,
                    ]);
                $request->session()->flash('service_name', 'Services  Created Successfully !');
                return response(1);
            }else{
                return response(0);
            }
       }
       else{
           if($findservice_while_update==0){
            DB::table('tbl_services')
                    ->where('pk_services_id',$services_update_id)
                    ->update([
                         'fk_service_grp_id'=>$request->service_grp,
                         'service_name'=>$request->servicename,
                         'hourly_rate'=>$request->hourlyrate,

                    ]);
             $request->session()->flash('service_name', 'Services  Updated Successfully !');
            return response(2);
           }
           else{
                return response(0);
           }
       }
    }

    public function partial_services(Request $request)
    {
        $search_service_name = $request->input('search_service_name') == null ? '' : $request->input('search_service_name');
        $items = $request->items ?? 10;
        $services_grps=DB::table('tbl_service_group')
            ->get();

        $services=DB::table('tbl_services')
            ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_services.fk_service_grp_id')
            ->select('tbl_services.*','tbl_service_group.*')
            ->where('tbl_services.service_name','LIKE',"%{$search_service_name}%")
            ->orderBy('tbl_services.created_at','DESC');

        $services_paginate=$services->paginate($items);
        foreach ($services_paginate as $service)
        {
            $task_count=DB::table('tbl_task')
                ->where('tbl_task.fk_services_id',$service->pk_services_id)
                ->count();
            $service->task_count=$task_count;
        }

        $view1 = view('ServiceManagement/PartialService', compact('items', 'services_paginate'));
        $view1 = $view1->render();
        return response()->json(['html' => $view1]);
    }


    public function task(Request $request)
    {
        $search_task = $request->input('search_task') == null ? '' : $request->input('search_task');
        $items = $request->items ?? 10;
        $service_groups=DB::table('tbl_service_group')
                    ->get();

        $tasks=DB::table('tbl_task')
                ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_task.fk_service_grp_id')
                ->join('tbl_services','tbl_services.pk_services_id','=','tbl_task.fk_services_id')
                ->where('tbl_task.task_name','LIKE',"%{$search_task}%")
                ->orderBy('tbl_task.created_at','DESC')
                ->paginate($items);
//        dd($tasks);
        return view('ServiceManagement/Task',compact('service_groups','tasks'));
    }

    public function partial_task(Request $request)
    {
        $items = $request->input('items') == null ?10 : $request->input('items');
        $search_task = $request->input('search_task') == null ? '' : $request->input('search_task');
        //$items = $request->items ?? 1;
        $service_groups=DB::table('tbl_service_group')
            ->get();

        $tasks=DB::table('tbl_task')
            ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_task.fk_service_grp_id')
            ->join('tbl_services','tbl_services.pk_services_id','=','tbl_task.fk_services_id')
            ->where('tbl_task.task_name','LIKE',"%{$search_task}%")
            ->orderBy('tbl_task.created_at','DESC')
            ->paginate($items);

        $view1 = view('ServiceManagement/PartialTask', compact('items', 'tasks','service_groups'));
        $view1 = $view1->render();
        return response()->json(['html' => $view1]);
    }

    public function add_new_task(Request $request)
    {
            $update_task_id=$_REQUEST['update_task_id'];
            
            $find_task=DB::table('tbl_task')
                            ->where('fk_service_grp_id',$request->service_grp)
                            ->where('fk_services_id',$request->servicename)
                            ->where('task_name',$request->taskname)
                            ->count();
            
              $find_task_for_update=DB::table('tbl_task')
                            ->where('fk_service_grp_id',$request->service_grp)
                            ->where('fk_services_id',$request->servicename)
                            ->where('task_name',$request->taskname)
                            ->where('pk_task_id','!=',$update_task_id)
                            ->count();
            if($update_task_id==0){
                if($find_task==0)
                {
                    DB::table('tbl_task')
                            ->insert([
                                'fk_service_grp_id'=>$request->service_grp,
                                'fk_services_id'=>$request->servicename,
                                'task_name'=>$request->taskname,
                                'task_description'=>$request->task_desp
                            ]);

                    $request->session()->flash('task_name_success', 'Task Added Successfully !');
                    return response(1);

                }else{
                    return response(0);
                }
            }
            else{
                 if($find_task_for_update==0){
                     DB::table('tbl_task')
                     ->where('pk_task_id',$update_task_id)
                     ->update([
                                'fk_service_grp_id'=>$request->service_grp,
                                'fk_services_id'=>$request->servicename,
                                'task_name'=>$request->taskname,
                                'task_description'=>$request->task_desp
                            ]);

                    $request->session()->flash('task_name_success', 'Task Updated Successfully !');
                    return response(1);

                 
                  }else{
                    return response(0);
                    }
                
            }
    }

    public function get_services($service_grp)
    {
        $services=DB::table('tbl_services')
            ->where('fk_service_grp_id',$service_grp)
            ->get();

        return response()->json($services);
    }
    
    public function edit_service_group(Request $request){
        $edit_service_grp_id=$_REQUEST['edit_grp_id'];
        $data_service_grp=DB::table('tbl_service_group')
                        ->where('pk_service_group_id',$edit_service_grp_id)
                        ->first();
        $servide_grp_data=$data_service_grp->pk_service_group_id;
         return response()->json($data_service_grp);
    }
    
    
    public function edit_services(Request $request){
        $services_edit_id=$_REQUEST['edit_service_id'];
        $data_services_edit=DB::table('tbl_services')
                            ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_services.fk_service_grp_id')
                            ->where('tbl_services.pk_services_id',$services_edit_id)
                            ->first();
       
        return response()->json($data_services_edit);
    }
    
    public function edit_task_data(Request $request){
        $edit_task_id=$_REQUEST['edit_task_id'];
        $edit_services=DB::table('tbl_task')
         ->join('tbl_service_group','tbl_service_group.pk_service_group_id','=','tbl_task.fk_service_grp_id')
            ->join('tbl_services','tbl_services.pk_services_id','=','tbl_task.fk_services_id')
            ->where('pk_task_id',$edit_task_id)
            ->first();
            
        return response()->json($edit_services);
       
        
    }
    public function service_grp_delete(Request $reques){
        $delete_grp_id=$_REQUEST['delete_id'];
        dd($delete_grp_id);
         $request->session()->flash('service_grp_name', 'Service Group Deleted Successfully !');
          return response()->json(1);
        
    }
    
    public function services_delete(Request $reques){
        $delete_services_id=$_REQUEST['delete_id'];
        dd($delete_services_id);
         $request->session()->flash('service_name', 'Services Deleted Successfully !');
          return response()->json(1);
    }
    public function task_delete(Request $request){
        $delete_task_id=$_REQUEST['delete_id'];
        dd($delete_task_id);
         $request->session()->flash('task_name_success', 'Task Deleted Successfully !');
          return response()->json(1);
    }
}
