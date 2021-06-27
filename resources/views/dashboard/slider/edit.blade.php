@extends('dashboard.layout.master')
<link href="{{asset('/admin/assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css" />
@section('main')
<style>
    .error{
        color:red !important;
    }
    .image-input .image-input-wrapper {
        width: 250px;
        height: 200px;
    }
</style>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Cập nhập slider website</h5>
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
        <form id="form" method="post" action="{{ route('dashboard.slider.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">
            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
        <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Thông tin chung</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tên slider</label>
                    <input type="text" name="name" class="form-control name" placeholder="Tên slider" value="{{$edit_slider->name}}">
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" name="content" rows="3" placeholder="nội dung" maxlength="65535">{{$edit_slider->content}}</textarea>
                </div>
                  <!-- /.form-group -->

                </div>
                <input type="hidden" name="id" class="form-control id" placeholder="Mã slider" value="{{$edit_slider->code}}">
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control select2bs4" name="status"  style="width: 100%;">
                            <option value="1" @if ($edit_slider->status==1)
                                selected
                            @endif>Hoạt động</option>
                            <option value="2"@if ($edit_slider->status==2)
                                selected
                            @endif>Dừng hoạt động</option>
                          </select>
                    </div>
                  <div class="form-group">
                    <label>Ảnh silder</label>
                        <div class="col-lg-9 col-xl-9">
                            <div class="image-input" id="kt_image_2">
                                <div class="image-input-wrapper" style="background-image: url({{asset('/uploads/images/'.$edit_slider->slider_img.'')}})"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Ảnh slider">
                                 <i class="fa fa-pen icon-sm text-muted"></i>
                                 <input type="file" name="slider_img" accept=".png, .jpg, .jpeg"/>
                                 <input type="hidden" name="slider_img_remove"/>
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Xoá">
                                 <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                               </div>
                        </div>
                 </div>

                  <!-- /.form-group -->
                </div>

                <!-- /.col -->
              </div>
              <button style="margin-top: 10px;" type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Cập nhập</button>
              <form>
              <!-- /.row -->
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('js')
<script src="{{asset('/admin/assets/js/pages/custom/user/add-user.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<script>
    var avatar2 = new KTImageInput('kt_image_2');
</script>

<script>
    $(document).ready(function () {
        jQuery.validator.addMethod("noSpace", function(value, element) {
            value = value.trim();
            if (value != "") {
                return true;
            }
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");

        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    noSpace: true
                },

                content:{
                    required: true,
                    noSpace: true
                },
            },
            // Specify validation error messages
            messages: {
                name:{
                    required: '* Tên slider không được để trống!',
                    noSpace: '* Tên slider không được để trống!',

                },
                content:{
                    required: '* Nội dung slider không được để trống!',
                    noSpace: '* Nội dung slider không được để trống!',
                },
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    })
    </script>
@endsection
