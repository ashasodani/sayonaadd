<!--/Script By Asha-->
<!--/Style for model to support api start-->
<style>
  .pac-container {
    z-index: 10000 !important;
}
</style>
<!--/Style for model to support api end-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<!--/ City state country for admin users start-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo9dMIPnjrc_1cg-qssupeOYiPtPQQlDI&libraries=places&callback=initAutocomplete_as" async defer></script>
<script type="text/javascript">
    function initAutocomplete_as() {
        debugger;
        autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById('admin_city')),
                //{types: ['(cities)'], componentRestrictions: {country: 'in'}}
                );
        autocomplete.addListener('place_changed', fillInAddress_as);
    }
    function fillInAddress_as() {
        debugger;
        var place = autocomplete.getPlace();
        // sync();
        // console.log("place",place)
        sync_as();
        city_as();
    }
    function sync_as()
    {
        debugger;
        var city = document.getElementById('admin_city').value;
        var state = city.split(',');
        state = state.reverse();
        var country = state[0];
        var state1 = state[1];
        document.getElementById('admin_state').value = state1;
        document.getElementById('admin_country').value = country;
    }
    function city_as()
    {
        debugger;
        var c = document.getElementById('admin_city').value;
        // console.log("city",c)
        var count = (c.match(/,/g) || []).length;
        if (count == 1)
        {
            var user_city = c.slice(0, c.lastIndexOf(","));
        }
        else
        {
            var Chunk = c.slice(0, c.lastIndexOf(","));
            var user_city = Chunk.slice(0, Chunk.lastIndexOf(","));
        }
        document.getElementById('admin_city').value = user_city;
    }

</script>
<!--/ City state country for admin users end-->



<script type="text/javascript">
$(document).ready(function(){
    debugger;
    var ajaxurl=$("#route_name").val();
     var group_ids=$('#group_ids').val();
    if(ajaxurl=='AdminUserGrpDetail'){
      //Detilal grp page jquery start
       $.ajax({
            type: 'GET',
            url: '../partialadmin_user_group_detail',
            data:{group_id:group_ids},
            error: function (error) {
                debugger;
                console.log(error);
            },
            success: function (result) {
                 $("#DetailAdminUsergrppartial").html(result.html);
              
            },
        });
        //Page link start
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url,function(data){
                jQuery.ajaxSetup({async:false});
                $('#DetailAdminUsergrppartial').html(data.html);
            });
        });
         //Page link end
         //admin detail pagination number start
          $(document).on('change','#admin_paginattion_number_detail',function(){
        debugger;
         var group_ids=$('#group_ids').val();
         var page_length_detail_page=$("#admin_paginattion_number_detail").val();
                debugger;
         $.ajax({
                type: 'GET',
                url: '../partialadmin_user_group_detail',
                data:{page_length_detail_page:page_length_detail_page,group_id:group_ids},
                async: false,
                error: function (error) {
                },
                success: function (result) {
                    $("#DetailAdminUsergrppartial").html(result.html);
                },
            });

      });
          //admin detail pagination number start
      
        //Detilal grp page jquery end
    }
    else{
        //All user admin start jquery
         var group_ids=$('#group_ids').val();
           $.ajax({
            type: 'GET',
            url: 'partial_all_admin_user',
            async: false,
            error: function (error) {
            },
            success: function (result) {
                $("#PartialAdminGroup").html(result.html);
            },
        });
        
        //pagination scriptstart
        $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url,function(data){
            jQuery.ajaxSetup({async:false});
            $('#PartialAdminGroup').html(data.html);
        });
       });
      //pagination script end
      
      //pagination number start
       $(document).on('change', '#admin_paginattion_number', function () {
           debugger;
           var page_length=$("#admin_paginattion_number").val();
           $.ajax({
               url:'partial_all_admin_user',
               type:'GET',
               data:{page_length_value:page_length},
               success:function(data){
                    $('#PartialAdminGroup').html(data.html);
                     if ($.trim($('#user_admin_data').html()) == '')
                    {
                        $('.data_not_show').html('No records found').css({'color': '#e42626', 'display': 'inline-block', 'width': '100%', 'text-align': 'center', 'font-family': 'calibri', 'font-size': '15px'});
                       
                    }
               },
               
           });
           
        });
        //pagination number end
        //All user admin start jquery
        }
     
       $(document).on('click','#edit_admin_grp_data',function(){
           debugger;
            $("#add_new_group_form_detail")[0].reset();
            $("input:checkbox").removeAttr("checked");
            $("input:radio").removeAttr("checked");
             var group_id_edit=$('#group_ids').val();
              $.ajax({
                        url: '../edit_grp_admin_id_check_detail',
                        type: 'GET',
                        dataType: 'json',
                        data: {'group_id_edit': group_id_edit},
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
                                $('#updategroup').val(group_id_edit);
                                $('#updategroup').attr('data-id', group_id_edit);
                                $('#updategroup').text('Update');
                            
                        },
                        error:{
                            
                        }
            });
       });
        $(document).on('click','#updategroup',function(){
            debugger;
             var new_admin_grp_data = [];
                var modules = [];
                var read_write = [];
                $(".error_msg").hide();
                $(".error_msg_grp_name").hide();
                var id_value_det=$(this).data('id');
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
                 $.ajax({
                    type: 'get',
                    url: '../update_admin_grp_detail_page',
                    async: false,
                    data: {
                        new_admin_grp_data: new_admin_grp_data, groupname: groupname,id_value_det:id_value_det,
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
        });
        
    
    
      
     //success message time set   
    $(".admin_sucess_message").delay(3000).fadeOut('slow'); 
    
    //Admin add button start
    $(".Add_new_admin").on('click',function(){
        $('#add_admin')[0].reset();
        $('#save_admin_user').val(0);
        $('#errmsg').empty();
        $('.error').remove();
          //$('.ms-options li[data-search-term = "' + group_name + '"]').removeClass('selected');
        if($('.ms-options li').hasClass('selected')){
           $('.ms-options li').removeClass('selected');
           $('#ms-list-1 span').text('Select Admin Group');
        }
         
         
    });
    //Admin add button end
    
    //Date picker script
    $('#m_datepicker_2_admin').datepicker({ dateFormat: "yy-mm-dd" });
    
    //Set age via Date start
    $(document).on('change','#m_datepicker_2_admin',function(e){
    var admin_dob = $('#m_datepicker_2_admin').val();
        if(admin_dob != '')
        {
            admin_dob = new Date(admin_dob);
            var today = new Date();
            var admin_age = Math.floor((today-admin_dob) / (365.25 * 24 * 60 * 60 * 1000));
            if(admin_age<0){
                admin_age=0;
            }
            $('#age').val(admin_age);
           // $('#ct_birth').text(ct_age);
        }
    });
     //Set age via Date end
     
     //Multiselect start
    $('#select_admin_grp').multiselect({
        columns: 1,
        placeholder: 'Select Admin Group',
        search: true
    });
     //Multiselect end
    
    //saveadmin__updateadmin start
    $("#save_admin_user").on('click',function(e){
        debugger;
         e.preventDefault();
        $('#errmsg').empty();
        $('.error').remove();
         var admin_name=$('#admin_name').val().trim(),
             contact_number=$("#contact_number").val().trim(),
             admin_grp=$("#select_admin_grp").val(),
             address=$("#address").val().trim(),
             city=$("#admin_city").val(),
             state=$("#admin_state").val(),
             country=$("#admin_country").val(),
             dob=$("#m_datepicker_2_admin").val(),
             gender_s=$("#gender_s").val(),
             age=$("#age").val();
         var error=false;
         if(admin_name==''){
               error = true;
                 $('#admin_name').after('<span class="error" style="color:red">Please Enter Admin Name</span>');
         }
         if(contact_number==''){
              error = true;
              $('#contact_number').after('<span class="error" style="color:red">Please Enter contact_number</span>');
         }
          if(admin_grp==''){
              error = true;
              $('#select_admin_grp').after('<span class="error" style="color:red">Please select admin group</span>');
         }
          if(address==''){
              error = true;
              $('#address').after('<span class="error" style="color:red">Please Fill Address</span>');
         }
          if(city==''){
              error = true;
              $('#admin_city').after('<span class="error" style="color:red">Please Enter city</span>');
         }
          if(state==''){
              error = true;
              $('#admin_state').after('<span class="error" style="color:red">Please Enter state</span>');
         }
         if(country==''){
              error = true;
              $('#admin_country').after('<span class="error" style="color:red">Please Enter country</span>');
         }
         if(dob==''){
             error = true;
             $('#m_datepicker_2_admin').after('<span class="error" style="color:red">Please Enter date of birth</span>');
         }
         if ($('input[name=gender]').is(':checked')){}
         else{
              debugger;
             error = true;
             $('#gender_vali').after('<span class="error" style="color:red">Please Select Gender</span>');
         }
         if (error == true){
                $('#save_admin_user').attr('disabled', false);
                 e.preventDefault();
                  return false;
         }
         else {
               var form_d = document.getElementById("add_admin");
               var formdatas = new FormData(form_d);
               var token = $('input[name="_token"]').val();
               var edit_id = $('#save_admin_user').data('id');
               
               formdatas.append('tokens',token);
               formdatas.append('edit_id',edit_id);
               
               var pass_url="";
                if(ajaxurl=='AdminUserGrpDetail'){
                    pass_url='../allusersave'
                }
                else{
                    pass_url='allusersave';
                }
                 $.ajax({
                        type: 'post',
                        url:pass_url,
                        dataType: 'json',
                        data: formdatas,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                               location.reload();
                        },
                        error: function () {
                            alert("Something went wrong");
                        }
           
                 });
         }
         
    });
    //Save update admin end 
    
    //Editrecord start
    $(document).on('click', '#edit_all_user_admin', function () {
        debugger;
        $('#errmsg').empty();
        $('.error').remove();
        $("#editwhileview").remove();
        $("#closemodal").remove();
        $('#ms-list-1 span').text('Select Admin Group');
        $('.ms-options li').removeClass('selected');
        $('#add_admin')[0].reset();
                var edit_id = $(this).data('id');
                var edit_id_1=$("#edit_all_user_admin").attr('data-id');
                var  pass_url_edit="";
                 if(ajaxurl=='AdminUserGrpDetail'){
                    pass_url_edit='../edit_admin_user_data'
                }
                else{
                    pass_url_edit='edit_admin_user_data';
                }
              
                    $.ajax({
                        url: pass_url_edit,
                        type: 'GET',
                        dataType: 'json',
                        data: {'edit_id': edit_id},
                        success: function (res) {
                             debugger;
                            if(res!=''){
                                $("#admin_name").val(res.admin_name);
                                $("#contact_number").val(res.contact_number);
                                $("#address").val(res.address);
                                $("#admin_city").val(res.city);
                                $("#admin_state").val(res.state);
                                $("#m_datepicker_2_admin").val(res.dob);
                                $("#admin_country").val(res.country);
                                $("#age").val(res.age);
                                $("#gender_s").val(res.gender);
                                $('#save_admin_user').val(edit_id);
                                $('#save_admin_user').attr('data-id', edit_id);
                                $('#save_admin_user').text('Update');
                                var genderval=res.gender;
                               
                                $('input:radio[name="gender"][value="' + genderval + '"]').attr('checked', true);
                                //multiple group name start
                                debugger;
                                var formultigrp_id = "";
                                var group_name_s = ""
                                if (res.fk_admin_grp_name_id != null && res.fk_admin_grp_name_id != 0) {
                                    if (res.fk_admin_grp_name_id.indexOf(",") >= 0) {
                                        var ids = res.fk_admin_grp_name_id.split(',');
                                        var grp_names = res.admin_grp_name.split(',');
                                        var grp_name_lower = $.map(grp_names,
                                                function(grp_names, index) {
                                                    return grp_names.toLowerCase();
                                                });

                                        debugger;
                                        $('#select_admin_grp').val(ids);
                                        $('#ms-list-1 span').text(res.admin_grp_name);
//                                         $.each(grp_name_lower, function(key, value) {
//                                            debugger;
//                                            group_name_s=value;
//                                                $('.ms-options li[data-search-term ="' +group_name_s +'"]').addClass('selected');
//                                        });
                                        $.each(ids, function(key, value) {
                                            debugger;
                                            formultigrp_id = value;

                                            $('.ms-options li input[value =' + formultigrp_id + ']').attr("checked", true);
                                            $('#select_admin_grp option[value =' + formultigrp_id + ']').prop("selected", true);

                                        });
                                    }
                                    else
                                    {
                                        $('.ms-options li input[value = "' + formultigrp_id + '"]').attr("checked", false);
                                        var group_name = res.admin_grp_name.toLowerCase();
                                        $('#ms-list-1 span').text(group_name);
                                        $('#select_admin_grp').val(res.fk_admin_grp_name_id);
                                        formultigrp_id = res.fk_admin_grp_name_id;
                                        $('.ms-options li input[value = ' + formultigrp_id + ']').attr("checked", true);
                                    }
                                }
                                //Multiplae group end
                                $("#editwhileview").trigger("click");
                                if ($('#save_admin_user').length == 0) {
                                      $('#save_admin_user').css('display','block');
                                }
                                if ($('#cancel_admin_modal').length == 0) {
                                      $('#cancel_admin_modal').css('display','block');
                                }
                            }
                        },
                        error: function () {
                                alert("Something went wrong");
                        }
                    });
    });
    $(document).on('click','#cancel_admin_modal',function(){
          debugger;
            $('#save_admin_user').text("Save");
            $('#save_admin_user').val(0);
            $('#save_admin_user').attr('data-id', 0);
            $('#add_admin')[0].reset();
            
    });
      
      
    //Admin Delete start
     //Get id user delete model
         $(document).on('click','#delete_all_user_admins',function(){
            debugger;
            var cleardeleteid=$("#delete_task_id").attr('data-id',0);
            var deleteuserid_a=$(this).data('id');
            var setdeleteid=$("#delete_grp_detail_id").attr('data-id',deleteuserid_a);
        });
    $(document).on('click','#delete_grp_detail_id',function(){
            debugger;
           
              var delete_user_ids=$(this).attr("data-id")
          
           var pass_url_delete="";
            if(ajaxurl=='AdminUserGrpDetail'){
                    pass_url_delete='../delete_admin_user_data'
                }
                else{
                    pass_url_delete='delete_admin_user_data';
                }
           
                $.ajax({
                    url: pass_url_delete,
                    type: 'GET',
                    dataType: 'json',
                    data: {'delete_id': delete_user_ids},
                    success: function(res) {
                        if (res == 1) {
                            location.reload();
                        }
                    },
                    error: {
                    }
                });
          
     });
    //Admin Delete end
    //Adminviewrecord start
     $(document).on('click', '#view_all_user', function () {
        debugger;
        $('#errmsg').empty();
        $('.error').remove();
        $('#add_admin')[0].reset();
        $('#ms-list-1 span').text('Select Admin Group');
        $('.ms-options li').removeClass('selected');
        var view_id = $(this).data('id');
        var idsss=$("#view_all_user").attr('data-id');
        //remove
        $.ajax({
            url: 'view_admin_user_data',
            type: 'GET',
            dataType: 'json',
            data: {'view_id': view_id},
            success: function(res) {
                debugger;
                if (res != '') {
                    $("#admin_name").val(res.admin_name);
                    $("#contact_number").val(res.contact_number);
                    $("#address").val(res.address);
                    $("#admin_city").val(res.city);
                    $("#admin_state").val(res.state);
                    $("#m_datepicker_2_admin").val(res.dob);
                    $("#admin_country").val(res.country);
                    $("#age").val(res.age);
                    $("#gender_s").val(res.gender);
                    $('#save_admin_user').val(view_id);
                    $('#save_admin_user').attr('data-id', view_id);
                    $('#save_admin_user').text('Update');
                    var genderval = res.gender;

                    $('input:radio[name="gender"][value="' + genderval + '"]').attr('checked', true);
                    //multipl group name
                    debugger;
                    var formultigrp_id = "";
                    var group_name_s = ""
                    if (res.fk_admin_grp_name_id != null && res.fk_admin_grp_name_id != 0) {
                        if (res.fk_admin_grp_name_id.indexOf(",") >= 0) {
                            var ids = res.fk_admin_grp_name_id.split(',');
                            var grp_names = res.admin_grp_name.split(',');
                            var grp_name_lower = $.map(grp_names,
                                    function(grp_names, index) {
                                        return grp_names.toLowerCase();
                                    });
                            debugger;
                            //$('#select_admin_grp').val(ids);
                            $('#select_admin_grp').val(ids);
                            $('#ms-list-1 span').text(grp_names);
                            //$('.ms-options li').removeClass('selected');

                            $.each(ids, function(key, value) {
                                debugger;
                                formultigrp_id = value;

                                $('.ms-options li input[value =' + formultigrp_id + ']').prop("checked", true);
                                $('#select_admin_grp option[value =' + formultigrp_id + ']').prop("selected", true);

                            });
                        }
                        else
                        {
                            debugger;
                            $('.ms-options li[data-search-term = "' + group_name + '"]').removeClass('selected');
                            $('.ms-options li input[value = "' + formultigrp_id + '"]').prop("checked", false);
                            var group_name = res.admin_grp_name.toLowerCase();
                            $('#ms-list-1 span').text(group_name);
                            //str.toLowerCase()
                            $('#select_admin_grp').val(res.fk_admin_grp_name_id);
                            formultigrp_id = res.fk_admin_grp_name_id;

                            $('.ms-options li input[value = ' + formultigrp_id + ']').prop("checked", true);

                        }
                    }

                    $("#admin_name").prop('disabled', true);
                    $("#contact_number").prop('disabled', true);
                    $("#select_admin_grp").multiselect("disable");
                    $("#address").prop('disabled', true);
                    $("#admin_city").prop('disabled', true);
                    $("#admin_state").prop('disabled', true);
                    $("#admin_country").prop('disabled', true);
                    $("#m_datepicker_2_admin").prop('disabled', true);
                    $("#age").prop('disabled', true);
                    $("#gender_s").prop('disabled', true);

                    $("#cancel_admin_modal").css('display', 'none');
                    if ($('#editwhileview').length == 0) {
                        $(".modal-footer").append("<button type='button' id='editwhileview' class='btn btn-primary'>Edit</button>")
                    }
                    $("#save_admin_user").css('display', 'none');
                    if ($('#closemodal').length == 0) {
                        $(".modal-footer").append("<button type='button' id='closemodal' class='btn btn-secondary' data-dismiss='modal' aria-label='Close'>Close</button>")
                    }
                }

            },
            error: function() {
                alert("Something went wrong");
            }
        });
    });
    //Admin view record end
    
    //Admineditwhileview start
       $(document).on('click', '#editwhileview', function () {
        debugger;
        $("#admin_name").prop('disabled', false);
        $("#contact_number").prop('disabled', false);
        $('#select_admin_grp').removeAttr('disabled');
        $(".dropdown button").prop('disabled', false);
        $('#select_admin_grp').multiselect();
        $("#address").prop('disabled', false);
        $("#admin_city").prop('disabled', false);
        $("#admin_state").prop('disabled', false);
        $("#admin_country").prop('disabled', false);
        $("#m_datepicker_2_admin").prop('disabled', false);
        $("#age").prop('disabled', false);
        $("#gender_s").prop('disabled', false);
        $("#save_admin_user").css('display', 'block');
        $("#cancel_admin_modal").css('display', 'block');
        $("#editwhileview").remove();
        $("#closemodal").remove();
    });
    //Admineditwhileview end
    //Adminclosemodel start
    $(document).on('click', '#closemodal', function () {
        $('#save_admin_user').text("Save");
        $('#save_admin_user').val(0);
        $('#save_admin_user').attr('data-id', 0);

    });
    //Contact validation start
    $('#contact_number').keypress(function(e) {
                var a = [];
                var k = e.which;
                for (i = 48; i < 58; i++)
                    a.push(i);

                if (!(a.indexOf(k)>=0))
                    e.preventDefault();
    });
    //Contact validation end



     
}); 
</script>
