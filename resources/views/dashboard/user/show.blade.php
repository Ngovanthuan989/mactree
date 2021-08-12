@extends('dashboard.layout.master')
<style>
    .form-control {
        width: 50% !important;
    }
</style>
@section('main')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Danh sách tài khoản</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        {{-- <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">4   50 Total</span> --}}
                        <form class="ml-5">
                            <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                                {{-- <input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Search..."> --}}
                                <div class="input-group-append">
                                    <span class="input-group-text">

                                        <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--end::Search Form-->
                    <!--begin::Group Actions-->

                    <!--end::Group Actions-->
                </div>
                <!--end::Details-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Button-->
                    <!--end::Button-->
                    <!--begin::Button-->
                    <a href="/user/add" class="btn btn-light-primary font-weight-bold ml-2">Thêm mới</a>
                    <!--end::Button-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Thêm mới">
                        <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </a>

                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>

        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Row-->
                <div class="row">
                    @foreach ($get_user as $get_users)
                        @if ($get_users->id != $user->id)
                            <!--begin::Col-->
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b card-stretch">
                                    <!--begin::Body-->
                                    <div class="card-body pt-4">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Thao tác">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
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
                                                            <a type="button" class="navi-link delete_user" data-id="{{$get_users->id}}">
                                                                <span class="navi-text">
                                                                    <span class="label label-xl label-inline label-light-danger" >Xoá tài khoản</span>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        {{-- <li class="navi-separator mt-3 opacity-70"></li>
                                                        <li class="navi-footer py-4">
                                                            <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                            <i class="ki ki-plus icon-sm"></i>Add new</a>
                                                        </li> --}}
                                                    </ul>
                                                    <!--end::Navigation-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Toolbar-->
                                        <!--begin::User-->
                                        <div class="d-flex align-items-end mb-7">
                                            <!--begin::Pic-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Pic-->
                                                <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                                    <div class="symbol symbol-circle symbol-lg-75">
                                                        <img src="{{asset('/uploads/images/'.$get_users->avatar.'')}}" alt="image">
                                                    </div>
                                                    <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                                        <span class="font-size-h3 font-weight-boldest">JM</span>
                                                    </div>
                                                </div>
                                                <!--end::Pic-->
                                                <!--begin::Title-->
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('dashboard.user.edit', ['id' => $get_users->id]) }}" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{$get_users->full_name}}</a>
                                                    {{-- <span class="text-muted font-weight-bold">Ngày đăng kí: {{ date('d/m/Y H:i', strtotime($get_users->updated_at)) }}</span> --}}
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::Desc-->
                                        {{-- <p class="mb-7">I distinguish three
                                        <a href="#" class="text-primary pr-1">#XRS-54PQ</a>objectives First objectives and nice cooked rice</p> --}}
                                        <!--end::Desc-->
                                        <!--begin::Info-->
                                        <div class="mb-7">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Email:</span>
                                                <a type="button" class="text-muted text-hover-primary">{{$get_users->email}}</a>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-cente my-1">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Số điện thoại:</span>
                                                <a type="button" class="text-muted text-hover-primary">{{$get_users->phone}}</a>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Quyền truy cập:</span>
                                                <select name="permission" class="form-control form-control-solid permission" disabled>
                                                    <option value="1" @if($get_users->permission == 1)
                                                        selected
                                                        @endif>Quản lý</option>
                                                    <option value="2" @if($get_users->permission == 2)
                                                        selected
                                                        @endif>Nhân viên</option>
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center my-1">
                                                <span class="text-dark-75 font-weight-bolder mr-2">Ngày đăng kí:</span>
                                                <span class="text-muted font-weight-bold">{{ date('d/m/Y H:i', strtotime($get_users->updated_at)) }}</span>
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                        <a href="{{ route('dashboard.user.edit', ['id' => $get_users->id]) }}" class="btn btn-block btn-sm btn-light-primary font-weight-bolder text-uppercase py-4">Cập nhập</a>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                        @endif
                    @endforeach

                </div>
                {{$get_user->links()}}


                <!--end::Pagination-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>
    $(document).on("click",".delete_user",function() {
        let id = $(this).attr('data-id');
        $.confirm({
            content: '<p style="color:red;">Bạn có chắc chắn muốn xoá tài khoản này không?</p>',
            buttons: {
                'Yes': {
                    action: function () {
                        Loading.show();

                        axios({
                            method: 'post',
                            url: '/user/delete',
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
