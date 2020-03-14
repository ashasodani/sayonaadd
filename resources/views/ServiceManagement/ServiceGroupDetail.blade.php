@extends('layouts.layout')
@section('title')
    Service Group Detail
@endsection
@section('main')
    <div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader breadcrumb_sad">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Service Group Details
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="index.html" class="m-nav__link m-nav__link--icon">
                                <img src="{{URL::asset('images/home.png')}}" alt=""/>

                            </a>
                        </li>
                        <li class="m-nav__separator">
                            <img src="{{URL::asset('images/dot_img.png')}}" alt=""/>
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                Service Management
                                            </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            <img src="{{URL::asset('images/dot_img.png')}}" alt="">
                        </li>
                        <li class="m-nav__item">
                            <a href="{{URL::to('service_group')}}" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                Service Group
                                            </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            <img src="{{URL::asset('images/dot_img.png')}}" alt="">
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                Service Group Details
                                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content page_contant service_pages s_group_dtl">
            <!--Begin::Section-->
            <div class="row">
                <div class="col-lg-6">
                    <!--begin:: Widgets/Best Sellers-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">Service Group Details</h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Section-->
                            <div class="row">
                                <div class="col-6">
                                    <div class="m-form__group form-group">
                                        <label for="">Service Group</label>
                                        <p>{{$service_grp_name[0]->service_grp_name}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="m-form__group form-group">
                                        <label for="">No. of Service Name</label>
                                        <p>{{$total_services}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="m-form__group form-group">
                                        <label for="">No. of Tasks</label>
                                        <p>{{$service_task}}</p>
                                    </div>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>



                    </div>
                    <!--end::Widget 11-->
                </div>

                <div class="col-lg-6">
                    <!--begin:: Widgets/Best Sellers-->
                    <div class="m-portlet m-portlet--full-height service_pages s_group_dtl">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">Services</h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Section-->
                            <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">
                                <!--begin::Item-->
                                <div class="m-accordion__item">
                                   @foreach($service_details as $service_detail)
                                        <div class="m-accordion__item-head collapsed" role="tab" id="{{$service_detail->accordion_name}}_head" data-toggle="collapse" href="#{{$service_detail->accordion_name}}_body" aria-expanded="false">
                                                        <span class="m-accordion__item-icon">
                                                            <h5>{{$service_detail->service_name}}</h5>
                                                        </span>
                                            <span class="m-accordion__item-title">
                                                            ₹ <b>{{$service_detail->hourly_rate}}</b> Hourly Rate
                                                        </span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse" id="{{$service_detail->accordion_name}}_body" role="tabpanel" aria-labelledby="{{$service_detail->accordion_name}}_head" data-parent="#m_accordion_1" style="">
                                            @foreach($task_details as $task_detail)
                                                @if($task_detail["fk_services_id"]==$service_detail->pk_services_id)
                                                    <div class="m-accordion__item-content">
                                                        <div class="accor_content">
                                                            <div class="l_s">{{$task_detail["task_name"]}}</div>
                                                            <div class="r_s">{{$task_detail["descp"]}}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                   @endforeach
                                </div>
                                <!--end::Item-->

                            </div>
                            <!--end::Section-->
                        </div>



                    </div>
                    <!--end::Widget 11-->
                </div>
            </div>
            <!--end:: Widgets/Best Sellers-->
        </div>
    </div>
    <!--End::Section-->
@stop



