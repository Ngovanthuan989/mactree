
@extends('dashboard.layout.master')
@section('main')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Cập nhập danh mục sản phẩm</h5>
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
        <div class="card card-default update_cate"  data-id="{{$edit_category->id}}">
            <div class="card-header">
                <h3 class="card-title">Thông tin chung</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" name="category_name" class="form-control category_name" placeholder="Tên danh mục" value="{{$edit_category->category_name}}">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                    <label>Mã danh mục</label>
                    <input type="text" name="category_code" class="form-control category_code" placeholder="Mã danh mục" value="{{$edit_category->category_code}}">
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Trạng thái</label>
                        <select id="status" class="form-control select2bs4">
                        <option value="1" @if ($edit_category->status==1)
                            selected
                        @endif>Hoạt động</option>
                        <option value="2" @if ($edit_category->status==2)
                            selected
                        @endif>Dừng hoạt động</option>
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
                <button type="button" class="btn btn-primary update-category"><i class="fas fa-pen-alt"></i> Cập nhập</button>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>
    $(document).on("click",".update-category",function() {
        Loading.show();
        var id = $('.update_cate').attr('data-id');
        var category_name = $('.category_name').val();
        var category_code = $('.category_code').val();
        var status = $('#status').val();

        axios({
            method: 'post',
            url: '/category/update',
            data: {
                id:id,
                category_name: category_name,
                category_code:category_code,
                status:status
            }
        }).then(function (response) {
            Toastr.success(response.data);
            window.location='/category';
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>
@endsection
