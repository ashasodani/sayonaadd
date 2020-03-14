@extends('layouts.layout')
@section('title')
    Admin User Groups
@endsection
@section('main')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN: Subheader -->
    <div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader breadcrumb_sad">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Admin User Groups
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
                                                Admin User Groups
                                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content page_contant">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Best Sellers-->
                    <div class="m-portlet m-portlet--full-height admin_user_group ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Admin User Groups
                                    </h3>
                                </div>
                            </div>
                            <form class="m-header-search__form  admin_user_grp">
                                <div class="Admin_user_groups m-header-search__wrapper">
                                    <div class="admin_user_groups">
                                        <a href="#" class="Add_new_group" data-toggle="modal" data-target="#modal_target_6" id="add_new_group">Add New Group</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="adminusergroupmodule">
                        </div>
                    </div>
                    <!--end::Widget 11-->
                </div>
            </div>
            <!--end:: Widgets/Best Sellers-->
        </div>
    </div>
    <!--End::Section-->
    </div>


<!-- BEGIN: Modal -->
<div class="modal fade dashboard_modal" id="modal_target_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
        <div class="modal-content">
         <form id="add_new_group_form">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Add New group
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    ×
                                </span>
                </button>
            </div>
            <div class="modal-body">
                <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
            
                <div class="form-group m-form__group row admin_new_group">
                    <div class="col-sm-6">
                        <label class="col-form-label">
                            Group Name *
                        </label>
                      
                        <input type="text" class="form-control m-input" id="groupname" aria-describedby="groupName" placeholder="Client Representative">
                        <div class="error_msg_grp_name" style="display: none">
                            <span class="" style="color: red">Group Name Already Exists</span>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6">
                        <label class="col-form-label">
                            Assigned Modules
                        </label>
                        <div class="m-form__group form-group admin_new_group">
                            <div class="m-checkbox-list">
                                @foreach($modules as $module)
                                    <label class="m-checkbox m-checkbox--brand">
                                        <input type="checkbox" id="assign_grp_module" class="assign_module" value="{{$module->pk_module_id}}">
                                        <input type="hidden" id="assign_grp_module_hidden" class="module_name" value="{{$module->module_name}}">
                                            {{$module->module_name}}
                                        <span></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="m-form__group form-group admin_new_group_read_edit">
                            <div class="m-radio-inline admin_new_group_btm permissions">
                                @foreach($modules as $module)
                                        <label class="m-radio m-radio--brand">
                                            <input type="radio" id="permission_grp_module_read" name="{{$module->module_name}}"  value="read">
                                            Read
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--brand">
                                            <input type="radio"  id="permission_grp_module_edit" name="{{$module->module_name}}"  value="edit">
                                            Edit
                                            <span></span>
                                        </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="error_msg" style="display: none">
                    <span class="" style="color: red">Enter Proper Data</span>
                </div>
         
                <!--end::Form-->
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_new_group">
                    Save
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </div>
           </form>
        </div>
    </div>
</div>
<!-- END: Modal -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
 $(document).ready(function(){

      debugger;
     $.ajax({
            type: 'GET',
            url: 'partial_all_admin_user_module',
            async: false,
            error: function (error) {
            },
            success: function (result) {
                $("#adminusergroupmodule").html(result.html);
            },
        });

      $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url,function(data){
            jQuery.ajaxSetup({async:false});
            $('#adminusergroupmodule').html(data.html);
        });
      });

      $(document).on('change','#paginationmodule',function(){
        debugger;
         var page_length_grp=$("#paginationmodule").val();
                debugger;
         $.ajax({
                type: 'GET',
                url: 'partial_all_admin_user_module',
                data:{page_length_grp:page_length_grp},
                async: false,
                error: function (error) {
                },
                success: function (result) {
                    $("#adminusergroupmodule").html(result.html);
                },
            });

      });

         $(document).on('click','#delete_admin_grp_id',function(){
      
        debugger;
         var delete_grp_id = $(this).data('id');
        var checkstr = confirm('are you sure you want to delete this?');
         if (checkstr == true) {
             $.ajax({
                    url: 'delete_admin_group_id',
                    type: 'GET',
                    dataType: 'json',
                    data: {'delete_grp_id': delete_grp_id},
                    success: function(res) {
                      if(res!=''){
                         location.reload();
                      }
                    },
                    error: {
                    }
                });
         }
     });

    $("#add_new_group").on('click',function(){
        debugger;
      
        $("#add_new_group_form")[0].reset();
        $("input:checkbox").removeAttr("checked");
        $("input:radio").removeAttr("checked");
        var error = 0;
        $(".error_msg").hide();
        $(".error_msg_grp_name").hide();
        $("#save_new_group").attr('data-id',0);
    });
    
    

    $("#save_new_group").on('click',function () {
        var error = 0;
        var new_admin_grp_data = [];
        var modules = [];
        var read_write = [];
        $(".error_msg").hide();
        $(".error_msg_grp_name").hide();
        var id_value=$(this).data('id');
        var assigned_modules = $(this).parents().find('input[class="assign_module"]:checked');

        //get pk of modules
        assigned_modules.each(function () {
            modules.push($(this).val());
        });

        //get read write permissions
        assigned_modules.each(function () {
            var module_name = $(this).parent().find('.module_name').val();
            var read_write_permission = $(this).parents().find('input[name="' + module_name + '"]:checked').val();
            if(read_write_permission)
            {
                read_write.push(read_write_permission);
            }
        });

        //combined array
        new_admin_grp_data.push(modules, read_write);
        console.log('new_admin_grp_data', new_admin_grp_data)
        var groupname = $("#groupname").val();

        if (!groupname || groupname == "") {
            error = 1;
            $(".error_msg").show();
        }
        debugger;
        if ((parseInt(modules.length) != 0) && (parseInt(read_write.length)!=0)){
            if (modules.length != read_write.length) {
                error = 1;
                $(".error_msg").show();
            }
        }
        if ((parseInt(modules.length) == 0) || (parseInt(read_write.length)==0)) {
            error = 1;
            $(".error_msg").show();
        }
        if(error==0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'save_admin_group',
                async: false,
                data: {
                    new_admin_grp_data: new_admin_grp_data, groupname: groupname,id_value:id_value,
                },
                error: function (error) {
                },
                success: function (result) {
                    if(result==0)
                    {
                        $(".error_msg_grp_name").show();
                    }

                    if(result==1)
                    {
                        window.location.reload();
                    }
                },
            });
        }
    });
    
  
   $(document).on('click','#edit_admin_grp_id',function(){
        debugger;
        $(".error_msg").hide();
        $(".error_msg_grp_name").hide();
         
        $("#add_new_group_form")[0].reset();
        $("input:checkbox").removeAttr("checked");
        $("input:radio").removeAttr("checked");
        $(".error_msg").hide();
        $(".error_msg_grp_name").hide();
        $("#save_new_group").attr('data-id',0);
       var edit_grp_admin_id=$(this).data('id');
        $.ajax({
                        url: 'edit_grp_admin_id_check',
                        type: 'GET',
                        dataType: 'json',
                        data: {'edit_grp_admin_id': edit_grp_admin_id},
                        success: function (res) {
                            debugger;
                              $('#groupname').val(res[0].group_name);
                             $.each(res, function(key, value) {
                                 debugger;
                                $('.module_name[value ="' +value.module_name+'"]').attr("checked", true);
                                $('.assign_module[value ="' +value.pk_module_id+'"]').attr("checked", true);
                                
                                 if(value.permission=='read'){
                                   $('#permission_grp_module_read[name ="' +value.module_name+'"]').attr("checked", true);
                                }
                                else{
                                    $('#permission_grp_module_edit[name ="' +value.module_name+'"]').attr("checked", true);
                                }
                                   
                             });
                                $('#save_new_group').val(edit_grp_admin_id);
                                $('#save_new_group').attr('data-id', edit_grp_admin_id);
                                $('#save_new_group').text('Update');
                            
                        },
                        error:{
                            
                        }
        });
    });
});
    
</script>
@stop
