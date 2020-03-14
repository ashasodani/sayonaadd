<!--denish code-->
<div class="m-portlet m-portlet--full-height client_tabel ">
            <div class="m-section ">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table client_service">
                        <!--begin::Thead-->
                        <thead>
                            <tr>
                                <th>Client Id</th>
                                <th>Client Name</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Health Conditions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_clients_infos as $allocated_client)

                            <tr>
                                <td>{{$allocated_client->pk_client_id}}</td>
                                <td>{{$allocated_client->client_name}}</td>
                                <td>{{$allocated_client->client_contact_no}}</td>
                                <td>{{$allocated_client->client_address}}</td>
                                <td>{{$allocated_client->health_conditions}}</td>
                                <td>
                                    <a href="javascript:void(0);" class="edit_icon"><img src="images/edit_icon.png" alt=""></a>
                                    <a href="javascript:void(0);" class="edit_icon"><img src="images/pencil.png" alt=""></a>
                                    <a href="{{URL::to('delete_ct_allocate_client?id=')}}{{$allocated_client->pk_client_id}}" allocated_client_id="{{$allocated_client->pk_client_id}}" class="edit_icon del_allocated_client"><img src="images/Delete.png" alt=""></a>
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
                                <select name="allocated_clients" aria-controls="m_table_1" class="form-control form-control-sm" onchange="allallocatedclientFilterPaginationAjax();">
                                    <option {{$perpage == 10 ? 'selected' : ''}}>10</option>
                                        <option {{$perpage == 20 ? 'selected' : ''}}>20</option> 
                                        <option {{$perpage == 30 ? 'selected' : ''}}>30</option> 
                                        <option {{$perpage == 50 ? 'selected' : ''}}>50</option> 
                                        <option {{$perpage == 100 ? 'selected' : ''}}>100</option> 
                                </select>
                                 <span class="m-datatable__pager-detail">Showing {{$tbl_clients_infos->firstItem()}} - {{$tbl_clients_infos->lastItem()}} of {{$tbl_clients_infos->total()}}</span>
                                <!-- <span>Showing 1 -10 of 80</span></div> -->
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers clientlist">
                                {{$tbl_clients_infos->links()}}
                            </div>
                        </div>
                    
                    </div>
                </div>

        
</div>
</div>