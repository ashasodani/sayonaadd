@extends('layouts.layout')
@section('title')
Client Management - Edit Client
@endsection
@section('main')
<style>
.err_msg,.exist_email_msg{
    color:#e42626;
    font-family:calibri;
    font-size:15px;
    font-weight: bold;
}
#errmsgbalance,#errmsg,#errmsg1{
    color:#e42626;
    font-family:calibri;
    font-size:15px;
    font-weight: bold;
}
.d-suc-msg{
    color: #f6fcfb;
    background-color: #58d8a0;
    border-color: #58d8a0;
    margin-top: 20px;    
    text-align: center;
    font-weight: bold;
}
.close_btn_clone {
    margin-top: 53px;
    margin-left: 74px;
}
a.d_cancel_clone_service {
    background-color: #293c5e;
    color: #ffffff;
    font-family: "Open Sans";
    font-size: 14px;
    font-weight: 400;
    padding: 9px 14px;
    vertical-align: middle;
    border-radius: 4px;
}
.m-portlet__head-title.ad_rt {
    float: right;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" class="d_hdn_clientID" value="{{$ClientData[0]->pk_client_id}}">
<!-- BEGIN: Subheader -->
<div class="m-subheader breadcrumb_sad">
    <div class="d-flex align-items-center edit_client">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Edit Client Detail
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="javascript:;" class="m-nav__link m-nav__link--icon">
                        <img src="{{URL::asset('images/home.png')}}" alt="" />
                    </a>
                </li>
                <li class="m-nav__separator">
                    <img src="{{URL::asset('images/dot_img.png')}}" alt="" />
                </li>
                <li class="m-nav__item">
                    <a href="{{url('getListingTemplate')}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Client Management
                        </span>
                    </a>

                <li class="m-nav__separator">
                    <img src="{{URL::asset('images/dot_img.png')}}" alt="" />
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Edit Client Detail
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END: Subheader -->
<div class="m-content page_contant">

    <!--Begin::Section-->
    <div class="alert alert-success d-suc-msg" style="display:none;">Congrats, Data updated successfully!</div>
    <div class="row">        
        <div class="col-xl-12">
            <!--begin:: Widgets/Best Sellers-->
            <div class="m-portlet m-portlet--full-height edit_client_detail">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Edit Client Detail
                            </h3>
                        </div>
                    </div>
                    <div class="edit_client m-header-search__wrapper">
                        <div class="save_btn">
                            <a href="javascript:void(0);" class="save_btn d_btn_save_edit">Save</a>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Widget 11-->
                    <div class="m-widget11 edit_client_detail">
                        <!--                                            <div class="table-responsive">-->
                        <div class="row m-0 box-content edit_client_detail">
                            <div class="box-content-1">
                                <span class="detail-title">Client Id</span>
                                <span class="detail-content">{{$ClientData[0]->client_view_id}}</span>
                            </div>
                            <div class="box-content-2">
                                <span class="detail-title">Client Name*</span>
                                <input type="text" class="form-control m-input d_clnt_Name" aria-describedby="groupName"
                                    placeholder="Enter Client Name" maxlength="40" value="{{$ClientData[0]->client_name}}">
                            </div>
                            <div class="box-content-2">
                                <span class="detail-title">Contact Number*</span>
                                <input type="text" class="form-control m-input d_clnt_contact"
                                    aria-describedby="groupName" placeholder="Enter Contact Number" maxlength="15" value="{{$ClientData[0]->client_contact_no}}">
                                <span id="errmsg"></span>
                            </div>
                            <div class="box-content-2">
                                <span class="detail-title">Email*</span>
                                <input type="text" class="form-control m-input d_clnt_email"
                                    aria-describedby="groupName" placeholder="Enter Email" value="{{$ClientData[0]->client_email}}" readonly>
                            </div>
                            <div class="box-content-6">
                                <span class="detail-title">Date of Birth*</span>
                                <div class="input-group date d_err_msg_dob">
                                    @php $example_datetime = $ClientData[0]->client_dob;
                                    $date=DateTime::createFromFormat('Y-m-d H:i:s', $example_datetime );
                                    $output=$date->format('d/m/Y');                                   
                                    @endphp
                                    <input type="hidden" value="{{$output}}" class="d_hdn_dob_edit">
                                    <input type="text" class="form-control m-input d_clnt_dob" autocomplete="off"
                                        id="dob" placeholder="DD/MM/YYYY">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <img src="{{URL::asset('images/date_picker_icon.png')}}" alt="" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content-1">
                                <span class="detail-title">Age</span>
                                <span class="age">{{$ClientData[0]->client_age}}</span>
                            </div>
                            <div class="box-content-3">
                                <span class="detail-title">Gender*</span>
                                <div class="m-form__group form-group d_err_gender_msg">
                                    <div class="m-radio-inline add_amount_balance_right">
                                        <label class="m-radio m-radio--brand">
                                            <input type="radio" name="gender" value="male" class="d_gender" {{$ClientData[0]->client_gender == 'male'?'checked':''}}>
                                            Male
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--brand">
                                            <input type="radio" name="gender" value="female" class="d_gender" {{$ClientData[0]->client_gender == 'female'?'checked':''}}>
                                            Female
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content-4">
                                <span class="detail-title">Address*</span>
                                <input type="text" class="form-control m-input d_clnt_address"
                                    aria-describedby="groupName" placeholder="Enter Address" maxlength="40" value="{{$ClientData[0]->client_address}}">
                            </div>

                            <div class="box-content-2">
                                <span class="detail-title">City*</span>
                                <input type="text" id="autocomplete" onFocus="geolocate()"
                                    class="form-control m-input d_clnt_city" aria-describedby="groupName"
                                    placeholder="Enter City" maxlength="40" value="{{$ClientData[0]->client_city}}">
                            </div>

                            <div class="box-content-5">
                                <span class="detail-title">State*</span>
                                <div class="dropdown bootstrap-select form-control m-bootstrap-select m_ d_msg_state">
                                    <input class="field form-control d_clnt_state" id="administrative_area_level_1"
                                        readonly placeholder="State" value="{{$ClientData[0]->client_state}}">
                                </div>
                            </div>
                            <div class="box-content-5">
                                <span class="detail-title">Country*</span>
                                <div class="dropdown bootstrap-select form-control m-bootstrap-select m_ d_msg_country">
                                    <input class="field form-control d_clnt_country" id="country" readonly
                                        placeholder="Country" value="{{$ClientData[0]->client_country}}">
                                </div>
                            </div>
                            <div class="box-content-2">
                                <span class="detail-title">Health Conditions*</span>
                                <input type="text" class="form-control m-input d_clnt_health"
                                    aria-describedby="groupName" placeholder="Enter Health Conditions" maxlength="40" value="{{$ClientData[0]->health_conditions}}">
                            </div>

                            <div class="box-content-2">
                                <span class="detail-title">Next of Kin Name*</span>
                                <input type="text" class="form-control m-input d_clnt_next_of_kin_name"
                                    aria-describedby="groupName" placeholder="Enter Next of Kin Name" maxlength="40" value="{{$ClientData[0]->kin_name}}">
                            </div>
                            <div class="box-content-2">
                                <span class="detail-title">Next of Kin Number*</span>
                                <input type="text" class="form-control m-input d_clnt_next_of_kin_number"
                                    aria-describedby="groupName" placeholder="Enter Next of Kin Number" maxlength="15" value="{{$ClientData[0]->kin_phone_no}}">
                                <span id="errmsg1"></span>
                            </div>
                            <div class="box-content-2">
                                <span class="detail-title">Next of Kin Email*</span>
                                <input type="text" class="form-control m-input d_clnt_next_of_kin_email"
                                    aria-describedby="groupName" placeholder="Enter Next of Kin Email" maxlength="40" value="{{$ClientData[0]->kin_email}}">
                            </div>
                            <div class="box-content-5">
                                <span class="detail-title">CT</span>
                                <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                                    <select class="form-control m-bootstrap-select m_selectpicker d_clnt_CT"
                                        tabindex="-98">
                                        <option value="0">Select CT</option>
                                        @foreach($getCTList as $ct_list)
                                        <option value="{{$ct_list->pk_ct_info_id}}" {{$ct_list->pk_ct_info_id == $ClientData[0]->fk_ct_id ? 'selected':''}}>{{$ct_list->ct_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- <div class="m-portlet__body client_tabs">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#m_tabs_1_1">
                Allocated Services
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">
                Transaction History
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#m_tabs_1_3">
                Complete Visits
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
            <div class="m-portlet m-portlet--full-height client_tabel ">
                <div class="m-section ">
                    <div class="table-responsive">
                        
                        <table class="table client_service">
                            
                            <thead>
                                <tr>
                                    <td class="m-section_group">
                                        Service Group
                                    </td>
                                    <td class="m-section_name">
                                        No. of Service Name
                                    </td>
                                    <td class="m-section_tasks">
                                        No. of Tasks
                                    </td>
                                    <td class="m-section_date">
                                        Date
                                        <a class="d-up_arrow">
                                            <img src="{{URL::asset('images/up_arrow.png')}}">
                                        </a>
                                        <a class="d-down_arrow">
                                            <img src="{{URL::asset('images/down_arrow.png')}}">
                                        </a>
                                    </td>
                                    <td class="m-section_action">
                                        Action
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>-</span>
                                    </td>
                                    <td>
                                        <span>-</span>
                                    </td>
                                    <td>
                                        <span>-</span>
                                    </td>
                                    <td>
                                        <span>-</span>
                                    </td>
                                    <td class="m-section_action">
                                        <a href="javascript:void(0);" class="edit_icon">
                                            <img src="{{URL::asset('images/edit_icon.png')}}" alt="">
                                        </a>
                                        <a href="javascript:void(0);" class="edit_icon">
                                            <img src="{{URL::asset('images/pencil.png')}}" alt="">
                                        </a>
                                        <a href="javascript:void(0);" class="edit_icon">
                                            <img src="{{URL::asset('images/Delete.png')}}" alt="">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane " id="m_tabs_1_2" role="tabpanel">
            <div class="table-responsive">
                
                <table class="table client_managemnet_service">
                   
                    <thead>
                        <tr>
                            <td class="m-section_date">
                                Date
                                <a class="d-up_arrow"><img src="{{URL::asset('images/up_arrow.png')}}" alt="" /></a>
                                <a class="d-down_arrow"><img src="{{URL::asset('images/down_arrow.png')}}" alt="" /></a>
                            </td>
                            <td class="m-section_group">
                                Service Group
                            </td>
                            <td class="m-section_name">
                                No. of Service Name
                            </td>
                            <td class="m-section_tranmodel">
                                Transaction Mode
                            </td>
                            <td class="m-section_debit">
                                Debit Amount
                            </td>
                            <td class="m-section_credit">
                                Credit Amount
                            </td>
                            <td class="m-section_action">
                                Action
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="date">
                                <span>-</span>
                            </td>
                            <td class="service">
                                <span>-</span>
                            </td>
                            <td class="name">
                                <span>-</span>
                            </td>
                            <td class="tranmodel">
                                <span>-</span>
                            </td>
                            <td class="debit">
                                <span>-</span>
                            </td>
                            <td class="credit">
                                <span>-</span>
                            </td>
                            <td class="action">
                                <a href="#" class="edit_icon">
                                    <img src="{{URL::asset('images/edit_icon.png')}}" alt="">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane " id="m_tabs_1_3" role="tabpanel">
            <div class="table-responsive">
                
                <table class="table client_complete">
                   
                    <thead>
                        <tr>
                            <td class="m-section_ct">
                                CT ID
                                <a class="d-up_arrow"><img src="{{URL::asset('images/up_arrow.png')}}" alt="" /></a>
                                <a class="d-down_arrow"><img src="{{URL::asset('images/down_arrow.png')}}" alt="" /></a>
                            </td>
                            <td class="m-section_ctname">
                                CT Name
                            </td>
                            <td class="m-section_ctphone">
                                CT Contact Number
                            </td>
                            <td class="m-section_date">
                                Visited Date
                            </td>
                            <td class="m-section_work">
                                Workd Hours
                            </td>
                            <td class="m-section_action">
                                Action
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ct">
                                <span>-</span>
                            </td>
                            <td class="ctname">
                                <span>-</span>
                            </td>
                            <td class="ctphone">
                                <span>-</span>
                            </td>
                            <td class="date">
                                <span>-</span>
                            </td>
                            <td class="work">
                                <span>-</span>
                            </td>

                            <td class="action">
                                <a href="#" class="edit_icon">
                                    <img src="{{URL::asset('images/edit_icon.png')}}" alt="">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->

<script>
$(function() {   
    $('#dob').datepicker({
        format: 'dd/mm/yyyy',             
    }).on('changeDate', function(e) { 
        var today = new Date(), 
            dob = new Date(e.format()), 
            age = new Date(today - dob).getFullYear() - 1970;
        $('.age').text(age);
    }).datepicker('setDate', $('.d_hdn_dob_edit').val());

    $('#date_new_service').datepicker({
        format: 'dd/mm/yyyy',
        startDate: "+0d",
    }).on('changeDate', function(e) {         
    });
   
    $('input[name="datetimes"]').daterangepicker({
        timePicker: true,       
        locale: {
            format: 'hh:mm A'
        }
    }, function (start, end, label) { 
        start_time = start.format('HH:mm A');
        end_time = end.format('HH:mm A');
        console.log(start_time, end_time);
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide(); 
    });

});
</script>

<script>

//FOR LOAD SEWRVICE GROUP IN ADD NEW SERVICE SECTION
function groupname(){
    $.ajax({
            url: 'getAjaxServiceGroup',
            type: 'GET',            
            success: function (data)
            {
                var htmlData ='<option value="0">Select Service Name</option>';                
                $.each(data['getServiceGroupList'],function(key,getData){           
                    htmlData +='<option value="'+getData['pk_service_group_id']+'">'+getData['service_grp_name']+'</option>';                                  
                });
                $('select.d_services_group').html(htmlData);                
            },
    });
}

//FUNCTION FOR SERVICE LIST
function getService(groupID,newclonecount){
    
    var groupID = groupID;
        $.ajax({
            url: 'getServiceList',
            type: 'GET',
            data: {groupID: groupID},
            success: function (data)
            {
                var htmlData ='<option value="0">Select Service Name</option>';                
                $.each(data['serviceList'],function(key,getData){           
                    htmlData +='<option value="'+getData['pk_services_id']+'">'+getData['service_name']+'</option>';                                  
                });
                $('select#d_services_name'+newclonecount).html(htmlData);
                
            },
        });
}

//FUNCTION FOR GET TASK LIST
function getTask(sID,newclonecount){
    
    var serviceID = sID;
        $.ajax({
            url: 'getTaskList',
            type: 'GET',
            data: {serviceID: serviceID},
            success: function (data)
            {
                //          
                var htmlData ='';                
                $.each(data['taskList'],function(key,getData){           
                    htmlData +='<option value="' + getData['pk_task_id'] + '">'+ getData['task_name'] + '</option>';                                  
                });               
                $('select#d_services_tasklist'+newclonecount).html(htmlData);
                $('.d_services_tasklist').multiselect('reload');
                $('.d_services_tasklist').multiselect({
                    columns: 1,
                    placeholder: 'Select Tasks',
                    search: true,
                });                           
            },
        });
}




$(document).ready(function(){
    //AJAX FUNCTION FOR GET SERVICE GROUP LIST ON PAGE LOAD
    //groupname();

    //CLONE ADD NEW SERVICE BLOCK
    $(document).on('click','.d_btn_add_new_service',function(){
                
        var cloneCount = $('.d_clone_service').length;
        var newclonecount =  cloneCount + 1;              
        var newEle = $(this).parents('.add_new_service').find('#d_clone_service').clone().attr('id', 'd_clone_service'+newclonecount).insertAfter($('[id^=d_clone_service]:last'));
        newEle.find('select.d_services_group').attr('id','d_services_group'+newclonecount);
        newEle.find('select.d_services_name').attr('id','d_services_name'+newclonecount);
        newEle.find('select.d_services_tasklist').attr('id','d_services_tasklist'+newclonecount); 
        newEle.find('.d_services_time_allocate').attr('id','d_services_time_allocate'+newclonecount);
        newEle.find('.d_date_new_service').attr('id','d_date_new_service'+newclonecount);
        newEle.find('.d_service_task_desc').attr('id','d_service_task_desc'+newclonecount);             
        //FOR RE-CALL SERVICES LIST FUNCTION BASED ON SELECT SERVICE GROUP 
        $(document).on('change','#d_services_group'+newclonecount,function(){            
            var gID = $(this).val();
            getService(gID,newclonecount);
        });
        //FOR GET TASK LIST FUNCTION FOR GET TASK BASED ON SERVICES
        $(document).on('change','#d_services_name'+newclonecount,function(){            
            var sID = $(this).val();
            getTask(sID,newclonecount);                      
        });
        //FOR APPEND CANCEL BUTTON IN CLONED BLOCK
        $('[id^=d_clone_service]:last').append('<div class="close_btn_clone"><a href="javascript:void(0);" class="d_cancel_clone_service">Cancel</a></div>');
        //FOR RE-CALL GROUP NAME FUNCTION 
        //groupname();                
        //FOR RE-CALL DATEPICKER EVENT
        $('input[name="date_new_service"]').datepicker({
            format: 'dd/mm/yyyy',
            startDate: "+0d",
        }).on('changeDate', function(e) {             
        });
    
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,       
            locale: {
                format: 'hh:mm A'
            }
        }, function (start, end, label) { //callback
            start_time = start.format('HH:mm A');
            end_time = end.format('HH:mm A');
            console.log(start_time, end_time);
        }).on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide(); //Hide calendar
        });

    });

    //DELETE ALREADY CLONED BLOCK
    $(document).on('click','.d_cancel_clone_service',function(){        
        $(this).parents('.d_clone_service').remove();
    });

    //GET SERVICE LIST FROM GROUP NAME
    $(document).on('change','select#d_services_group', function(){
        //        
        var groupID = $(this).val();
        $.ajax({
            url: 'getServiceList',
            type: 'GET',
            data: {groupID: groupID},
            success: function (data)
            {
                var htmlData ='<option value="0">Select Service Name</option>';                
                $.each(data['serviceList'],function(key,getData){           
                    htmlData +='<option value="'+getData['pk_services_id']+'">'+getData['service_name']+'</option>';                                  
                });
                $('select#d_services_name').html(htmlData);
                
            },
        });
    });

    //GET TASK LIST FROM SERVICES
    $(document).on('change','select#d_services_name', function(){
        //
        var serviceID = $(this).val();
        $.ajax({
            url: 'getTaskList',
            type: 'GET',
            data: {serviceID: serviceID},
            success: function (data)
            {
                //          
                var htmlData ='';                
                $.each(data['taskList'],function(key,getData){           
                    htmlData +='<option value="' + getData['pk_task_id'] + '">'+ getData['task_name'] + '</option>';                                  
                });               
                $('select#d_services_tasklist').html(htmlData);
                $('.d_services_tasklist').multiselect('reload');
                $('.d_services_tasklist').multiselect({
                    columns: 1,
                    placeholder: 'Select Tasks',
                    search: true,
                });                           
            },
        });
    });

    //SAVE NEW CLIENT
    $(document).on('click','.d_btn_save_edit',function(){
        debugger;
        var d_clientID = $('.d_hdn_clientID').val();          
        var d_clnt_Name = $('.d_clnt_Name').val();
        var d_clnt_contact = $('.d_clnt_contact').val();
        var d_clnt_email = $('.d_clnt_email').val();
        var d_clnt_dob = $('.d_clnt_dob').val();
        var d_clnt_age = $('.age').text();
        var d_clnt_gender = $("input[name='gender']:checked").val();
        var d_clnt_address = $('.d_clnt_address').val();
        var d_clnt_city = $('.d_clnt_city').val();
        var d_clnt_state = $('.d_clnt_state').val();
        var d_clnt_country = $('.d_clnt_country').val();        
        var d_clnt_health = $('.d_clnt_health').val();
        var d_clnt_next_of_kin_name = $('.d_clnt_next_of_kin_name').val();
        var d_clnt_next_of_kin_number = $('.d_clnt_next_of_kin_number').val();
        var d_clnt_next_of_kin_email = $('.d_clnt_next_of_kin_email').val();
        var d_clnt_CT = $('.d_clnt_CT option:selected').val();        
        // var d_services_group = [];
        // $('.d_services_group').each(function(){
        //     var val = $(this).val();
        //     d_services_group.push(val);
        // });

        // var d_services_name = [];
        // $('.d_services_name').each(function(){
        //     var val = $(this).val();
        //     d_services_name.push(val);
        // });

        // var arrTask = [];        
        // $(".d_services_tasklist").each(function(){
        //     var val = $(this).val();
        //     arrTask.push(val.join(","));
        // });     
              
        // var d_services_time_allocate = [];
        // $('.d_services_time_allocate').each(function(){
        //     var val = $(this).val();
        //     d_services_time_allocate.push(val);
        // });

        // var d_date_new_service = [];
        // $('.d_date_new_service').each(function(){
        //     var val = $(this).val();
        //     d_date_new_service.push(val);
        // });

        // var d_service_task_desc = [];
        // $('.d_service_task_desc').each(function(){
        //     var val = $(this).val();
        //     d_service_task_desc.push(val);
        // });

        var emailfilter = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        //var numberFilter = /^(\+\d{1,3}[- ]?)?\d{10}$/;
        var validNumber = new RegExp(/^\d*\.?\d*$/);
        var error = false;

        $('.err_msg').remove();

        if(d_clnt_Name == ''){
            $('.d_clnt_Name').after('<span class="err_msg">This field is required</span>');
            error = true;
        }
        if(d_clnt_contact == ''){
            $('.d_clnt_contact').after('<span class="err_msg">This field is required</span>');
            error = true;
        }
        else{
            if(!validNumber.test(d_clnt_contact))
            {               
                $('.d_clnt_contact').after('<span class="err_msg">Invalid Contact Number</span>');                
                error = true;                    
            }    
        }        
        if(d_clnt_email == ''){            
            $('.d_clnt_email').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        else
        {
            if(!emailfilter.test(d_clnt_email))
            {               
                $('.d_clnt_email').after('<span class="err_msg">Invalid Email</span>');                
                error = true;                    
            }                  
        }
        if(d_clnt_dob == ''){
            $('.d_err_msg_dob').after('<span class="err_msg">This field is required</span>');
            error = true;
        } 
        if($("input[name='gender']:checked").length == '0'){            
            $('.d_err_gender_msg').after('<span class="err_msg">Gender is required</span>');                
            error = true
        }
        if(d_clnt_address == ''){            
            $('.d_clnt_address').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        if(d_clnt_city == ''){            
            $('.d_clnt_city').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        if(d_clnt_state == ''){            
            $('.d_clnt_state').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        if(d_clnt_country == ''){            
            $('.d_clnt_country').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        if(d_clnt_health == ''){            
            $('.d_clnt_health').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        if(d_clnt_next_of_kin_name == ''){            
            $('.d_clnt_next_of_kin_name').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        if(d_clnt_next_of_kin_number == ''){            
            $('.d_clnt_next_of_kin_number').after('<span class="err_msg">This field is required</span>');                
            error = true
        }
        else{
            if(!validNumber.test(d_clnt_next_of_kin_number))
            {               
                $('.d_clnt_next_of_kin_number').after('<span class="err_msg">Invalid Kin Number</span>');                
                error = true;                    
            }    
        }   
        if(d_clnt_next_of_kin_email == ''){            
            $('.d_clnt_next_of_kin_email').after('<span class="err_msg">This field is required</span>');                
            error = true
        }       
        else
        {
            if(!emailfilter.test(d_clnt_next_of_kin_email))
            {               
                $('.d_clnt_next_of_kin_email').after('<span class="err_msg">Invalid Email</span>');                
                error = true;                    
            }                  
        }
        // if(d_clnt_receive_balance != ''){
        //     if(d_clnt_paymode == '0'){            
        //         $('.dropdown.d_clnt_paymode').after('<span class="err_msg">This field is required</span>');
        //         error = true
        //     }
        // }
        // $('.d_services_group').each(function(){
        //     if($(this).val() == '0'){            
        //         $(this).parents('.d_clone_service').find('.d_services_group').after('<span class="err_msg">This field is required</span>');
        //         error = true
        //     }
        // });
        // $('.d_services_name').each(function(){
        //     if($(this).val() == '0'){ 
        //         $(this).parents('.d_clone_service').find('.d_services_name').after('<span class="err_msg">This field is required</span>');
        //         error = true
        //     }
        // });
        // $(".d_services_tasklist").each(function(){
        //     if($(this).val() == ''){            
        //         $(this).parents('.d_clone_service').find('.d_er_msg').after('<span class="err_msg">This field is required</span>');
        //         error = true
        //     }
        // });  
        // $('.d_date_new_service').each(function(){
        //     if($(this).val() == ''){            
        //         $(this).parents('.d_clone_service').find('.d_after_msg_servicedate').after('<span class="err_msg">This field is required</span>');
        //         error = true
        //     }
        // });
        
        

        if(error == true){
            return false;
        }else{            
            $.ajax({
                url: '<?php echo URL::to('updateClient'); ?>',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'd_clientID': d_clientID,                    
                    'd_clnt_Name': d_clnt_Name,
                    'd_clnt_contact': d_clnt_contact,
                    'd_clnt_email': d_clnt_email,
                    'd_clnt_dob': d_clnt_dob,
                    'd_clnt_age': d_clnt_age,
                    'd_clnt_gender': d_clnt_gender,
                    'd_clnt_address': d_clnt_address,
                    'd_clnt_city': d_clnt_city,
                    'd_clnt_state': d_clnt_state,
                    'd_clnt_country': d_clnt_country,
                    'd_clnt_health': d_clnt_health,
                    'd_clnt_next_of_kin_name': d_clnt_next_of_kin_name,
                    'd_clnt_next_of_kin_number': d_clnt_next_of_kin_number,
                    'd_clnt_next_of_kin_email': d_clnt_next_of_kin_email,
                    'd_clnt_CT': d_clnt_CT,                    
                    // 'd_services_group': d_services_group,
                    // 'd_services_name': d_services_name,
                    // 'arrTask': arrTask,
                    // 'd_services_time_allocate': d_services_time_allocate,
                    // 'd_date_new_service': d_date_new_service,
                    // 'd_service_task_desc': d_service_task_desc,
                },
                success: function (data) {
                    //                   
                    if(data.res == 1)
                    {
                        $('.d-suc-msg').show();
                        setTimeout(function () {
                            $('.d-suc-msg').hide();
                            location.reload();
                        }, 3000);
                    }
                    if(data.res == 0)
                    {                                 
                        $('.d_clnt_email').after('<span class="err_msg">Email already Exist</span>');               
                        setTimeout(function () {
                            $('.err_msg').remove();
                        }, 3000);
                    }                    
                },
                error: function () {
                    alert("Something went wrong");
                }
            });
        }
    });

    //FOR ALLOW ONLY DIGIT
    $(".d_clnt_contact").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#errmsg").html("Allow digits only").show().fadeOut("slow");
              return false;
        }
   });
   $(".d_clnt_next_of_kin_number").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#errmsg1").html("Allow digits only").show().fadeOut("slow");
              return false;
        }
   });
   $(".d_clnt_receive_balance").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#errmsgbalance").html("Allow digits only").show().fadeOut("slow");
              return false;
        }
   });
   $(".d_clnt_age").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#errmsgbalance").html("Allow digits only").show().fadeOut("slow");
              return false;
        }
   });


})
</script>

<script>
// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
  //street_number: 'short_name',
  //route: 'long_name',
  //locality: 'long_name',
  administrative_area_level_1: 'long_name',
  country: 'long_name',
  //postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9dMIPnjrc_1cg-qssupeOYiPtPQQlDI&libraries=places&callback=initAutocomplete" async defer></script>


<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@stop