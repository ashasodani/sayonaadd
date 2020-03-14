<div class="m-portlet__body">
    <!--begin::Widget 11-->
    <div class="m-widget11">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table">
                <!--begin::Thead-->
                <thead>
                <tr>
                    <th class="th_h">Task Name</th>
                    <th class="th_h">Task Description</th>
                    <th class="th_h">Service Name</th>
                    <th class="th_h">Service Group</th>
                    <th class="th_h">Action</th>
                </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td  data-title="Task Group">{{$task->task_name}}</td>

                        <td  data-title="Tasks Description"> {{ Str::limit($task->task_description, 100) }}</td>
                        <td  data-title="Service Name">{{$task->service_name}}</td>
                        <td  data-title="Service Group">{{$task->service_grp_name}}</td>
                        <td data-title="Action">
                            <a href="#" class="edit_icon" data-toggle="modal" data-target="#modal_target_11"  data-id="{{$task->pk_task_id}}" id="edit_task_a"><img src="images/pencil.png" /></a>
                            <a href="javascript:void(0);" class="edit_icon" data-id="{{$task->pk_task_id}}" data-toggle="modal" data-target="#modal_target_53" id="delete_task_model"><img src="images/Delete.png"/></a>
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
                        <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="pagination_task">
                            <option value="1" @if($items == 10) selected @endif>1</option>
                            <option value="2" @if($items == 2) selected @endif>2</option>
                            <option value="5" @if($items == 5) selected @endif>5</option>
                            <option value="10" @if($items == 10) selected @endif>10</option>
                        </select>
                        <span>Showing {{($tasks->currentpage()-1)*$tasks->perpage()+1}} - {{$tasks->currentpage()*$tasks->perpage()}} of {{$tasks->total()}}</span></div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            {{ $tasks->appends(\Request::except('_token'))->render() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Table-->
</div>
</div>

