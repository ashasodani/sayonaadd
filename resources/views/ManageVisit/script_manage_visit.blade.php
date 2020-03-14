
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).ready(function() {
        //visit_date
        debugger;
        var filename = $("#filename").val();
        var visit_id = "";
        $('.e_other_task_list').hide();
        $('.e_other_task_name').hide();
        $('.e_remove_div').hide();
        $('#visit_date').datepicker({dateFormat: 'dd/mm/yy', startDate: '-0m'});
        //find clone section


        $('#save_data').attr('data-id', visit_id);
        if (filename == 'addfile') {
            visit_id = $("#visit_id").val();
            var clone_length = $('.clone_section').length;
            if (clone_length == 1) {

                $('.e_remove_div').hide();
            }

            $('body').on('focus', '.e_start_time', function() {
                $('.e_start_time').timepicker({
                    interval: 15,
                    scrollbar: true,
                    'minTime': '1:00 AM',
                    change: start_time_method
                });
            });
            function start_time_method() {
                debugger;
               
                //change remove//
                var visit_date_s = $("#visit_date").val();
                var ct_name_s = $("#ctname").val();
                var client_name_s = $("#clientname").val();
                var current_start_time = $(this).val();
                var disable_time = '';
                $("#valueofstart_end").val(current_start_time);
                if (ct_name_s != "" || ct_name_s != null || visit_date_s != '' || visit_date_s != null) {
                    $.ajax({
                        type: 'GET',
                        data: {ct_name: ct_name_s, visit_date_s: visit_date_s},
                        url: 'check_visit',
                        error: function(error) {
                        },
                        success: function(data) {
                            debugger;
                            if (data == 1) {
                            }
                            else {
                                debugger;
                                var disable_time = data;
                                console.log(disable_time);
                            }
                        }
                    });
                }


                //change remove//
                var id = $(this).attr('id');
                //Block out time start
                var end_id = $(this).parents('.clone_section').find('.e_end_time').attr('id');
                $('#id_of_confn_block').val(id);
                var this_start_time_val = $(this).val();
                var ct_block_time_y = $("#ct_blockout_time").val();
                var end_time_arrays = [];
                $('.e_end_time').each(function() {
                    debugger;
                    var this_end_time_value = $(this).parents('.clone_section').find('.e_end_time').attr('id');
                    var this_end_id = $(this).attr('id');
                    if (end_id != this_end_id) {
                        var this_end_value = end_time_arrays.push($(this).val());
                    }
                });
                $.each(end_time_arrays, function(key, value) {
                    debugger;
                    var strTime_inc_a = blocktime_inc_method(value);
                    if (this_start_time_val >= value && this_start_time_val < strTime_inc_a) {
                        $('#modal_target_8').modal('show');
                    }
                });
                
                
                //start_end validation start
                debugger;
            var error_s = "false";
            var start_time_class = $(this);
            var start_time_val = $(this).val();
            var decimal_time=0;
            //asha
            var this_end_value = start_time_class.parents('.clone_section').find('.e_end_time').val();
            if(this_end_value!=''){
                var get_s = new Date("2019-12-15 " + this_end_value);
                var gettimes_s = get_s.getTime();
                var time_incr_s = new Date(gettimes_s);
                var hours_s = time_incr_s.getHours();
                var minutes_s = time_incr_s.getMinutes();
                var this_start_val = start_time_class.parents('.clone_section').find('.e_start_time').val();
                var get_e = new Date("2019-12-15 " + this_start_val);
                var gettimes_e = get_e.getTime();
                var time_incr_e = new Date(gettimes_e);
                var hours_e = time_incr_e.getHours();
                var minutes_e = time_incr_e.getMinutes();
                if (hours_s < hours_e) {
                    $('.error').remove();
                    error_s = true;
                    start_time_class.parents('.clone_section').find('.e_start_time_div').after('<span class="error" style="color:red">Start time always greater than end time </span>');
                }
                else if (hours_s == hours_e) {
                    error_s = true;
                    if (minutes_s < minutes_e) {
                        $('.error').remove();
                        start_time_class.parents('.clone_section').find('.e_start_time_div').after('<span class="error" style="color:red">Start time always greater than end time </span>');
                    }
                    if (minutes_s == minutes_e) {
                        $('.error').remove();
                        start_time_class.parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start Time End time not same </span>');
                    }
                }
                else {
                    error_s = false;
                    $('.error').remove();
                }
                if (error_s == false) {
                    //duration code
                        debugger;

                       //duration code satrt//
                    var this_start_values_t = $(this).parents('.clone_section').find('.e_start_time').val();
                    var this_end_time_values_t = $(this).parents('.clone_section').find('.e_end_time').val();
                    if(this_end_time_values_t!='' || this_end_time_values_t!=null)
                     decimal_time = duration_method(this_end_time_values_t, this_start_values_t)
                   
                    //duration code end
                }
              }
              
               $(this).parents('.clone_section').find('.e_duration').val(decimal_time);
                
            }


            $(document).on('focusin', '.e_end_time', function() {
                
                var close_start_time = $(this).parents('.clone_section').find('.e_start_time').val();
                if (close_start_time != '') {
                    $(this).parents('.clone_section').find('.e_end_time').timepicker({
                        interval: 15,
                        scrollbar: true,
                        'minTime': '1:00 AM',
                        change: end_time_method
                    });
                }
            });
        }

        if (filename == 'editfile') {


            visit_id = $("#edit_visit_id").val();
            $('.mainblock').find('.e_remove_div').not(':first').show();
            $('.mainblock').find('.add_clone').not(':first').hide();
            //options disable
            $(document).on('focus', '.e_start_time', function() {
                debugger;
                // Store the current value on focus and on change

                var idt = $(this).attr('id');
                $('#id_of_confn_block').val(idt);
                var previous = this.value;
                $("#valueofstart_end").val(previous);
            });
            $(document).on('change', '.e_start_time', function() {

                //blockout pop up satrt//
                var id = $(this).attr('id');
                var end_id_e = $(this).parents('.clone_section').find('.e_end_time').attr('id');
                $('#id_of_confn_block').val(id);
                var this_start_time_val_e = $(this).val();
                var ct_block_time_ye = $("#ct_blockout_time").val();
                var end_time_arrays_e = [];
                $('.e_end_time').each(function() {
                    debugger;
                    var this_end_time_value_e = $(this).parents('.clone_section').find('.e_end_time').attr('id');
                    var this_end_id_e = $(this).attr('id');
                    if (end_id_e != this_end_id_e) {
                        var this_end_value = end_time_arrays_e.push($(this).val());
                    }
                });
                $.each(end_time_arrays_e, function(key, value) {
                    debugger;
                    var strTime_inc = blocktime_inc_method(value);
                    if (this_start_time_val_e >= value && this_start_time_val_e < strTime_inc) {

                        $('#modal_target_8').modal('show');
                    }

                });
                //block out pop up end
//                debugger;
//            
//               var id = $(this).attr('id');
//                 
//                if (id != "start_time1")
//                {
//                   
//                    if ($(this).find('option:selected').attr("data-time")=='disable_as') {
//                      
//                        $('#modal_target_8').modal('show');
//                    }
//                }

                //duration code satrt//
                var this_start_values = $(this).parents('.clone_section').find('.e_start_time').val();
                var this_end_time_values = $(this).parents('.clone_section').find('.e_end_time').val();
                var decimal_time = duration_method(this_end_time_values, this_start_values)
                $(this).parents('.clone_section').find('.e_duration').val(decimal_time);
                //duration code end

            });
            $(document).on('change', '.e_end_time', function() {
                debugger;
                var error_st = false;
                var end_time_val = $(this).val();
                //asha
                var this_start_value_s = $(this).parents('.clone_section').find('.e_start_time').val();
                var get_st = new Date("2019-12-15 " + this_start_value_s);
                var gettimes_st = get_st.getTime();
                var time_incr_st = new Date(gettimes_st);
                var hours_st = time_incr_st.getHours();
                var minutes_st = time_incr_st.getMinutes();
                var this_end_val_s = $(this).parents('.clone_section').find('.e_end_time').val();
                var get_et = new Date("2019-12-15 " + this_end_val_s);
                var gettimes_et = get_et.getTime();
                var time_incr_et = new Date(gettimes_et);
                var hours_et = time_incr_et.getHours();
                var minutes_et = time_incr_et.getMinutes();
                if (hours_st > hours_et) {
                    $('.error').remove();
                    error_st = true;
                    $(this).parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start always greater than end time </span>');
                }
                else if (hours_st == hours_et) {
                    error_st = true;
                    if (minutes_st > minutes_et) {
                        $('.error').remove();
                        $(this).parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start always greater than end time </span>');
                    }
                    if (minutes_st == minutes_et) {
                        $('.error').remove();
                        $(this).parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start Time End time not same </span>');
                    }
                }
                else {
                    error_st = false;
                    $('.error').remove();
                }

                //duration code start
                var this_start_valuest = $(this).parents('.clone_section').find('.e_start_time').val();
                var this_end_time_valuest = $(this).parents('.clone_section').find('.e_end_time').val();
                var decimal_timet = duration_method(this_end_time_valuest, this_start_valuest);
                $(this).parents('.clone_section').find('.e_duration').val(decimal_timet);
                //duration code end


            });
        }



        function end_time_method() {
            debugger;
            var error_s = "false";
            var end_time_class = $(this);
            var end_time_val = $(this).val();
            //asha
            var this_start_value = end_time_class.parents('.clone_section').find('.e_start_time').val();
            var get_s = new Date("2019-12-15 " + this_start_value);
            var gettimes_s = get_s.getTime();
            var time_incr_s = new Date(gettimes_s);
            var hours_s = time_incr_s.getHours();
            var minutes_s = time_incr_s.getMinutes();
            var this_end_val = end_time_class.parents('.clone_section').find('.e_end_time').val();
            var get_e = new Date("2019-12-15 " + this_end_val);
            var gettimes_e = get_e.getTime();
            var time_incr_e = new Date(gettimes_e);
            var hours_e = time_incr_e.getHours();
            var minutes_e = time_incr_e.getMinutes();
            if (hours_s > hours_e) {
                $('.error').remove();
                error_s = true;
                end_time_class.parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start always greater than end time </span>');
            }
            else if (hours_s == hours_e) {
                error_s = true;
                if (minutes_s > minutes_e) {
                    $('.error').remove();
                    end_time_class.parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start always greater than end time </span>');
                }
                if (minutes_s == minutes_e) {
                    $('.error').remove();
                    end_time_class.parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start Time End time not same </span>');
                }
            }
            else {
                error_s = false;
                $('.error').remove();
            }
            if (error_s == false) {
                //duration code
                    debugger;

                var decimal_time = duration_method(end_time_val, this_start_value);
                end_time_class.parents('.clone_section').find('.e_duration').val(decimal_time);
                //duration code
                //change next start time based on prev end time
//                 var next_starttime_length = $(this).parents('.clone_section').next().find('.e_start_time').length;
//                 if (next_starttime_length != '' || next_starttime_length != 0) {
//                     debugger;
//                     var this_time_val = $(this).timepicker('getTime');
//                     var ct_block_time = $("#ct_blockout_time").val();
//                     var setsTime = new Date(this_time_val.getTime() + (ct_block_time) * 60000);   // add 30 minutes
//                     var hours = setsTime.getHours();
//                     var minutes = setsTime.getMinutes();
//                     var ampm = hours >= 12 ? 'PM' : 'AM';
//                     hours = hours % 12;
//                     hours = hours ? hours : 12; // the hour '0' should be '12'
//                     minutes = minutes < 10 ? '0' + minutes : minutes;
//                     var strTime = hours + ':' + minutes + ' ' + ampm;
//                     $(this).parents('.clone_section').next().find('.e_start_time').val(strTime);
//                     $("#valueofstart_end").val(strTime);
//                 }
                //duration code


            }




//            

        }

        //Time setup end

        //clone remove
        $(document).on('click', '.e_remove_btn', function() {

            debugger;
            //Increment block time based prev next start
            var pre_end_time_r = $(this).parents('.clone_section').prev().find('.e_end_time').val();
            var strTime_r = blocktime_inc_method(pre_end_time_r);
            if (filename == 'editfile') {
                $(this).parents('.clone_section').next().find(".e_start_time option[value='" + strTime_r + "']").attr("selected", "selected");
            }
            else {
                $(this).parents('.clone_section').next().find('.e_start_time').val(strTime_r);
            }


            $("#valueofstart_end").val(strTime_r);
            //Increment block time based prev next start
            $(this).parents('.clone_section').remove();
        });
        function blocktime_inc_method(timebeforeinc) {
            var get = new Date("2019-12-15 " + timebeforeinc);
            var gettimes = get.getTime();
            var ct_block_time = $("#ct_blockout_time").val();
            var time_incr = new Date(gettimes + (ct_block_time) * 60000);
            var hours = time_incr.getHours();
            var minutes = time_incr.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var hours_u = '';
            if (hours < 10) {
                hours_u = '0' + hours;
            }
            else {
                hours_u = hours
            }
            var time_after_inc = hours_u + ':' + minutes + ' ' + ampm;
            return time_after_inc;
        }
        function blocktime_inc_fifteenminute_method(timebeforeinc) {
            var get = new Date("2019-12-15 " + timebeforeinc);
            var gettimes = get.getTime();
            var inc = 15;
            var time_incr = new Date(gettimes + (inc) * 60000);
            var hours = time_incr.getHours();
            var minutes = time_incr.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var hours_u = '';
            if (hours < 10) {
                hours_u = '0' + hours;
            }
            else {
                hours_u = hours
            }
            var time_after_inc = hours_u + ':' + minutes + ' ' + ampm;
            return time_after_inc;
        }

        function duration_method(end_time, start_time) {
            debugger;
            var diff = (new Date("2019-1-1 " + end_time) - new Date("2019-1-1 " + start_time)) / 1000 / 60;
            var hour = parseInt(diff / 60);
            var min = diff % 60;
            if (min < 10) {
                min = "0" + min;
            }
            var timein = hour + ":" + min;
            var arr = timein.split(':');
            var dec = parseInt((arr[1] / 6) * 10, 10);
            var decimal_time = parseFloat(parseInt(arr[0], 10) + '.' + (dec < 10 ? '0' : '') + dec);
            if (decimal_time < 0) {
                decimal_time = 0;
            }
            return decimal_time;
        }

        //Model method start

        $(document).on('click', '#block_overdueyes', function() {
            debugger;
            $("#modal_target_8").modal("hide");
        });
        $(document).on('click', '#block_overdueno', function() {
            debugger;
            var blocknovalue = $('#valueofstart_end').val();
            var id_of_confn_block = $('#id_of_confn_block').val();
            $('#' + id_of_confn_block).val(blocknovalue);
        });
        //Model method end



        $(document).on('change', '#ctname', function() {
            debugger;
            var ct_name = $(this).val();
            if (ct_name) {
                $.ajax({
                    type: 'GET',
                    url: 'get_client/' + ct_name,
                    error: function(error) {
                    },
                    success: function(data) {
                        debugger;
                        var htmlData = '<option value="0">Select Client Name</option>';
                        $.each(data['client_name'], function(key, value) {

                            htmlData += '<option value="' + value['pk_client_id'] + '">' + value['client_name'] + '</option>';
                        });
                        $('#clientname').html(htmlData);
                        //Service grop//
                        if (data.getServiceGroupList != '') {
                            debugger;
                            var htmlData_a = '<option value="0">Select Service Group</option>';
                            $.each(data['getServiceGroupList'], function(key, getData) {

                                htmlData_a += '<option value="' + getData['pk_service_group_id'] + '">' + getData['service_grp_name'] + '</option>';
                            });
                            $('.e_service_group').html(htmlData_a);
                        }
                        $("#ct_blockout_time").val(data.ct_blockout_time);
                        if(filename=='addfile'){
                            
                        }
                        //Edit file by default time block out
                        if (filename == 'editfile') {

                            $('.e_start_time').each(function() {
                                debugger;
                                var id = $(this).parents('.clone_section').attr('id');
                                if (id != "clone_section") {
                                    debugger;
                                    //asha
                                    var prev_end_time = $(this).parents('.clone_section').prev().find('.e_end_time option:selected').val();
                                    var strTime_as = blocktime_inc_method(prev_end_time);
                                    var this_start_time = $(this).parents('.clone_section').find('.e_start_time option:selected').val();
                                    var forstart = prev_end_time.trim();
                                    var start_point = $(this).parents(".clone_section").find(".e_start_time option[value='" + forstart + "']").attr('name');
                                    var cc = start_point + 1;
                                    var end_point = $(this).parents(".clone_section").find(".e_start_time option[value='" + strTime_as + "']").attr('name');
                                    var list = [];
                                    for (var i = start_point; i < end_point; i++) {
                                        list.push(i);
                                    }
                                    var id = $(this).attr('id');
                                    $.each(list, function(key, value) {
                                        debugger;
                                        var disb = value;
                                        $('#' + id + ' option[name =' + disb + ']').addClass('disable_as').attr('data-time', 'disable_as').css('backgroundColor', '#DCDCDC');
                                    });
                                }

                            });
                        }
                        //block time end

                    }
                });
            }
        });
        //Service name based on service group
        $(document).on('change', '.e_service_group', function() {
            //$(".e_service_group").on('change', function() {
            debugger;
            var service_group = $(this).val();
            var thisclass = $(this);
            if (service_group)
            {
                service_name(service_group, thisclass);
            }

        });
        function service_name(srv_group, thisclass)
        {
            debugger;
            $.ajax({
                type: 'GET',
                url: 'manage_get_services/' + srv_group,
                async: false,
                error: function(error) {
                },
                success: function(data) {

                    debugger;
                    var htmlData = '<option value="0">Select Service Name</option>';
                    $.each(data['clone_service'], function(key, value) {
                        htmlData += '<option value="' + value['pk_services_id'] + '">' + value['service_name'] + '</option>';
                    });
                    thisclass.parents('.clone_section').find('.e_service_name').html(htmlData);
                }

            });
        }
        //Task name based on service name
        $(document).on('change', '.e_service_name', function() {

            debugger;
            var service_name = $(this).val();
            var thisclass_service = $(this);
            if (service_name)
            {
                task_list(service_name, thisclass_service);
            }

        });
        function task_list(service_name, thisclass_service)
        {
            $.ajax({
                type: 'GET',
                url: 'manage_clone_task/' + service_name,
                async: false,
                error: function(error) {
                },
                success: function(data)
                {
                    debugger;
                    var htmlData = '<option value="0">Select Task</option>';
                    $.each(data['clone_task'], function(key, value) {
                        htmlData += '<option value="' + value['pk_task_id'] + '">' + value['task_name'] + '</option>';
                    });
                    htmlData += "<option value='other_task' class='other' class='other_task' id='task_name'>Other</option>";
                    thisclass_service.parents('.clone_section').find('.e_task_name').html(htmlData);
                }
            });
        }
        //Task description according to task
        $(document).on('change', '.e_task_name', function() {
            //$(".e_task_name").on('change', function() {
            var task_name = $(this).val();
            var taskclass = $(this);
            if (task_name == 'other_task')
            {

                taskclass.parents('.clone_section').find('.e_other_task_list').show();
                taskclass.parents('.clone_section').find('.e_other_task_name').show();
                taskclass.parents('.clone_section').find('.e_other_task_name').val('');
                taskclass.parents('.clone_section').find('.e_other_task_description_default').show();
                taskclass.parents('.clone_section').find('.e_other_task_description').show();
                taskclass.parents('.clone_section').find('.e_other_task_description').val('');
            }
            else
            {
                $.ajax({
                    type: 'GET',
                    url: 'clone_manage_desc/' + task_name,
                    async: false,
                    error: function(error) {
                    },
                    success: function(c_task_desc) {
                        taskclass.parents('.clone_section').find('.e_other_task_list').hide();
                        taskclass.parents('.clone_section').find('.e_other_task_name').hide();
                        taskclass.parents('.clone_section').find('.e_other_task_description_default').show();
                        taskclass.parents('.clone_section').find('.e_other_task_description').val(c_task_desc[0].task_description);
                    }
                });
            }
        });
        //Validation function start//
        function manage_validation(error) {
            debugger
            $(".error").remove();
            var ct_name = $('#ctname').val();
            var client_name = $('#clientname').val();
            var visit_date = $('#visit_date').val();
            $('.error').remove();
            if (ct_name == '' || ct_name == null) {
                error = true;
                $('#ctname').after('<span class="error" style="color:red">Please Select Care Tacker Name</span>');
            }
            if (client_name == '' || client_name == null) {
                error = true;
                $('#clientname').after('<span class="error" style="color:red">Please Select Client Name</span>');
            }

            if (visit_date == '') {
                error = true;
                $('.e_visit_date_div').after('<span class="error" style="color:red">Please Choose Visit Date</span>');
            }


            $('.e_service_group').each(function() {
                var service_group = $(this).val();
                if (service_group == 0 || service_group == null) {
                    error = true;
                    $(this).after('<span class="error" style="color:red">Service Group is required</span>');
                }

            });
            $('.e_service_name').each(function() {
                var service_name = $(this).val();
                if (service_name == 0 || service_name == null) {
                    error = true;
                    $(this).after('<span class="error" style="color:red">Service Name is required</span>');
                }

            });
            $('.e_task_name').each(function() {
                var task_list = $(this).val();
                if (task_list == 0 || task_list == null) {
                    error = true;
                    $(this).after('<span class="error" style="color:red">Task Name is required</span>');
                }

            });
            $('.e_start_time').each(function() {

                var start_time = $(this).val();
                if (start_time == "" || start_time == null) {

                    error = true;
                    $(this).parents('.e_start_time_div').after('<span class="error" style="color:red">Start Time is required</span>');
                }


            });
            $('.e_end_time').each(function() {
                debugger;
                var end_time = $(this).val();
                if (end_time == "" || end_time == null) {

                    error = true;
                    $(this).parents('.e_end_time_div').after('<span class="error" style="color:red">End Time is required</span>');
                }


            });
            $('.e_other_task_description').each(function() {
                debugger;
                var thisvalues = $(this).val().trim();
                if (thisvalues == "") {

                    error = true;
                    $(this).after('<span class="error" style="color:red">Task Description Required</span>');
                }
            });
            $('.e_other_task_name').each(function() {
                debugger;
                if ($(this).is(":visible")) {
                    var thisvalues = $(this).val().trim();
                    if (thisvalues == "" || thisvalues == null) {
                        error = true;
                        $(this).after('<span class="error" style="color:red">Task Name Required</span>');
                    }
                }
            });
            return error;
        }
        //Validation function end

        //Add clone
        $(document).on('click', '#add_clone', function(e) {
            //add validation start
            var error = false;
            error = manage_validation(error);
            //add validation end

            debugger;
            if (error == false) {
                var cloneCount = $('.clone_section').length;
                var newclonecount = cloneCount + 1;
                var newEle = $(this).parents('.mainblock').find('#clone_section').clone().val('').attr('id', 'clone_section' + newclonecount).insertAfter($('[id^=clone_section]:last'));
                newEle.find('.e_service_group').attr('id', 'service_group' + newclonecount);
                newEle.find('.e_service_name').attr('id', 'service_name' + newclonecount);
                newEle.find('.e_task_name').attr('id', 'task_name' + newclonecount);
                newEle.find('.e_start_time').attr('id', 'start_time' + newclonecount).val('');
                newEle.find('.e_end_time').attr('id', 'end_time' + newclonecount).val('').append('<option value="" disabled selected hidden>11:00 AM</option>');
                newEle.find('.e_duration').attr('id', 'e_duration' + newclonecount).val('');
                newEle.find('.e_other_task_name').attr('id', 'other_task_name' + newclonecount).val('')
                newEle.find('.e_other_task_list').hide();
                newEle.find('.e_other_task_description').attr('id', 'other_task_desc' + newclonecount).val('');
                newEle.find('.e_remove_btn').attr('id', 'remove_button' + newclonecount);
                if (filename == 'editfile') {
                    newEle.find('.e_checkinup').attr('id', 'checkinup' + newclonecount).val('newinsert');
                    newEle.find('.e_primary_id').attr('id', 'primary_id' + newclonecount).val('');
                }
                $(this).parents('.mainblock').find('.e_remove_div').not(':first').show();
                $(this).parents('.mainblock').find('.add_clone').not(':first').hide();
                newEle.find('.e_service_name').html('<option value="0"  selected disabled>Select Service Name</option>');
                newEle.find('.e_task_name').html('<option value="0"  selected disabled>Select Task</option>');
                //next time set up start
                debugger;
                var prevend_time_length = newEle.prev().find('.e_end_time').length;
                if (prevend_time_length != '' || prevend_time_length != 0) {
                    var prev_end_time_val = newEle.prev().find('.e_end_time').val();
                    var ct_block_time = $("#ct_blockout_time").val();
                    var get_s = new Date("2019-12-15 " + prev_end_time_val);
                    var gettimes_s = get_s.getTime();
                    var setsTime = new Date(gettimes_s + (ct_block_time) * 60000); // add 30 minutes
                    var hours = setsTime.getHours();
                    var minutes = setsTime.getMinutes();
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    var hours_con = '';
                    if (hours < 10) {
                        var hours_con = '0' + hours;
                    }
                    else {
                        hours_con = hours;
                    }
                    var strTime = hours_con + ':' + minutes + ' ' + ampm;
                    if (filename == 'editfile') {
                        newEle.find(".e_start_time option[value='" + strTime + "']").attr("selected", "selected");
                    }
                    else {
                        newEle.find('.e_start_time').val(strTime);
                    }
                    $("#valueofstart_end").val(strTime);
                }
                //next time set up end
            }
        });
        $(document).on('click', '#save_data', function(e) {
            debugger;
            e.preventDefault();
            var error = false;
            var updateid = visit_id;
            error = manage_validation(error);
            var service_group_arr = [];
            $('.e_service_group').each(function() {
                var service_group = $(this).val();
                service_group_arr.push(service_group);
            });
            var services_name_arr = [];
            $('.e_service_name').each(function() {
                var service_name = $(this).val();
                services_name_arr.push(service_name);
            });
            var task_arr = [];
            $('.e_task_name').each(function() {
                var task_list = $(this).val();
                task_arr.push(task_list);
            });
            var start_time_arr = [];
            $('.e_start_time').each(function() {
                var start_time = $(this).val();
                start_time_arr.push(start_time);
            });
            var end_time_arr = [];
            $('.e_end_time').each(function() {
                var end_time = $(this).val();
                end_time_arr.push(end_time);
            });
            var duration_arr = [];
            $('.e_duration').each(function() {
                var duration = $(this).val();
                duration_arr.push(duration);
            });
            var new_task_name_arr = [];
            $('.e_other_task_name').each(function() {
                var val = $(this).val();
                new_task_name_arr.push(val);
            });
            var new_task_desc_arr = [];
            $('.e_other_task_description').each(function() {

                var val = $(this).val();
                new_task_desc_arr.push(val);
            });
            var new_check_in_up_arr = [];
            $('.e_checkinup').each(function() {

                var val = $(this).val();
                new_check_in_up_arr.push(val);
            });
            var primary_ids_arr = [];
            $('.e_primary_id').each(function() {

                var val = $(this).val();
                primary_ids_arr.push(val);
            });
            if (error == false) {
                var ct_name = $('#ctname').val();
                var client_name = $('#clientname').val();
                var visit_date = $('#visit_date').val();
                debugger;
                $.ajax({
                    url: 'manage_visit_store_save',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'updateid': updateid,
                        'ct_group': ct_name,
                        'client_name': client_name,
                        'visit_date': visit_date,
                        'service_group_arr': service_group_arr,
                        'services_name_arr': services_name_arr,
                        'task_arr': task_arr,
                        'new_task_name_arr': new_task_name_arr,
                        'new_task_desc_arr': new_task_desc_arr,
                        'start_time_arr': start_time_arr,
                        'end_time_arr': end_time_arr,
                        'duration_arr': duration_arr,
                        'new_check_in_up_arr': new_check_in_up_arr,
                        'primary_ids_arr': primary_ids_arr,
                    },
                    datType: 'json',
                    success: function(res) {
                        debugger;
                        if (res == 1) {
                            window.location = '{{ url('manage_visit')}}'
                        }

                    },
                    error: function() {
                    }
                });
            }

        });
        //End document ready
    });


</script>