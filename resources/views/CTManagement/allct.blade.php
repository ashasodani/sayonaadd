<!--denish code-->
@extends('layouts.layout')
@section('title')
    CT Management
@endsection
@section('main')
<div class="m-subheader breadcrumb_sad">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                CT Management
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
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="m-content page_contant">
    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Best Sellers-->
            <div class="m-portlet m-portlet--full-height CT__Management ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                CT Management
                            </h3>
                        </div>
                    </div>
                    <form class="m-header-search__form" id="frm">
                        <div class="CT_Management m-header-search__wrapper">
                            <div class="filter">
                                <select class="form-control m-bootstrap-select m_selectpicker dropdown" id="grp_name">
                                    <option>Filter by CT Group</option>
                                    @foreach($services_grp as $ser)
                                    <option value="{{ $ser->pk_service_group_id }}">{{ $ser->service_grp_name }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="search">
                                <span class="m-header-search__icon-search" id="m_quicksearch_search">
                                    <i class="la la-search"></i>
                                </span>
                                <span class="m-header-search__input-wrapper">
                                    <input autocomplete="off" type="text" class="m-header-search__input" placeholder="Search..." id="ct_search">
                                </span>	
                            </div>
                            <div class="add_new_CT_btn">
                                <a href="{{URL::to('add_new_ct')}}" class="new_Ct_btn">Add New CT</a>
                            </div>

                        </div>
                    </form>  
                </div>
                <div id="PartialAllctGroup">
                	@include('CTManagement/partialallct')
				</div>
            </div>
            <!--end::Widget 11-->
        </div>
    </div>
    <!--end:: Widgets/Best Sellers-->
</div>
@stop
