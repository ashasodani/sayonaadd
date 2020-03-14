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
                <h3 class="m-subheader__title m-subheader__title--separator">Add New CT</h3>
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
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">
                                CT Management
                            </span>
                        </a>

                    <li class="m-nav__separator">
                        <img src="images/dot_img.png" alt=""/>
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Add New CT
                            </span>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content page_contant hca_add_new_ct">
    	<form method="post" id="add_ct" action="" enctype="multipart/form-data">
    		@csrf
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Best Sellers-->

                <div class="m-portlet m-portlet--full-height edit_client_detail hca_sec">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Add New CT
                                </h3>
                            </div>
                        </div>
                        <div class="edit_client m-header-search__wrapper">
                            <div class="save_btn">
                                <a href="{{URL::to('ct_management')}}" class="cancel_btn">Cancel</a>                                                
                                <a href="javascript:void(0);" class="create_btn ct_det_add" id="ct_add">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body hca_dts">
                        <!--begin::Widget 11-->
                        <div class="m-widget11 edit_client_detail">
                            <!--                                            <div class="table-responsive">-->
                            <div class="row m-0 box-content edit_client_detail">
                                <div class="box-content-1">
                                    <span class="detail-title">CT Name*</span>
                                    <input type="text" class="form-control m-input" id="ct_name" name="ct_name" aria-describedby="groupName" placeholder="Enter Text Here" maxlength="20">
                                </div>
                                <div class="box-content-2">
                                    <span class="detail-title">Contact Number*</span>
                                    <input type="text" class="form-control m-input" id="ct_contact_info" name="ct_contact_info" aria-describedby="groupName" placeholder="Enter Text Here" maxlength="12">
                                </div>
                                <div class="box-content-3">
                                    <span class="detail-title">Email*</span>
                                    <input type="text" class="form-control m-input" id="ct_email" name="ct_email" aria-describedby="groupName" placeholder="Enter Text Here" maxlength="50">
                                </div>
                                <input type="hidden" name="ct_age_new" id="ct_ages">
                                <div class="box-content-4">
                                    <span class="detail-title">Date of Birth*</span>
                                    <div class="input-group date date_select">
                                        <input type="text" class="form-control m-input ct_dob" readonly="" placeholder="DD/MM/YYYY" id="m_datepicker_2" name="ct_dob" class="ct_dob">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <img src="images/date_picker_icon.png" alt=""/>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-content-5">
                                    <span class="detail-title" id="ct_age" name="ct_age">Age</span>
                                    <span class="detail-content" id="ct_birth">-</span>
                                </div>
                                <div class="box-content-6">
                                    <span class="detail-title">Gender*</span>
                                    <div class="m-form__group form-group">
                                        <div class="m-radio-inline add_amount_balance_right">
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="ct_gender" id="ct_gender" value="Male" checked="">
                                                Male
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="ct_gender" id="ct_gender" value="Female">
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
                                                            @foreach($services_grp as $ser)
                                                                <option value="{{ $ser->pk_service_group_id }}">{{ $ser->service_grp_name }}</option> 
                                                                @endforeach
                                                        </select>
                                    </div>
                                </div>
                                </div>

                                
                                
<!--                                            </div>
                            <div class="row m-0 box-content edit_client_detail">-->

                                <div class="box-content-8">
                                    <span class="detail-title">Address*</span>
                                    <input type="text" class="form-control m-input" id="ct_address" name="ct_address" aria-describedby="groupName" placeholder="Enter Text Here" maxlength="50">
                                </div>
                                <div class="box-content-1">
                                    <span class="detail-title">City*</span>
                                    <input type="text" class="form-control m-input" id="ct_city" name="ct_city" aria-describedby="groupName" placeholder="Enter Text Here" maxlength="15">
                                </div>

                                <div class="box-content-1">
                                    <span class="detail-title">State*</span>
                                    <input type="text" class="form-control m-input" id="ct_state" name="ct_state" aria-describedby="groupName" placeholder="Enter Text Here" maxlength="15" readonly="">
                                </div>

                                <div class="box-content-1">
                                    <span class="detail-title">Country*</span>
                                    <input type="text" class="form-control m-input" id="ct_country" name="ct_country" aria-describedby="groupName" placeholder="Enter Text Here" maxlength="15" readonly="">
                                </div>

                                <!-- <div class="box-content-2">
                                    <span class="detail-title">State*</span>
                                    <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                                        <select class="form-control m-bootstrap-select m_selectpicker" tabindex="-98" placeholder="Select State" name="ct_state" id="ct_state">
                                            <option>
                                                Rajasthan
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
                                </div> -->
                               <!--  <div class="box-content-3"> 
                                    <span class="detail-title">Country*</span>
                                    <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                                        <select class="form-control m-bootstrap-select m_selectpicker" tabindex="-98" placeholder="Select Country" name="ct_country" id="ct_country">
                                            <option>
                                                India
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
                                </div> -->
                                <div class="box-content-4">
                                    <span class="detail-title">Salary*</span>
                                    <input type="text" class="form-control m-input" id="ct_salary" placeholder="₹ 1500" aria-describedby="groupName" placeholder="Enter Text Here" name="ct_salary" maxlength="10">
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
                                                <input type="radio" name="police_checkup_status" id="police_checkup_status" value="Done" checked="">
                                                Done
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="police_checkup_status" id="police_checkup_status" value="Pending">
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
                                        <input id="upload" type="file" name="fileToUpload">
                                        <input type="file" name="police_checkup_file[]" class="upload_img_btn upd_police" id="police_checkup_file" multiple>
                                         <a href="" id="upload_link" class="upload_img_btn">Attach File</a> 
                                    </div>-->
                                    <!-- <div class="alert alert-dismissible fade show   m-alert m-alert--outline m-alert--air hca_alt picappend" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <p>Picturemessage_yqrhxbz4.u0u.png<strong> (27.6KB)</strong></p>
                                    </div> -->
                                    <div class="error_msg">Max file size is 1MB and max number of files is 5</div>
                                </div>
                                <div class="col-4">
                                    <span class="detail-title">Training Certificate</span>
                                    <div class="m-form__group form-group">
                                        <div class="m-radio-inline add_amount_balance_right">
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="training_certi_status" id="training_certi_status" value="Done" checked="">
                                                Done
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="training_certi_status" id="training_certi_status"value="Pending">
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
                                        <input type="file" name="training_certi_file[]" class="upload_img_btn training_certi_file" id="training_certi_file" multiple>
                                         <a href="" id="upload_link" class="upload_img_btn">Attach File</a> 
                                    </div>-->
                                </div>
                                <div class="col-4">
                                    <span class="detail-title">Other Doucment</span>
                                    <div class="m-form__group form-group">
                                        <div class="m-radio-inline add_amount_balance_right">
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="other_doc_sataus" id="other_doc_sataus" value="Done" checked="">
                                                Done
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--brand">
                                                <input type="radio" name="other_doc_sataus" id="other_doc_sataus" value="Pending">
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
                                        <input type="file" name="other_doc_file[]" class="upload_img_btn upd_doc" id="other_doc_file" multiple>
                                         <a href="" id="upload_link" class="upload_img_btn">Attach File</a> 
                                    </div>-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
 <script src="{{URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9dMIPnjrc_1cg-qssupeOYiPtPQQlDI&libraries=places&callback=initAutocomplete1')}}" async defer></script>
@stop
