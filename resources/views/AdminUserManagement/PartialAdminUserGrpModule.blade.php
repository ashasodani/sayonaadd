<div class="m-portlet__body">
                            <!--begin::Widget 11-->
                            <div class="m-widget11">
                                <div class="table-responsive Admin_user_group">
                                    <!--begin::Table-->
                                    <table class="table">
                                        <!--begin::Thead-->
                                        <thead>
                                        <tr>
                                            <td class="m-widget11_Group_name">
                                                Group Name
                                            </td>
                                            <td class="m-widget11__No_of_Members">
                                                No. of Member
                                            </td>
                                            <td class="m-widget11__Assign_modules">
                                                Assigned Modules
                                            </td>
                                            <td class="m-widget11__action">
                                                Action
                                            </td>
                                        </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody>
                                        @foreach($admin_groups as $admin_group)
                                        <tr>
                                            <td  data-title="Group_name">
                                                <span>{{$admin_group->group_name}}</span>
                                            </td>
                                            <td  data-title="No_of_Members">
                                                <span>{{$admin_group->total_members}}</span>
                                            </td>
                                            <td  data-title="Assign_modules">
                                                <span>{{$admin_group->names}}</span>
                                            </td>
                                            <td data-title="Action">
                                                <a href="admin_user_group_det/{{$admin_group->pk_group_id}}" class="edit_icon"><img src="images/edit_icon.png" alt=""/></a>
                                                <a href="#" class="edit_icon" id="edit_admin_grp_id" data-toggle="modal" data-target="#modal_target_6" data-id="{{$admin_group->pk_group_id}}"><img src="images/pencil.png"/></a>
                                                <a href="#" class="edit_icon" id="delete_admin_grp_id" data-id="{{$admin_group->pk_group_id}}" ><img src="images/Delete.png" alt=""/></a>
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
                                                <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="paginationmodule">
                                                    <option value="10" @if($items == 10) selected @endif>10</option>
                                                    <option value="25" @if($items == 25) selected @endif>25</option>
                                                    <option value="50" @if($items == 50) selected @endif>50</option>
                                                    <option value="100" @if($items == 100) selected @endif>100</option>
                                                </select>
                                                <span>Showing {{($admin_groups->currentpage()-1)*$admin_groups->perpage()+1}} - {{$admin_groups->currentpage()*$admin_groups->perpage()}} of {{$admin_groups->total()}}</span></div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers">
                                                <ul class="pagination">
                                                    {{ $admin_groups->appends(\Request::except('_token'))->render() }}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end::Table-->
                        </div>