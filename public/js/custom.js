$(document).on('click', '.ct_list .page-link', function (e) 
{
    debugger;
    e.preventDefault();
    var requestedpage = $(this).attr('href').split('?page=')[1];
    clientFilterPaginationAjax(requestedpage);
    return false;
});
function clientFilterPaginationAjax(requestedpage)
{
    debugger;
    var search = $('#ct_search').val();
    var sort_val = $('#grp_name').find(":selected").text();
    var PerPage = $('select[name="ClientPerPage"]').val();
    var page = 1;
    if (requestedpage)
    {
        page = requestedpage;
    }
    $.ajax({
        url: 'FilterPaginationAjaxclient',
        type: 'GET',
        dataType: 'json',
        data: {'page': page, 'search': search, 'sort_val': sort_val, 'PerPage': PerPage},
        success: function (data) {
            $('#PartialAllctGroup').html(data.html);
        },
        error: function () {
        }
    });
}
$("#frm").submit(function(e)
{
    e.preventDefault();
});
$("#grp_name,#ct_search").on('change', function (e) 
{
    debugger;
    e.preventDefault();clientFilterPaginationAjax();
    return false;
});

$(document).on('change','#m_datepicker_2',function(e)
{
  
    var ct_dob = $('#m_datepicker_2').val();
    if(ct_dob != '')
    {
        ct_dob = new Date(ct_dob);
        var today = new Date();
        var ct_age = Math.floor((today-ct_dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#ct_ages').val(ct_age);
        $('#ct_birth').text(ct_age);
    }
});
//add ct
$(document).on('click', '#ct_add', function (e) 
{
    debugger;
    e.preventDefault();
    var ct_name = $('#ct_name').val();
    var ct_contact_info = $('#ct_contact_info').val();
    var ct_email = $('#ct_email').val();
    var ct_dob = $('#m_datepicker_2').val();
    if(ct_dob != '')
    {
        ct_dob = new Date(ct_dob);
        var today = new Date();
        var ct_age = Math.floor((today-ct_dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#ct_ages').val(ct_age);
        $('#ct_birth').text(ct_age);
    }

    var ct_gender = $('#ct_gender').val();
    var ct_address = $('#ct_address').val();
    var ct_city = $('#ct_city').val();
    var ct_state = $('#ct_state').val();
    var ct_country = $('#ct_country').val();
    var ct_salary = $('#ct_salary').val();
    var chk_email = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var error = true;
    $('.error').remove();
    $('.error1').remove();
    $('.error2').remove();
    $('.error3').remove();
    var images = $('#police_checkup_file').val();
    if(images!='')
    {
        var file_length = $('#police_checkup_file')[0].files.length;
        var file_size = $('#police_checkup_file')[0].files[0].size;
        if (file_length > 5) {
            error = false;
            $('.police_att').after('<br><span class="error" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size > 100000) {
            error = false;
            $('.police_att').after('<br><span class="error" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
    }
    

    var images1 = $('#training_certi_file').val();
    if(images1!='')
    {
        var file_length1 = $('#training_certi_file')[0].files.length;
        var file_size1 = $('#training_certi_file')[0].files[0].size;
        if (file_length1 > 5) {
            error = false;
            $('.doc_att').after('<br><span class="error" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size1 > 100000) {
            error = false;
            $('.doc_att').after('<br><span class="error" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
    }
    var images2 = $('#other_doc_file').val();
    if(images2!='')
    {

        var file_length2 = $('#other_doc_file')[0].files.length;
        var file_size2 = $('#other_doc_file')[0].files[0].size;
        if (file_length2 > 5) {
            error = false;
            $('.other_att').after('<br><span class="error" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size2 > 100000) {
            error = false;
            $('.other_att').after('<br><span class="error" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
    } 
    
    if (ct_name == "") {
        error = false;
        $('#ct_name').after('<span class="error" style="color:red">Please enter name</span>')
    }
    if (ct_email == "")
    {
        error = false;
        $('#ct_email').after('<span class="error" style="color:red">Please enter email</span>')
    }
    else
    {
        if (!chk_email.test(ct_email))
        {
            error = false;
            $('#ct_email').after('<span class="error" style="color:red">Please enter valid email</span>')

        }
    }
    if (ct_contact_info == "") {
        $('#ct_contact_info').after('<span class="error" style="color:red">Please enter contact info</span>')

    }
    else
    {
        if ($('#ct_contact_info').val().length < 10)
        {
            error = false;
            $('#ct_contact_info').after('<span class="error" style="color:red">Please enter atleast 10 digit contact info</span>')

        }
    }
    if (ct_dob == "") {
        error = false;
        $('.date').after('<span class="error" style="color:red">Please enter dob</span>')
    }
    if (ct_gender == "") {
        error = false;
        $('#ct_gender').after('<span class="error" style="color:red">Please enter gender</span>')
    }
    if (ct_address == "") {
        error = false;
        $('#ct_address').after('<span class="error" style="color:red">Please enter address</span>')
    }
    if (ct_city == "") {
        error = false;
        $('#ct_city').after('<span class="error" style="color:red">Please enter city</span>')
    }
    if (ct_state == "") {
        error = false;
        $('#ct_state').after('<span class="error" style="color:red">Please enter state</span>')
    }
    if (ct_country == "") {
        error = false;
        $('#ct_country').after('<span class="error" style="color:red">Please enter country</span>')
    }
    if (ct_salary == "") {
        error = false;
        $('#ct_salary').after('<span class="error" style="color:red">Please enter salary</span>')
    }
    if (error == false) {
        e.preventDefault();
    }
    else {
        var form = new FormData(document.getElementById('add_ct'));
        form.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: 'save_ct',
            type: 'POST',
            data: form,
            dataType: 'json',
            contentType: false,
            processData: false,
            async:false,
            success: function (res)
            {debugger;
                
                // $('#ct_add').attr('disabled', false);
                if (res == 0)
                {
                    $('#ct_email').after('<span class="error" style="color:red">CT Email is already exists</span>');
                    return false;
                } else
                {
                    $('.ct_det_add').after('<div><span class="error" style="color:green">CT user inserted successfully</span></div>');
                    // window.location.reload();
                    window.location.href = "ct_management";
                }

            },
            error: function ()
            {
                alert('error');
            }
        });
    }
});
$(document).on('click', '#ct_edit', function (e) 
{
    debugger;
    e.preventDefault();
    var ct_name = $('#ct_name').val();
    var ct_contact_info = $('#ct_contact_info').val();
    var ct_email = $('#ct_email').val();
    var ct_dob = $('#m_datepicker_2').val();
    if(ct_dob != '')
    {
        ct_dob = new Date(ct_dob);
        var today = new Date();
        var ct_age = Math.floor((today-ct_dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#ct_ages').val(ct_age);
        $('#ct_birth').text(ct_age);
    }

    var ct_gender = $('#ct_gender').val();
    var ct_address = $('#ct_address').val();
    var ct_city = $('#ct_city').val();
    var ct_state = $('#ct_state').val();
    var ct_country = $('#ct_country').val();
    var ct_salary = $('#ct_salary').val();
    var chk_email = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var error = true;
    $('.error').remove();
    $('.error1').remove();
    $('.error2').remove();
    $('.error3').remove();
    var images = $('#police_checkup_file').val();
    if(images!='')
    {
        var file_length = $('#police_checkup_file')[0].files.length;
        var file_size = $('#police_checkup_file')[0].files[0].size;
        if (file_length > 5) {
            error = false;
            $('#police_att').after('<br><span class="error" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size > 100000) {
            error = false;
            $('#police_att').after('<br><span class="error" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
    }
    

    var images1 = $('#training_certi_file').val();
    if(images1!='')
    {
        var file_length1 = $('#training_certi_file')[0].files.length;
        var file_size1 = $('#training_certi_file')[0].files[0].size;
        if (file_length1 > 5) {
            error = false;
            $('#training_certi_file').after('<br><span class="error" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size1 > 100000) {
            error = false;
            $('#training_certi_file').after('<br><span class="error" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
    }
    var images2 = $('#other_doc_file').val();
    if(images2!='')
    {

        var file_length2 = $('#other_doc_file')[0].files.length;
        var file_size2 = $('#other_doc_file')[0].files[0].size;
        if (file_length2 > 5) {
            error = false;
            $('#other_doc_file').after('<br><span class="error" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size2 > 100000) {
            error = false;
            $('#other_doc_file').after('<br><span class="error" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
    } 
    
    if (ct_name == "") {
        error = false;
        $('#ct_name').after('<span class="error" style="color:red">Please enter name</span>')
    }
    if (ct_email == "")
    {
        error = false;
        $('#ct_email').after('<span class="error" style="color:red">Please enter email</span>')
    }
    else
    {
        if (!chk_email.test(ct_email))
        {
            error = false;
            $('#ct_email').after('<span class="error" style="color:red">Please enter valid email</span>')

        }
    }
    if (ct_contact_info == "") {
        $('#ct_contact_info').after('<span class="error" style="color:red">Please enter contact info</span>')

    }
    else
    {
        if ($('#ct_contact_info').val().length < 10)
        {
            error = false;
            $('#ct_contact_info').after('<span class="error" style="color:red">Please enter atleast 10 digit contact info</span>')

        }
    }
    if (ct_dob == "") {
        error = false;
        $('.date').after('<span class="error" style="color:red">Please enter dob</span>')
    }
    if (ct_gender == "") {
        error = false;
        $('#ct_gender').after('<span class="error" style="color:red">Please enter gender</span>')
    }
    if (ct_address == "") {
        error = false;
        $('#ct_address').after('<span class="error" style="color:red">Please enter address</span>')
    }
    if (ct_city == "") {
        error = false;
        $('#ct_city').after('<span class="error" style="color:red">Please enter city</span>')
    }
    if (ct_state == "") {
        error = false;
        $('#ct_state').after('<span class="error" style="color:red">Please enter state</span>')
    }
    if (ct_salary == "") {
        error = false;
        $('#ct_salary').after('<span class="error" style="color:red">Please enter salary</span>')
    }
    if (error == false) {
        e.preventDefault();
    }
    else {
        var form = new FormData(document.getElementById('edit_ct'));
        form.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: 'save_edited_ct',
            type: 'POST',
            data: form,
            dataType: 'json',
            contentType: false,
            processData: false,
            async:false,
            success: function (res)
            {debugger;
                
                // $('#ct_add').attr('disabled', false);
                if (res == 0)
                {
                    $('#ct_email').after('<span class="error" style="color:red">CT Email is already exists</span>');
                    return false;
                } else
                {
                    $('.ct_det_add').after('<div><span class="error" style="color:green">CT user inserted successfully</span></div>');
                    // window.location.reload();
                    window.location.href = "ct_management";
                }

            },
            error: function ()
            {
                alert('error');
            }
        });
    }
});
$(document).ready(function() {

    //DOM manipulation code
$('#fk_service_grp_ids').multiselect({
        columns: 1,
        placeholder: 'Select Admin Group',
        search: true
    });

//multipl group name
                    // debugger;
                    // var formultigrp_id = "";
                    // var group_name_s = ""
                    // if (res.fk_service_grp_ids != null && res.fk_service_grp_ids != 0) {
                    //     if (res.fk_service_grp_ids.indexOf(",") >= 0) {
                    //         var ids = res.fk_service_grp_ids.split(',');
                    //         var grp_names = res.admin_grp_name.split(',');
                    //         var grp_name_lower = $.map(grp_names,
                    //                 function(grp_names, index) {
                    //                     return grp_names.toLowerCase();
                    //                 });
                    //         debugger;
                    //         //$('#select_admin_grp').val(ids);
                    //         $('#select_admin_grp').val(ids);
                    //         $('#ms-list-1 span').text(grp_names);
                    //         //$('.ms-options li').removeClass('selected');
                    //         $.each(ids, function(key, value) {
                    //             debugger;
                    //             formultigrp_id = value;
                    //             $('.ms-options li input[value =' + formultigrp_id + ']').prop("checked", true);
                    //         });
                    //     }
                    //     else
                    //     {
                    //         debugger;
                    //         $('.ms-options li[data-search-term = "' + group_name + '"]').removeClass('selected');
                    //         $('.ms-options li input[value = "' + formultigrp_id + '"]').prop("checked", false);
                    //         var group_name = res.admin_grp_name.toLowerCase();
                    //         $('#ms-list-1 span').text(group_name);
                    //         //str.toLowerCase()
                    //         $('#select_admin_grp').val(res.fk_service_grp_ids);
                    //         formultigrp_id = res.fk_service_grp_ids;
                    //         //$('.select_tech li').removeClass('selected');
                    //         //$('.ms-options li[data-search-term = ' + group_name + ']').addClass('selected');
                    //         $('.ms-options li input[value = ' + formultigrp_id + ']').prop("checked", true);
                    //     }
                    // }
});
function initAutocomplete1() {
        debugger;

        autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById('ct_city')),
                //{types: ['(cities)'], componentRestrictions: {country: 'in'}}
                );

//alert(autocomplete);
        autocomplete.addListener('place_changed', fillInAddress1);



    }
    function fillInAddress1() {
        debugger;
        var place = autocomplete.getPlace();
        // sync();
        // console.log("place",place)
        sync();
        city1();


    }
    function sync()
    {
        debugger;
        var city = document.getElementById('ct_city').value;
        var state = city.split(',');
        state = state.reverse();
        var country = state[0];
        var state1 = state[1];
        document.getElementById('ct_state').value = state1;
        document.getElementById('ct_country').value = country;
    }
    function city1()
    {

        debugger;
        var c = document.getElementById('ct_city').value;
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
        document.getElementById('ct_city').value = user_city;


    }
    $(document).ready(function () {
  //called when key is pressed in textbox
  $("#ct_contact_info").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
$(document).ready(function () {
  //called when key is pressed in textbox
  $("#ct_salary").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
$('#police_checkup_file').on('change', function () {
        debugger;
        $('.error1').remove();
        $('.police_s').text("");
        var error = true;
        var images = $(this).val();
        var file_length = $('#police_checkup_file')[0].files.length;
        var file_size = $('#police_checkup_file')[0].files[0].size;
        var msg=file_length+ " file selected";
        $('.police_s').text(msg);
        if (file_length > 5) {
            error = false;
            $('.police_att').after('<br><span class="error1" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size > 100000) {
            error = false;
            $('.police_att').after('<br><span class="error1" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
});
$('#training_certi_file').on('change', function () {
        debugger;
        $('.error2').remove();
        $('.training_s').text("");
        var error2 = true;
        var images = $(this).val();
        var file_length = $('#training_certi_file')[0].files.length;
        var file_size = $('#training_certi_file')[0].files[0].size;
        var msg=file_length+ " file selected";
        $('.training_s').text(msg);
        if (file_length > 5) {
            error = false;
            $('.doc_att').after('<br><span class="error2" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size > 100000) {
            error = false;
            $('.doc_att').after('<br><span class="error2" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
});
$('#other_doc_file').on('change', function () {
        debugger;
        $('.error3').remove();
        $('.other_s').text("");
        var error3 = true;
        var images = $(this).val();
        var file_length = $('#other_doc_file')[0].files.length;
        var file_size = $('#other_doc_file')[0].files[0].size;
        var msg=file_length+ " file selected";
        $('.other_s').text(msg);
        if (file_length > 5) {
            error = false;
            $('.other_att').after('<br><span class="error3" style="color:red">You can select only 5 files</span>');
            // return false;
        }
        else if (file_size > 100000) {
            error = false;
            $('.other_att').after('<br><span class="error3" style="color:red">Maximum upload file size is 1 MB.</span>');
            // return false;
        }
});

$('.police_id_del').on('click',function(){
    debugger;
    var id = $(this).attr('cer_id');
    $.ajax({
            url: 'cerdelete',
            type: 'GET',
            data: {
                'id': id
            },
            success: function (res) {
                debugger;
                // $(".table_row[data_id='" + data_id + "']").remove();
            },
            error: function () {
                alert("Something went wrong");
            }
        });
})


$(document).on('click', '.clientlist .page-link', function (e) 
{
    debugger;
    e.preventDefault();
    var requestedpage = $(this).attr('href').split('?page=')[1];
    allallocatedclientFilterPaginationAjax(requestedpage);
    return false;
});
$(document).on('click', '.clientvisted .page-link', function (e) 
{
    debugger;
    e.preventDefault();
    var requestedpage = $(this).attr('href').split('?page=')[1];
    allvisitedclientFilterPaginationAjax(requestedpage);
    return false;
});
function allallocatedclientFilterPaginationAjax(requestedpage)
{
    debugger;
    var id = $('#id').val()
    // var search = $('#ct_search').val();
    // var sort_val = $('#grp_name').find(":selected").text();
    // var PerPage = $('select[name="allocated_clients"]').val();
    var PerPage =1;
    var page = 1;
    if (requestedpage)
    {
        page = requestedpage;
    }
    $.ajax({
        url: 'FilterPaginationAjaxclientlist',
        type: 'GET',
        dataType: 'json',
        data: {'page': page,'PerPage': PerPage,'id':id},
        success: function (data) {
            $('#PartialAllctGroup').html(data.html);
        },
        error: function () {
        }
    });
}

function allvisitedclientFilterPaginationAjax(requestedpage)
{
    debugger;
    var id = $('#id').val()
    // var search = $('#ct_search').val();
    // var sort_val = $('#grp_name').find(":selected").text();
    // var PerPage = $('select[name="allocated_clients"]').val();
    var PerPage =1;
    var page = 1;
    if (requestedpage)
    {
        page = requestedpage;
    }
    $.ajax({
        url: 'FilterPaginationAjaxvisitclientlist',
        type: 'GET',
        dataType: 'json',
        data: {'page': page,'PerPage': PerPage,'id':id},
        success: function (data) {
            $('#PartialAllctGroup1').html(data.html);
        },
        error: function () {
        }
    });
}

    $("#m_login_signin_submit").on('click',function(e){

                    debugger;
                    
                    //e.preventDefault();
                    var email = $("#email").val();
                    var password = $("#password").val();
                    var token = $('input[name="_token"]').val();
                    var error=false;
                    if(email=='')  
                    {
                    error = true;
                    $('#email').after('<span class="error" style="color:red">Please Enter Email</span>');
                    }
                    if(password=='')  
                    {
                    error = true;
                    $('#password').after('<span class="error" style="color:red">Please Enter Password</span>');
                    }
                    else
                    {
                       $.ajaxSetup({
                       headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                       $.ajax({
                        url: 'postlogin',
                        type: 'POST',
                        /*headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },*/
                        dataType: 'JSON',
                        data: {
                            'email': email,
                            'password' : password,                            
                        },
                        success: function (res) {
                             debugger;                             
                            
                        },
                        error:function(){
                            //alert("Error");
                        }
                    }); 
                    }
            
});
$('.allocatedvisit').click(function(){
    debugger;
    $('.client').hide();
    $('.visit').show();
});
$('.allocatedclient').click(function(){
    debugger;
    $('.client').show();
    $('.visit').hide();
});

// $("ul.tabs li").click(function () {
//   $(".tab_content").hide();
//   var activeTab = $(this).attr("rel");
//   $("#" + activeTab).fadeIn();
//   $("ul.tabs li").removeClass("active");
//   $(this).addClass("active");
//   $(".tab_drawer_heading").removeClass("d_active");
//   $(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
// });

// $('.bc1').click(function(){
// debugger;
// });

 $("#m_datepicker_2").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange : 'c-65:c+10',
            endDate: "+0d",
      autoclose: true,
      startDate: '-50y'
//      yearRange: '2000:'+(new Date).getFullYear()         
    });
//$('#m_datepicker_2').datepicker({changeMonth: true, changeYear: true, yearRange: '1950:2010'});

$('.police_att').click(function()
{
    $('.upd_police').trigger('click');
});
$('.doc_att').click(function()
{
    $('.upd_doc').trigger('click');
});
$('.other_att').click(function()
{
    $('.upd_other').trigger('click');
});


$('.delete_ct').on('click',function(e){
    debugger;
    e.preventDefault();
    var id = $(this).attr('ct_id');
    if (confirm("Are you sure you want to delete this ct?")) {
        $.ajax({
            url: 'delete_ct',
            type: 'GET',
            data: {
                'id': id
            },
            success: function (res) {
                
                location.href = 'ct_management';
                // $(".table_row[data_id='" + data_id + "']").remove();

            },
            error: function () {
                alert("Something went wrong");
            }
        });
    }
});


$('.del_allocated_client').on('click',function(e){
    debugger;
    e.preventDefault();
    var id = $(this).attr('allocated_client_id');
    if (confirm("Are you sure you want to delete this client?")) {
        $.ajax({
            url: 'delete_ct_allocate_client',
            type: 'GET',
            data: {
                'id': id
            },
            success: function (res) {
                
                location.href = 'ct_management';
                // $(".table_row[data_id='" + data_id + "']").remove();

            },
            error: function () {
                alert("Something went wrong");
            }
        });
    }
});

$('.del_allocated_visit').on('click',function(e){
    debugger;
    e.preventDefault();
    var id = $(this).attr('allocated_visit_id');
    if (confirm("Are you sure you want to delete this client?")) {
        $.ajax({
            url: 'delete_ct_allocate_visit',
            type: 'GET',
            data: {
                'id': id
            },
            success: function (res) {
                
                location.href = 'ct_management';
                // $(".table_row[data_id='" + data_id + "']").remove();

            },
            error: function () {
                alert("Something went wrong");
            }
        });
    }
});