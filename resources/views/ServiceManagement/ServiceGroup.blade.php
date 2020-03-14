@extends('layouts.layout')
@section('title')
    Services Group
@endsection
@section('main')
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
                                                Service Group
                                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
                <!-- END: Subheader -->
                <div class="m-content page_contant service_pages">
                    @if(session()->has('service_grp_name'))
                        <div class="alert alert-success service_grp_success_msg">
                            {{ session()->get('service_grp_name') }}
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
                                                Service Group List
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
                                                        <input autocomplete="off" type="text" name="q" class="m-header-search__input search_grp_list"  placeholder="Search..." id="srch_service_grp" onkeyup="search_service_grp(event);">
                                                    </span>
                                            </div>
                                            <div class="add_new_CT_btn">
                                                <!--                                                <a href="javascript:void(0);" class="new_Ct_btn" data-modal="#modal_target_9">Add New Service Group</a>-->
                                                <a href="#" class="new_Ct_btn change_status_btn" data-toggle="modal" data-target="#modal_target_9" id="add_new_service_grp">Add New Service Group</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div id="PartialServiceGroup">

                                </div>
                            </div>
                            <!--end::Widget 11-->
                        </div>
                    </div>
                    <!--end:: Widgets/Best Sellers-->
                </div>
        </div>
        <!--End::Section-->
@stop

<!-- BEGIN: Modal -->
<!--    Add New Service Group Popup Starts  -->

<div class="modal fade dashboard_modal show" id="modal_target_9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Add New Service Group
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodal">
                            <span aria-hidden="true">
                                ×
                            </span>
                </button>
            </div>
            <div class="modal-body">
                <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                <div class="form-group m-form__group row add_service_group">
                    <label class="col-form-label col-sm-12">
                        Service Group Name *
                    </label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control m-input" id="service-group-name" aria-describedby="ServiceGroupName" placeholder="E.g Home Care"  maxlength="100" autocomplete="nope">
                        <span style="color: red;display: none" class="error_msg">Enter Service Group Name</span>
                    </div>
                </div>
                <!--end::Form-->
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_service_grp">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>
<!--    Add New Service Group Popup Ends  -->

<!-- END: Modal -->
<!--/Delete Model Start-->
 <div class="modal fade dashboard_modal" id="modal_target_51" tabindex="-1" role="dialog"
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
                            <h6 class="inactive-modal-title-btm">Do you really want to Delete This Service Group?</h6>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer inactive_user_btn_center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary d_cm_delete" id="service_group_delete">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
<!--/Delete Model End-->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
$(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: 'partial_service_grp',
            async: false,
            error: function (error) {
            },
            success: function (result) {
                $("#PartialServiceGroup").html(result.html);
            },
        });
        
        //page link start
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url,function(data){
                jQuery.ajaxSetup({async:false});
                $('#PartialServiceGroup').html(data.html);
            });
        
        });
        //page link end
        
        //Pagination start
        $(document).on('change', '#pagination_services_group', function (e) {
              debugger;
               e.preventDefault();
                var search_service_grp=document.getElementById("srch_service_grp").value;
                 var se_grp_page_length=$("#pagination_services_group").val();
                 $.ajax({
                    url:'partial_service_grp',
                    type:'GET',
                    data:{se_grp_page_length:se_grp_page_length,search_service_grp:search_service_grp},
                    success:function(data){
                         $('#PartialServiceGroup').html(data.html);
                        
                    },

                });
        });
        //Pagination end
          
          
        //Service group edit start
        $(document).on('click', '#service_grp_edit', function (e) {
                 debugger;
                
                 var edit_grp_id=$(this).attr('data-id');
               
                  $.ajax({
                            url: 'edit_service_group',
                            type: 'GET',
                            dataType: 'json',
                            data: {'edit_grp_id': edit_grp_id},
                             success: function (res) {
                                 debugger;
                                   if(res!=''){
                                       $('#service-group-name').val(res.service_grp_name);
                                       $('#save_service_grp').attr('data-id', edit_grp_id);
                                       $('#save_service_grp').text('Update');
                                   }
                             }
                 });
        });
        //Service group edit end
        
    //success msg
    $(".service_grp_success_msg").delay(3000).fadeOut('slow'); 
      
    
        
     //Add service group start    
    $("#add_new_service_grp").on('click',function(){
                   debugger;
                   $("#service-group-name").val('');
                   $('.error_msg').hide();
                   $('#save_service_grp').text('Save');
    });
    //Add service group end
     



});
    
//Close model start  
$("#closemodal").on('click',function(){
         $("#service-group-name").val('');
});
//Close model end  
//Get id task delete model
         $(document).on('click','#service_grp_model_id',function(){
            debugger;
            var cleardeleteid=$("#service_group_delete").attr('data-id',0);
            var deletetaskid=$(this).data('id');
            var setdeleteid=$("#service_group_delete").attr('data-id',deletetaskid);
        }); 
//Service Group Delete start
    $(document).on('click','#service_group_delete',function(){
            debugger;
            
            var delete_service_grp_id=$(this).attr("data-id")
                $.ajax({
                    url: 'service_grp_delete',
                    type: 'GET',
                    dataType: 'json',
                    data: {'delete_id': delete_service_grp_id},
                    success: function(res) {
                        if (res == 1) {
                            location.reload();
                        }
                    },
                    error: {
                    }
                });
     });
//Service Group Delete end
     
//Save service group start
    $("#save_service_grp").on('click',function(){
        debugger;
        var error=0;
      
        $(".error_msg").hide();
        var service_grp_name=$("#service-group-name").val();
        if(service_grp_name=="" || !service_grp_name)
        {
            error=1;
            $(".error_msg").show();
        }

        if(error==0)
        {
            var ser_edit_id = $('#save_service_grp').data('id');
            $.ajax({
                type: 'GET',
                url: 'save_service_grp_name',
                async: false,
                data: {
                    service_grp_name:service_grp_name,
                    ser_edit_id:ser_edit_id
                },
                error: function (error) {
                },
                success: function (result) {
                    if(result==0)
                    {
                        
                    }

                    if(result==1)
                    {
                        window.location.reload();
                    }
                },
            });
        }
    });
//Save service group end
//Search service group start
    function search_service_grp(event)
    {
        debugger;

        event.preventDefault();
        if(event.code=="Enter")
        {
            var search_service_grp=$("#srch_service_grp").val();
            $.ajax({
                type: 'GET',
                url: 'partial_service_grp',
                data:{search_service_grp:search_service_grp},
                async: false,
                error: function (error) {
                },
                success: function (result) {
                    $("#PartialServiceGroup").html(result.html);
                },
            });
        }
    }
//Search service group end
    
    
    
     

</script>

