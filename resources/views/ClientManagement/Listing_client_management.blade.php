@extends('layouts.layout')
@section('title')
    Client Management - Listing
@endsection
@section('main')

 <!-- END: Left Aside -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader breadcrumb_sad">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title m-subheader__title--separator">
                                    Client Management
                                </h3>
                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="javascript:;" class="m-nav__link m-nav__link--icon">
                                            <img src="images/home.png" alt=""/>
                                        </a>
                                    </li> 
                                    <li class="m-nav__separator">
                                        <img src="images/dot_img.png" alt=""/>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="javascript:;" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                Client Management
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
                                <div class="m-portlet m-portlet--full-height  client_manegment_Table ">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Client Management
                                                </h3>
                                            </div>
                                        </div>
                                        <form class="client_management m-header-search__form">
                                            <div class="Client_Management m-header-search__wrapper">
                                                <div class="filter ">
                                                    <select class="form-control m-bootstrap-select m_selectpicker dropdown d_select_profile_filter">
                                                        <option value="">
                                                            Filter by Profile Status
                                                        </option>
                                                        <option value="active">
                                                            Active
                                                        </option>
                                                        <option value="inactive">
                                                            Inactive
                                                        </option>                                                        
                                                    </select>
                                                </div>
                                                <div class="filter">
                                                    <select class="form-control m-bootstrap-select m_selectpicker dropdown d_select_assigned_filter">
                                                        <option value="">
                                                            Filter by Assigned Status
                                                        </option>
                                                        <option value="assigned">
                                                            Assigned
                                                        </option>
                                                        <option value="unassigned">
                                                            Unassigned
                                                        </option>                                                        
                                                    </select>
                                                </div>                                               
                                                <div class="search">
                                                    <span class="m-header-search__icon-search" id="m_quicksearch_search">
                                                        <i class="la la-search"></i>
                                                    </span>
                                                    <span class="m-header-search__input-wrapper">
                                                        <input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search..." id="generalSearch">
                                                    </span>	
                                                </div>
                                                <div class="add_new_client_btn">
                                                    <a href="{{url('NewClient')}}" class="new_client_btn">Add New Clients</a>
                                                </div>

                                            </div>
                                        </form>  
                                    </div>
                                    
                                    <div class="paginate_data">
                                    @include('ClientManagement.ListingClientManagementPpartial')
                                    </div>

                                </div>
                                <!--end::Widget 11-->
                            </div>
                        </div>
                        <!--end:: Widgets/Best Sellers-->
                    </div>
                </div>
                <!--End::Section-->


                <!-- BEGIN: Modal -->
                <div class="modal fade dashboard_modal" id="modal_target_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                    <input type="hidden" class="d_hdn_clientID">
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
                                            <select class="form-control m-bootstrap-select m_selectpicker d_select_profile_status" tabindex="-98">
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
                                <button type="button" class="btn btn-primary d_btn_change_status">
                                    Change Status
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Modal -->

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
                                <button type="button" class="btn btn-primary d_cm_delete">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


<script>
$(document).ready(function(){
    //AJAX PAGINATION FOR CILENT MANAGEMENT LISTING
    $(document).on('click', '.client_data_pagination a', function (event) {
        debugger;
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];        
        paginate_data(page);
    });

    function paginate_data(page)
    {   
        var pageLength_val = $('#cld_pageLength_dropdown :selected').val();
        var keyword = $('#generalSearch').val();
        var profileDropFilter = $('select.d_select_profile_filter :selected').val();
        var assigedDropFilter = $('select.d_select_assigned_filter :selected').val();
        $.ajax({
            url: "getListingTemplate/PaginateData?page=" + page,
            type: 'GET',
            data: {pageLength_val: pageLength_val, keyword: keyword, profileDropFilter: profileDropFilter, assigedDropFilter: assigedDropFilter},            
            success: function (data)
            {
                $('.paginate_data').html(data);
            }
        });
    }

    //DROPDOWN FILTER
    $(document).on('change', '#cld_pageLength_dropdown', function () {
        debugger;
        var pageLength_val = $(this).val();
        var keyword = $('#generalSearch').val();
        var profileDropFilter = $('select.d_select_profile_filter :selected').val();
        var assigedDropFilter = $('select.d_select_assigned_filter :selected').val();

        $.ajax({
            url: 'filterClientData',
            type: 'GET',
            data: {pageLength_val: pageLength_val, keyword: keyword, profileDropFilter: profileDropFilter, assigedDropFilter: assigedDropFilter},
            success: function (data)
            {
                $('.paginate_data').html(data);
            },
        });
    });

    //SEARCH FILTER
    $('#generalSearch').on('keyup', function () {       
        var pageLength_val = $('#cld_pageLength_dropdown :selected').val();
        var keyword = $(this).val();
        var profileDropFilter = $('select.d_select_profile_filter :selected').val();
        var assigedDropFilter = $('select.d_select_assigned_filter :selected').val();

        $.ajax({
            url: 'filterClientData',
            type: 'GET',
            data: {pageLength_val: pageLength_val, keyword: keyword, profileDropFilter: profileDropFilter, assigedDropFilter: assigedDropFilter},
            success: function (data)
            {
                $('.paginate_data').html(data);
                if ($.trim($('.d_cm_tbody').html()) == '')
                {
                    $('.msg_search_data').html('No records found').css({'color': '#e42626', 'display': 'inline-block', 'width': '100%', 'text-align': 'center', 'font-family': 'calibri', 'font-size': '15px'});
                    $('.d_cm_data_showhide').hide();
                }
            },
        });
    });
    $('#generalSearch').keypress(function(e){        
        if ( e.which == 13 ) e.preventDefault();
    });

    //CHANGE PROFILE STATUS
    $(document).on('click','.d_change_status',function(){
        debugger;
        var clientID = $(this).attr('data-client-id');
        $('.d_hdn_clientID').val(clientID);
    });
    $(document).on('click','.d_btn_change_status',function(){
        debugger;
        var clientID = $('.d_hdn_clientID').val();
        var status = $('.d_select_profile_status :selected').val();
        $.ajax({
                url: 'updateClientProfileStatus',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'clientID': clientID,
                    'status': status                    
                },
                success: function (data) {                   
                    $('.d_status_show').each(function() {
                        var id = $(this).attr('data-client-id');
                        if(data.clientID == id){
                            if(data.chkStatus == 'active'){
                                $(this).addClass('active_btn');
                                $(this).removeClass('Inactive_btn');
                                $(this).text('Active');
                            }
                            if(data.chkStatus == 'inactive'){
                                $(this).addClass('Inactive_btn');
                                $(this).removeClass('active_btn');
                                $(this).text('Inactive');
                            }                            
                        }
                    });
                    $('.close').trigger('click');
                },
                error: function () {
                    alert("Something went wrong");
                }
            });
    });

    //DROPDOWN FILTER WITH PROFILE
    $(document).on('change','select.d_select_profile_filter', function() {
        debugger;
        var pageLength_val = $('#cld_pageLength_dropdown :selected').val();
        var keyword = $('#generalSearch').val();
        var profileDropFilter = $(this).val();
        var assigedDropFilter = $('select.d_select_assigned_filter :selected').val();

        $.ajax({
            url: 'filterClientData',
            type: 'GET',
            data: {pageLength_val: pageLength_val, keyword: keyword, profileDropFilter: profileDropFilter, assigedDropFilter: assigedDropFilter},
            success: function (data)
            {
                $('.paginate_data').html(data);
                if ($.trim($('.d_cm_tbody').html()) == '')
                {
                    $('.msg_search_data').html('No records found').css({'color': '#e42626', 'display': 'inline-block', 'width': '100%', 'text-align': 'center', 'font-family': 'calibri', 'font-size': '15px'});
                    $('.d_cm_data_showhide').hide();
                }
            },
        });
    });

    //DROPDOWN FILTER WITH ASSIGN STATUS
    $(document).on('change','select.d_select_assigned_filter', function(){
        debugger;
        var pageLength_val = $('#cld_pageLength_dropdown :selected').val();
        var keyword = $('#generalSearch').val();
        var profileDropFilter = $('select.d_select_profile_filter :selected').val();
        var assigedDropFilter = $(this).val();

        $.ajax({
            url: 'filterClientData',
            type: 'GET',
            data: {pageLength_val: pageLength_val, keyword: keyword, profileDropFilter: profileDropFilter, assigedDropFilter: assigedDropFilter},
            success: function (data)
            {
                $('.paginate_data').html(data);
                if ($.trim($('.d_cm_tbody').html()) == '')
                {
                    $('.msg_search_data').html('No records found').css({'color': '#e42626', 'display': 'inline-block', 'width': '100%', 'text-align': 'center', 'font-family': 'calibri', 'font-size': '15px'});
                    $('.d_cm_data_showhide').hide();
                }
            },
        });
    });

    //DELETE CLIENT
    $(document).on('click','.d_cm_delete_open_mdl', function(){
        debugger;
        var clientID = $(this).attr('data-client-id');
        $('.d_cm_delete').attr('data-client-id',clientID);
    });
    $(document).on('click','.d_cm_delete', function(){
        debugger;
        var clientID = $(this).attr('data-client-id'); 
        $.ajax({
                url: 'deleteClient',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'clientID': clientID,                                     
                },
                success: function (data) {
                    location.reload();
                },
                error: function () {
                    alert("Something went wrong");
                }
        });        
    });
});
</script>
@stop