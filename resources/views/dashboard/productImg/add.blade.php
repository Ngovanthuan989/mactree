@extends('dashboard.layout.master')
<link href="{{asset('/admin/assets/plugins/custom/uppy/uppy.bundle.css')}}" rel="stylesheet" type="text/css" />

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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Thêm danh sách ảnh cho sản phẩm</h5>
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


    {{-- Danh sách ảnh sản phẩm --}}

    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Notice-->

            <!--end::Notice-->
            <!--begin::Row-->
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Thêm danh sách ảnh</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group" style="width: 740px">
                        <label>Chọn sản phẩm</label>
                        <select class="form-control select2bs4 product_id" name="product_id"  style="width: 100%;">
                            @foreach ($get_product as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <label>Thêm ảnh sản phẩm</label>
                    <div class="uppy" id="kt_uppy_1">
                        <div class="uppy-dashboard"></div>
                        <div class="uppy-progress"></div>
                    </div>

                <button style="margin-top: 10px;" type="button" class="btn btn-primary add_img"><i class="fas fa-plus"></i> Lưu</button>

                </div>
            </div>
            <!--end::Card-->

            <!--end::Row-->
            <!--begin::Row-->

            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>


@endsection
@section('js')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="{{asset('/admin/assets/plugins/custom/uppy/uppy.bundle.js')}}"></script>
<script src="{{asset('/admin/assets/js/pages/crud/file-upload/uppy.js')}}"></script>
<script>
    $(document).on("click",".add_img",function() {
        let img = [];
        var product_id = $('.product_id').val();
        $('.uppy-Dashboard-Item-previewLink').each(function(){
            img.push($(this).attr('href'));
        });
        axios({
            method: 'post',
            url: '/product/addPostImg',
            data: {
                img: img,
                product_id:product_id,
            }
        }).then(function (response) {
            Toastr.success(response.data);
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>

@endsection
