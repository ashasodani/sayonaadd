
                                    
                                    <div class="m-portlet__body">
                                        <!--begin::Widget 11-->
                                        <div class="m-widget11">
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table">
                                                    <!--begin::Thead-->
                                                    <thead>
                                                        <tr>
                                                            <td class="m-widget11_client_id">
                                                                Client Id
                                                            </td>
                                                            <td class="m-widget11__Client_Name">
                                                                Client Name
                                                            </td>
                                                            <td class="m-widget11__Client_Contact_Number">
                                                                Client Contact Number
                                                            </td>
                                                            <td class="m-widget11__CT_Name">
                                                                CT Name
                                                            </td>
                                                            <td class="m-widget11__Contact_No">
                                                                CT Contact Number
                                                            </td>
                                                            <td class="m-widget11__service">
                                                                Service
                                                            </td>
                                                            <td class="m-widget11__visit_date">
                                                                Visit Date
                                                                <a class="up_arrow" id="date_up"><img src="images/up_arrow.png" alt=""/></a>
                                                                <a class="down_arrow" id="date_down"><img src="images/down_arrow.png" alt=""/></a>     
                                                            </td>
                                                            <td class="m-widget11__time">
                                                                Time
                                                                <a class="up_arrow"><img src="images/up_arrow.png" alt=""/></a>
                                                                <a class="down_arrow"><img src="images/down_arrow.png" alt=""/></a>     
                                                            </td>
                                                            <td class="m-widget11__visit_status">
                                                                Visit Status
                                                            </td>
                                                            <td class="m-widget11__action">
                                                                Action
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <!--end::Thead-->
                                                    <!--begin::Tbody-->
                                                    <tbody>
                                                        @foreach($visit_detail as $visit_data)
                                                        <tr>
                                                            <td  data-title="id">
                                                                <span>{{$visit_data->client_id}}</span>
                                                            </td>
                                                            <td  data-title="Client_name">
                                                                <span>{{$visit_data->client_name}}</span>
                                                            </td>
                                                            <td  data-title="Contact_no">
                                                                <span>+{{$visit_data->client_contact_no}}</span>
                                                            </td>
                                                            <td  data-title="CT_name">
                                                                <span>{{$visit_data->ct_name}}</span>
                                                            </td>
                                                            <td  data-title="CT Contact Number">
                                                                <span>{{$visit_data->ct_contact_info}}</span>
                                                            </td>
                                                            <td  data-title="Service">
                                                                <span>{{$visit_data->names}}</span>
                                                            </td>

                                                            <td data-title="Visit Date">
                                                                <span>{{$visit_data->visit_date}}</span>
                                                            </td>
                                                            <td data-title="time">
                                                                <span>{{$visit_data->start_time}}
                                                                </span>
                                                            </td>
                                                            <td data-title="Visit Status">
                                                                <a href="javascript:void(0);" class="pending_btn">{{$visit_data->visit_status}}</a>
                                                                <!--                                                                                                            <a href="javascript:void(0);" class="change_status_btn" data-toggle="modal" data-target="#modal_target_1">Change Status</a>-->
                                                            </td>
                                                            <td data-title="Action">
                                                                <a href="javascript:void(0);" class="edit_icon"><img src="images/edit_icon.png" alt=""/></a>
                                                                <a href="javascript:void(0);" class="edit_icon"><img src="images/pencil.png" alt=""/></a>
                                                                <a href="javascript:void(0);" class="edit_icon" data-toggle="modal" data-target="#modal_target_3"><img src="images/Delete.png" alt=""/></a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>

                                                    <!--end::Tbody-->
                                                </table>
                                            </div>
                                            <div class="show_pagintion">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <div class="dataTables_length" id="m_table_1_length">
                                                            <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="pagination_dashboard"> 
                                                                <option value="10" @if($items == 10) selected @endif>10</option>
                                                        <option value="25" @if($items == 25) selected @endif>25</option>
                                                        <option value="50" @if($items == 50) selected @endif>50</option>
                                                        <option value="100" @if($items == 100) selected @endif>100</option>
                                                            </select>
                                                            <span>Showing 
                                {{($visit_detail->currentpage()-1)*$visit_detail->perpage()+1}} - {{$visit_detail->currentpage()*$visit_detail->perpage()}} of {{$visit_detail->total()}}</span></div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <div class="dataTables_paginate paging_simple_numbers">
                                                            <ul class="pagination">
                                                                {{ $visit_detail->appends(\Request::except('_token'))->render() }}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Table-->
                                    </div>
                                </div>