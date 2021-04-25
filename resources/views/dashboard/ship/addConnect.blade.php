@extends('dashboard.layout.master')
@section('main')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Kết nối đơn vị vận chuyển</h5>
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
        @include('elements.show_error')
        <!--begin::Profile Change Password-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                <!--begin::Profile Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover py-5">
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-drop"></i>
                                                </span>
                                                <span class="navi-text">New Group</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-list-3"></i>
                                                </span>
                                                <span class="navi-text">Contacts</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-rocket-1"></i>
                                                </span>
                                                <span class="navi-text">Groups</span>
                                                <span class="navi-link-badge">
                                                    <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-bell-2"></i>
                                                </span>
                                                <span class="navi-text">Calls</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-gear"></i>
                                                </span>
                                                <span class="navi-text">Settings</span>
                                            </a>
                                        </li>
                                        <li class="navi-separator my-3"></li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-magnifier-tool"></i>
                                                </span>
                                                <span class="navi-text">Help</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-bell-2"></i>
                                                </span>
                                                <span class="navi-text">Privacy</span>
                                                <span class="navi-link-badge">
                                                    <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>

                        <!--end::Toolbar-->
                        <!--begin::User-->

                        <!--end::Contact-->
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            @foreach ($get_ship as $item)
                            <div class="navi-item mb-2">
                                <a href="/ship/add-connect/{{$item->ship_code}}" class="navi-link py-4 @if ($ship->ship_code == $item->ship_code)
                                    active
                                @endif">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">{{$item->ship_name}}</span>
                                </a>
                            </div>
                            @endforeach



                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Profile Card-->
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                @if ($ship->active == 1)
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">Kết nối thành công</h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-ver"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover">
                                        <li class="navi-header font-weight-bold py-4">
                                            <span class="font-size-lg">Thao tác:</span>
                                            <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
                                        </li>
                                        <li class="navi-separator mb-3 opacity-70"></li>
                                        <li class="navi-item">
                                            <a type="button" class="navi-link delete_connect" data-id="{{$ship->id}}">
                                                <span class="navi-text">
                                                    <span class="label label-xl label-inline label-light-danger">Xoá kết nối</span>
                                                </span>
                                            </a>
                                        </li>

                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        <!--begin::Item-->
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                <div class="symbol-label" style="background-image: url('{{asset('/uploads/images/'.$ship->ship_img.'')}}')"></div>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Title-->
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <a href="/ship/add-connect/{{$ship->ship_code}}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$ship->name}}</a>
                                <span class="text-muted font-weight-bold font-size-sm my-1">Giao hàng nhanh sẽ tiếp nhận mọi đơn hàng của bạn</span>
                                <span class="text-muted font-weight-bold font-size-sm">Mã đơn vị vận chuyển:
                                <span class="text-primary font-weight-bold">{{$ship->ship_code}}</span></span>
                            </div>
                            <!--end::Title-->
                            <!--begin::Info-->
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="label label-lg label-light-success label-inline font-weight-bold py-4">Đã kết nối</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Body-->
                </div>
                @else
                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Kết nối đơn vị vận chuyển: {{$ship->ship_name}}</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Việc này sẽ giúp ích cho bạn</span>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-success mr-2 add-connect">Kết nối</button>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    {{-- <h5 class="font-weight-bold mb-6">Thông tin </h5> --}}
                                </div>
                            </div>

                            <input type="hidden" name="id" class="id" value="{{$ship->id}}">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Tên đơn vị vận chuyển</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="text" class="form-control form-control-lg form-control-solid ship_name" name="ship_name" value="{{$ship->ship_name}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Mã đơn vị vận chuyển</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="text" class="form-control form-control-lg form-control-solid ship_code" name="ship_code" value="{{$ship->ship_code}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Key kết nối</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" class="form-control form-control-lg form-control-solid ship_key" name="ship_key" value="">
                                    @if ($ship->name == 'GHN')
                                        <a href="https://khachhang.ghn.vn/account" target="_blank">Lấy key kết nối</a>
                                    @endif
                                </div>
                            </div>



                        </div>
                        <!--end::Body-->
                    </form>
                    <!--end::Form-->
                </div>
                @endif



            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Change Password-->
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    var avatar2 = new KTImageInput('kt_image_2');

</script>

<script>
    $(document).on("click",".add-connect",function() {
        Loading.show();
        var id = $('.id').val();
        var ship_key = $('.ship_key').val();

        axios({
            method: 'post',
            url: '/ship/addPostConnect',
            data: {
                id: id,
                ship_key:ship_key
            }
        }).then(function (response) {
            Toastr.success(response.data);
            location.reload();
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });

    });
</script>



<script>
    $(document).on("click",".delete_connect",function() {
        let id = $(this).attr('data-id');
        $.confirm({
            content: '<p style="color:red;">Bạn có chắc chắn muốn xoá kết nối không?</p>',
            buttons: {
                'Yes': {
                    action: function () {
                        Loading.show();
                        axios({
                            method: 'post',
                            url: '/ship/delete-connect',
                            data: {
                                id:id,
                            }
                        }).then(function (response) {
                            Toastr.success(response.data);
                            location.reload();
                        }).catch(function(error) {
                            Toastr.error(error.response.data);
                        }).finally(function() {
                            Loading.hide();
                        });
                    }
                },
                'No':{
                    action: function () {

                    }
                }

            }
        });

    });
</script>

@endsection
