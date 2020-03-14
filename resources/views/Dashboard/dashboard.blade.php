@extends('layouts.layout')
@section('title')
    Dashboard   
@endsection
@section('main')
<div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader breadcrumb_sad">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title m-subheader__title--separator">
                                    Dashboard
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
                                                Dashboard
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-content page_contant">
                        <div class="subheader_box">
                            <!-- BEGIN: Subheader -->
                            <div class="m-subheader subheader_text">
                                <div class="d-flex align-items-center">
                                    <div class="ml-auto subheader_right_content">
                                        <!--begin::Content-->
                                        <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                                            <span class="m-subheader__daterange-label">
                                                <span class="m-subheader__daterange-title"></span>
                                                <span class="m-subheader__daterange-date m--font-brand"></span>
                                            </span>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                <i class="la la-angle-down"></i>
                                            </a>
                                        </span>
                                        <input type="hidden" name="hide1" id="hide1"/>
                                        <input type="hidden" name="hide2" id="hide2"/>
                                        <input type="hidden" name="hide2" id="hide3"/>
                                        

                                        <!--end::Content-->
                                    </div>
                                </div>
                            </div>
                            <!-- END: Subheader -->
                            <!-- START :: Top box--> 
                            <div class="top_box">
                                <div class="m-portlet__body  m-portlet__body--no-padding">
                                    <div class="row m-0 dashboard">
                                        <div class="box_main_content">
                                            <!--begin::Total Number of Bids-->

                                            <div class="box_content">
                                                <p>Total Clients</p>
                                                <span class="font" id="total_clients"></span>
                                            </div>
                                            <div class="box_img">
                                                <img src="images/user_box_1.png" alt=""/>

                                            </div>
                                            <!--end::Total Number of Bids-->
                                        </div>
                                        <div class="box_main_content">
                                            <!--begin::Total Number of Bids-->
                                            <div class="box_content">
                                                <p>Total CT</p>
                                                <span class="font" id="total_ct"></span>
                                            </div>
                                            <div class="box_img">
                                                <img src="images/user_box_2.png" alt=""/>

                                            </div>
                                            <!--end::Total Number of Bids-->
                                        </div>
                                        <div class="box_main_content">
                                            <!--begin::Total Number of Bids-->
                                            <div class="box_content">
                                                <p>Total Visits</p>
                                                <span class="font" id="total_visit"></span>
                                            </div>
                                            <div class="box_img">
                                                <img src="images/user_box_3.png" alt=""/>

                                            </div>
                                            <!--end::Total Number of Bids-->
                                        </div>
                                        <div class="box_main_content">
                                            <!--begin::Total Number of Bids-->
                                            <div class="box_content">
                                                <p>Total Pending</p>
                                                <span class="font" id="total_pending"></span>
                                            </div>
                                            <div class="box_img">
                                                <img src="images/user_box_4.png" alt=""/>

                                            </div>
                                            <!--end::Total Number of Bids-->
                                        </div>
                                        <div class="box_main_content">
                                            <!--begin::Total Number of Bids-->
                                            <div class="box_content">
                                                <p>Total Inprocess</p>
                                                <span class="font" id="total_inprocess"></span>
                                            </div>
                                            <div class="box_img">
                                                <img src="images/user_box_5.png" alt=""/>

                                            </div>
                                            <!--end::Total Number of Bids-->
                                        </div>
                                        <div class="box_main_content">
                                            <!--begin::Total Number of Bids-->
                                            <div class="box_content">
                                                <p>Total Completed</p>
                                                <span class="font" id="total_completed"></span>
                                            </div>
                                            <div class="box_img">
                                                <img src="images/user_box_6.png" alt=""/>

                                            </div>
                                            <!--end::Total Number of Bids-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END :: Top box--> 
                        </div>
                        <!--Begin::Section-->
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin:: Widgets/Best Sellers-->
                                <div class="m-portlet m-portlet--full-height dashboard_table">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Manage Visits
                                                </h3>
                                            </div>
                                        </div>
                                        <form class="m-header-search__form dashboard">
                                            <div class="m-header-search__wrapper">
                                                <div class="search">
                                                    <span class="m-header-search__icon-search" id="m_quicksearch_search">
                                                        <i class="la la-search"></i>
                                                    </span>
                                                    <span class="m-header-search__input-wrapper">
                                                        <input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search..." id="ct_data">
                                                    </span> 
                                                </div>
                                                <div class="filter">
                                                    <select class="form-control m-bootstrap-select m_selectpicker" id="status_filter">
                                                        <option>
                                                            Filter By Status
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
                                            </div>
                                        </form>  
                                    </div>

                                    <div id="partialdashboard"></div>
                                </div>

                                
                                <!--end::Widget 11-->
                            </div>
                        </div>
                        <!--end:: Widgets/Best Sellers-->
                    </div>
                </div>
                <!--End::Section-->
                <!-- BEGIN: Modal -->
                <div class="modal fade dashboard_modal" id="modal_target_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    Change Status
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        &times;
                                    </span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">-->
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-sm-12">
                                        Status *
                                    </label>
                                    <div class="col-sm-12">
                                        <select class="form-control m-bootstrap-select m_selectpicker">
                                            <option>
                                                Pending
                                            </option>
                                            <option>
                                                1
                                            </option>
                                            <option>
                                                2
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Form-->
                                <!--</div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">
                                    Change Status
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Modal -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: 'partial_dashboard',
            async: false,
            error: function (error) {
            },
            success: function (result) {
                debugger;
                $("#partialdashboard").html(result.html);
            },
        });
        //pagelink task start
          $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.get(url,function(data){
                    jQuery.ajaxSetup({async:false});
                    $('#partialdashboard').html(data.html);
                });
        });
        $(document).on('change', '#pagination_dashboard', function (e) {
                 debugger;
                var item=$(this).val();
                //var search_task=document.getElementById("search_task_name").value;
                var search_ct = $("#ct_data").val();
                var filter_status = $("#status_filter").val();
                  $.ajax({
                type: 'GET',
                url: 'partial_dashboard',
                data:{items:item, search_ct: search_ct, filter_status : filter_status},
                async: false,
                error: function (error) {
                },
                success: function (result) {
                    $("#partialdashboard").html(result.html);
                },
            });
                 
         });
        $("#ct_data").keyup(function(event) {
        event.preventDefault();
        //debugger;
            var search_ct = $(this).val();
            //var search_status = $("#selectstatus").val();
            //var search_clientid = $("#selectclient").val();
            $.ajax({
                type: 'GET',
                url: 'partial_dashboard',
                data: {search_ct: search_ct},                
                error: function(error) {
                },
                success: function(result) {
                    $("#partialdashboard").html(result.html);
                },
            });        
    });

        $('#ct_data').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) { 
            e.preventDefault();
            return false;
          }
        });
        $(document).on('click','#date_up',function(){
            var date_value = "date_up";
            enabledate(date_value);
        });
        $(document).on('click','#date_down',function(){
            var date_value = "date_down";
            enabledate(date_value);
        });
        function enabledate(date_value)
        {
            $.ajax({
                type: 'GET',
                url: 'partial_dashboard',
                data : {date_value : date_value},
                error: function ()
                {
                },
                success: function()
                {
                    $("#partialdashboard").html(result.html);
                }
            });
        }
        
        //Dash board count function start
         var date_ranges = 'Today';
        $("#hide3").val(date_ranges);
        changerange();
        //Dashboard count function end
        
        //Dash board range
         $('#m_dashboard_daterangepicker').on('apply.daterangepicker', function (ev, picker) {
             alert("dashboaerd");
              debugger;
            var start = picker.startDate.format('YYYY-MM-DD');
            var end = picker.endDate.format('YYYY-MM-DD');
            $("#hide1").val(start);
            $("#hide2").val(end);
        });
          
        $(document).on('click', '.ranges li', function () {
                  var date_range = $(this).text();
                    $("#hide3").val(date_range);
                    changerange();
        });
        function changerange(){
          debugger;
          alert("change");
            $("#total_clients").empty();
            $("#total_ct").empty();
            $("#total_visit").empty();
            $("#total_pending").empty();
            $("#total_inprocess").empty();
            $("#total_completed").empty();
            var start = $("#hide1").val();
            var end = $("#hide2").val();
            var date_a=get_date();
           
           
            var date_range = $("#hide3").val();
          
            //Ajax function starts
            if (date_range === 'Today' || date_range === 'Yesterday') {
                 debugger;
                $.ajax({
                    type: 'GET',
                    url: 'given_date',
                    data: {
                        date: date_a,
                    },
                    contentType: "application/json;charset=utf-8",
                    success: function (data) {
                        debugger;
                        document.getElementById("total_clients").innerHTML = data.total_clients;
                        document.getElementById("total_ct").innerHTML = data.total_ct;
                        document.getElementById("total_visit").innerHTML = data.total_visits;
                        document.getElementById("total_pending").innerHTML = data.total_pending;
                        document.getElementById("total_completed").innerHTML = data.total_completed;
                        document.getElementById("total_inprocess").innerHTML = data.total_inprocess;
                    },
                    error: function (error) {

                    }
                });
            //Ajax function end
            }
            if (date_range === 'Last 7 Days') {
                 $.ajax({
                    type: 'GET',
                    url: 'last_seven_days',
                    data: {
                        date: date_a,
                    },
                    contentType: "application/json;charset=utf-8",
                    success: function (data) {
                        debugger;
                        document.getElementById("total_clients").innerHTML = data.total_clients;
                        document.getElementById("total_ct").innerHTML = data.total_ct;
                        document.getElementById("total_visit").innerHTML = data.total_visits;
                        document.getElementById("total_pending").innerHTML = data.total_pending;
                        document.getElementById("total_completed").innerHTML = data.total_completed;
                        document.getElementById("total_inprocess").innerHTML = data.total_inprocess;
                    },
                    error: function (error) {

                    }
                });
            }
            if (date_range === 'Last 30 Days') {
                $.ajax({
                    type: 'GET',
                    url: 'last_thirty_days',
                    data: {
                        date: date_a,
                    },
                    contentType: "application/json;charset=utf-8",
                    success: function (data) {
                        debugger;
                        document.getElementById("total_clients").innerHTML = data.total_clients;
                        document.getElementById("total_ct").innerHTML = data.total_ct;
                        document.getElementById("total_visit").innerHTML = data.total_visits;
                        document.getElementById("total_pending").innerHTML = data.total_pending;
                        document.getElementById("total_completed").innerHTML = data.total_completed;
                        document.getElementById("total_inprocess").innerHTML = data.total_inprocess;
                    },
                    error: function (error) {

                    }
                });
            }
            if (date_range === 'This Month') {
                $.ajax({
                        type: 'GET',
                        url: 'this_month',
                        data: {
                            date: date_a,
                        },
                        contentType: "application/json;charset=utf-8",
                        success: function (data) {
                            debugger;
                            document.getElementById("total_clients").innerHTML = data.total_clients;
                            document.getElementById("total_ct").innerHTML = data.total_ct;
                            document.getElementById("total_visit").innerHTML = data.total_visits;
                            document.getElementById("total_pending").innerHTML = data.total_pending;
                            document.getElementById("total_completed").innerHTML = data.total_completed;
                            document.getElementById("total_inprocess").innerHTML = data.total_inprocess;
                        },
                        error: function (error) {

                        }
                    });
            }
            if (date_range === 'Last Month') {
                  $.ajax({
                        type: 'GET',
                        url: 'last_month',
                        data: {
                            date: date_a,
                        },
                        contentType: "application/json;charset=utf-8",
                        success: function (data) {
                            debugger;
                            document.getElementById("total_clients").innerHTML = data.total_clients;
                            document.getElementById("total_ct").innerHTML = data.total_ct;
                            document.getElementById("total_visit").innerHTML = data.total_visits;
                            document.getElementById("total_pending").innerHTML = data.total_pending;
                            document.getElementById("total_completed").innerHTML = data.total_completed;
                            document.getElementById("total_inprocess").innerHTML = data.total_inprocess;
                        },
                        error: function (error) {

                        }
                    });
             }
             if (date_range == 'Custom Range') {
                 alert(start);
                 alert(end);
                 
                  $.ajax({
                        type: 'GET',
                        url: 'custom_range',
                        data: {
                              s_date: start,
                              e_date: end
                        },
                        contentType: "application/json;charset=utf-8",
                        success: function (data) {
                            debugger;
                            document.getElementById("total_clients").innerHTML = data.total_clients;
                            document.getElementById("total_ct").innerHTML = data.total_ct;
                            document.getElementById("total_visit").innerHTML = data.total_visits;
                            document.getElementById("total_pending").innerHTML = data.total_pending;
                            document.getElementById("total_completed").innerHTML = data.total_completed;
                            document.getElementById("total_inprocess").innerHTML = data.total_inprocess;
                        },
                        error: function (error) {

                        }
                    });
                 
             }
      }
        
        function get_date() {
            debugger;
        // var ab = document.getElementById("select1").value;
            var date_range = $("#hide3").val();
        // console.log(ab);
            var date = null;
            if (date_range === 'Today') {
                debugger;
                var n = new Date();
                var y = n.getFullYear();
                var m = n.getMonth() + 1;
                var d = n.getDate();
                var date1;
                date1 = y + "-" + m + "-" + d;
                console.log("Today..", date1);
                date = date1;
            }

            if (date_range === 'Yesterday') {
                debugger;
                var da = new Date();
                var curr_date = da.getDate() - 1;
                var curr_month = da.getMonth() + 1;
                var curr_year = da.getFullYear();
                var yesterday;
                yesterday = curr_year + "-" + curr_month + "-" + curr_date;
                console.log("Yesterday..", yesterday);
                date = yesterday;
            }

            if (date_range === 'Last 3 Days') {
                    debugger;
                var result2 = [];
                for (var i = 1; i < 4; i++) {
                    var dt = new Date();
                    dt.setDate(dt.getDate() - i);
                    var y = dt.getFullYear();
                    var m = dt.getMonth() + 1;
                    var d = dt.getDate();
                    var cal = y + "-" + m + "-" + d;
                    result2.push(cal)
            }
                console.log("Last 3 Days..", result2);
                date = result2;
            }
            if (date_range === 'Last 7 Days') {
                    debugger;
                var result3 = [];
                for (var i = 1; i < 8; i++) {
                    var dt = new Date();
                    dt.setDate(dt.getDate() - i);
                    var y = dt.getFullYear();
                    var m = dt.getMonth() + 1;
                    var d = dt.getDate();
                    var cal = y + "-" + m + "-" + d;
                    result3.push(cal)
                }
                console.log("Last 7 Days..", result3);
                date = result3;
            }

            if (date_range === 'Last 30 Days') {
                debugger;
                var result4 = [];
                for (var i = 1; i < 31; i++) {
                    var dt = new Date();
                    dt.setDate(dt.getDate() - i);
                    var y = dt.getFullYear();
                    var m = dt.getMonth() + 1;
                    var d = dt.getDate();
                    var cal = y + "-" + m + "-" + d;
                    result4.push(cal)
                }
                console.log("Last 30 Days..", result4);
                date = result4;
            }

        if (date_range === 'This Month') {
            debugger;
            var result = [];
            var nowdate = new Date();
            var monthStartDay = new Date(nowdate.getFullYear(), nowdate.getMonth(), 0);
            var monthEndDay = new Date(nowdate.getFullYear(), nowdate.getMonth() + 1, 0);
            var getDateArray = function (start, end) {
                var arr = [];
                var dt = new Date(start);
                while (dt < end) {
                    arr.push(new Date(dt));
                    dt.setDate(dt.getDate() + 1);
                    var y = dt.getFullYear();
                    var m = dt.getMonth() + 1;
                    var d = dt.getDate();
                    var cal = y + "-" + m + "-" + d;
                    result.push(cal)
                }
                return result;
            }
            var dateArr = getDateArray(monthStartDay, monthEndDay);
            console.log("This Month..", dateArr);
            date = dateArr;
        }

        if (date_range === 'Last Month') {
            debugger;
            var result1 = [];
            var nowdate1 = new Date();
            var monthStartDay1 = new Date(nowdate1.getFullYear(), nowdate1.getMonth() - 1, 0);
            var monthEndDay1 = new Date(nowdate1.getFullYear(), nowdate1.getMonth(), 0);
            var getDateArray1 = function (start, end) {
                var arr = [];
                var dt = new Date(start);
                while (dt < end) {
                    arr.push(new Date(dt));
                    dt.setDate(dt.getDate() + 1);
                    var y = dt.getFullYear();
                    var m = dt.getMonth() + 1;
                    var d = dt.getDate();
                    var cal = y + "-" + m + "-" + d;
                    result1.push(cal)
                }
                return result1;
            }
            var dateArr1 = getDateArray1(monthStartDay1, monthEndDay1);
            console.log("Last Month..", dateArr1);
            date = dateArr1;
        }

        if (date_range === 'This Year' || date_range === 'Last Year') {
            debugger;
            var dateArr = [];
            var nowdate = new Date();
            var year = nowdate.getFullYear();
            if (date_range === 'Last Year')
                year = year - 1;
            var result = [];
            var start_date = year + "-" + 01 + "-" + 01;
            var end_date = year + "-" + 12 + "-" + 31;
            dateArr.push(start_date)
            dateArr.push(end_date)
            //  console.log(ab, dateArr);
            date = dateArr;
        }

        return date;
    }
    });
</script>
@stop