<div class="m-portlet__body">
    <!--begin::Widget 11-->
    <div class="m-widget11">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table">
                <!--begin::Thead-->
                <thead>
                <tr>
                    <th class="th_h">Service Name</th>
                    <th class="th_h">Service Group</th>
                    <th class="th_h">No.of Tasks</th>
                    <th class="th_h">Per Hour Service Price</th>
                    <th class="th_h">Action</th>
                </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody>
                @foreach($services_paginate as $service)
                    <tr>
                        <td  data-title="Service Name">{{$service->service_name}}</td>
                        <td  data-title="Service Group">{{$service->service_grp_name}}</td>
                        <td  data-title="no_task">{{$service->task_count}}</td>
                        <td  data-title="Per Hour Service Price">{{$service->hourly_rate}}</td>
                        <td data-title="Action">
                            <a href="javascript:void(0);" class="edit_icon" data-toggle="modal" data-target="#modal_target_10" data-id="{{$service->pk_services_id}}" id="services_edit"><img src="images/pencil.png" alt=""/></a>
                            <a href="javascript:void(0);" class="edit_icon" data-id="{{$service->pk_services_id}}" data-toggle="modal" data-target="#modal_target_delete" id="delete_services_model"><img src="images/Delete.png" alt=""/></a>
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
                        <select name="m_table_1_length" aria-controls="m_table_1" class="form-control form-control-sm" id="pagination">
                            <option value="1" @if($items == 1) selected @endif>1</option>
                            <option value="2" @if($items == 2) selected @endif>2</option>
                            <option value="5" @if($items == 5) selected @endif>5</option>
                            <option value="10" @if($items == 10) selected @endif>10</option>
                        </select>
                        <span>Showing {{($services_paginate->currentpage()-1)*$services_paginate->perpage()+1}} - {{$services_paginate->currentpage()*$services_paginate->perpage()}} of {{$services_paginate->total()}}</span></div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            {{ $services_paginate->appends(\Request::except('_token'))->render() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Table-->
    </div>
</div>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        document.getElementById('pagination').onchange = function(e) {
            debugger;
            e.preventDefault();
            var search_service_name=document.getElementById("search_service_name").value;
            var url = "{!! $services_paginate->path() !!}?&items=" + this.value+"&search_service_name="+search_service_name;
            $.get(url,function(data){
                jQuery.ajaxSetup({async:false});
                $('#PartialServices').html(data.html);
            });
            {{--window.location = "{!! $services_paginate->path() !!}?&items=" + this.value;--}}
        };
    });
    $(document).on('click','.page-link', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url,function(data){
            jQuery.ajaxSetup({async:false});
            $('#PartialServices').html(data.html);
        });
    });
</script>
