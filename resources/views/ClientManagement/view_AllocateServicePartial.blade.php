<div class="m-portlet m-portlet--full-height client_tabel ">
    <div class="m-section ">
        <div class="table-responsive">
            <!-- begin::Table-->
            <table class="table client_service">
                <!--  begin::Thead-->
                <thead>
                    <tr>
                        <td class="m-section_group">
                            Service Group
                        </td>
                        <td class="m-section_name">
                            No. of Service Name
                        </td>
                        <td class="m-section_tasks">
                            No. of Tasks
                        </td>
                        <td class="m-section_date">
                            Date
                            <a class="d-up_arrow">
                                <img src="{{URL::asset('images/up_arrow.png')}}">
                            </a>
                            <a class="d-down_arrow">
                                <img src="{{URL::asset('images/down_arrow.png')}}">
                            </a>
                        </td>
                        <td class="m-section_action">
                            Action
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getAllocatedServices as $AllocatedServices)
                    <tr>
                        <td>
                            <span>{{$AllocatedServices->service_grp_name}}</span>
                        </td>
                        <td>
                            <span>- </span>
                        </td>
                        <td>
                            <span>{{$AllocatedServices->task_count}}</span>
                        </td>
                        <td>
                            <span>{{ date('d F Y',strtotime(str_replace('/','-', $AllocatedServices->service_date))) }}
                            </span>
                        </td>
                        <td class="m-section_action">
                            <a href="javascript:void(0);" class="edit_icon">
                                <img src="{{URL::asset('images/edit_icon.png')}}" alt="">
                            </a>
                            <a href="javascript:void(0);" class="edit_icon">
                                <img src="{{URL::asset('mages/pencil.png')}}" alt="">
                            </a>
                            <a href="javascript:void(0);" class="edit_icon">
                                <img src="{{URL::asset('images/Delete.png')}}" alt="">
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
