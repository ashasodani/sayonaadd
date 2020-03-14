@extends('layouts.layout')
@section('title')
    Task Service Management
@endsection
@section('main')


    <div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader breadcrumb_sad">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">
                            Task
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
                                                Service Managements
                                            </span>
                                </a>
                            </li>
                            <li class="m-nav__separator">
                                <img src="images/dot_img.png" alt="">
                            </li>
                            <li class="m-nav__item">
                                <a href="" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                Task
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content page_contant service_pages s_task">
                <!--Begin::Section-->
                <!--/Success message start-->
                @if(session()->has('task_name_success'))
                    <div class="alert alert-success alert" id="task_success_message">
                        {{ session()->get('task_name_success') }}
                    </div>
                @endif
                 <!--/Success message end-->
                <div class="row">
                    <div class="col-xl-12">
                        <!--begin:: Widgets/Best Sellers-->
                        <div class="m-portlet m-portlet--full-height">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Task List
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
                                                        <input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search..." id="search_task_name" onkeyup="search_task(event)">
                                                    </span>
                                        </div>
                                        <div class="add_new_CT_btn">
                                            <!--                                                    <a href="javascript:void(0);" class="new_Ct_btn" data-modal="">Add New Task</a>-->
                                            <a href="#" class="change_status_btn new_Ct_btn" data-toggle="modal" data-target="#modal_target_11" id="add_new_task_service">Add New Task</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="PartialTask"></div>

                        <!--end::Widget 11-->
                    </div>
                </div>
                <!--end:: Widgets/Best Sellers-->
            </div>
        </div>
        <!--End::Section-->
    </div>
@stop

<!--    Add New Service TaskPopup Starts  -->
<div class="modal fade dashboard_modal" id="modal_target_11" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Add New Task
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                ×
                            </span>
                </button>
            </div>
            <div class="modal-body">
                <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                <form  enctype="multipart/form-data" id="task_services">
                    <meta name="csrf-token1" content="{{ csrf_token() }}">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-6" >
                            <label class="col-form-label">
                                Service Group *
                            </label>
                            {{--<div class="bootstrap-select form-control m-bootstrap-select m_">--}}
                                <select class="form-control" tabindex="-98" id="service_grp">
                                    <option selected disabled>
                                        Select Group
                                    </option>
                                    @foreach($service_groups as $service_group)
                                        <option value="{{$service_group->pk_service_group_id}}">{{$service_group->service_grp_name}}</option>
                                    @endforeach
                                </select>
                            {{--</div>--}}
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Service Name *
                            </label>
                            <select class="form-control" tabindex="-98" id="servicename" disabled="disabled">
                                <option selected disabled>
                                    Select Service
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-6">
                            <label class="col-form-label">
                                Task Name *
                            </label>
                            <input type="text" class="form-control m-input" id="taskname" aria-describedby="TaskName" placeholder="Task Name">

                        </div>
                    </div>
                    <div class="form-group m-form__group row add_new_task_service">
                        <div class="col-sm-12">
                            <label class="col-form-label">
                                Task Description *
                            </label>
                            <textarea class="form-control m-input" id="task_desp" rows="4" placeholder="Enter Task Description"></textarea>
                        </div>
                    </div>
                    <span style="color: red;display: none" class="error_msg">Enter Required Fields</span>
                    <span class="error__task_msg" style="display: none;color:red;"></span>
                </form>
                <!--end::Form-->
                <!--</div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add_new_task">
                    Save
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<!--    Add New Service Task Popup Ends  -->
<!--/Delete Model Start-->
 <div class="modal fade dashboard_modal" id="modal_target_53" tabindex="-1" role="dialog"
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
                            <h6 class="inactive-modal-title-btm">Do you really want to Delete This Task?</h6>
                        </div>
                    </div>
                    <!--end::Form-->
                    <!--</div>-->
                </div>
                <div class="modal-footer inactive_user_btn_center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary d_cm_delete" id="delete_task_id">
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
            url: 'partial_task',
            async: false,
            error: function (error) {
            },
            success: function (result) {
                $("#PartialTask").html(result.html);
            },
        });
        
          //Pagination task start
           $(document).on('change', '#pagination_task', function (e) {
       
               debugger;
                var item=$(this).val();
                var search_task=document.getElementById("search_task_name").value;
                  $.ajax({
                type: 'GET',
                url: 'partial_task',
                data:{items:item,search_task:search_task},
                async: false,
                error: function (error) {
                },
                success: function (result) {
                    $("#PartialTask").html(result.html);
                },
            });
             
         });
         //Pagination end

         //pagelink task start
          $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.get(url,function(data){
                    jQuery.ajaxSetup({async:false});
                    $('#PartialTask').html(data.html);
                });
        });
        //pagelink task end
        // Add task button start
        $(document).on('click', '#add_new_task_service', function (e) {
            $("#task_services")[0].reset();
            $('#add_new_task').val(0);
            $('#add_new_task').attr('data-id',0);
            $(".error_msg").hide();
            $('#errmsg').empty();
            $('.error').remove();
            $(".error__task_msg").text("");
            $(".error__task_msg").hide();
            $('#add_new_task').text('Save');
        });
        // Add task button start
        
        //Task success meassge
         $("#task_success_message").delay(3000).fadeOut('slow'); 
       
       //Edit get data task services start
        $(document).on('click', '#edit_task_a', function (e) {
        debugger;
           var edit_task_id=$(this).data('id');
            $.ajax({
                        url: 'edit_task_data',
                        type: 'GET',
                        dataType: 'json',
                        data: {'edit_task_id': edit_task_id},
                         success: function (res) {
                            debugger; 
                            if(res!=''){
                                $(".error_msg").hide();
                                $(".error__task_msg").text("");
                                $(".error__task_msg").hide();
                                $("#taskname").val(res.task_name);
                                $("#servicename").val(res.fk_services_id);
                                $("#task_desp").val(res.task_description);
                                $("#service_grp").val(res.service_grp_name); 
                                $('#service_grp option[value =' + res.pk_service_group_id + ']').prop("selected", true);  
                                $('#servicename').removeAttr("disabled");
                                enable_service($('#service_grp').val());
                                $('#servicename option[value =' + res.pk_services_id + ']').prop("selected", true);
                                $('#add_new_task').val(edit_task_id);
                                $('#add_new_task').attr('data-id', edit_task_id);
                                $('#add_new_task').text('Update');
                                //$('.filter-option-inner').text(res.service_grp_name);
                            }
                         },
                         error: function (error) {
                         }
                     });
           
        });
        //Edit get data task services end
        //Enable service based on service group start
        function enable_service(service_grp)
        {
            $("#servicename").empty();
            $.ajax({
                type: 'GET',
                url: 'get_services/'+service_grp,
                async: false,
                error: function (error) {
                },
                success: function (services) {
                    debugger;
                    $("#servicename").removeAttr("disabled");
                    $("#servicename").parents().removeAttr("disabled");
                    $("#servicename").append("<option selected disabled>Select Services</option>");
                    for(var i=0;i<services.length;i++)
                    {
                        $("#servicename").append("<option value="+services[i].pk_services_id+">"+services[i].service_name+"</option>");
                    }

                },
            });
        }
        //Enable service based on service group end
        
        //Add new task services start
        $("#add_new_task").on('click',function (e) {
            debugger;
            e.preventDefault();
            var error=0;
            $(".error_msg").hide();
            $(".error__task_msg").text("");
            $(".error__task_msg").hide();
            $('#errmsg').empty();
            $('.error').remove();
            var taskname=$("#taskname").val();
            var servicename =$("#servicename").val();
            var task_desp=$("#task_desp").val();
            var service_grp=$("#service_grp").val();
            var update_task_id="";
            if(taskname=="")
            {
                error=1;
                $('#taskname').after('<span class="error" style="color:red">Please Enter Task Name</span>');
            }
            if(task_desp==""){
                 error=1;
                 $('#task_desp').after('<span class="error" style="color:red">Please Enter Task Description</span>');
            }
            
            if(service_grp=="" || !service_grp)
            {
                error=1;
                //$(".error_msg").show();
                $('#service_grp').after('<span class="error" style="color:red">Please Select Service Group</span>');
            }

            if(!servicename || servicename=="")
            {
                error=1;
                //$(".error_msg").show();
                 $('#servicename').after('<span class="error" style="color:red">Please Select Service Name</span>');
            }

            if(error==0)
            {
                update_task_id = $('#add_new_task').data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'add_new_task',
                    async: false,
                    data: {
                        service_grp:service_grp,servicename:servicename,task_desp:task_desp,taskname:taskname,update_task_id:update_task_id
                    },
                    error: function (error) {
                    },
                    success: function (result) {
                        debugger;
                        if(result==0)
                        {
                            var service_grp=$("#service_grp option:selected").text()
                            var service=$("#servicename option:selected").text();
                            console.log(service_grp,service);
                            $(".error__task_msg").text("");
                            $(".error__task_msg").show();
                            $(".error__task_msg").text(service_grp+" -> "+service+" already has this task.");
                        }

                        if(result==1)
                        {
                            window.location.reload();
                        }
                    },
                });
            }
        });
        //Add new task services start
        
        //Text area length start
        $('#task_desp').keyup(function(){
            debugger;
            var maxlength = 500,
                text = $(this).val(),
                eol = text.match(/(\r\n|\n|\r)/g),
                count_eol = $.isArray(eol) ? eol.length : 0,//error if eol is null
                count_chars = text.length - count_eol;
            if (maxlength && count_chars > maxlength)
              $(this).val(text.substring(0, maxlength + count_eol));
          });
        //Text area length end
        //Get id task delete model
         $(document).on('click','#delete_task_model',function(){
            debugger;
            var cleardeleteid=$("#delete_task_id").attr('data-id',0);
            var deletetaskid=$(this).data('id');
            var setdeleteid=$("#delete_task_id").attr('data-id',deletetaskid);
        });
        
        //Delete_task_model
        //
        //Task Delete start
         $(document).on('click','#delete_task_id',function(){
            debugger;
            var delete_task_id=$(this).attr("data-id")
            
                $.ajax({
                    url: 'services_delete',
                    type: 'GET',
                    dataType: 'json',
                    data: {'delete_id': delete_task_id},
                    success: function(res) {
                        if (res == 1) {
                            location.reload();
                        }
                    },
                    error: {
                    }
                });
           
        });
      
        //Task Delete End
        
      

        //Service name based on service group start
        $("#service_grp").on('change',function () {
            debugger;
           if($(this).val())
           {
               enable_service($(this).val());
           }
        });
        //Service name based on service group end
    });
    
      //Search Task start
        function search_task(event)
        {
            debugger;
            event.preventDefault();
            if(event.code=="Enter")
            {
                var search_task=$("#search_task_name").val();
                $.ajax({
                    type: 'GET',
                    url: 'partial_task',
                    data:{search_task:search_task},
                    async: false,
                    error: function (error) {
                    },
                    success: function (result) {
                        $("#PartialTask").html(result.html);
                    },
                });
            }
        }
        //Search Task end
    
  
    

    

    
   
    
      

</script>

