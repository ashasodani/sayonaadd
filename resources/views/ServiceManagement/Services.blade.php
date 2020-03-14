<!--/Services (Asha)-->
@extends('layouts.layout')
@section('title')
    Services
@endsection
@section('main')
<style>
.dropdown.bootstrap-select.form-control.m-bootstrap-select.m_ services_list_dropdown_d >select{
    position: inherit !important;
    left: auto;
    height: auto !important;
    border: 1px solid #EBEDF2;
    bottom: auto;
    display: inherit !important;
    opacity: inherit !important;
    padding: .65rem 1rem !important;
    width: 100% !important;
}
</style>
    <meta name="csrf-token1" content="{{ csrf_token() }}">

    <div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader breadcrumb_sad">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Services
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
                                                Service Management
                                            </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            <img src="images/dot_img.png" alt="">
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                Services
                                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content page_contant service_pages s_mng">
            @if(session()->has('service_name'))
                <div class="alert alert-success" id="services_success_msg">
                    {{ session()->get('service_name') }}
                </div>
            @endif
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Best Sellers-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Serivces List
                                    </h3>
                                </div>
                            </div>
                            <div class="m-header-search__form">
                                <div class="m-header-search__wrapper">
                                    <div class="search">
                                                    <span class="m-header-search__icon-search" id="m_quicksearch_search">
                                                        <i class="la la-search"></i>
                                                    </span>
                                        <span class="m-header-search__input-wrapper">
                                                        <input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search Service Name" id="search_service_name" onkeyup="search_service(event);">
                                                    </span>
                                    </div>
                                    <div class="add_new_CT_btn">
                                        <a href="#" class="new_Ct_btn change_status_btn" data-toggle="modal" data-target="#modal_target_10" id="add_new_services">Add New Service</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="PartialServices"></div>
                    <!--end::Widget 11-->
                </div>
            </div>
            <!--end:: Widgets/Best Sellers-->
        </div>
    </div>
    <!--End::Section-->
    </div>
@stop

<!--    Add New Service Popup Starts  -->
<div class="modal fade dashboard_modal" id="modal_target_10" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Add New Service
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                </button>
            </div>
            <!--/form start-->
            <form id="add_new_services_in" method="" action="">
                <div class="modal-body">
                    <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->

                    <div class="form-group m-form__group row">
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Select Service Group *
                            </label>
                            <div class="dropdown bootstrap-select form-control m-bootstrap-select m_ services_list_dropdown_d" id="servicess_group">
                                <select class="form-control m-bootstrap-select m_selectpicker" tabindex="-98" id="service_grp">
                                  <option selected disabled>
                                        Select Group
                                    </option>
                                    @foreach($services_grps as $service_grp)
                                    
                                        <option value="{{$service_grp->pk_service_group_id}}">{{$service_grp->service_grp_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Service Name *
                            </label>
                            <input type="text" class="form-control m-input" id="servicename" aria-describedby="ServiceName" placeholder="Service Name" maxlength="100">
                            <span style="color: red;display: none" class="error__service_name_msg">Service Name Already Exists</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Hourly Rate *
                            </label>
                            <input type="text" class="form-control m-input" id="hourlyrate" aria-describedby="HourlyRate" placeholder="Hourly Rate" maxlength="5">
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div>
                    <span style="color: red;display: none" class="error_msg">Enter Required Fields</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save_new_service">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" id="cancelmodel_services">
                        Cancel
                    </button>
                </div>
        </form>
        <!--/form end-->
        </div>
    </div>
</div>
<!--    Add New Service Popup Ends  -->
<!--/Delete Model Start-->
 <div class="modal fade dashboard_modal" id="modal_target_delete" tabindex="-1" role="dialog"
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
                            <h6 class="inactive-modal-title-btm">Do you really want to Delete This Services?</h6>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer inactive_user_btn_center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary d_cm_delete" id="delete_services">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
<!--/Delete Model End-->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        //Pagination services
        $.ajax({
            type: 'GET',
            url: 'partial_services',
            async: false,
            error: function (error) {
            },
            success: function (result) {
                $("#PartialServices").html(result.html);
            },
        });
         $("#services_success_msg").delay(3000).fadeOut('slow'); 
        
        
        //Edit getdata services
        $(document).on('click','#services_edit',function(){
            debugger;
            $(".error_msg").hide();
            $(".error__service_name_msg").hide();
            $('#add_new_services_in')[0].reset();
            $('#save_new_service').val(0);
            var edit_service_id=$(this).data('id');
            
            $.ajax({
                            url: 'edit_services',
                            type: 'GET',
                            dataType: 'json',
                            data: {'edit_service_id': edit_service_id},
                             success: function (res) {
                                 debugger;
                                   if(res!=''){
                                       debugger;
                                      $("#servicename").val(res.service_name);
                                      $('select option').removeClass("selected");
                                      $("#service_grp").val(res.fk_service_grp_id);
                                      $('select option[value= ' + res.fk_service_grp_id + ']').attr("selected", true);
                                      $('.filter-option-inner').text(res.service_grp_name);
                                      $("#hourlyrate").val(res.hourly_rate);
                                      $('#save_new_service').attr('data-id', edit_service_id);
                                      $('#save_new_service').text('Update');
                                   }
                             }
                 });
            
        });
        
        //Addnew button services
         $(document).on('click','#add_new_services',function(){
             debugger;
            $(".error_msg").hide();
            $(".error__service_name_msg").hide();
            $('#add_new_services_in')[0].reset();
            $('#save_new_service').val(0);
            $('#save_new_service').text('Save');
            $('.filter-option-inner').text('Select Group');
         });
         
         //Cancelmodel services
          $(document).on('click','#cancelmodel_services',function(){
             debugger;
            $(".error_msg").hide();
            $(".error__service_name_msg").hide();
            $('#add_new_services_in')[0].reset();
            $('#save_new_service').val(0);
            $('.filter-option-inner').text('Select Group');
         });
         
         
        //Hourly rate number start
         $('#hourlyrate').keypress(function(e) {
                var a = [];
                var k = e.which;
                for (i = 48; i < 58; i++)
                    a.push(i);

                if (!(a.indexOf(k)>=0))
                    e.preventDefault();
        });
        //Hourly rate number start
        
        
        //Get id task delete model
         $(document).on('click','#delete_services_model',function(){
            debugger;
            var cleardeleteid=$("#delete_services").attr('data-id',0);
            var deletetaskid=$(this).data('id');
            var setdeleteid=$("#delete_services").attr('data-id',deletetaskid);
        });
        
        //Delete_task_model
        //Services Delete start
    $(document).on('click','#delete_services',function(){
            debugger;
            var delete_service_id = $(this).attr("data-id")
            
           
                $.ajax({
                    url: 'services_delete',
                    type: 'GET',
                    dataType: 'json',
                    data: {'delete_id': delete_service_id},
                    success: function(res) {
                        if (res == 1) {
                            location.reload();
                        }
                    },
                    error: {
                    }
                });
     });
    //Services Delete end
        
        
        
        
    });
//Save services start
$("#save_new_service").on('click',function () {
    debugger;
   
    var error=0;
    $(".error_msg").hide();
    $(".error__service_name_msg").hide();
    var service_grp=$("#service_grp").val();
    var servicename =$("#servicename").val();
    var hourlyrate=$("#hourlyrate").val();

    if(service_grp=="" || !service_grp)
    {
        error=1;
        $(".error_msg").show();
    }

    if(!servicename || servicename=="")
    {
        error=1;
        $(".error_msg").show();
    }

    if(!hourlyrate || hourlyrate=="")
    {
        error=1;
        $(".error_msg").show();
    }



    if(error==0)
    {
         var services_edit_id = $('#save_new_service').data('id');
        $.ajax({
            type: 'GET',
            url: 'save_new_service',
            async: false,
            data: {
                service_grp:service_grp,servicename:servicename,hourlyrate:hourlyrate,services_edit_id:services_edit_id
            },
            error: function (error) {
            },
            success: function (result) {
                if(result==0)
                {
                    $(".error__service_name_msg").show();
                }

                if(result==1||result==2)
                {
                    window.location.reload();
                }
            },
        });
    }
    
});

//Save services end

//Search services start
    function search_service(event)
    {

        event.preventDefault();
        if(event.code=="Enter")
        {
            var search_service_name=$("#search_service_name").val();
            $.ajax({
                type: 'GET',
                url: 'partial_services',
                data:{search_service_name:search_service_name},
                async: false,
                error: function (error) {
                },
                success: function (result) {
                    $("#PartialServices").html(result.html);
                },
            });
        }
    }
//Search services end
</script>

