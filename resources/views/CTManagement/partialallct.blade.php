<!--denish code-->
<div class="m-portlet__body">
    <!--begin::Widget 11-->
    <div class="m-widget11">
        <div class="table-responsive CT_Manage">
            <!--begin::Table-->
            <table class="table">
                <!--begin::Thead-->
                <thead>
                    <tr>
                        <td class="m-widget11_CT_Id">
                            CT Id
                        </td>
                        <td class="m-widget11__CT_Name">
                            CT Name
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
                        <td class="m-widget11__CT_Service_Group_Name">
                            CT Service Group Name  
                        </td>
                        <td class="m-widget11__Allocated_Client">
                            Allocated Client(s) 
                        </td>
                        <td class="m-widget11__action">
                            Action
                        </td>
                    </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody>
                    @php $i=1; @endphp
                @foreach($ct_all as $ct)
                    <tr>
                        <td  data-title="id">
                            <span>{{$i+$ct_all->currentPage()*$ct_all->perPage()-$ct_all->perPage()}}</span>
                        </td>
                        <td  data-title="Client_name">
                            <span>{{$ct->ct_name}}</span>
                        </td>
                        <td  data-title="Address">
                            <span>{{$ct->ct_address}}</span>
                        </td>
                        <td  data-title="Contact_no">
                            <span>{{$ct->ct_contact_info}}</span>
                        </td>
                        <td  data-title="age">
                            <span>{{$ct->ct_age}}</span>
                        </td>
                        <td  data-title="Gender">
                            <span>{{$ct->ct_gender}}</span>
                        </td>
                        <td  data-title="CT Service Group Name  ">
                            <span>{{$ct->grp_name}}</span>
                        </td>
                        
                        <td  data-title="Allocated Client(s)">
                            <span>{{$ct->cnt_client}}</span>
                        </td>
                        <td data-title="Action">
                            <a href="{{URL::to('view_ct?id=')}}{{$ct->pk_ct_info_id}}" class="edit_icon"><img src="images/edit_icon.png" alt=""/></a>
                            <a href="{{URL::to('edit_ct?id=')}}{{$ct->pk_ct_info_id}}" class="edit_icon"><img src="images/pencil.png" alt=""/></a>
                            <a href="{{URL::to('delete_ct?id=')}}{{$ct->pk_ct_info_id}}" ct_id="{{$ct->pk_ct_info_id}}" class="edit_icon delete_ct"><img src="images/Delete.png" alt=""/></a>
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
                            <div class="dataTables_length" id="m_table_1_length client_pagintion">
                                <select name="ClientPerPage" aria-controls="m_table_1" class="form-control form-control-sm" onchange="clientFilterPaginationAjax();">
                                    <option {{$perpage == 10 ? 'selected' : ''}}>10</option>
                                        <option {{$perpage == 20 ? 'selected' : ''}}>20</option> 
                                        <option {{$perpage == 30 ? 'selected' : ''}}>30</option> 
                                        <option {{$perpage == 50 ? 'selected' : ''}}>50</option> 
                                        <option {{$perpage == 100 ? 'selected' : ''}}>100</option> 
                                </select>
                                 <span class="m-datatable__pager-detail">Showing {{$ct_all->firstItem()}} - {{$ct_all->lastItem()}} of {{$ct_all->total()}}</span>
                                <!-- <span>Showing 1 -10 of 80</span></div> -->
                        </div>
                            </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers ct_list">
                                {{$ct_all->links()}}
                            </div>
                        </div>
                    </div>
                    
                </div>
<!--            <div class="show_pagintion">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_length" id="m_table_1_length client_pagintion">
                            <select name="ClientPerPage" aria-controls="m_table_1" class="form-control form-control-sm" data-selected="10" tabindex="-98" id="perpage" onchange="clientFilterPaginationAjax();"> 
                                <option {{$perpage == 10 ? 'selected' : ''}}>10</option>
                                <option {{$perpage == 20 ? 'selected' : ''}}>20</option> 
                                <option {{$perpage == 30 ? 'selected' : ''}}>30</option> 
                                <option {{$perpage == 50 ? 'selected' : ''}}>50</option> 
                                <option {{$perpage == 100 ? 'selected' : ''}}>100</option> 
                            </select>
                            <span class="m-datatable__pager-detail">Showing {{$ct_all->firstItem()}} - {{$ct_all->lastItem()}} of {{$ct_all->total()}}</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers ct_list">
                             {{$ct_all->links()}}
                        </div>
                    </div>
                </div>
            </div>-->
       
    </div>
    <!--end::Table-->
</div>