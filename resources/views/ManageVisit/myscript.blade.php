<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        var filename = $("#filename").val();
        var visit_id = "";
        $('#save_data').attr('data-id', visit_id);
        $('.e_other_task_list').hide();
        $('.e_other_task_name').hide();
        $('.e_remove_div').hide();
        var all_disable = [];
        if (filename == 'addfile') {
            visit_id = $("#visit_id").val();
            var clone_length = $('.clone_section').length;
            if (clone_length == 1) {

                $('.e_remove_div').hide();
            }
        }
        if (filename == 'editfile') {
            debugger;
            //block time start

            visit_id = $("#edit_visit_id").val();
            var ct_id = $("#ctname").val();
            var visit_date = $("#visit_date").val();
            $.ajax({
                type: 'GET',
                data: {'ct_id': ct_id, 'visit_date': visit_date, 'visit_id': visit_id},
                url: 'get_block_out',
                error: function(error) {
                },
                success: function(data) {
                    debugger;
                    all_disable = data.all_disb_time;

                    $.each(data.block_times, function(key, value) {
                        debugger;
                        var disb = value;
                        $('.e_start_time option[value ="' + value + '"]').addClass('disable_as').attr('data-time', 'disable_as').css('backgroundColor', '#DCDCDC');
                    });

//                            $.each(all_disable, function(key, value) {

//                            var disb = value;
//                            $('.e_start_time option[value ="'+value+'"]').addClass('disable').attr('data-time', 'disable').attr("disabled", true);
//                            });

                }
            });
            visit_id = $("#edit_visit_id").val();
            $('.mainblock').find('.e_remove_div').not(':first').show();
            $('.mainblock').find('.add_clone').not(':first').hide();

        }
        var collection_end = [];
        var disable_time = '';
        var noavailable = [];
        var times = [];
        var error = false;
        // $('#visit_date').datepicker({dateFormat: 'dd/mm/yy', startDate: '-0m'});
        $('#visit_date').datepicker({dateFormat: 'dd/mm/yy'});
//        $(document).on('focus', '#visit_date', function() {
//            error = false;
//            var ctname = $("#ctname").val();
//            if (ctname == '' || ctname == null) {
//                $('.error').remove();
//                $("#ctname").after('<span class="error" style="color:red">Select Ct name </span>');
//                error = true;
//                
//                
//
//            }
//
//        });
        $(document).on('change', '#ctname', function() {
            debugger;
            $('.error').remove();
            error=false;
            var ct_name = $(this).val();
            if(ct_name){
                $.ajax({
                        type: 'GET',
                        data: {'ct_name': ct_name, 'visit_date_s': visit_date_s},
                        url: 'get_client',
                        error: function(error) {
                        },
                        success: function(data) {
                            debugger;
                            $("#ct_blockout_time").val(data.ct_blockout_time);
                            //Set Client name start
                            var htmlData = '<option value="0">Select Client Name</option>';
                            $.each(data['client_name'], function(key, value) {

                                htmlData += '<option value="' + value['pk_client_id'] + '">' + value['client_name'] + '</option>';
                            });
                            $('#clientname').html(htmlData);
                            //Set Client name end
                            //set Service grop start//
                            if (data.getServiceGroupList != '') {

                                var htmlData_a = '<option value="0">Select Service Group</option>';
                                $.each(data['getServiceGroupList'], function(key, getData) {

                                    htmlData_a += '<option value="' + getData['pk_service_group_id'] + '">' + getData['service_grp_name'] + '</option>';
                                });
                                $('.e_service_group').html(htmlData_a);
                            }
                        }
                            
                    });
            }
            var visit_date_s = $("#visit_date").val();
            if ((ct_name!=null || ct_name!='')) {
                debugger;
                if(visit_date_s!=''){
                getdata_onchange(ct_name,visit_date_s);
                }
            }
            else {
                return false;
            }
        });

        //Ct name end
        $(document).on('change', '#visit_date', function() {
            debugger;
            
            $('.error').remove();
            error=false;
            var visit_date_sv = $(this).val();
            var ct_namev = $("#ctname").val();
             if (!(ct_namev) == '' || !(ct_namev) == null) {
            
                if(visit_date_sv!= ''){

                getdata_onchange(ct_namev,visit_date_sv);
                }
            }
            else{
                 return false;
            }


        });
        function getdata_onchange(ct_name,visit_date_s){
            debugger;
             
            
             $.ajax({
                        type: 'GET',
                        data: {'ct_name': ct_name, 'visit_date_s': visit_date_s},
                        url: 'get_times',
                        error: function(error) {
                        },
                        success: function(data) {
                            debugger;
//                            $('.e_start_time').timepicker('destroy'); 
//                            $('.e_end_time').timepicker('destroy'); 
                            //Set Client name start
                            
                            //Time picker//
                            debugger;

                            collection_end = data.all_end_times;

                            disable_time = data.disable_timet;

                            noavailable = data.not_aval;
                            //asha
                            var x = 15; //minutes interval
                            // time array
                            var tt = 0; // start time
                            var ap = ['AM', 'PM']; // AM-PM

                            //loop to increment the time and push results in array
                            for (var i = 0; tt < 24 * 60; i++) {
                                var hh = Math.floor(tt / 60); // getting hours of day in 0-24 format
                                var mm = (tt % 60); // getting minutes of the hour in 0-55 format
                                times[i] = ("0" + (hh % 12)).slice(-2) + ':' + ("0" + mm).slice(-2) + ap[Math.floor(hh / 12)]; // pushing data in array in [00:00 - 12:00 AM/PM format]
                                tt = tt + x;
                            }
                            //asha
                            debugger;
                            $.each(times, function(key, value) {
                                debugger;

                                if (jQuery.inArray("value", noavailable) == -1) {

                                    $("#start_time").val(value);
                                    return false;
                                }
                            });
                            //asha
                            //
                            
                            $('.e_start_time').timepicker('remove');
                            
                            $('.e_start_time').timepicker({
                                'timeFormat': 'h:i A',
                                'disableTextInput': true,
                                'disableTimeRanges': data.disable_timet,
                                'step': 15
                            });
                            $('.e_end_time').timepicker('remove');
                            $('.e_end_time').timepicker({
                                'timeFormat': 'h:i A',
                                'disableTextInput': true,
                                'disableTimeRanges': data.disable_timet,
                                'step': 15
                            });

                        }
                    });
            
        }
        //visit_date end
        if (filename == 'editfile') {
        $(document).on('focus', '.e_start_time', function() {

            // Store the current value on focus and on change

            var idt = $(this).attr('id');
            $('#id_of_confn_block').val(idt);
            var previous = this.value;
            $("#valueofstart_end").val(previous);
        });
                $(document).on('change', '.e_start_time', function() {
            debugger;
            var ct_block_time_ye = $("#ct_blockout_time").val();
            var previous_value = $("#valueofstart_end").val();
            if ($(this).find('option:selected').attr("data-time") == 'disable_as') {

                $('#modal_target_8').modal('show');
            }

        });
        }
        else {

        $(document).on('change', '.e_start_time', function() {
            debugger;
            

            $('.error').remove();
            var start_id = $(this).attr('id');
            var end_id = $(this).parents('.clone_section').find('.e_end_time').attr('id');
            $('#id_of_confn_block').val(start_id);
            var this_start_time_val_p = $(this).val();

            var ct_block_time_y = $("#ct_blockout_time").val();
            var end_time_arrays = [];
            $('.e_end_time').each(function() {
                debugger;
                var this_end_time_ids = $(this).parents('.clone_section').find('.e_end_time').attr('id');
                var this_end_id = $(this).attr('id');
                if (end_id != this_end_id) {

                    var this_end_value = end_time_arrays.push($(this).val());
                }
            });
            var collect_end = collection_end;
            if (collect_end != '') {
                var all_end_times = $.merge(collection_end, end_time_arrays);
            }
            else {
                all_end_times = end_time_arrays;
            }
            
            debugger;
           
            $.each(all_end_times, function(key, value) {
                debugger;
                var strTime_inc_a = blocktime_inc_method(value);

                if (this_start_time_val_p >= value && this_start_time_val_p < strTime_inc_a) {
                    $('#modal_target_8').modal('show');
                }
            });

            //active end time
            //Duration find


            var this_end_time_val_p = $(this).parents('.clone_section').find('.e_end_time').val();
            if (this_end_time_val_p == "" || this_end_time_val_p == null) {


            }
            else {
                

                var start_hours = converthours(this_start_time_val_p);
                var startmins = convertmins(this_start_time_val_p);
                var endhours = converthours(this_end_time_val_p);
                var endmins = convertmins(this_end_time_val_p);
               

                debugger;

                debugger;
                if (start_hours > endhours) {
                    $(this).parents('.clone_section').find('.e_start_time_div').after('<span class="error" style="color:red">Start time always less then end time.</span>');
                    error = true;
                }
                else if (start_hours == endhours) {
                   
                        $(this).parents('.clone_section').find('.e_start_time_div').after('<span class="error" style="color:red">Start time and end time not same</span>');
                        error = true;
                   
                }
                else {
                    error = false;
                    $('.error').remove();
                }





                var decimal_time_s = 0;
                if (this_start_time_val_p != '' || this_start_time_val_p != null) {
                    decimal_time_s = duration_method(this_start_time_val_p, this_start_time_val_p);
                }


                $(this).parents('.clone_section').find('.e_duration').val(decimal_time_s);



            }
            });
                    //start_time_end
                    //End time start


                    //End time end
            }
            $(document).on('change', '.e_end_time', function() {
                debugger;
                var start_time_value_p = $(this).parents('.clone_section').find('.e_start_time').val();
                $('.error').remove();
                error = false;
                if (start_time_value_p == '' || start_time_value_p == null) {
                    $('.error').remove();
                    $(this).parents('.clone_section').find('.e_start_time_div').after('<span class="error" style="color:red">Select start time first</span>');
                    error = true;
                    return false;

                }
                else {

                    var end_time_value_p = $(this).parents('.clone_section').find('.e_end_time').val();
                    var start_hours = converthours(start_time_value_p);
                    var startmins = convertmins(start_time_value_p);
                    var endhours = converthours(end_time_value_p);
                    var endmins = convertmins(end_time_value_p);

                    if (start_hours > endhours) {
                        $(this).parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start time always less then end time.</span>');
                        error = true;
                    }
                    else if (start_hours == endhours) {
                       
                            $(this).parents('.clone_section').find('.e_end_time_div').after('<span class="error" style="color:red">Start time and end time not same</span>');
                            error = true;
                        
                    }
                    else {
                        error = false;
                        $('.error').remove();
                    }

                    var decimal_time = duration_method(end_time_value_p, start_time_value_p);
                    $(this).parents('.clone_section').find('.e_duration').val(decimal_time);
                }
            });
            
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
            //block out inc start
            function blocktime_inc_method(timebeforeinc) {
                debugger;
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
            //block out inc end
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

            //Service name based on service group start
            $(document).on('change', '.e_service_group', function() {
                //$(".e_service_group").on('change', function() {

                var service_group = $(this).val();
                var thisclass = $(this);
                if (service_group)
                {
                    service_name(service_group, thisclass);
                }

            });
            function service_name(srv_group, thisclass)
            {

                $.ajax({
                    type: 'GET',
                    url: 'manage_get_services/' + srv_group,
                    async: false,
                    error: function(error) {
                    },
                    success: function(data) {


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

                error = false;
                $(".error").remove();
                var ct_name = $('#ctname').val();
                var client_name = $('#clientname').val();
                var visit_date = $('#visit_date').val();
                $('.error').remove();
                if (ct_name == '' || ct_name == null) {
                    error = true;
                    $('#ctname').after('<span class="error" style="color:red">Please Select Care Tacker Name</span>');
                }
                if (client_name == '' || client_name == null || client_name == 0) {
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
                    var end_time_validation = $(this).parents('.clone_section').find('.e_end_time').val();
                    debugger;
                var start_time_ch = converthours(start_time);
                var end_time_ch = converthours(end_time_validation);
                

                   //  if (start_time == "" || start_time == null) {

                   //      error = true;
                   //      $(this).parents('.e_start_time_div').after('<span class="error" style="color:red">Start Time is required</span>');
                   //  }
                   // if (start_time_ch > end_time_ch) {
                   //      error = true;
                   //      $(this).parents('.e_start_time_div').after('<span class="error" style="color:red">Start and end time not validate s</span>');
                   //  }
                   //   if (start_time_ch == end_time_ch) {
                        
                   //      $(this).parents('.clone_section').find('.e_start_time_div').after('<span class="error" style="color:red">Start and end time not validate s</span>');
                   //      error = true;
                        
                   //  }
                    


                });
                $('.e_end_time').each(function() {

                    var end_time = $(this).val();
                    var stat_time_validation = $(this).parents('.clone_section').find('.e_start_time').val();
                    if (end_time == "" || end_time == null) {

                        error = true;
                        $(this).parents('.e_end_time_div').after('<span class="error" style="color:red">End Time is required</span>');
                    }
                    // if (end_time < stat_time_validation) {
                    //     error = true;
                    //     $(this).parents('.e_end_time_div').after('<span class="error" style="color:red">Start and end time not validate</span>');
                    // }


                });
                $('.e_other_task_description').each(function() {

                    var thisvalues = $(this).val().trim();
                    if (thisvalues == "") {

                        error = true;
                        $(this).after('<span class="error" style="color:red">Task Description Required</span>');
                    }
                });
                $('.e_other_task_name').each(function() {

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

            //Service name based on service group end
            //clone remove start
            $(document).on('click', '.e_remove_btn', function() {


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
            //clone remove end
            //add clone
            $(document).on('click', '#add_clone', function(e) {
                //add validation start

                error = manage_validation(error);
                //add validation end


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

                    //service_group get option


                    //next time set up start
                    debugger;

                    //asha


                    //asha

                    debugger;
                    var prevend_time_length = newEle.prev().find('.e_end_time').length;
                    if (prevend_time_length != '' || prevend_time_length != 0) {
                        var prev_end_time_val = newEle.prev().find('.e_end_time').val();
                        var strTime = blocktime_inc_method(prev_end_time_val);
                        //set value skip start
                        var setvalue = '';
                        if (jQuery.inArray(strTime, noavailable) == -1) {
                            setvalue = strTime;

                        }
                        else {
                            debugger;
                            var set_times = '';
                            $.each(times, function(key, value) {
                                debugger;
                                settimes = blocktime_inc_fifteenminute_method(strTime)
                                while (settimes <= value) {
                                    debugger;
                                    var settimes = blocktime_inc_fifteenminute_method(settimes);
                                    if (jQuery.inArray(settimes, noavailable) == -1) {
                                        set_times = settimes;
                                        return false;
                                    }

                                }
                            });
                            setvalue = set_times;
                        }
                        //set value skip end

                        if (filename == 'editfile') {
                            newEle.find(".e_start_time option[value='" + setvalue + "']").attr("selected", "selected");
                        }
                        else {
                            newEle.find('.e_start_time').val(setvalue);
                        }
                        $("#valueofstart_end").val(strTime);

                    }
                    //next time set up end
                    if (filename == 'editfile') {
                        debugger;
                        var service_grop_arr_s = [];
                        $("#service_group option").each(function(a, b)
                        {
                            service_grop_arr_s.push({name: b.value, index: b.text});
                        });
                        debugger;

                        var htmlData_o = '<option value="0" selected>Select Service Group</option>';
                        $.each(service_grop_arr_s, function(key, value) {
                            debugger;
                            htmlData_o += '<option value="' + value.name + '">' + value.index + '</option>';
                        });
                        newEle.find('.e_service_group').html(htmlData_o);


                    }
                    else {
                        newEle.find('.e_start_time').timepicker({
                            'timeFormat': 'h:i A',
                            'disableTextInput': true,
                            'disableTimeRanges': disable_time,
                            'step': 15
                        });

                        newEle.find('.e_end_time').timepicker({
                            'timeFormat': 'h:i A',
                            'disableTextInput': true,
                            'disableTimeRanges': disable_time,
                            'step': 15
                        });
                    }
                }
            });

            //save data start
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
                                    if (res == 0) {
                                        alert("This data not insert because care tacker time conflict");
                                    }

                                },
                                error: function() {
                            }
                    });
        }

        });
                //save data end

                //document ready end

    });

    function converthours(value) {
        debugger;
        var get_st = new Date("2019-12-15 " + value);
        var gettimes_st = get_st.getTime();
        var time_incr_st = new Date(gettimes_st);
        var hours_st = time_incr_st.getHours();
        var minutes_st = time_incr_st.getMinutes();
        if(hours_st<10){
            hours_st='0'+hours_st
        }
        var time=hours_st+':'+minutes_st;
        

        return time



    }
    function convertmins(value) {
        var get_st = new Date("2019-12-15 " + value);
        var gettimes_st = get_st.getTime();
        var time_incr_st = new Date(gettimes_st);
        var minutes_st = time_incr_st.getMinutes();
        return minutes_st;
    }


</script>