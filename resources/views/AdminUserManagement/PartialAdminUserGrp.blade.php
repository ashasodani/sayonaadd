@if(count($all_admin_user)>0)
<div class="m-portlet__body">
                    <!--begin::Widget 11-->
                    <div class="m-widget11">
                        <div class="table-responsive All_admin">
                            <!--begin::Table-->
                            <table class="table">
                                <!--begin::Thead-->
                                <thead>
                                <tr>
                                    <td class="m-widget11_Admin_Id">
                                        Admin Id
                                    </td>
                                    <td class="m-widget11__Admin_Name">
                                        Admin Name
                                    </td>
                                    <td class="m-widget11__Address">
                                        Address
                                    </td>
                                    <td class="m-widget11__Contact_Number">
                                        Contact Number
                                    </td>
                                    <td class="m-widget11__Age">
                                        Age
                                    </td>
                                    <td class="m-widget11__Gender">
                                        Gender
                                    </td>
                                    <td class="m-widget11__Assigned_Admin_Group">
                                        Assigned Admin Group
                                    </td>
                                    <td></td>
                                    <td class="m-widget11__action">
                                        Action
                                    </td>
                                </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody id="user_admin_data">
                                       @php $i=1; @endphp
                                        @foreach($all_admin_user as $all_user)
                                <tr>
                                    <td  data-title="{{$all_user->pk_admin_users_id}}">
                                        <span>{{$all_user->pk_admin_users_id}}</span>
                                        
                                    </td>
                                    <td  data-title="Admin_name">
                                        <span>{{$all_user->admin_name}}</span>
                                    </td>
                                    <td  data-title="Address">
                                        <span>{{$all_user->address}}</span>
                                    </td>
                                    <td  data-title="Contact_no">
                                        <span>+{{$all_user->contact_number}}</span>
                                    </td>
                                    <td  data-title="age">
                                        <span>{{$all_user->age}}</span>
                                    </td>
                                    <td  data-title="Gender">
                                        <span>{{$all_user->gender}}</span>
                                    </td>
                                    <td  data-title="Assigned Admin Group">
                                        <span>{{$grp_name[$all_user->pk_admin_users_id]}}</span>
                                    </td>
                                    <td class="blue_button">
                                        <a href="#" class="change_Group_btn">Change Group</a>
                                    </td>

                                    <td data-title="Action">
<!--                                          <a href="#" class="Add_new_admin" data-toggle="modal" data-target="#modal_target_5">Add New Admin User</a>-->
                                        <a href="#" class="edit_icon "  id="view_all_user"  data-toggle="modal"  data-target="#modal_target_5" data-id="{{$all_user->pk_admin_users_id}}"><img src="images/edit_icon.png" alt=""/></a>
                                        <a href="#" class="edit_icon" id="edit_all_user_admin"  data-toggle="modal"  data-target="#modal_target_5" data-id="{{$all_user->pk_admin_users_id}}"><img src="images/pencil.png"  alt=""/></a>
                                        <a href="#" class="edit_icon"  data-toggle="modal" data-target="#modal_target_65" id="delete_all_user_admins" data-id="{{$all_user->pk_admin_users_id}}"><img src="images/Delete.png"  alt=""/></a>
                                    </td>
                                </tr>
                                  @php $i++; @endphp
                                        @endforeach
                                
                                </tbody>

                                <!--end::Tbody-->
                            </table>
                             <span id="data_not_show"></span>
                        </div>
                        <div class="show_pagintion">
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_length" id="m_table_1_length">
                                        <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="admin_paginattion_number">
                                              <option value="1" @if($items == 10) selected @endif>1</option>
                                                <option value="2" @if($items == 2) selected @endif>2</option>
                                                <option value="5" @if($items == 5) selected @endif>5</option>
                                                <option value="10" @if($items == 10) selected @endif>10</option>
                                        </select>
                                        <span>Showing {{($all_admin_user->currentpage()-1)*$all_admin_user->perpage()+1}} - {{$all_admin_user->currentpage()*$all_admin_user->perpage()}} of {{$all_admin_user->total()}}</span></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                         <ul class="pagination">
                                            {{ $all_admin_user->appends(\Request::except('_token'))->render() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Table-->
                </div>
@else
<div class="no_record_admin">No Record Found</div>
@endif

                

