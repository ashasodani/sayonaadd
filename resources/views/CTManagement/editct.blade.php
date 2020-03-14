<!--denish code-->
@extends('layouts.layout')
@section('title')
    CT Management
@endsection
@section('main')
<div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader breadcrumb_sad">
        <div class="d-flex align-items-center edit_client">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Edit Details</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="index.html" class="m-nav__link m-nav__link--icon">
                            <img src="images/home.png" alt=""/>
                        </a>
                    </li>  
                    <li class="m-nav__separator">
                        <img src="images/dot_img.png" alt=""/>
                    </li>
                    <li class="m-nav__item">
                        <a href="javascript:void(0);" class="m-nav__link">
                            <span class="m-nav__link-text">
                                CT Management
                            </span>
                        </a>

                    <li class="m-nav__separator">
                        <img src="images/dot_img.png" alt=""/>
                    </li>
                    <li class="m-nav__item">
                        <a href="javascript:void(0);" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Edit Details
                            </span>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content page_contant hca_add_new_ct">
    	<form method="post" id="edit_ct" action="" enctype="multipart/form-data">
    		@csrf
        <!--Begin::Section-->
        <input type="hidden" id="hdn_id" name="id" value="{{$ct_get->pk_ct_info_id}}">
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height edit_client_detail hca_sec">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Edit Details
                                </h3>
                            </div>
                        </div>
                        <div class="edit_client m-header-search__wrapper">
                            <div class="save_btn">
                                <a href="{{URL::to('ct_management')}}" class="cancel_btn">Cancel</a>                                                
                                <a href="javascript:void(0);" class="create_btn" id="ct_edit">Save</a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body hca_dts hca_edit_dts">
                        <!--begin::Widget 11-->
                        <div class="m-widget11 edit_client_detail">
                            <!--                                            <div class="table-responsive">-->
                            <div class="row m-0 box-content edit_client_detail">
                                <div class="box-content-1">
                                    <span class="detail-title">CT Name*</span>
                                    <input type="text" class="form-control m-input" id="ct_name" name="ct_name" aria-describedby="groupName" value="{{$ct_get->ct_name}}">
                                </div>
                                <div class="box-content-2">
                                    <span class="detail-title">Contact Number*</span>
                                    <input type="text" class="form-control m-input" id="ct_contact_info" name="ct_contact_info" aria-describedby="groupName" value="{{$ct_get->ct_contact_info}}">
                                </div>
                                <div class="box-content-3">
                                    <span class="detail-title">Email*</span>
                                    <input type="text" class="form-control m-input" id="ct_email" name="ct_email" aria-describedby="groupName" value="{{$ct_get->ct_email}}" readonly="">
                                </div>
                                <input type="hidden" name="ct_age_new" id="ct_ages">
                                <div class="box-content-4">
                                    <span class="detail-title">Date of Birth*</span>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input" readonly="" value="{{$ct_dob}}" id="m_datepicker_2" name="ct_dob">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <img src="images/date_picker_icon.png" alt=""/>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-content-5">
                                    <span class="detail-title">Age</span>
                                    <span class="detail-content" id="ct_birth" value="">{{$ct_get->ct_age}}</span>
                                    <!-- <span class="detail-content">{{$ct_get->ct_age}}</span> -->
                                </div>
                                <div class="box-content-6">
                                    <span class="detail-title">Gender*</span>
                                    <div class="m-form__group form-group">
                                        <div class="m-radio-inline add_amount_balance_right">
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="ct_gender" value="Male" <?php echo ($ct_get->ct_gender=='Male') ? 'checked="checked"':'';?>>
                                                Male
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="ct_gender" value="Female" <?php echo ($ct_get->ct_gender=='Female') ? 'checked="checked"':'';?>>
                                                Female
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="box-content-7">
                                    <span class="detail-title">CT Service Group Name</span>
                                    <div class="auto_search_check">
                                    <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                                       <select name="fk_service_grp_ids[]"  id="fk_service_grp_ids" multiple>
                                        <?php
                                        $selected_array = explode(',',$admin_group_id);
                                          foreach($services_grp as $list){
                                          $mark_as_select = (in_array($list->pk_service_group_id,$selected_array)) ? 'selected' : NULL;
                                            echo '<option value="'.$list->pk_service_group_id.'" '.$mark_as_select.'>'.$list->service_grp_name.'</option>';
                                          }  
                                        ?>
                                       <!--  @foreach($services_grp as $ser)

                                            <option value="{{ $ser->pk_service_group_id }}" selected="true">{{ $ser->service_grp_name }}</option> 
                                            @endforeach -->
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <!--                                            </div>
                                                                            <div class="row m-0 box-content edit_client_detail">-->
                                <div class="box-content-9">
                                    <span class="detail-title">Allocated Client</span>
                                    <span class="detail-content">{{$cnt_client}}</span>
                                </div>
                                <div class="box-content-8">
                                    <span class="detail-title">Address*</span>
                                    <input type="text" class="form-control m-input" id="ct_address" name="ct_address" aria-describedby="groupName" value="{{$ct_get->ct_address}}">
                                </div>
                                <div class="box-content-1">
                                    <span class="detail-title">City*</span>
                                    <input type="text" class="form-control m-input" name="ct_city" id="ct_city" aria-describedby="groupName" value="{{$ct_get->ct_city}}">
                                </div>

                                 <div class="box-content-1">
                                    <span class="detail-title">State*</span>
                                    <input type="text" class="form-control m-input" id="ct_state" name="ct_state" aria-describedby="groupName" value="{{$ct_get->ct_state}}" maxlength="15" readonly="">
                                </div>

                                <div class="box-content-1">
                                    <span class="detail-title">Country*</span>
                                    <input type="text" class="form-control m-input" id="ct_country" name="ct_country" aria-describedby="groupName" value="{{$ct_get->ct_country}}" maxlength="15" readonly="">
                                </div>
                                <div class="box-content-10">
                                    <span class="detail-title">Salary*</span>
                                    <input type="text" class="form-control m-input" name="ct_salary" id="ct_salary" aria-describedby="groupName" value="{{$ct_get->ct_salary}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->
                <div class="m-portlet m-portlet--full-height edit_client_detail hca_sec">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Upload Certificate
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body hca_dts">
                        <div class="m-widget11 edit_client_detail">
                            <div class="row">
                                <div class="col-4">
                                    <span class="detail-title">Police Checkup</span>
                                    <div class="m-form__group form-group">
                                        <div class="m-radio-inline add_amount_balance_right">
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="police_checkup_status" value="Done" <?php echo ($ct_get->police_checkup_status=='Done') ? 'checked="checked"':'';?>>
                                                Done
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="police_checkup_status" value="Pending" <?php echo ($ct_get->police_checkup_status=='Pending') ? 'checked="checked"':'';?>>
                                                Pending
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="upload_s">
                                        <span>Upload Documents</span>
                                        <!-- <input id="upload" type="file" name="fileToUpload"> -->
                                        <input type="file" name="police_checkup_file[]" class="upd_police" id="police_checkup_file" multiple>
                                        <a href="javascript:void(0);" id="upload_link" class="upload_img_btn police_att">Attach File</a>
                                         <span class="police_s"></span>
                                    </div>
<!--                                    <div class="upload_s">
                                        <span>Upload Documents</span>
                                        <input id="upload" type="file">
                                        <input type="file" name="police_checkup_file[]" class="upload_img_btn upd_police" id="police_checkup_file" multiple>
                                         <a href="" id="upload_link" class="upload_img_btn">Attach File</a> 
                                    </div>-->

                                    @foreach($get_police_cer as $c)
                                    <div class="police_id_del alert alert-dismissible fade show   m-alert m-alert--outline m-alert--air hca_alt" role="alert" cer_id="{{$c->pk_ct_upd_id}}" onclick="delete_cer();">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <p>{{$c->file_name}}<strong> {{$c->file_size}}</strong></p>
                                    </div>
                                    @endforeach
                                    
                                    
                                    <div class="error_msg">Max file size is 1MB and max number of files is 5</div>
                                </div>
                                <div class="col-4">
                                    <span class="detail-title">Training Certificate</span>
                                    <div class="m-form__group form-group">
                                        <div class="m-radio-inline add_amount_balance_right">
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="training_certi_status" value="Done" <?php echo ($ct_get->training_certi_status=='Done') ? 'checked="checked"':'';?>>
                                                Done
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="training_certi_status" value="Pending" <?php echo ($ct_get->training_certi_status=='Pending') ? 'checked="checked"':'';?>>
                                                Pending
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="upload_s">
                                        <span>Upload Documents</span>
                                        <!-- <input id="upload" type="file" name="fileToUpload"> -->
                                        <input type="file" name="training_certi_file[]" class="upd_doc" id="training_certi_file" multiple>
                                        <a href="javascript:void(0);" id="upload_link" class="upload_img_btn doc_att">Attach File</a>
                                        <span class="training_s"></span>
                                    </div>
<!--                                    <div class="upload_s">
                                        <span>Upload Training Certificate</span>
                                        <input id="upload" type="file">
                                        <input type="file" name="training_certi_file[]" class="upload_img_btn upd_police" id="training_certi_file" multiple>
                                         <a href="" id="upload_link" class="upload_img_btn">Attach File</a> 
                                    </div>-->
                                    @foreach($get_training_cer as $training) 
                                    <div class="alert alert-dismissible fade show   m-alert m-alert--outline m-alert--air hca_alt" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <p>{{$training->file_name}}<strong> {{$training->file_size}}</strong></p>
                                    </div>
                                    @endforeach
                                    <div class="error_msg">Max file size is 1MB and max number of files is 5</div>
                                </div>
                                <div class="col-4">
                                    <span class="detail-title">Other Doucment</span>
                                    <div class="m-form__group form-group">
                                        <div class="m-radio-inline add_amount_balance_right">
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="other_doc_sataus" value="Done" <?php echo ($ct_get->other_doc_sataus=='Done') ? 'checked="checked"':'';?>>
                                                Done
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="other_doc_sataus" value="Pending" <?php echo ($ct_get->other_doc_sataus=='Pending') ? 'checked="checked"':'';?>>
                                                Pending
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="upload_s">
                                        <span>Upload Documents</span>
                                        <!-- <input id="upload" type="file" name="fileToUpload"> -->
                                        <input type="file" name="other_doc_file[]" class="upd_other" id="other_doc_file" multiple>
                                        <a href="javascript:void(0);" id="upload_link" class="upload_img_btn other_att">Attach File</a>
                                         <span class="other_s"></span>
                                    </div>
<!--                                    <div class="upload_s">
                                        <span>Upload Other Documents</span>
                                        <input id="upload" type="file">
                                        <input type="file" name="other_doc_file[]" class="upload_img_btn upd_police" id="other_doc_file" multiple>
                                         <a href="" id="upload_link" class="upload_img_btn">Attach File</a> 
                                    </div>-->
                                    @foreach($get_other_cer as $cer)
                                    <div class="alert alert-dismissible fade show   m-alert m-alert--outline m-alert--air hca_alt" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <p>{{$cer->file_name}}<strong> {{$cer->file_size}}</strong></p>
                                    </div>
                                    @endforeach
                                    <div class="error_msg">Max file size is 1MB and max number of files is 5</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

    <div class="m-portlet__body client_tabs hca_add_new_ct">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item allocatedclient">
                <a class="nav-link active show" data-toggle="tab" href="#m_tabs_1_1">Allocated Clients</a>
            </li>
            <li class="nav-item allocatedvisit">
                <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">Allocated Visits</a>
            </li>               
        </ul>
        <input type="hidden" name="id" id="id" value="{{$id}}">
        <a href="{{URL::to('NewClient')}}" class="change_status_btn all_new_cnt_btn">Allocate New Client</a>
        <div class="tab-content client">
            <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
               <div id="PartialAllctGroup">
                    @include('CTManagement/allocatedclient')
                </div>
            </div>
        </div>
        <div class="tab-content visit">
            <div class="tab-pane " id="m_tabs_1_2" role="tabpanel">
                <div id="PartialAllctGroup1">
                    @include('CTManagement/allocatedvisit')
                </div>
            </div>
        </div>

    </div>
</div> 
 <script src="{{URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9dMIPnjrc_1cg-qssupeOYiPtPQQlDI&libraries=places&callback=initAutocomplete1')}}" async defer></script>
@stop
