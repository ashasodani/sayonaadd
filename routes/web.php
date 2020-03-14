<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('testblade');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
});*/
//Start DashBoard Listing Route
Route::get('/dashboard','DashboardController@index');
Route::get('partial_dashboard','DashboardController@partial_dashboard');
Route::get('given_date', 'DashboardController@given_date');
Route::get('last_seven_days','DashboardController@last_seven_days');
Route::get('last_thirty_days','DashboardController@last_thirty_days');
Route::get('this_month','DashboardController@this_month');
Route::get('last_month','DashboardController@last_month');
Route::get('custom_range','DashboardController@custom_range');




//End Dashboard List Route



//Service Management Routes
Route::get('/service_group','ServiceController@display_service_groups');
Route::get('/partial_service_grp','ServiceController@partial_service_grp');
Route::get('/save_service_grp_name','ServiceController@save_service_grp_name');
Route::get('/service_grp_detail/{service_grp_id}','ServiceController@service_grp_detail');
Route::get('/services','ServiceController@services');
Route::get('/save_new_service','ServiceController@save_new_service');
Route::get('/partial_services','ServiceController@partial_services');
Route::get('/task','ServiceController@task');
Route::get('/partial_task','ServiceController@partial_task');
Route::post('/add_new_task','ServiceController@add_new_task');
Route::get('/get_services/{service_grp}','ServiceController@get_services');
Route::get('/edit_service_group','ServiceController@edit_service_group');
Route::get('/edit_services','ServiceController@edit_services');
Route::get('/edit_task_data','ServiceController@edit_task_data');
Route::get('/service_grp_delete','ServiceController@service_grp_delete');
Route::get('/services_delete','ServiceController@services_delete');
Route::get('/task_delete','ServiceController@task_delete');


//End Service Management Routes


//Admin User Management Routes
Route::get('/all_admin_users','AdminUserController@all_admin_users');
Route::get('/admin_user_group','AdminUserController@admin_user_group');
Route::post('/save_admin_group','AdminUserController@save_admin_group');
Route::get('/partial_all_admin_user','AdminUserController@partial_all_admin_user');
Route::get('/edit_admin_user_data','AdminUserController@edit_admin_user_data');
Route::get('/delete_admin_user_data','AdminUserController@delete_admin_user_data');

Route::get('/admin_user_group_det/{group_id}','AdminUserController@admin_user_group_det');

Route::post('/allusersave','AdminUserController@allusersave');
Route::get('/view_admin_user_data','AdminUserController@view_admin_user_data');
Route::get('/edit_grp_admin_id_check','AdminUserController@edit_grp_admin_id_check');
Route::get('partial_all_admin_user_module','AdminUserController@partial_all_admin_user_module');
Route::get('delete_admin_group_id','AdminUserController@delete_admin_group_id');
Route::get('partialadmin_user_group_detail','AdminUserController@partialadmin_user_group_detail');
Route::get('/edit_grp_admin_id_check_detail','AdminUserController@edit_grp_admin_id_check_detail');
Route::get('/update_admin_grp_detail_page','AdminUserController@update_admin_grp_detail_page');
Route::get('/change_group_data_fetch','AdminUserController@change_group_data_fetch');
Route::get('/detail_delete_admin_user_data','AdminUserController@detail_delete_admin_user_data');





//End Adminroutes


//CT Management Routes start
Route::get('/ct_management','CTController@ct_management');
Route::get('FilterPaginationAjaxclient', 'CTController@FilterPaginationByAjaxct');
Route::get('/add_new_ct','CTController@add_new_ct');
Route::post('save_ct','CTController@save_ct');
Route::get('/edit_ct','CTController@edit_ct');
Route::post('save_edited_ct','CTController@save_edited_ct');
Route::get('cerdelete','CTController@cerdelete');
Route::get('FilterPaginationAjaxclientlist', 'CTController@FilterPaginationAjaxclientlist');
Route::get('FilterPaginationAjaxvisitclientlist', 'CTController@FilterPaginationAjaxvisitclientlist');
Route::get('view_ct','CTController@viewct');
Route::get('delete_ct','CTController@delete_ct');
Route::get('delete_ct_allocate_client','CTController@delete_ct_allocate_client');
Route::get('delete_ct_allocate_visit','CTController@delete_ct_allocate_visit');
//CT Management Routes End

//START Client Management Routes
Route::get('NewClient','ClientManagementController@callAddNewClientTemplate');
Route::get('getAjaxServiceGroup','ClientManagementController@getAjaxServiceGroup');
Route::post('storeClient','ClientManagementController@storeNewClient');
Route::get('getServiceList','ClientManagementController@get_service_List_from_group');
Route::get('getTaskList','ClientManagementController@get_task_List_from_service');
Route::get('getListingTemplate','ClientManagementController@get_listing_template');
Route::get('getListingTemplate/PaginateData','ClientManagementController@paginate_data');
Route::post('updateClientProfileStatus','ClientManagementController@updateClientProfileStatus');
Route::get('filterClientData','ClientManagementController@filterClientData');
Route::post('deleteClient','ClientManagementController@deleteClient');
Route::get('viewClient/{id}','ClientManagementController@viewClientData');
Route::get('editClient/{id}','ClientManagementController@editClientData');
Route::post('updateClient','ClientManagementController@updateClient');
Route::get('viewUpdateProfileStatus','ClientManagementController@viewUpdateProfileStatus');
Route::get('viewAssignCT','ClientManagementController@viewAssignCT');
//END Client Management Routes


//Login Routes Start
Route::get('/login','LoginController@index');
Route::post('postlogin','LoginController@check');

Route::get('/forgot_password','LoginController@forgot_password');
Route::post('/forgot_pass','LoginController@verify_email');

Route::post('send_mail','LoginController@sendEmail');
//Login Routes End

//Manage Visit Start

Route::get('manage_visit','ManageVisitController@index');
Route::get('manage_visits_add','ManageVisitController@create');
Route::get('get_client','ManageVisitController@get_client');
Route::get('get_times','ManageVisitController@get_times');



Route::get('manage_get_services/{srv_group}','ManageVisitController@manage_get_services');
Route::get('manage_task/{srv_name}','ManageVisitController@manage_task');

Route::get('service_group','ManageVisitController@get_service');
Route::get('manage_task_desc/{task}','ManageVisitController@manage_task_desc');
Route::get('manage_clone_service/{clone_service_group}','ManageVisitController@manage_clone_service');
Route::get('manage_clone_task/{clone_service_name}','ManageVisitController@manage_clone_task');

Route::post('manage_visit_store_save','ManageVisitController@manage_visit_store_save');
Route::get('clone_manage_desc/{c_task}','ManageVisitController@clone_manage_desc');
Route::get('partial_managevisit','ManageVisitController@partial_managevisit');
Route::get('edit_manage_visit','ManageVisitController@edit_manage_visit');
Route::get('visit_delete','ManageVisitController@visit_delete');
Route::get('view_manage_visit','ManageVisitController@view_manage_visit');
Route::get('visit_detail_delete','ManageVisitController@visit_detail_delete');



//Manage Visit End


//Invoices Routes Start
Route::get('invoices','InvoiceController@index');
Route::get('Createinvoices','InvoiceController@Createinvoices');
Route::get('partialcreateinvoice','InvoiceController@partialcreateinvoice');
Route::get('add_invoice','InvoiceController@add_invoice');
Route::get('pdf/{id}','InvoiceController@download_pdf');
Route::get('generate-pdf','InvoiceController@generatePDF');
Route::get('partial_invoice','InvoiceController@partial_invoice');
Route::get('listpdf/{id}','InvoiceController@listpdf');
//Invoices Routes End

//Settings Route Start
Route::get('settings','SettingController@index');
Route::get('save_time','SettingController@save_time');
//Settings Route End

