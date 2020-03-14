<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use DateInterval;
use Response;
use DateTime;
use DatePeriod;

class DashboardController extends Controller {

    public function index(Request $request) {
        return view('Dashboard.dashboard');
    }

    public function partial_dashboard(Request $request) {
        $items = $request->input('items') == null ? 10 : $request->input('items');
        $search_clientid = $request->input('search_clientid') == null ? '' : $request->input('search_clientid');
        $search_status = $request->input('filter_status') == null ? '' : $request->input('filter_status');
        $search_ct = $request->input('search_ct') == null ? '' : $request->input('search_ct');
        $enable_time = $request->input('enable_time') == null ? '' : $request->input('enable_time');
        $enabledate_value = $request->input('date_value') == null ? '' : $request->input('date_value');

        $visit_detail1 = DB::table('tbl_visit_detail')
                ->join('tbl_visits', 'tbl_visit_detail.fk_visit_id', '=', 'tbl_visits.pk_visits_id')
                ->join('tbl_service_group', 'tbl_service_group.pk_service_group_id', '=', 'tbl_visit_detail.fk_service_grp_id')
                ->join('tbl_ct_info', 'tbl_ct_info.pk_ct_info_id', '=', 'tbl_visits.fk_ct_id')
                ->select('tbl_visit_detail.fk_visit_id', DB::raw('group_concat(tbl_service_group.service_grp_name) as names'), 'tbl_visits.fk_ct_id', 'tbl_ct_info.ct_name', 'tbl_ct_info.ct_contact_info', 'tbl_visits.fk_client_id', 'tbl_visits.visit_date', 'tbl_visits.visit_status', 'tbl_visit_detail.start_time', 'tbl_visit_detail.fk_service_grp_id', 'tbl_visits.pk_visits_id'
                )
                ->where('tbl_visit_detail.is_delete', 0)
                ->where('tbl_visits.is_delete', 0);


        if ($search_clientid != '') {
            $visit_detail1->where('tbl_visits.fk_client_id', $search_clientid);
        }
        if ($search_status != '') {
            $visit_detail1->where('tbl_visits.visit_status', $search_status);
        }
        if ($search_ct != '') {

            $visit_detail1->where('tbl_ct_info.ct_name', 'LIKE', "%{$search_ct}%");
        }
        if ($enable_time != '') {
            if ($enable_time == 'down_time') {
                $visit_detail1->orderBy('tbl_visit_detail.start_time', 'DESC');
            } else {
                $visit_detail1->orderBy('tbl_visit_detail.start_time', 'ASC');
            }
        }
        if ($enabledate_value != '') {
            if ($enabledate_value == 'down_date') {
                $visit_detail1->orderBy('tbl_visits.visit_date', 'DESC');
            } else {
                $visit_detail1->orderBy('tbl_visits.visit_date', 'ASC');
            }
        }


        $visit_detail = $visit_detail1->groupBy('tbl_visit_detail.fk_visit_id')//->get();
                ->paginate($items);




        foreach ($visit_detail as $visit) {
            $client_name = DB::table('tbl_clients_info')
                    ->where('pk_client_id', $visit->fk_client_id)
                    ->where('is_delete', 0)
                    ->get();


            if ($client_name != '') {

                $visit->client_name = $client_name[0]->client_name;
                $visit->client_id = $client_name[0]->pk_client_id;
                $visit->client_contact_no = $client_name[0]->client_contact_no;
            }
            $service_grp_name = DB::table('tbl_service_group')
                    ->where('pk_service_group_id', $visit->fk_service_grp_id)
                    ->where('is_delete', 0)
                    ->get();
            $visit->Services = $service_grp_name[0]->service_grp_name;
        }

        $view_services = view('Dashboard/PartialDashboard', compact('items', 'visit_detail'));
        $view_services = $view_services->render();
        return response()->json(['html' => $view_services]);
    }

    public function given_date(Request $request) {

        $data = $request->date;
        $dashboard = [];
        //dd($data);
        $total_client = DB::table('tbl_clients_info')
                ->where('is_delete', 0)
                ->whereDate('created_at', '=', $data)
                ->count();

        $total_ct = DB::table('tbl_ct_info')
                ->where('is_delete', 0)
                ->whereDate('created_at', '=', $data)
                ->count();

        $total_visits = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->whereDate('created_at', '=', $data)
                ->count();

        $total_pending = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'pending')
                ->whereDate('created_at', '=', $data)
                ->count();

        $total_completed = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'completed')
                ->whereDate('created_at', '=', $data)
                ->count();
        $total_inprocess = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'inprocess')
                ->whereDate('created_at', '=', $data)
                ->count();
        return response()->json([
                    'total_clients' => $total_client,
                    'total_ct' => $total_ct,
                    'total_visits' => $total_visits,
                    'total_pending' => $total_pending,
                    'total_completed' => $total_completed,
                    'total_inprocess' => $total_inprocess,
        ]);
    }
    public function last_seven_days(Request $request){
        $data=$request->date;
         $total_client = DB::table('tbl_clients_info')
                ->where('is_delete', 0)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_ct=DB::table('tbl_ct_info')
                ->where('is_delete', 0)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_visits=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_pending=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'pending')
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_completed=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'completed')
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
        $total_inprocess = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'inprocess')
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
        
        return response()->json([
                    'total_clients' => $total_client,
                    'total_ct' => $total_ct,
                    'total_visits' => $total_visits,
                    'total_pending' => $total_pending,
                    'total_completed' => $total_completed,
                    'total_inprocess' => $total_inprocess,
        ]);
         
         
         
        
    }
     public function last_thirty_days(Request $request){
        $data=$request->date;
         $total_client = DB::table('tbl_clients_info')
                ->where('is_delete', 0)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_ct=DB::table('tbl_ct_info')
                ->where('is_delete', 0)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_visits=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_pending=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'pending')
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
         $total_completed=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'completed')
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
         
        $total_inprocess = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'inprocess')
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                ->whereDate(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), '!=', Carbon::now()->toDateString())
                ->count();
        
        return response()->json([
                    'total_clients' => $total_client,
                    'total_ct' => $total_ct,
                    'total_visits' => $total_visits,
                    'total_pending' => $total_pending,
                    'total_completed' => $total_completed,
                    'total_inprocess' => $total_inprocess,
        ]);
         
         
         
        
    }
    public function this_month(Request $request){
      
        $data=$request->date;
        $now = Carbon::now();
        $monthStart = $now->startOfMonth()->toDateString();
        $monthEnd = $now->endOfMonth()->toDateString();
         $total_client = DB::table('tbl_clients_info')
                ->where('is_delete', 0)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
       
         
         $total_ct=DB::table('tbl_ct_info')
                ->where('is_delete', 0)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
         $total_visits=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
         $total_pending=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'pending')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
         $total_completed=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'completed')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
        $total_inprocess = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'inprocess')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
        
        return response()->json([
                    'total_clients' => $total_client,
                    'total_ct' => $total_ct,
                    'total_visits' => $total_visits,
                    'total_pending' => $total_pending,
                    'total_completed' => $total_completed,
                    'total_inprocess' => $total_inprocess,
        ]);
         
         
         
        
    }
     public function last_month(Request $request){
    
        $data=$request->date;
        $now = Carbon::now()->subMonth();
        $monthStart = $now->startOfMonth()->toDateString();
        $monthEnd = $now->endOfMonth()->toDateString();
         $total_client = DB::table('tbl_clients_info')
                ->where('is_delete', 0)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
       
         
         $total_ct=DB::table('tbl_ct_info')
                ->where('is_delete', 0)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
         $total_visits=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
         $total_pending=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'pending')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
         $total_completed=DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'completed')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
         
        $total_inprocess = DB::table('tbl_visits')
                ->where('is_delete', 0)
                ->where('visit_status', 'inprocess')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
        
        return response()->json([
                    'total_clients' => $total_client,
                    'total_ct' => $total_ct,
                    'total_visits' => $total_visits,
                    'total_pending' => $total_pending,
                    'total_completed' => $total_completed,
                    'total_inprocess' => $total_inprocess,
        ]);
         
         
         
        
    }
    
    public function custom_range(Request $request){
       dd($_REQUEST);
    }
    

}
