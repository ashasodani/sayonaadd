<!--denish code-->
<div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table client_managemnet_service">
                        <!--begin::Thead-->
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Client Id</th>
                                <th>Client Name</th>
                                <th>Service Group</th>
                                <th>No. of Service Name</th>
                                <th>No. of Tasks</th>
                                <th>Allocated Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($visited as $visit)
                            <tr>
                                <td>{{$visit->service_date}}</td>
                                <td>{{$visit->fk_client_id}}</td>
                                <td>{{$visit->client_name}}</td>
                                <td>{{$visit->service_grp_name}}</td>
                                <td>{{$visit->ser_cnt}}</td>
                                <td>{{$visit->task_cnt}}</td>
                                <td>{{$visit->allocated_time}}</td>
                                <td>
                                    <a href="javascript:void(0);" class="edit_icon"><img src="images/edit_icon.png" alt=""></a>
                                    <a href="javascript:void(0);" class="edit_icon"><img src="images/pencil.png" alt=""></a>
                                    <a href="javascript:void(0);" allocated_visit_id="{{$visit->pk_client_id}}" class="edit_icon del_allocated_visit"><img src="images/Delete.png" alt=""></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>   
                </div>
                <div class="show_pagintion">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_length" id="m_table_1_length">
                                <select name="allocated_clients" aria-controls="m_table_1" class="form-control form-control-sm" onchange="allvisitedclientFilterPaginationAjax();">
                                    <option {{$perpage == 10 ? 'selected' : ''}}>10</option>
                                        <option {{$perpage == 20 ? 'selected' : ''}}>20</option> 
                                        <option {{$perpage == 30 ? 'selected' : ''}}>30</option> 
                                        <option {{$perpage == 50 ? 'selected' : ''}}>50</option> 
                                        <option {{$perpage == 100 ? 'selected' : ''}}>100</option> 
                                </select>
                                 <span class="m-datatable__pager-detail">Showing {{$visited->firstItem()}} - {{$visited->lastItem()}} of {{$visited->total()}}</span>
                                <!-- <span>Showing 1 -10 of 80</span></div> -->
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers clientvisted">
                                {{$visited->links()}}
                            </div>
                        </div>
                    
                    </div>
                </div>
<!--                <div class="show_pagintion">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_length" id="m_table_1_length">
                                <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" onchange="allvisitedclientFilterPaginationAjax();">
                                    <option {{$perpage == 10 ? 'selected' : ''}}>10</option>
                                        <option {{$perpage == 20 ? 'selected' : ''}}>20</option> 
                                        <option {{$perpage == 30 ? 'selected' : ''}}>30</option> 
                                        <option {{$perpage == 50 ? 'selected' : ''}}>50</option> 
                                        <option {{$perpage == 100 ? 'selected' : ''}}>100</option> 
                                </select>
                                <span class="m-datatable__pager-detail">Showing {{$visited->firstItem()}} - {{$visited->lastItem()}} of {{$visited->total()}}</span>
                                 <span>Showing 1 -10 of 80</span></div> 
                             </div>
                        </div>
                    
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers clientvisted">
                                {{$visited->links()}}
                            </div>
                        </div>
                        </div>
                </div>-->