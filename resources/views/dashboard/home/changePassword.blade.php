@extends('dashboard.layout.master')
@section('main')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Đổi mật khẩu</h5>
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
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                <div class="symbol-label" style="background-image:url('{{asset('/uploads/images/'.$user->avatar.'')}}')"></div>
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{$user->full_name}}</a>
                                <div class="text-muted">Application Developer</div>
                                <div class="mt-2">
                                    <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
                                    <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                                </div>
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="py-9">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                <a class="text-muted text-hover-primary">{{$user->email}}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Phone:</span>
                                <span class="text-muted">{{$user->phone}}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="font-weight-bold mr-2">Quyền truy cập:</span>
                                <select style="width: 50%" name="permission" class="form-control form-control-solid permission" disabled>
                                    @foreach($get_permission as $permission)
                                        <option value="{{$permission->id}}"
                                            @if($user->permission == $permission->id)
                                            selected
                                            @endif>{{$permission->permission_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::Contact-->
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">

                            <div class="navi-item mb-2">
                                <a href="/profile" class="navi-link py-4">
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
                                    <span class="navi-text font-size-lg">Cập nhập thông tin cá nhân</span>
                                </a>
                            </div>

                            <div class="navi-item mb-2">
                                <a href="/profile/change-password" class="navi-link py-4 active">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Shield-user.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">Đổi mật khẩu</span>
                                    <span class="navi-label">
                                        {{-- <span class="label label-light-danger label-rounded font-weight-bold">5</span> --}}
                                    </span>
                                </a>
                            </div>

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
                <div class="card card-custom">
                    <!--begin::Header-->
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Đổi mật khẩu</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Thay đổi mật khẩu tài khoản của bạn</span>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-success mr-2 reset_password">Cập nhập</button>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                        <div class="card-body">
                            <!--begin::Alert-->
                            {{-- <div class="alert alert-custom alert-light-danger fade show mb-10" role="alert">
                                <div class="alert-icon">
                                    <span class="svg-icon svg-icon-3x svg-icon-danger">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Info-circle.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                                <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                                                <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <div class="alert-text font-weight-bold">Configure user passwords to expire periodically. Users will need warning that their passwords are going to expire,
                                <br>or they might inadvertently get locked out of the system!</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="ki ki-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div> --}}
                            <!--end::Alert-->
                            <input type="hidden" class="user_id" value="{{$user->id}}">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Mật khẩu hiện tại</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" class="form-control form-control-lg form-control-solid mb-2 password" value="" placeholder="Mật khẩu hiện tại">
                                    {{-- <a href="#" class="text-sm font-weight-bold">Forgot password ?</a> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Mật khẩu mới</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" class="form-control form-control-lg form-control-solid password_new" value="" placeholder="Mật khẩu mới">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Xác nhận lại mật khẩu</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" class="form-control form-control-lg form-control-solid password_new2" value="" placeholder="Xác nhận lại mật khẩu">
                                </div>
                            </div>
                        </div>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Change Password-->
    </div>

@endsection
@section('js')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>
    $(document).on("click",".reset_password",function() {
        Loading.show();
        var id = $('.user_id').val();
        var password = $('.password').val();
        var password_new = $('.password_new').val();
        var password_new2 = $('.password_new2').val();

        axios({
            method: 'post',
            url: '/profile/reset-password',
            data: {
                id:id,
                password: password,
                password_new:password_new,
                password_new2:password_new2
            }
        }).then(function (response) {
            Toastr.success(response.data);
            window.location='/logout';
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>


@endsection
