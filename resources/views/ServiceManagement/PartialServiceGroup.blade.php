<div class="m-portlet__body">
    <!--begin::Widget 11-->
    <div class="m-widget11">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table">
                <!--begin::Thead-->
                <thead>
                <tr>
                    <th class="th_h">Service Group</th>
                    <th class="th_h">No.of Service Name</th>
                    <th class="th_h">No.of Tasks</th>
                    <th class="th_h">Action</th>
                </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody>
                @foreach($service_groups as $service_grp)
                    <tr>
                        <td  data-title="service_group">{{$service_grp->service_group_name}}</td>
                        <td  data-title="no_service_name">{{$service_grp->total_services}}</td>
                        <td  data-title="no_task">{{$service_grp->total_task}}</td>
                        <td data-title="Action">
                            <a href="service_grp_detail/{{$service_grp->pk_service_group_id}}" class="edit_icon"><img src="images/edit_icon.png" alt=""/></a>
                            <a href="javascript:void(0);" class="edit_icon" data-toggle="modal" data-target="#modal_target_9" data-id="{{$service_grp->pk_service_group_id}}" id="service_grp_edit"><img src="images/pencil.png" alt=""/></a>
                            <a href="javascript:void(0);" class="edit_icon" data-id="{{$service_grp->pk_service_group_id}}"  id="service_grp_model_id" data-toggle="modal" data-target="#modal_target_51"><img src="images/Delete.png" alt=""/></a>
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
                        <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="pagination_services_group">
                            <option value="1" @if($items == 10) selected @endif>1</option>
                            <option value="2" @if($items == 2) selected @endif>2</option>
                            <option value="5" @if($items == 5) selected @endif>5</option>
                            <option value="10" @if($items == 10) selected @endif>10</option>
                        </select>
                        <span>Showing {{($service_groups->currentpage()-1)*$service_groups->perpage()+1}} - {{$service_groups->currentpage()*$service_groups->perpage()}} of {{$service_groups->total()}}</span></div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            {{ $service_groups->appends(\Request::except('_token'))->render() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Table-->
</div>


