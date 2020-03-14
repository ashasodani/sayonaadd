@extends('layouts.layout')
@section('title')
Client Management - View Client Details
@endsection
@section('main')
<style>
.dropdown.bootstrap-select.form-control.m-bootstrap-select.m_.custom-css-group >select{
    position: inherit !important;
    left: auto;
    height: auto !important;
    border: 1px solid #ebedf2;
    bottom: auto;
    display: inherit !important;
    opacity: inherit !important;
    padding: .65rem 1rem !important;
    width: 100% !important;
}
</style>
<!-- END: Left Aside -->
<input type="hidden" class="url_listing" value="{{url('getListingTemplate')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader breadcrumb_sad">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Client Detail
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="javascript:void(0);" class="m-nav__link m-nav__link--icon">
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
                        <a href="javascript:void(0);" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Client Detail
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
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height dashboard_table client_table  client_detail_style">
                    <div class="m-portlet__head">
                        <div class="client_mamangement_view m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Client Detail
                                </h3>
                            </div>
                        </div>
                        <div class="client_mamangement_view m-portlet-button">

                            <button type="button" class="btn  ">
                                <a href="javascript:void(0);" role="button">Generate Invoice</a>
                            </button>
                            <button type="button" class="btn  ">
                                <a href="javascript:void(0);" role="button" data-toggle="modal"
                                    data-target="#modal_target_4">Add Balance Account</a>
                            </button>
                            <button type="button" class="btn">
                                <a href="{{url('editClient/'.$getClientData[0]->pk_client_id)}}" role="button">Edit</a>
                            </button>
                            <button type="button" class="btn_del">
                                <a href="javascript:void(0);" role="button" data-toggle="modal"
                                    data-target="#modal_target_3">Delete</a>
                            </button>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget 11-->
                        <div class="m-widget11 client_information">
                            <!--                                            <div class="table-responsive">-->
                            <div class="row box-content client-tabel">
                                <div class="box-content-1 box-content">
                                    <span class="detail-title">Client Id</span>
                                    <span class="detail-content">{{ $getClientData[0]->client_view_id }}</span>
                                </div>
                                <div class="box-content-2 box-content">
                                    <span class="detail-title">Client Name</span>
                                    <span class="detail-content">{{ $getClientData[0]->client_name }}</span>
                                </div>
                                <div class="box-content-3 box-content">
                                    <span class="detail-title">Contact Number</span>
                                    <a href="tel:8888234395"
                                        class="detail-content">{{$getClientData[0]->client_contact_no}}</a>
                                </div>
                                <div class="box-content-4 box-content">
                                    <span class="detail-title">Email</span>
                                    <a href="mailto:yashchoudhury@gmail.com"
                                        class="detail-content">{{$getClientData[0]->client_email}}</a>
                                </div>
                                <div class="box-content-5 box-content">
                                    <span class="detail-title">Date of Birth</span>
                                    <span class="detail-content">{{ date('d F Y',strtotime($getClientData[0]->client_dob)) }}</span>
                                </div>
                                <div class="box-content-6 box-content">
                                    <span class="detail-title">Age</span>
                                    <span class="detail-content">{{$getClientData[0]->client_age}}</span>
                                </div>
                                <div class="box-content-7 box-content">
                                    <span class="detail-title">Gender</span>
                                    <span class="detail-content">{{$getClientData[0]->client_gender}}</span>
                                </div>
                                <div class="box-content-8 box-content">
                                    <span class="detail-title">Address</span>
                                    <p class="detail-content">{{$getClientData[0]->client_address}}</p>
                                </div>

                                <div class="box-content-9 box-content">
                                    <span class="detail-title">City</span>
                                    <span class="detail-content">{{$getClientData[0]->client_city}}</span>
                                </div>
                                <div class="box-content-10 box-content">
                                    <span class="detail-title">State</span>
                                    <span class="detail-content">{{$getClientData[0]->client_state}}</span>
                                </div>
                                <div class="box-content-11 box-content">
                                    <span class="detail-title">Country</span>
                                    <span class="detail-content">{{$getClientData[0]->client_country}}</span>
                                </div>
                                <div class="box-content-12 box-content">
                                    <span class="detail-title">Health Conditions</span>
                                    <span class="detail-content">{{$getClientData[0]->health_conditions}}</span>
                                </div>

                                <div class="box-content-13 box-content">
                                    <span class="detail-title">Next of Kin Name</span>
                                    <span class="detail-content">{{$getClientData[0]->kin_name}}</span>
                                </div>
                                <div class="box-content-14 box-content">
                                    <span class="detail-title">Next of Kin Number</span>
                                    <a href="tel: 8209327861"
                                        class="detail-content">{{$getClientData[0]->kin_phone_no}}</a>
                                </div>
                                <div class="box-content-15 box-content">
                                    <span class="detail-title">Next of Kin Email</span>
                                    <a href="mailto:nishibrar@gmail.com"
                                        class="detail-content">{{$getClientData[0]->kin_email}}</a>
                                </div>
                                <div class="box-content-16 box-content">
                                    <span class="detail-title">CT</span>
                                    @if($getClientData[0]->fk_ct_id == 0)
                                    <p class="detail-content d_text_CT_name">Unassigned</p>
                                    <a href="javascript:void(0);" class="btn btn-a d_btn_ctassign" role="button" data-toggle="modal"
                                        data-target="#modal_target_2">Assign CT</a>
                                    @else
                                    <p class="detail-content">{{$getClientData[0]->ct_name}}</p>
                                    @endif
                                </div>
                                <div class="box-content-17 box-content">
                                    <span class="detail-title">Profile status</span>
                                    @if($getClientData[0]->is_active == 1)
                                    <p class="detail-content d_text_pro_status">Active</p>
                                    @else
                                    <p class="detail-content d_text_pro_status">Inactive</p>
                                    @endif
                                    <a href="javascript:void(0);" class="btn btn-c" role="button" data-toggle="modal"
                                        data-target="#modal_target_1">Change Status</a>
                                </div>

                                <div class="box-content-18 box-content">
                                    <span class="detail-title">Available Balance</span>
                                    <span class="detail-content">{{ env('MONEY_SYMBOL') }} {{$getClientData[0]->received_amount}}</span>
                                </div>
                                <div class="box-content-19 box-content">
                                    <span class="detail-title">Total Spent Amount</span>
                                    <span class="detail-content">{{ env('MONEY_SYMBOL') }} 0.0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body client_tabs">
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
                <div class="paginate_data_allocated">
                    @include('ClientManagement.view_AllocateServicePartial')
                </div>
            </div>
            <div class="tab-pane " id="m_tabs_1_2" role="tabpanel">
                @include('ClientManagement.view_TransectionHistoryPartial') 
            </div>
            <div class="tab-pane " id="m_tabs_1_3" role="tabpanel">
                @include('ClientManagement.view_CompletedVisitPartial') 
            </div>
        </div>
    </div>
    <!--End::Section-->
    <div class="modal fade dashboard_modal" id="modal_target_3" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered inactive_user_modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{URL::asset('images/close_icon.png')}}" alt="Close Icon" class="close_icon" />
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                    <div class="form-group m-form__group row">

                        <div class="col-sm-12">
                            <h4 class="inactive-modal-title">Are you Sure?</h4>
                            <h6 class="inactive-modal-title-btm">Do you really want to Delete this Client?</h6>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer inactive_user_btn_center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary d_cm_delete" data-client-id="{{ $getClientData[0]->pk_client_id }}">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade dashboard_modal" id="modal_target_2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered assign_ct_modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Assign CT
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-sm-12">
                            CT *
                        </label>
                        <div class="col-sm-12">
                            <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                                <select class="form-control m-bootstrap-select m_selectpicker d_mdl_select_assign_ct_view" tabindex="-98">
                                    <option value="0">
                                        Select CT
                                    </option>
                                    @foreach($getCTList as $CTList)
                                    <option value="{{$CTList->pk_ct_info_id}}">{{$CTList->ct_name}}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary d_mdl_btn_assign_view"data-client-id="{{$getClientData[0]->pk_client_id}}">
                        Assign
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade dashboard_modal" id="modal_target_4" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Add Balance Amount
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                    <div class="form-group m-form__group row">
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Service Group *
                            </label>
                            <div class="dropdown bootstrap-select form-control m-bootstrap-select m_ custom-css-group">
                                <select class="form-control d_services_group" tabindex="-98">                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Service Name *
                            </label>
                            <div class="dropdown bootstrap-select form-control m-bootstrap-select m_ custom-css-group">
                                <select class="form-control d_services_name" tabindex="-98">
                                <option value="0">Select Service Name</option>                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-6 add_amount_balance_left">
                            <label class="col-form-label">
                                Add Amount *
                            </label>
                            <input type="text" class="form-control m-input" id="amountblance"
                                aria-describedby="AmountBlance" placeholder="Enter Text Here">
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Transaction Mode *
                            </label>
                            <div class="m-form__group form-group">
                                <div class="m-radio-inline add_amount_balance_right">
                                    <label class="m-radio m-radio--brand">
                                        <input type="radio" name="amount-balance" value="1" checked>
                                        Online
                                        <span></span>
                                    </label>
                                    <label class="m-radio m-radio--brand">
                                        <input type="radio" name="amount-balance" value="2">
                                        Cheque
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade dashboard_modal" id="modal_target_1" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Change Status
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-sm-12">
                            Status *
                        </label>
                        <div class="col-sm-12">
                            <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                                <select class="form-control m-bootstrap-select m_selectpicker d_mdl_select_pro_status"
                                    tabindex="-98">
                                    <option value="active">
                                        Active
                                    </option>
                                    <option value="inactive">
                                        Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary d_btn_view_change_pro_status"
                        data-client-id="{{$getClientData[0]->pk_client_id}}">
                        Change Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
//FOR LOAD SERVICE GROUP IN ADD NEW SERVICE SECTION
function groupname(){
    $.ajax({
            url: '<?php echo URL::to('getAjaxServiceGroup'); ?>',
            type: 'GET',            
            success: function (data)
            {
                var htmlData ='<option value="0">Select Group Name</option>';                
                $.each(data['getServiceGroupList'],function(key,getData){           
                    htmlData +='<option value="'+getData['pk_service_group_id']+'">'+getData['service_grp_name']+'</option>';                                  
                });
                $('select.d_services_group').html(htmlData);                
            },
    });
}


$(document).ready(function() {
    //FOR CALL SERVICE GROUP LIST IN MODEL
    groupname();
    
    //GET SERVICE LIST FROM GROUP NAME
    $(document).on('change','select.d_services_group', function(){
        debugger;        
        var groupID = $(this).val();
        $.ajax({
            url: '<?php echo URL::to('getServiceList'); ?>',
            type: 'GET',
            data: {groupID: groupID},
            success: function (data)
            {
                var htmlData ='<option value="0">Select Service Name</option>';                
                $.each(data['serviceList'],function(key,getData){           
                    htmlData +='<option value="'+getData['pk_services_id']+'">'+getData['service_name']+'</option>';                                  
                });
                $('select.d_services_name').html(htmlData);
                
            },
        });
    });

    //UPDATE PROFILE STATUS
    $(document).on('click','.d_btn_view_change_pro_status', function() {
        //debugger;
        var clientID = $(this).attr('data-client-id');
        var status = $('select.d_mdl_select_pro_status :selected').val();
        $.ajax({
            url: '<?php echo URL::to('viewUpdateProfileStatus'); ?>',
            type: 'GET',
            data: {clientID: clientID, status: status},
            success: function (data)
            {
                if (data.chkStatus == 'active') {                   
                    $('.d_text_pro_status').text('Active');
                }
                if (data.chkStatus == 'inactive') {                    
                    $('.d_text_pro_status').text('Inactive');
                }
                $('.close').trigger('click');
            },
        });        
    });

    //ASSIGN CT
    $(document).on('click','.d_mdl_btn_assign_view', function() {
        //debugger;
        var clientID = $(this).attr('data-client-id');
        var ctID = $('select.d_mdl_select_assign_ct_view :selected').val();
        $('.err_msg').remove();
        if(ctID == '0'){
            $('.dropdown.d_mdl_select_assign_ct_view').after('<span class="err_msg" style="color: #e42626;font-family: calibri;font-size: 15px;font-weight: bold;">The field is required</span>');
            return false;
        }else{
            $.ajax({
                url: '<?php echo URL::to('viewAssignCT'); ?>',
                type: 'GET',
                data: {clientID: clientID, ctID: ctID},
                success: function (data)
                {   
                    console.log();
                    $('.d_text_CT_name').text(data.ct_name);
                    $('.d_btn_ctassign').css('display','none');
                    $('.close').trigger('click');
                },
            });      
        }          
    });

    $(document).on('click','.d_cm_delete', function(){
        debugger;
        var clientID = $(this).attr('data-client-id');
        $.ajax({
                url: '<?php echo URL::to('deleteClient'); ?>',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'clientID': clientID,                                     
                },
                success: function (data) {
                    location.href = $('.url_listing').val();
                },
                error: function () {
                    alert("Something went wrong");
                }
        });       
    });

});
</script>
@stop