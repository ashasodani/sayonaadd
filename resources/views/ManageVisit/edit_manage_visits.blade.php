@extends('layouts.layout')
@section('title')
Manage Visit
@endsection
@section('main')
<div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader breadcrumb_sad">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Edit Visit
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
                                Edit Visit
                            </span>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" name="filename" id="filename" value="editfile"/>
    <input type="hidden" id="edit_visit_id" name="visit_id" value="{{$visit_id}}"/>
    <input type="hidden" name="ct_blockout_time" id="ct_blockout_time" value="{{$ct_block_time}}">
     

    <div class="m-content page_contant manage_page">
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height managed_add_style managed_visit_detail ">
                    <div class="m-portlet__body">
                        <!--begin::Widget 11-->
                        <div class="m-widget11 client_information">
                            <!--                                            <div class="table-responsive">-->
                            <div class="managed_add_1">
                                <div class="row box-content managed_table">
                                    <div class="col-box-3 ">
                                        <div class="form-group m-form__group">
                                            <label>CT Name*</label>                           
                                            <select class="form-control  ctname" id="ctname">

                                                @foreach ($all_c_name as $n_ct_name)
                                                <option value="{{ $n_ct_name->pk_ct_info_id}}" {{ ($n_ct_name->pk_ct_info_id== $client_id ? "selected":"") }}>{{ $n_ct_name->ct_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>     
                                    <div class="col-box-3">
                                        <div class="form-group m-form__group">
                                            <label>Client*</label>                                                               
                                            <select class="form-control  clientname" id="clientname">
                                                
                                                @foreach ($related_client as $clientstr)
                                                @foreach ($clientstr as $clientst)
                                                <option value="{{ $clientst->pk_client_id}}" {{ ($clientst->pk_client_id== $ct_id ? "selected":"") }}>{{ $clientst->client_name }}</option>
                                                @endforeach
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-box-3">
                                        <div class="form-group m-form__group">
                                            <label>Visit Date</label>
                                            <div class="input-group date e_visit_date_div">
                                                <input type="text" class="form-control m-input visit_date" readonly="" placeholder="DD/MM/YY" id="visit_date" value={{$visit_date}}>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <img src="images/date_picker_icon.png" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="mainblock">
                                @foreach($get_data as $datas)
                                <div class="managed_add_1 clone_section" id="clone_section{{($datas->divids== 1 ?"":"$datas->divids")}}">

                                    <div class="row box-content managed_table">
                                        <div class="col-box-3">
                                            <div class="form-group m-form__group">
                                                <label>Service Group</label>                           
                                                <select class="form-control  e_service_group" id="service_group{{($datas->divids== 1 ?"":"$datas->divids")}}">
                                                     
                                                    @foreach ($datas->relatedservicegroup as $related_service_grp)
                                                    <option value="{{ $related_service_grp->pk_service_group_id}}" {{ ($related_service_grp->pk_service_group_id== $datas->fk_service_grp_id ? "selected":"") }}>{{ $related_service_grp->   service_grp_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>     
                                        <div class="col-box-3">
                                            <div class="form-group m-form__group">
                                                <label>Service Name</label>                                                               
                                                <select class="form-control  e_service_name" id="service_name">
                                                    @foreach ($datas->relatedservice_name as $related_service)
                                                    <option value="{{ $related_service->pk_services_id}}" {{ ($related_service->pk_services_id== $datas->fk_service_id ? "selected":"") }}>{{ $related_service->service_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-box-3">
                                            <div class="form-group m-form__group">
                                                <label>Task</label>
                                                <select class="form-control m_task_name e_task_name" id="task_name" name="task_name">
                                                    @foreach ($datas->relatedtask_name as $related_task)
                                                    <option value="{{ $related_task->pk_task_id}}" {{ ($related_task->pk_task_id== $datas->fk_task_id ? "selected":"") }}>{{ $related_task->task_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="checkinup" class="e_checkinup" value={{$datas->checkinup}}>
                                    <input type="hidden" id="primary_id" class="e_primary_id" value={{$datas->pk_visit_detail_id}}>
                                    
                                    
                                    <div class="row box-content managed_table">
                                        <div class="col-box-3">
                                            <div class="form-group m-form__group">
                                                <label>Start Time</label>     

                                                <select class="form-control e_start_time" id="start_time{{$datas->divids}}">
                                                    @foreach ($datas->timearray as $timearr=>$key)
                                                    <option name="{{ ($timearr) }}" value="{{ $key}}" {{ ($key== $datas->start_time ? "selected":"") }}> {{ ($key) }}</option>
                                                    @endforeach
                                                </select>   
                                                <div class="e_start_time_div"></div>
                                            </div>
                                        </div>     
                                        <div class="col-box-3">
                                            <div class="form-group m-form__group">
                                                <label>End Time</label>                                                               
                                                <select class="form-control e_end_time" id="end_time{{$datas->divids}}">
                                                    @foreach ($datas->timearray as $timearr=>$key)
                                                    <option name="{{ ($timearr) }}" value="{{ $key }}" {{ ($key== $datas->end_time ? "selected":"") }}> {{ ($key) }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="e_end_time_div"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control m-input e_duration" id="e_duration" value="{{$datas->duration}}" readonly="" >
                                        <div class="col-box-3 e_other_task_list">
                                            <div class="form-group m-form__group">
                                                <label>Other Task Name*</label>
                                                <input class="form-control m-input e_other_task_name" type="text" id="other_task_name" >
                                            </div>
                                        </div>
                                        <div class="col-box-4 e_other_task_description_default">
                                            <div class="form-group m-form__group text_cls">
                                                <label for="exampleTextarea">Other Task Description*</label>
                                                <textarea class="form-control m-input e_other_task_description" id="other_task_desc" rows="3">{{$datas->task_description}}
                                                </textarea>
                                            </div>
                                            <div class="mva_remove tp e_remove_div">
                                                <a href="javascript:void(0);" class="remove_btn e_remove_btn" id="remove_button">Remove</a>
                                            </div>
                                            <div class="mva_add">
                                                <a href="javascript:void(0);" class="add_btn add_clone" id="add_clone">+ Add</a>
                                            </div>
                                        </div>





                                    </div>

                                </div>
                                @endforeach
                                <!--                                <div class="col-box-2">
                                                                    <div class="form-group m-form__group">
                                                                        <div class="mva_add">
                                                                            <a href="javascript:void(0);" class="add_btn add_clone" id="add_clone">+ Add</a>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </div>
                            <div class="m-form__actions">
                                <a href="{{URL::to('manage_visit')}}" class="cancel_btn">Cancel</a>
                                <a href="javascript:void(0);" class="save_btn" id="save_data">Save</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                   


</div>
<!--</div>
</div>-->

<div class="modal fade dashboard_modal" id="modal_target_8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered manage_visit_blockout_time" role="document">
        <div class="modal-content">
            <div class="modal-header">
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
                        <h4 class="manage_visit_blockout_time">Do you want to overrule blockout time?</h4>
                    </div>
                </div>
                <!--end::Form-->
                <!--</div>-->
            </div>
            <div class="modal-footer manage_visit_blockout_time_center">
                <input type="no" id="valueofstart_end" value=""/>
                <input type="hidden" id="thisclassof" value=""/>
                <input type="hidden" id="id_of_confn_block"/>


                <button type="button" class="btn btn-secondary" id="block_overdueno" data-dismiss="modal" aria-label="Close">
                    No
                </button>
                <button type="button" class="btn btn-primary" id="block_overdueyes" data-dismiss="modal">
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end:: Body -->

<!-- end:: Page -->
@include('ManageVisit.myscript');

@stop
