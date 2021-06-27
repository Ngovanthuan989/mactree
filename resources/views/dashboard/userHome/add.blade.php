@extends('dashboard.layout.master')
@section('main')
    <link href="{{asset('/admin/assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css" />
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Thêm mới tài khoản người dùng</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <!--end::Actions-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->

            <!--end::Toolbar-->
        </div>
    </div>
    <div class="container">
        <div class="col-xs-12" id="show_success_mss" style="display: none;"></div>
        @include('elements.show_error')
        <!--begin::Card-->
        <div class="card card-custom card-transparent">
            <div class="card-body p-0">
                <!--begin::Wizard-->
                <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">
                    <!--begin::Wizard Nav-->
                    <div class="wizard-nav">
                        <div class="wizard-steps">

                        </div>
                    </div>
                    <!--end::Wizard Nav-->
                    <!--begin::Card-->
                    <div class="card card-custom card-shadowless rounded-top-0">
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                <div class="col-xl-12 col-xxl-10">
                                    <!--begin::Wizard Form-->
                                    <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form" method="post" action="{{ route('dashboard.userHome.addPost') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row justify-content-center">
                                            <div class="col-xl-9">
                                                <!--begin::Wizard Step 1-->
                                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Họ và Tên</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input class="form-control form-control-solid form-control-lg" name="full_name" type="text" value="">
                                                        <div class="fv-plugins-message-container"></div></div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->

                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group input-group-solid input-group-lg">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-at"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control form-control-solid form-control-lg" name="email" value="" placeholder="Email">
                                                            </div>
                                                        <div class="fv-plugins-message-container"></div></div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <!--end::Group-->
                                                </div>

                                                <!--end::Wizard Step 3-->

                                                <!--begin::Wizard Actions-->
                                                <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary font-weight-bolder px-9 py-4">Tạo mới</button>
                                                    </div>
                                                </div>
                                                <!--end::Wizard Actions-->
                                            </div>
                                        </div>
                                        <div></div><div></div><div></div>
                                    </form>
                                    <!--end::Wizard Form-->
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Wizard-->
            </div>
        </div>
        <!--end::Card-->
    </div>

@endsection
@section('js')

    <script src="{{asset('/admin/assets/js/pages/custom/user/add-user.js')}}"></script>



@endsection
