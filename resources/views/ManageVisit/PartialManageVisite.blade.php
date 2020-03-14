<div class="m-portlet__body">
    <!--begin::Widget 11-->
    <div class="m-widget11">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table">
                <!--begin::Thead-->
                <thead>
                    <tr>
                        <th class="m-widget11_client_id">
                            Client Id
                        </th>
                        <th class="m-widget11__Client_Name">
                            Client Name
                        </th>
                        <th class="m-widget11__Contact_Number">
                            Client Contact Number
                        </th>
                        <th class="m-widget11__name">
                            CT Name
                        </th>
                        <th class="m-widget11__ct_contact">
                            CT Contact Number
                        </th>
                        <th class="m-widget11__service">
                            Service group
                        </th>
                        <th class="m-widget11__visit-date">
                            Visit Date
                <div class="table_arrow">
                    <a class="up_arrow" id="up_date" data-id="up_date">
                        <img src="images/up_arrow.png">
                    </a>
                    <a class="down_arrow" id="down_date" data-id="down_date">
                        <img src="images/down_arrow.png"> 

                    </a>
                </div>
                </th>
                <th class="m-widget11__time">
                    Time
                <div class="table_arrow">
                    <a class="up_arrow" id="up_time" data-id="up_time">
                        <img src="images/up_arrow.png">
                    </a>
                    <a class="down_arrow" id="down_time" data-id="down_time">
                        <img src="images/down_arrow.png"> 

                    </a>
                </div>
                </th>
                <th class="m-widget11__visit-status">
                    Visit Status
                </th>
                <th class="m-widget11__action">
                    Action
                </th>
                </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->

                <tbody>
                    @if(count($manage_detail) > 0)
                    @foreach($manage_detail as $manage_data)
                    <tr>
                       
                        
                        <td  data-title="Client Id">
                            <span>{{$manage_data->client_view_id}}</span>
                        </td>
                        <td  data-title="Client Name">
                            <span>{{$manage_data->client_name}}</span>
                        </td>
                        <td  data-title="Client Contact Number">
                            <span>{{$manage_data->client_contact_no}}</span>
                        </td>
                        <td  data-title="CT Name">
                            <span>{{$manage_data->ct_name}}</span>
                        </td>
                        <td  data-title="CT Contact Number">
                            <span>{{$manage_data->ct_contact_info}}</span>
                        </td>
                        <td  data-title="Service">
                            <span>{{$manage_data->names}}</span>
                        </td>
                        <td  data-title="Visit Date">
                            <span>{{$manage_data->visit_date}}</span>
                        </td>
                        <td  data-title="Time">
                            <span>{{$manage_data->start_time}}</span>
                        </td>

                        <td data-title="Visit Status">
                            @if($manage_data->visit_status == "Pending")
                            <a href="javascript:void(0);" class="pending_btn">Pending</a>
                            @elseif($manage_data->visit_status == "Completed")
                            <a href="javascript:void(0);" class="pending_btn completed_btn">Completed</a>
                            @elseif($manage_data->visit_status == "Inprogress")
                            <a href="javascript:void(0);" class="pending_btn progress_btn">In Progress</a>
                            @endif
                        </td>
                        <td data-title="Action">
                            <a href="{{URL::to('view_manage_visit?id=')}}{{$manage_data->pk_visits_id}}" class="edit_icon"><img src="images/edit_icon.png" alt=""/></a>
                            <a href="{{URL::to('edit_manage_visit?id=')}}{{$manage_data->pk_visits_id}}" class="edit_icon"><img src="images/pencil.png" alt=""/></a>

                            <a href="javascript:void(0);" class="edit_icon" data-id="{{$manage_data->pk_visits_id}}" data-toggle="modal" data-target="#modal_target_233" id="delete_visit_model"><img src="images/Delete.png" alt=""/></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="no_dt"><td colspan="10">NODATA</td></tr>
                    @endif
                </tbody>


                <!--end::Tbody-->
            </table>
        </div>
        <div class="show_pagintion">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_length" id="m_table_1_length">
                        <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="managevisitdata">
                            <option value="10" @if($items == 10) selected @endif>10</option>
                            <option value="20" @if($items == 20) selected @endif>20</option>
                            <option value="50" @if($items == 50) selected @endif>50</option>
                            <option value="100" @if($items == 100) selected @endif>100</option>
                        </select>
                        <span>Showing {{($manage_detail->currentpage()-1)*$manage_detail->perpage()+1}} - {{$manage_detail->currentpage()*$manage_detail->perpage()}} of {{$manage_detail->total()}}</span></div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            {{ $manage_detail->appends(\Request::except('_token'))->render() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--end::Table-->
</div>