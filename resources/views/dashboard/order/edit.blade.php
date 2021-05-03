
@extends('dashboard.layout.master')
@section('main')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Cập nhập đơn hàng:</h5>
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
        <div class="card card-default update_order" data-id="">
            <div class="card-header">
              <h3 class="card-title">Thông tin chung</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Khách hàng</label>
                    <input type="text" name="customer_id" class="form-control permission_name" placeholder="Tên quyền truy cập" value="">
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control phone" placeholder="Số điện thoại" value="{{$edit_permission->permission_code}}">
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  {{-- <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control select2bs4" id="status" style="width: 100%;">
                        <option value="1" @if ($edit_permission->status==1)
                        selected
                                @endif>Hoạt động</option>
                        <option value="2" @if ($edit_permission->status==2)
                        selected
                                @endif>Dừng hoạt động</option>
                    </select>
                  </div> --}}

                  <!-- /.form-group -->
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary update-permission"><i class="fas fa-pen-alt"></i> Cập nhập</button>
            </div>
          </div>
    </div>
@endsection
@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>



@endsection
