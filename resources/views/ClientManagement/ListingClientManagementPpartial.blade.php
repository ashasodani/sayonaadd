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
                            Contact Number
                        </th>
                        <th class="m-widget11__Age">
                            Age
                        </th>
                        <th class="m-widget11__Gender">
                            Gender
                        </th>
                        <th class="m-widget11__Next_of_Kin">
                            Next of Kin
                        </th>
                        <th class="m-widget11__Contact_No">
                            Contact Number
                        </th>
                        <th class="m-widget11__CT_Assign_Status">
                            CT Assign Status
                        </th>
                        <th class="m-widget11__visit_date">
                            Profile Status
                        </th>
                        <th class="m-widget11__action">
                            Action
                        </th>
                    </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody class="d_cm_tbody">
                    @php 
                    function generate_numbers($start, $count, $digits) {
                        $result = str_pad($start, $digits, "0", STR_PAD_LEFT);  
                        return $result;
                    }
                    @endphp
                    @foreach($getClientData as $ClientData)
                    <tr>
                        <td data-title="id">
                            <span>{{$ClientData->client_view_id}}</span>
                        </td>
                        <td data-title="Client_name">
                            <span>{{$ClientData->client_name}}</span>
                        </td>
                        <td data-title="Contact_no">
                            <span>{{$ClientData->client_contact_no}}</span>
                        </td>
                        <td data-title="age">
                            <span>{{$ClientData->client_age}}</span>
                        </td>
                        <td data-title="Gender">
                            <span>{{$ClientData->client_gender}}</span>
                        </td>
                        <td data-title="Next of Kin">
                            <span>{{$ClientData->kin_name}}</span>
                        </td>
                        <td data-title="Contact Number">
                            <span>{{$ClientData->kin_phone_no}}</span>
                        </td>
                        <td data-title="CT Assign Status">
                            @if($ClientData->fk_ct_id != 0)
                            <span class="assign">Assigned</span>
                            @else
                            <span class="unassign">Unassigned</span>
                            @endif
                        </td>

                        <td data-title="Profile Status">
                            @if($ClientData->is_active == 1)
                            <a href="javascript:void(0);" class="active_btn d_status_show" data-client-id="{{$ClientData->pk_client_id}}">Active</a>
                            <a href="javascript:void(0);" class="Change_status_btn d_change_status" data-toggle="modal" data-target="#modal_target_1" data-client-id="{{$ClientData->pk_client_id}}">Change Status</a>
                            @else
                            <a href="javascript:void(0);" class="Inactive_btn d_status_show" data-client-id="{{$ClientData->pk_client_id}}">Inactive</a>
                            <a href="javascript:void(0);" class="Change_status_btn d_change_status" data-toggle="modal" data-target="#modal_target_1" data-client-id="{{$ClientData->pk_client_id}}">Change Status</a>
                            @endif                            
                        </td>
                        <td data-title="Action">
                            <a href="{{url('viewClient/'.$ClientData->pk_client_id)}}" class="edit_icon d_cm_view" data-client-id="{{$ClientData->pk_client_id}}"><img src="images/edit_icon.png" alt="" /></a>
                            <a href="{{url('editClient/'.$ClientData->pk_client_id)}}" class="edit_icon d_cm_edit" data-client-id="{{$ClientData->pk_client_id}}"><img src="images/pencil.png" alt="" /></a>
                            <a href="javascript:;" class="edit_icon d_cm_delete_open_mdl" data-toggle="modal"
                                    data-target="#modal_target_3" data-client-id="{{$ClientData->pk_client_id}}"><img src="images/Delete.png" alt="" /></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>

                <!--end::Tbody-->
            </table>
            <span class="msg_search_data"></span>
        </div>
        <div class="show_pagintion">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_length d_cm_data_showhide">
                        <select aria-controls="m_table_1" class="form-control form-control-sm" id="cld_pageLength_dropdown" name="cld_pageLength_dropdown">
                            <option value="1" {{$query == 1 ? 'Selected' : ''}}>1</option>                            
                            <option value="10" {{$query == 10 ? 'Selected' : ''}}>10</option>
                            <option value="25" {{$query == 25 ? 'Selected' : ''}}>25</option>
                            <option value="50" {{$query == 50 ? 'Selected' : ''}}>50</option>
                            <option value="100" {{$query == 100 ? 'Selected' : ''}}>100</option>
                        </select>
                        <span>Showing  {{ $getClientData->firstItem() }} - {{ $getClientData->lastItem() }} of {{$getClientData->total()}}</span></div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                    @if ($getClientData->lastPage() > 1)
                    <ul class="pagination client_data_pagination">
                        <li class="paginate_button page-item previous {{ ($getClientData->currentPage() == 1) ? 'disabled' : '' }}">
                            <a href="{{ $getClientData->url(1) }}"><img src="{{ URL::asset('images/pagi_arrow_left.png') }}" alt=""></a>
                        </li>
                        <li class="paginate_button page-item previous {{ ($getClientData->currentPage() == $getClientData->onFirstPage()) ? 'disabled' : '' }}">
                            <a href="{{ $getClientData->url($getClientData->currentPage()-1) }}" ><i class="la la-angle-left"></i></a>
                        </li>
                        <?php $link_limit = 7; ?>
                        @for ($i = 1; $i <= $getClientData->lastPage(); $i++)                                                        
                        <?php
                        $half_total_links = floor($link_limit / 2);
                        $from = $getClientData->currentPage() - $half_total_links;
                        $to = $getClientData->currentPage() + $half_total_links;
                        if ($getClientData->currentPage() < $half_total_links) {
                            $to += $half_total_links - $getClientData->currentPage();
                        }
                        if ($getClientData->lastPage() - $getClientData->currentPage() < $half_total_links) {
                            $from -= $half_total_links - ($getClientData->lastPage() - $getClientData->currentPage()) - 1;
                        }
                        ?>
                        @if ($from < $i && $i < $to)
                        <li class="paginate_button page-item {{ ($getClientData->currentPage() == $i) ? 'active' : '' }}">
                            <a href="{{ $getClientData->url($i) }}" class="page-link">{{ $i }}</a>
                        </li>
                        @endif
                        @endfor
                       <li class="paginate_button page-item next {{ ($getClientData->currentPage() == $getClientData->lastPage()) ? 'disabled' : '' }}">
                            <a href="{{ ($getClientData->currentPage() != $getClientData->lastPage()) ? $getClientData->url($getClientData->currentPage()+1) : $getClientData->url($getClientData->lastPage()) }}" ><i class="la la-angle-right"></i></a>
                        </li>
                        <li class="paginate_button page-item next {{ ($getClientData->currentPage() == $getClientData->lastPage()) ? 'disabled' : '' }}">
                            <a href="{{ $getClientData->url($getClientData->lastPage()) }}"><img src="{{ URL::asset('images/pagi_arrow.png') }}" alt=""></a>
                        </li>
                    </ul>
                    @endif                        
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--end::Table-->
</div>