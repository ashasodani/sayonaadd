@extends('layouts.layout')
@section('title')
Manage Visit
@endsection
@section('main')

<!-- END: Left Aside -->
<div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader breadcrumb_sad">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Manage Visits
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{URL::asset('dashboard')}}" class="m-nav__link m-nav__link--icon">
                            <img src="images/home.png" alt=""/>

                        </a>
                    </li> 
                    <li class="m-nav__separator">
                        <img src="images/dot_img.png" alt=""/>
                    </li>
                    <li class="m-nav__item">
                        <a href="javascript:void(0);" class="m-nav__link no_link">
                            <span class="m-nav__link-text">
                                Manage Visits
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
         <!--/Success message start-->
                @if(session()->has('manage_visit'))
                    <div class="alert alert-success alert" id="manage_visit">
                        {{ session()->get('manage_visit') }}
                    </div>
                @endif
                 <!--/Success message end-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height  client_manegment_Table managed_table">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Manage Visits
                                </h3>
                            </div>
                        </div>
                        <div class="m-header-search__form">
                            <div class="Client_Management m-header-search__wrapper">                                              
                                <div class="filter">
                                    <select class="form-control m-bootstrap-select m_selectpicker dropdown" id="selectclient">
                                        <option value="">
                                            Filter by Client
                                        </option>
                                        @foreach($clienct_name_list as $clicnt_list)
                                        <option value="{{$clicnt_list->pk_client_id}}">{{$clicnt_list->client_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="filter">
                                    <select class="form-control m-bootstrap-select m_selectpicker dropdown" id="selectstatus">
                                        <option value="">
                                            Filter by Status
                                        </option>
                                        <option value="pending">
                                            Pending
                                        </option>
                                        <option value="inprogress">
                                            In Progress
                                        </option>
                                        <option value="completed">
                                            Completed
                                        </option>
                                    </select>
                                </div>
                                <div class="search">
                                    <span class="m-header-search__icon-search" >
                                        <i class="la la-search"></i>
                                    </span>
                                    <span class="m-header-search__input-wrapper">
                                        <input autocomplete="off" type="text"  class="m-header-search__input"  placeholder="Search..."  id="ct_input">
                                    </span> 
                                </div>
                                <div class="add_new_client_btn">
                                    <a href="{{URL::to('manage_visits_add')}}" class="new_client_btn">Add New Visit</a>
                                </div>

                            </div>
                        </div>  
                    </div>  
                    <!--/partial-->
                    <div id="managevisitpartial"></div>
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
                            <select class="form-control m-bootstrap-select m_selectpicker" tabindex="-98">
                                <option>
                                    Active
                                </option>
                                <option>
                                    Pending
                                </option>
                                <option>
                                    In Progress
                                </option>
                                <option>
                                    Completed
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end::Form-->
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    Change Status
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal -->
<!--/Delete Model Start-->
 <div class="modal fade dashboard_modal" id="modal_target_233" tabindex="-1" role="dialog"
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
                            <h6 class="inactive-modal-title-btm">Do you really want to Delete Visit?</h6>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer inactive_user_btn_center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary d_cm_delete" id="delete_visit_id">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
<!--/Delete Model End-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
     $("#manage_visit").delay(3000).fadeOut('slow'); 
    debugger;
    $.ajax({
        type: 'GET',
        url: 'partial_managevisit',
        async: false,
        error: function(error) {
        },
        success: function(result) {
            $("#managevisitpartial").html(result.html);
        },
    });

    //Pagination managevist start
    $(document).on('change', '#managevisitdata', function(e) {

        debugger;
        var item = $(this).val();
        var search_cts = $("#ct_input").val();
        var search_status = $("#selectstatus").val();
        var search_clientid = $("#selectclient").val();

        $.ajax({
            type: 'GET',
            url: 'partial_managevisit',
            data: {items: item, search_clientid: search_clientid, search_status: search_status, search_cts: search_cts},
            async: false,
            error: function(error) {
            },
            success: function(result) {
                $("#managevisitpartial").html(result.html);
            },
        });

    });
    //Pagination managevist end

    //pagelink task start
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, function(data) {
            jQuery.ajaxSetup({async: false});
            $('#managevisitpartial').html(data.html);
        });
    });
    //pagelink task end
    $(document).on('change', '#selectclient', function(e) {
        debugger;
        var item = $(this).val();
        var search_cts = $("#ct_input").val();
        var search_status = $("#selectstatus").val();
        var search_clientid = $("#selectclient").val();
        $.ajax({
            type: 'GET',
            url: 'partial_managevisit',
            data: {search_clientid: search_clientid, search_status: search_status, search_cts: search_cts},
            async: false,
            error: function(error) {
            },
            success: function(result) {
                $("#managevisitpartial").html(result.html);
            },
        });
    });
    $(document).on('change', '#selectstatus', function(e) {
        var search_cts = $("#ct_input").val();
        var search_status = $("#selectstatus").val();
        var search_clientid = $("#selectclient").val();
        $.ajax({
            type: 'GET',
            url: 'partial_managevisit',
            data: {search_clientid: search_clientid, search_status: search_status, search_cts: search_cts},
            async: false,
            error: function(error) {
            },
            success: function(result) {
                $("#managevisitpartial").html(result.html);
            },
        });
    });

    $("#ct_input").keyup(function(event) {
        event.preventDefault();
        debugger;
        if (event.keyCode == 13) {

            var search_cts = $("#ct_input").val();
            var search_status = $("#selectstatus").val();
            var search_clientid = $("#selectclient").val();
            $.ajax({
                type: 'GET',
                url: 'partial_managevisit',
                data: {search_clientid: search_clientid, search_status: search_status, search_cts: search_cts},
                async: false,
                error: function(error) {
                },
                success: function(result) {
                    $("#managevisitpartial").html(result.html);
                },
            });
        }
    });

    function enablediv_value(enable_div)
    {
        var search_cts = $("#ct_input").val();
            var search_status = $("#selectstatus").val();
            var search_clientid = $("#selectclient").val();

        $.ajax({
            type: 'GET',
            url: 'partial_managevisit',
            data: {search_clientid: search_clientid, search_status: search_status, search_cts: search_cts,enable_time: enable_div},
            async: false,
            error: function(error) {
            },
            success: function(result) {
                $("#managevisitpartial").html(result.html);
            }

        });
    }
    function enabledate_value(enabledate_value) {
        var search_cts = $("#ct_input").val();
        var search_status = $("#selectstatus").val();
        var search_clientid = $("#selectclient").val();
        $.ajax({
            type: 'GET',
            url: 'partial_managevisit',
            data: {search_clientid: search_clientid, search_status: search_status, search_cts: search_cts,enabledate_value: enabledate_value},
            async: false,
            error: function(error) {
            },
            success: function(result) {
                $("#managevisitpartial").html(result.html);
            }
        });
    }

    $(document).on('click', '#up_time', function(e) {
        debugger;
       
        var div_value = "up_time";
        enablediv_value(div_value);
    });

    $(document).on('click', '#down_time', function(e) {
        var div_value = "down_time";
        
        enablediv_value(div_value);
    });

    $(document).on('click', '#up_date', function(e) {
        debugger;
        var div_date = "up_date";
//         if(($('.activedate').length)==1){
//         $(this).removeClass('activedate');
//        }
//        $(this).addClass('activedate');
       
        enabledate_value(div_date);
    });

    $(document).on('click', '#down_date', function(e) {
        debugger;
        var div_date = "down_date";
        
        enabledate_value(div_date);
    });
    
    //Get id visit delete model
         $(document).on('click','#delete_visit_model',function(){
            debugger;
            var cleardeleteid_visit=$("#delete_visit_id").attr('data-id',0);
            var deletevisitid=$(this).data('id');
            var setdeleteidvisit=$("#delete_visit_id").attr('data-id',deletevisitid);
        });
        
         //Delete_visit_model
        //Visit Delete start
         $(document).on('click','#delete_visit_id',function(){
            debugger;
            var delete_visit_id=$(this).attr("data-id")
            
                $.ajax({
                    url: 'visit_delete',
                    type: 'GET',
                    dataType: 'json',
                    data: {'delete_id': delete_visit_id},
                    success: function(res) {
                        if (res == 1) {
                            location.reload();
                        }
                    },
                    error: {
                    }
                });
           
        });
      
        //visit Delete End
        






});
</script>
@stop