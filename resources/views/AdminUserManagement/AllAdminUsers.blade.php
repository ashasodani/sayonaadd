@extends('layouts.layout')
@section('title')
    All Admin Users
@endsection
@section('main')
<!-- BEGIN: Subheader -->
<div class="m-subheader breadcrumb_sad">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                All Admin Users
            </h3>
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
                                                Admin User Management
                                            </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    <img src="images/dot_img.png" alt=""/>
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                All Admin Users
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
    <!--Success Message start-->
      @if(session()->has('add_admin_user'))
                    <div class="alert alert-success admin_sucess_message">
                        {{ session()->get('add_admin_user') }}
                    </div>
    @endif
    <input type="hidden" id="route_name" value="all_admin_users" />
    <!--Success Message start-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Best Sellers-->
            <div class="m-portlet m-portlet--full-height All_admin_user ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                All Admin Users
                            </h3>
                        </div>
                    </div>
                    <form class="m-header-search__form  All_admin">
                        <div class="All_admin_use m-header-search__wrapper">
                            <div class="add_new_admin_user">
                                <a href="#" class="Add_new_admin" data-toggle="modal" data-target="#modal_target_5">Add New Admin User</a>
                            </div>
                        </div>
                    </form>
                </div>
                 <div id="PartialAdminGroup">

                 </div>
            </div>
            <!--end::Widget 11-->
        </div>
    </div>
    <!--end:: Widgets/Best Sellers-->
</div>

<!-- BEGIN: Modal -->
<div class="modal fade dashboard_modal" id="modal_target_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Add New Admin User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                </button>
            </div>
            <div class="modal-body">
          <form class="m-form" action="allusersave" method="post" id="add_admin" enctype="multipart/form-data">
                        {{ csrf_field() }}
                <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                <div class="form-group m-form__group row add_new_admin_user">
                    <div class="col-sm-6">
                        <label class="col-form-label">
                            Admin Name *
                        </label>
                        <input type="text" class="form-control m-input" name="admin_name" id="admin_name" aria-describedby="AdminName" placeholder="Enter Text Here" autocomplete="nope">
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label">
                            Contact Number *
                        </label>
                       
                        <input type="text" class="form-control m-input"  maxlength="10" name="contact_number" id="contact_number" aria-describedby="ContactNumber" placeholder="Enter Text Here">
                    </div>
                </div>
                <div class="form-group m-form__group row select_grp_name">
                    <div class="col-sm-7 add_amount_balance_left">
                        <label class="col-form-label">
                            Select Admin Group *
                        </label>
                        <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                                           <select name="admin_user_group[]" multiple id="select_admin_grp" multiple>
                                            @foreach($admin_users_grp as $admin_user)
                                                <option value="{{$admin_user->pk_group_id}}">{{$admin_user->group_name}}</option>
                                            @endforeach
                                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row add_new_admin_user">
                    <div class="col-sm-12">
                        <label class="col-form-label">
                            Address *
                        </label>
                        <input type="text" class="form-control m-input"  name="address" id="address" aria-describedby="Address" placeholder="Enter Text Here" autocomplete="nope">
                    </div>
                </div>
                <div class="form-group m-form__group row add_new_admin_user">
                    <div class="col-sm-6">
                        <label class="col-form-label" for="user_city">
                            City *
                        </label>
                        
                        
                         <input type="text" name="admin_city" class="form-control" id="admin_city" autocomplete="nope">
                         <label><span id="store_city_result"></span></label>
                    </div>
                    <div class="col-sm-6">
                        <label for="store_state" class="col-form-label">
                            State *
                        </label>
                        <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                           
                                    
                        <input type="text" name="admin_state" class="form-control" id="admin_state" autocomplete="nope" placeholder="Please Select State">
                        <label><span id="store_state_result"></span></label>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6">
                        <label class="col-form-label" for="user_country">
                            Country *
                        </label>
                        <div class="dropdown bootstrap-select form-control m-bootstrap-select m_">
                            <input type="text" name="admin_country"  class="form-control" id="admin_country" autocomplete="nope">
                            <label> <span id="country_result" class="text-danger"></span> </label>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-5 date_of_birth">
                        <label class="col-form-label">
                            Date of Birth *
                        </label>
                        <div class="input-group date">
                            <input type="text" class="form-control m-input"  name="dob" placeholder="DD/MM/YY" id="m_datepicker_2_admin" autocomplete="nope">
                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <img src="images/date_picker_icon.png" alt=""/>
                                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 add_new_admin_user">
                        <label class="col-form-label">
                            Age
                        </label>
                        <input type="text" class="form-control m-input" id="age" name="age" aria-describedby="Age"  min="1" readonly>
                    </div>
                    <div class="col-sm-5">
                        <label class="col-form-label">
                            Gender *
                        </label>
                        <div class="m-form__group form-group">
                            <div class="m-radio-inline add_amount_balance_right">
                                <label class="m-radio m-radio--brand">
                                    <input type="radio" name="gender" id="gender_s" value="male">
                                    Male
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--brand">
                                    <input type="radio" name="gender" id="gender_s" value="female">
                                    Female
                                    <span></span>
                                </label>
                               
                            </div>
                            <label id="gender_vali"></label>
                        </div>
                    </div>
                </div>
                <!--end::Form-->
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <button type="button" id="save_admin_user"class="btn btn-primary">
                    Save
                </button>
                <button type="button" class="btn btn-secondary" id="cancel_admin_modal" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<!-- END: Modal -->
<!--/Delete Model Start-->
 <div class="modal fade dashboard_modal" id="modal_target_65" tabindex="-1" role="dialog"
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
                            <h6 class="inactive-modal-title-btm">Do you really want to Delete This User?</h6>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer inactive_user_btn_center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary d_cm_delete" id="delete_grp_detail_id">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
<!--/Delete Model End-->
 @include('AdminUserManagement.ScriptAdminAllDetail')
@endsection