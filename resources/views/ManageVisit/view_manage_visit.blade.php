@extends('layouts.layout')
@section('title')
View Visit
@endsection
@section('main')
<div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader breadcrumb_sad">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Visit Detail
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

                    <li class="m-nav__separator">
                        <img src="images/dot_img.png" alt=""/>
                    </li>
                    <li class="m-nav__item">
                        <a href="javascript:void(0);" class="m-nav__link no_link">
                            <span class="m-nav__link-text">
                                Visit Detail
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
        @if(session()->has('manage_visit'))
        <div class="alert alert-success alert" id="manage_visits">
            {{ session()->get('manage_visit') }}
        </div>
        @endif

        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height client_detail_style managed_visit_detail">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Visit Detail
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet-button">
                            <button type="button" class="btn ">
                                <a href="{{URL::to('edit_manage_visit?id=')}}{{$get_visit_data->pk_visits_id}}" role="button">Edit</a>
                            </button>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget 11-->
                        <div class="m-widget11 client_information">
                            <!--                                            <div class="table-responsive">-->
                            <div class="row box-content managed_table">
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>Client Id</label>  
                                        <span class="form-control">{{$get_client_data->client_view_id}}</span>

                                    </div>
                                </div>     
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>Client Name </label>                                                               
                                        <span class="form-control">{{$get_client_data->client_name}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>Client Contact Number</label>
                                        <span class="form-control">{{$get_client_data->client_contact_no}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 col-box-2">
                                    <div class="form-group m-form__group">
                                        <label>Address</label>                                                                                        
                                        <span class="form-control">{{$get_client_data->client_address}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>City</label>                                                                                        
                                        <span class="form-control">{{$get_client_data->client_city}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>State</label>                                                                                        
                                        <span class="form-control">{{$get_client_data->client_state}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>Country</label>                                                                                        
                                        <span class="form-control">{{$get_client_data->client_country}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>CT Name</label>                                                                                        
                                        <span class="form-control">{{$get_ct_data->ct_name}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>CT Contact Number</label>                                                                                        
                                        <span class="form-control">{{$get_ct_data->ct_contact_info}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>Visit Date</label>                                                                                        
                                        <span class="form-control">{{$get_visit_data->visit_date}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 col-box-2">
                                    <div class="form-group m-form__group">
                                        <label>Start Time</label>                                                                                        
                                        <span class="form-control">{{$start_time_visit}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>End Time</label>                                                                                        
                                        <span class="form-control">{{$end_time_visit}}</span>
                                    </div>
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>Total Task Duration</label>                                                                                        
                                        <span class="form-control">{{$dec_to_hours}} Hours</span>
                                    </div>  
                                </div>
                                <div class="col-box-1 ">
                                    <div class="form-group m-form__group">
                                        <label>Visit Status</label> 
                                        <a href="javascript:void(0);" class="pending_btn" id="viewstatus" data-id="{{$get_visit_data->visit_status}}">{{$get_visit_data->visit_status}}</a>
                                    </div>
                                </div> 
                                <!--/Client submited detail start-->
                                <div class="col-box-12 col_4 exp">
                                    <div class="form-group m-form__group">
                                        <label>How Was The Experience</label>
                                         @if($get_visit_data->experience != "")
                                        <span class="form-control">{{$get_visit_data->experience}}</span>
                                        @else
                                         <span class="form-control">N/A</span>
                                        @endif
                                       
                                    </div>
                                </div>
                                <div class="col-box-12 col_4 nature">
                                    <div class="form-group m-form__group">
                                        <label>How was The Nature of Care Taker?</label>  
                                          @if($get_visit_data->ct_nature != "")
                                        <span class="form-control">{{$get_visit_data->ct_nature}}</span>
                                        @else
                                         <span class="form-control">N/A</span>
                                        @endif
                                     
                                    </div>
                                </div>
                                <div class="col-box-12 col_4 feedback">
                                    <div class="form-group m-form__group">
                                        <label>Feedback Meassage</label>
                                          @if($get_visit_data->client_issue_comment != "")
                                        <span class="form-control">{{$get_visit_data->client_issue_comment}}</span>
                                        @else
                                         <span class="form-control">N/A</span>
                                        @endif
                                        
                                    </div>
                                </div>
                                <!--/Client Submitted detail end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!--/Submited Detail start-->
    <div class="m-content page_contant ct_sub_dets submit_detail">
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12 ">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height client_detail_style managed_visit_detail">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    CT Submitted Details
                                </h3>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget 11-->
                        <div class="m-widget11 client_information">
                            <!--                                            <div class="table-responsive">-->
                            <div class="row box-content managed_table">
                                <div class="col-box-2 ">
                                    <div class="form-group m-form__group">
                                       @if($get_visit_data->ct_visit_pic != "")
                                        <span class="form-control"> <img src="{{URL::asset('images/ct_visit_images/'.$get_visit_data->ct_visit_pic)}}" alt=""/></span>
                                        @else
                                        <span class="form-control">No Image</span>
                                        @endif

                                    </div>
                                </div>     
                                <div class="col-box-22 ">
                                    <div class="form-group m-form__group">
                                        <label>Summary</label> 
                                        @if($get_visit_data->ct_visit_summary != "")
                                        <span class="form-control">{{$get_visit_data->ct_visit_summary}}</span>
                                        @else
                                         <span class="form-control">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-box-22 ">
                                    <div class="form-group m-form__group">
                                        <label>Reason(If Required)</label>
                                         @if($get_visit_data->ct_reason != "")
                                        <span class="form-control">{{$get_visit_data->ct_reason}}</span>
                                        @else
                                         <span class="form-control">N/A</span>
                                        @endif
                                        
                                    </div>
                                </div>

                                <!--/Client Submitted detail end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/submited detail end-->
    <div class="m-content page_contant manage_detail_table">
        <!--Begin::Section-->
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
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget 11-->
                        <div class="m-widget11">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table">
                                    <!--begin::Thead-->
                                    <thead>
                                        <tr>
                                            <th class="m-widget11_client_id">
                                                No.
                                            </th>
                                            <th class="m-widget11_Service_Group">
                                                Service Group
                                            </th>
                                            <th class="m-widget11_Service_Name">
                                                Service Name
                                            </th>
                                            <th class="m-widget11_task">
                                                Task Name
                                            </th>
                                            <th class="m-widget11_task_description">
                                                Task Description
                                            </th>
                                            <th class="m-widget11_Allocated_Time">
                                                Allocated Time
                                            </th>
                                            <th class="m-widget11_Action">
                                                Action
                                            </th> 
                                        </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody>
                                        @php $count=1 @endphp
                                        @foreach($get_visit_detail_data as $get_visit_detail)
                                        <tr>
                                            <td  data-title="No.">
                                                <span>{{$count++}}</span>
                                            </td>
                                            <td  data-title="Service Group">
                                                <span>{{$get_visit_detail->Service_grp}}</span>
                                            </td>
                                            <td  data-title=" Service Name">
                                                <span>{{$get_visit_detail->service_name}}</span>
                                            </td>
                                            <td  data-title="Task Name">
                                                <span>{{$get_visit_detail->task_name}}</span>
                                            </td>
                                            <td  data-title="Task Description">
                                                <span>{{$get_visit_detail->task_description}}</span>
                                            </td>
                                            <td  data-title="Allocated Time">
                                                <span>{{$get_visit_detail->start_time}} to {{$get_visit_detail->end_time}}</span>
                                            </td>
                                            <td data-title="Action">

                                                <a href="{{URL::to('edit_manage_visit?id=')}}{{$get_visit_data->pk_visits_id}}" class="edit_icon"><img src="images/pencil.png" alt=""/></a>
                                                <a href="javascript:void(0);" data-id="{{$get_visit_detail->pk_visit_detail_id}}" data-toggle="modal" data-target="#modal_target_234" id="delete_visit_detail_model" class="edit_icon"><img src="images/Delete.png" alt=""/></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                    <!--end::Tbody-->
                                </table>
                            </div>
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Widget 11-->
            </div>
        </div>
        <!--end:: Widgets/Best Sellers-->
    </div>
    <!--End::Section-->


</div>

<!--/Delete Model Start-->
<div class="modal fade dashboard_modal" id="modal_target_234" tabindex="-1" role="dialog"
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
                        <h6 class="inactive-modal-title-btm">Do you really want to Delete Visit Block From this visit?</h6>
                    </div>
                </div>
                <!--end::Form-->
                <!--</div>-->
            </div>
            <div class="modal-footer inactive_user_btn_center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary d_cm_delete" id="delete_visit_detail_id">
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>
<!--/Delete Model End-->




<!-- end:: Body -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    var viewstatus = $("#viewstatus").attr('data-id');
    $('.submit_detail').hide();
    $('.exp').hide();
    $('.nature').hide();
    $('.feedback').hide();

    if (viewstatus == 'Completed') {
        $('.submit_detail').show();
        $('.exp').show();
        $('.nature').show();
        $('.feedback').show();
    }
    $("#manage_visits").delay(2000).fadeOut('slow');

    //Get id visit detaildelete model
    $(document).on('click', '#delete_visit_detail_model', function () {
        debugger;
        var cleardeleteid_visitdetail = $("#delete_visit_detail_id").attr('data-id', 0);
        var deletevisitdetailid = $(this).data('id');
        var setdeleteidvisit = $("#delete_visit_detail_id").attr('data-id', deletevisitdetailid);
    });

    //Delete_visit_model
//Visit Delete start
    $(document).on('click', '#delete_visit_detail_id', function () {
        debugger;
        var delete_visit_detail_id = $(this).attr("data-id")

        $.ajax({
            url: 'visit_detail_delete',
            type: 'GET',
            dataType: 'json',
            data: {'delete_visit_detail_id': delete_visit_detail_id},
            success: function (res) {
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