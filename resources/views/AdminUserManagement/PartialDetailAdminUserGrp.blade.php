<div class="m-portlet__body">
                    <!--begin::Widget 11-->
                    <div class="m-widget11">
                        <div class="table-responsive Admin_user_group">
                            <!--begin::Table-->
                           <!--begin::Table-->
                                                <table class="table">
                                                    <!--begin::Thead-->
                                                    <thead>
                                                        <tr>
                                                            <td class="id">
                                                                No.
                                                            </td>
                                                            <td class="name">
                                                                Admin Name 
                                                            </td>
                                                            <td class="address">
                                                                Address
                                                            </td>
                                                            <td class="Contact Number">
                                                                Contact Number
                                                            </td>
                                                            <td class="Date of Birth">
                                                                Date of Birth
                                                            </td>
                                                            <td class="Age">
                                                                Age
                                                            </td>
                                                            <td class="Gender">
                                                                Gender
                                                            </td>
                                                            <td class="action">
                                                                Action
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <!--end::Thead-->
                                                    <!--begin::Tbody-->
                                                    <tbody>
                                                            @php $i=1; @endphp
                                                            @foreach($admin_data_as as $all_user_data)
                                                        <tr>
                                                            <td data-title="no">
                                                                <span>1</span>
                                                            </td>
                                                            <td  data-title="admin name">
                                                                <span>{{$all_user_data->admin_name}}</span>
                                                            </td>
                                                            <td data-title="address">
                                                                <span>{{$all_user_data->address}}</span>
                                                            </td>
                                                            <td  data-title="Contact number">
                                                                <span>+{{$all_user_data->contact_number}}</span>
                                                            </td>
                                                            <td data-title="date of birth">
                                                                <span>{{date('d F Y', strtotime($all_user_data->dob))}}</span>
                                                            </td>
                                                            <td data-title="age">
                                                                <span>{{$all_user_data->age}}</span>
                                                            </td>
                                                            <td  data-title="Gender">
                                                                <span>{{$all_user_data->gender}}</span>
                                                            </td>
                                                            <td data-title="Action">
                                                                <a href="javascript:void(0);" class="edit_icon" id="edit_all_user_admin" data-toggle="modal" data-target="#modal_target_56" data-id="{{$all_user_data->pk_admin_users_id}}"><img src="../images/pencil.png" alt=""/></a>
                                                                <a href="javascript:void(0);" class="edit_icon"  data-toggle="modal" id="delete_all_user_admins" data-target="#modal_target_65" data-id="{{$all_user_data->pk_admin_users_id}}"><img src="../images/Delete.png" alt=""/></a>
                                                            </td>
                                                        </tr>
                                                          @php $i++; @endphp
                                                          @endforeach
                                                    </tbody>

                                                    <!--end::Tbody-->
                                                </table>
                                            </div>
                         <div class="show_pagintion">
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_length" id="m_table_1_length">
                                        <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="admin_paginattion_number_detail">
                                              <option value="1" @if($items == 10) selected @endif>1</option>
                                                <option value="2" @if($items == 2) selected @endif>2</option>
                                                <option value="5" @if($items == 5) selected @endif>5</option>
                                                <option value="10" @if($items == 10) selected @endif>10</option>
                                        </select>
                                        <span>Showing {{($admin_data_as->currentpage()-1)*$admin_data_as->perpage()+1}} - {{$admin_data_as->currentpage()*$admin_data_as->perpage()}} of {{$admin_data_as->total()}}</span></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                         <ul class="pagination">
                                            {{ $admin_data_as->appends(\Request::except('_token'))->render() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                                        </div>
                                        <!--end::Table-->
                        </div>
                        

                    </div>
                    <!--end::Table-->
                </div>