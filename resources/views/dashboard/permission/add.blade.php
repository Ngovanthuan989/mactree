@extends('dashboard.layout.master')
<style>
    .label.label-lg {
        font-size: 10px !important;
    }
</style>
@section('main')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Thêm quyền truy cập</h5>
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

        <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Thông tin chung</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tên quyền truy cập</label>
                    <input type="text" name="per_name" class="form-control per_name" placeholder="Tên quyền truy cập" value="">
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Mã quyền truy cập</label>
                    <input type="text" name="per_code" class="form-control per_code" placeholder="Mã quyền truy cập" value="">
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control select2bs4" id="status"  style="width: 100%;">
                        <option value="1">Hoạt động</option>
                        <option value="2">Dừng hoạt động</option>
                      </select>
                  </div>
                  <!-- /.form-group -->
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary add-per"><i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>

    </div>


@endsection
@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).on("click",".add-per",function() {
            Loading.show();
            var per_name = $('.per_name').val();
            var per_code = $('.per_code').val();
            var status = $('#status').val();

            axios({
                method: 'post',
                url: '/permission/addPost',
                data: {
                    per_name: per_name,
                    per_code:per_code,
                    status:status
                }
            }).then(function (response) {
                Toastr.success(response.data);
                window.location='/permission';
            }).catch(function(error) {
                Toastr.error(error.response.data);
            }).finally(function() {
                Loading.hide();
            });

        });
    </script>

@endsection
