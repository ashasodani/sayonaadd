<!--denish code-->
@extends('layouts.layout')
@section('title')
    CT Management
@endsection
@section('main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>
<style type="text/css">
    a {
  color: #FFFFFF;
  text-decoration: none;
}

.primary-btn {
  background-image: -moz-linear-gradient(0deg, #235ee7 0%, #4ae7fa 100%);
  background-image: -webkit-linear-gradient(0deg, #235ee7 0%, #4ae7fa 100%);
  background-image: -ms-linear-gradient(0deg, #235ee7 0%, #4ae7fa 100%);
}

.primary-btn {
  line-height: 36px;
  padding-left: 30px;
  padding-right: 30px;
  border-radius: 25px;
  border: none;
  color: #fff;
  display: inline-block;
  font-weight: 500;
  position: relative;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  cursor: pointer;
  text-transform: uppercase;
  position: relative;
}

.primary-btn {
  color: #fff;
  border: 1px solid #fff;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}

.primary-btn:hover {
  background: transparent;
  color: #235ee7;
  border-color: #235ee7;
}
</style>
                <!-- END: Left Aside -->
                <div class="m-grid__item m-grid__item--fluid m-wrapper admin_space">
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader breadcrumb_sad">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title m-subheader__title--separator">
                                    CT Detail
                                </h3>
                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="index.html" class="m-nav__link m-nav__link--icon">
                                            <img src="images/home.png" alt=""/>
                                        </a>
                                    </li>  
                                    <li class="m-nav__separator">
                                        <img src="images/dot_img.png" alt=""/>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                CT Management
                                            </span>
                                        </a>

                                    <li class="m-nav__separator">
                                        <img src="images/dot_img.png" alt=""/>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                CT Detail
                                            </span>
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-content page_contant">
                        <!--Begin::Section-->
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin:: Widgets/Best Sellers-->
                                <div class="m-portlet m-portlet--full-height hca_management_view_allocate_client">
                                    <div class="m-portlet__head">
                                        <div class="hca_management_view_allocate_client m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    CT Detail
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="edit_client m-header-search__wrapper">
                                            <div class="edit_btn">
                                                <a href="{{URL::to('edit_ct?id=')}}{{$get_ct->pk_ct_info_id}}" class="edit_btn">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <!--begin::Widget 11-->
                                        <div class="m-widget11 client-tabel">
                                            <!--                                            <div class="table-responsive">-->
                                            <div class="row box-content">
                                                <div class="box-content-2 box-content">
                                                    <span class="detail-title">Client Name</span>
                                                    <span class="detail-content">{{$get_ct->ct_name}}</span>
                                                </div>
                                                <div class="box-content-3 box-content">
                                                    <span class="detail-title">Contact Number</span>
                                                    <a href="tel:8888234395" class="detail-content">{{$get_ct->ct_contact_info}}</a>
                                                </div>
                                                <div class="box-content-4 box-content">
                                                    <span class="detail-title">Email</span>
                                                    <a href="mailto:yashchoudhury@gmail.com" class="detail-content">{{$get_ct->ct_email}}</a>
                                                </div>
                                                <div class="box-content-5 box-content">
                                                    <span class="detail-title">Date of Birth</span>
                                                    <span class="detail-content">{{$ct_dob}}</span>
                                                </div>
                                                <div class="box-content-6 box-content">
                                                    <span class="detail-title">Age</span>
                                                    <span class="detail-content">{{$get_ct->ct_age}}</span>
                                                </div>
                                                <div class="box-content-7 box-content">
                                                    <span class="detail-title">Gender</span>
                                                    <span class="detail-content">{{$get_ct->ct_gender}}</span>
                                                </div>
                                                <div class="box-content-1 box-content">
                                                    <span class="detail-title">CT Service Group Name</span>
                                                    <span class="detail-content">{{$key}}</span>
                                                </div>
                                                <div class="box-content-8 box-content">
                                                    <span class="detail-title">Address</span>
                                                    <p class="detail-content">{{$get_ct->ct_address}}</p>
                                                </div>

                                                <div class="box-content-9 box-content">
                                                    <span class="detail-title">City</span>
                                                    <span class="detail-content">{{$get_ct->ct_city}}</span>
                                                </div>
                                                <div class="box-content-10 box-content">
                                                    <span class="detail-title">State</span>
                                                    <span class="detail-content">{{$get_ct->ct_state}}</span>
                                                </div>
                                                <div class="box-content-11 box-content"> 
                                                    <span class="detail-title">Country</span>
                                                    <span class="detail-content">{{$get_ct->ct_country}}</span>
                                                </div>
                                                <div class="box-content-12 box-content">
                                                    <span class="detail-title">Allocated Client </span>
                                                    <span class="detail-content">50</span>
                                                </div>

                                                <div class="box-content-13 box-content">
                                                    <span class="detail-title">Salary</span>
                                                    <span class="detail-content">{{$get_ct->ct_salary}}</span>
                                                </div>
                                                <div class="box-content-14 box-content police_chk">
                                                    <span class="detail-title">Police Checkup</span>
                                                    <span class="detail-content">{{$get_ct->police_checkup_status}}</span>
                                                    @if(count($get_police_cer)>0)
                                                    @foreach($get_police_cer as $police)
                                                    <div class="dc_cp">
                                                    <span class="detail-content_link">{{$police->file_name}}</span>
                                                    <a data-toggle="modal" data-target="#modal_img_care" href="images/police_checkup_image/<?=$police->fk_ct_info_id?>/<?=$police->file_name?>" class="border_circle"><img src="images/edit_icon.png" alt=""/></a>
                                                    
                                                    <!--<a data-toggle="modal" href="images/police_checkup_image/<?=$police->fk_ct_info_id?>/<?=$police->file_name?>" class="border_circle bc1"><img src="images/edit_icon.png" alt=""/></a>-->
                                                    <a download="{{$police->file_name}}" href="images/police_checkup_image/<?=$police->fk_ct_info_id?>/<?=$police->file_name?>" class="border_circle"><img src="images/download_icon.png" alt=""/></a>

                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <!-- BEGIN: Modal -->
                                        <div class="modal fade" id="modal_img_care" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                            @if(count($get_police_cer)>0)
                                                                    @foreach($get_police_cer as $police)
                                            <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
                                                <div class="modal-content">
                                                <div class="modal-body">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">
                                                                                ×
                                                                            </span>
                                                        </button>

                                                        <img  src="images/police_checkup_image/<?=$police->fk_ct_info_id?>/<?=$police->file_name?>" class="border_circle"/>
                                                </div>
                                                </div>
                                            </div>
                                        @endforeach
                                                                    @endif
                                        </div>
                                                
<!-- END: Modal -->

                                                <div class="box-content-15 box-content">
                                                    <span class="detail-title">Training Certificate</span>
                                                    @if(count($get_training_cer)>0)
                                                    @foreach($get_training_cer as $training)
                                                    <div class="dc_cp">
                                                    <span class="detail-content">{{$get_ct->training_certi_status}}</span>
                                                    <span class="detail-content_link">{{$training->file_name}}</span>
                                                    <a data-toggle="modal" data-target="#modal_img_care1" href="images/training_certificate_image/<?=$training->fk_ct_info_id?>/<?=$training->file_name?>" class="border_circle"><img src="images/edit_icon.png" alt=""/></a>
                                                    <a download="{{$training->file_name}}" href="images/training_certificate_image/<?=$training->fk_ct_info_id?>/<?=$training->file_name?>" class="border_circle"><img src="images/download_icon.png" alt=""/></a>
                                                    
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                                        <!-- BEGIN: Modal -->
                        <div class="modal fade" id="modal_img_care1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                            @if(count($get_training_cer)>0)
                                                    @foreach($get_training_cer as $training)
                            <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">
                                                                ×
                                                            </span>
                                        </button>

                                        <img  src="images/training_certificate_image/<?=$training->fk_ct_info_id?>/<?=$training->file_name?>" class="border_circle"/>
                                </div>
                            </div>
                        </div>
                        @endforeach
                                                    @endif
                        </div>
<!-- END: Modal -->
                                                <div class="box-content-15 box-content">
                                                    <span class="detail-title">Other Document</span>
                                                    @if(count($get_other_cer)>0)
                                                    @foreach($get_other_cer as $other)
                                                    <div class="dc_cp">
                                                    <span class="detail-content">{{$get_ct->other_doc_sataus}}</span>
                                                    <span class="detail-content_link">{{$other->file_name}}</span>
                                                    <a data-toggle="modal" data-target="#modal_img_care2" href="images/other_document_image/<?=$other->fk_ct_info_id?>/<?=$other->file_name?>" class="border_circle"><img src="images/edit_icon.png" alt=""/></a>
                                                    <a download="{{$other->file_name}}" href="images/other_document_image/<?=$other->fk_ct_info_id?>/<?=$other->file_name?>" class="border_circle"><img src="images/download_icon.png" alt=""/></a>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <div class="modal fade" id="modal_img_care2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                            @if(count($get_other_cer)>0)
                                                    @foreach($get_other_cer as $other)
                            <div class="modal-dialog modal-dialog-centered add_balance_amount_modal" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">
                                                                ×
                                                            </span>
                                        </button>

                                        <img  src="images/other_document_image/<?=$other->fk_ct_info_id?>/<?=$other->file_name?>" class="border_circle"/>
                                </div>
                            </div>
                        </div>
                        @endforeach
                                                    @endif
                        </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__body client_tabs hca_add_new_ct">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item allocatedclient">
                                <a class="nav-link active show" data-toggle="tab" href="#m_tabs_1_1">Allocated Clients</a>
                            </li>
                            <li class="nav-item allocatedvisit">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">Allocated Visits</a>
                            </li>               
                        </ul>
                        <input type="hidden" name="id" id="id" value="{{$id}}">
                        <a href="{{URL::to('NewClient')}}" class="change_status_btn all_new_cnt_btn">Allocate New Client</a>
                        <div class="tab-content client">
                            <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                               <div id="PartialAllctGroup">
                                    @include('CTManagement/allocatedclient')
                                </div>
                            </div>
                        </div>
                        <div class="tab-content visit">
                            <div class="tab-pane " id="m_tabs_1_2" role="tabpanel">
                                <div id="PartialAllctGroup1">
                                    @include('CTManagement/allocatedvisit')
                                </div>
                            </div>
                        </div>

                    </div>   
                    <!--End::Section-->
                    
                </div>

            </div>
        </div>
    </body>
    <!-- end::Body -->
</html>
@stop
