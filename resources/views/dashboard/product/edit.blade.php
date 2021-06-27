@extends('dashboard.layout.master')
@section('main')
<style>
    .error{
        color:red;
    }
</style>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Cập nhập sản phẩm</h5>
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
            <form id="form" method="post" action="{{ route('dashboard.product.editPost') }}" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Thông tin chung</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="product_name" class="form-control product_name" placeholder="Tên sản phẩm" value="{{$edit_product->product_name}}">
                      </div>
                      <input type="hidden" name="id" class="form-control id" value="{{$edit_product->product_code}}">
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label> Mô tả ngắn </label>
                        <textarea class="form-control" name="product_description" rows="3" placeholder="Mô tả ngắn sản phẩm" maxlength="65535">{{$edit_product->product_description}}</textarea>
                    </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>Giới thiệu sản phẩm</label>
                        <textarea name="product_content" id="kt-ckeditor-5">
                            {{$edit_product->product_content}}
                        </textarea>
                      </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control select2bs4" name="status"  style="width: 100%;">
                            <option value="1" @if ($edit_product->status==1)
                                selected
                            @endif>Đang bán</option>
                            <option value="2" @if ($edit_product->status==2)
                                selected
                            @endif>Dừng bán</option>
                          </select>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>Danh mục sản phẩm</label>
                        <select class="form-control select2bs4" name="category_id"  style="width: 100%;">
                            @foreach ($get_category as $category)
                                <option value="{{$category->id}}" @if ($edit_product->category_id==$category->id)
                                    selected
                                @endif>{{$category->category_name}}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Bộ sưu tập</label>
                        <select class="form-control select2bs4" name="collection"  style="width: 100%;">
                            <option value="1" @if ($edit_product->collection==1)
                                selected
                            @endif>Sản phẩm mới</option>
                            <option value="2"@if ($edit_product->collection==2)
                                selected
                            @endif>Sản phẩm bán chạy</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Ảnh đại diện sản phẩm</label>
                        <div class="col-lg-9 col-xl-9">
                            <div class="image-input" id="kt_image_2">
                                <div class="image-input-wrapper" style="background-image: url({{asset('/uploads/images/'.$edit_product->product_img.'')}})"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Ảnh đại diện sản phẩm">
                                 <i class="fa fa-pen icon-sm text-muted"></i>
                                 <input type="file" name="product_img" accept=".png, .jpg, .jpeg"/>
                                 <input type="hidden" name="profile_avatar_remove"/>
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
                  <!-- /.row -->
                </div>
            </div>



            {{-- Danh sách ảnh sản phẩm --}}

            {{-- <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Danh sách ảnh sản phẩm</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <!-- /.row -->
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group mt-10">
                        <label>Chiều dài sản phẩm</label>
                        <input type="number" min="1" name="product_length" value="" placeholder="Chiều dài: cm" class="form-control data_pro">
                      </div>

                    </div>

                     <div class="col-sm-3">
                      <div class="form-group mt-10">
                        <label>Chiều rộng sản phẩm</label>
                        <input type="number" name="product_width" id="package_width" value="" placeholder="Chiều rộng: cm" class=" form-control data_pro">
                      </div>

                    </div>

                    <div class="col-sm-3">
                      <div class="form-group mt-10">
                        <label>Chiều cao sản phẩm</label>
                        <input type="number" name="product_height" value="" placeholder="Chiều cao: cm" class="form-control data_pro">
                      </div>

                    </div>


                  </div>
                </div>
            </div> --}}


            {{-- Giá bán,kích thước sản phẩm --}}

            <div class="card card-default" style="margin-top: 20px">
                <div class="card-header">
                  <h3 class="card-title">Giá bán, Kích thưóc sản phẩm</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group mt-10">
                            <label>Giá gốc (Giá so sánh)</label>
                            <input type="text" name="unit_price" onchange="this.value=formatNumber(this.value.replace(/\./g,''))" value="{{$edit_product->unit_price}}" placeholder="Giá gốc" class="form-control data_pro">
                          </div>
                          <div class="form-group mt-10">
                            <label>Mã sản phẩm</label>
                            <input type="text" name="product_code" id="product_code" value="{{$edit_product->product_code}}" placeholder="Mã sản phẩm" class=" form-control data_pro">
                            <svg id="barcode_sku" style="display: none;"></svg>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group mt-10">
                            <label>Giá bán (<= giá gốc)</label>
                            <input type="text" name="price_sale" onchange="this.value=formatNumber(this.value.replace(/\./g,''))" value="{{$edit_product->price_sale}}" placeholder="Giá bán" class="form-control data_pro">
                          </div>
                          <div class="form-group mt-10">
                            <label>Đơn vị tính (chiếc, hộp, lọ, kg...)</label>
                            <input type="text" id="unit_name" name="unit_name" value="{{$edit_product->unit_name}}" class="form-control data_pro" placeholder="Đơn vị tính, vd: hộp, lạng, con, bộ,..">
                          </div>
                        </div>

                      </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group mt-10">
                        <label>Chiều dài sản phẩm</label>
                        <input type="number" min="1" name="product_length" value="{{$edit_product->product_length}}" placeholder="Chiều dài: cm" class="form-control data_pro">
                      </div>

                    </div>

                     <div class="col-sm-3">
                      <div class="form-group mt-10">
                        <label>Chiều rộng sản phẩm</label>
                        <input type="number" name="product_width" id="package_width" value="{{$edit_product->product_width}}" placeholder="Chiều rộng: cm" class=" form-control data_pro">
                      </div>

                    </div>

                    <div class="col-sm-3">
                      <div class="form-group mt-10">
                        <label>Chiều cao sản phẩm</label>
                        <input type="number" name="product_height" value="{{$edit_product->product_height}}" placeholder="Chiều cao: cm" class="form-control data_pro">
                      </div>

                    </div>
                    <div class="col-sm-3">
                      <div class="form-group mt-10">
                        <label>Số lượng sản phẩm</label>
                        <input type="number" name="product_amount" value="{{$edit_product->product_amount}}" placeholder="Số lượng sản phẩm" class="form-control data_pro">
                      </div>

                    </div>

                  </div>
                </div>
            </div>
            <button style="margin-top: 10px" type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Cập nhập</button>
        </form>
    </div>

@endsection
@section('js')
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
                product_name: {
                    required: true,
                    noSpace: true,
                },
                product_description:{
                    required: true,
                    noSpace: true,
                    maxlength: 300,
                    minlength: 50
                },
                product_amount:{
                    required: true,
                    noSpace: true,
                    number: true
                },
                product_content:{
                    required: true,
                    noSpace: true,
                    minlength: 100
                },
                unit_price:{
                    required: true,
                    noSpace: true,
                    number: true,
                },
                price_sale:{
                    required: true,
                    noSpace: true,
                    number: true,
                },
                product_code:{
                    required: true,
                    noSpace: true,
                    maxlength: 6,
                    minlength: 4
                },
                unit_name:{
                    required: true,
                    noSpace: true,
                },
                product_length:{
                    required: true,
                    noSpace: true,
                    number: true,
                },
                product_width:{
                    required: true,
                    noSpace: true,
                    number: true,
                },
                product_height:{
                    required: true,
                    noSpace: true,
                    number: true,
                }

            },
            // Specify validation error messages
            messages: {
                product_name:{
                    required: '* Tên sản phẩm không được để trống!',
                    noSpace: '* Tên sản phẩm không được để trống!',

                },
                product_description:{
                    required: '* Mô tả ngắn không được để trống!',
                    noSpace: '* Mô tả ngắn không được để trống!',
                    minlength:'* Mô tả ngắn ít nhất phải là 50 kí tự',
                    maxlength: '* Mô tả ngắn nhiều nhất là 300 kí tự'
                },
                product_content:{
                    required: '* Giới thiệu sản phẩm không được để trống!',
                    noSpace: '* Giới thiệu sản phẩm không được để trống!',
                    minlength: '* Giới thiệu sản phẩm ít nhất phải có 100 ký tự'
                },
                unit_price:{
                    required: '* Giá gốc sản phẩm không được để trống!',
                    noSpace: '* Giá gốc sản phẩm không được để trống!',
                    number:'* Giá gốc sản phẩm phải là số!'
                },
                price_sale:{
                    required: '* Giá bán sản phẩm không được để trống!',
                    noSpace: '* Giá bán sản phẩm không được để trống!',
                    number:'* Giá sản bán sản phẩm phải là số!'
                },
                product_code:{
                    required: '* Mã sản phẩm không được để trống!',
                    noSpace: '* Mã sản phẩm không được để trống!',
                    minlength:'* Mã sản phẩm ít nhất phải là 4 kí tự',
                    maxlength: '* Mã sản phẩm nhiều nhất là 6 kí tự'
                },
                unit_name:{
                    required: '* Đơn vị tính không được để trống!',
                    noSpace: '* Đơn vị tính không được để trống!',
                },
                product_length:{
                    required: '* Chiều dài sản phẩm không được để trống!',
                    noSpace: '* Chiều dài sản phẩm không được để trống!',
                    number:'* Chiều dài sản phẩm phải là số!'
                },
                product_amount:{
                    required: '* Số lượng sản phẩm không được để trống!',
                    noSpace: '* Số lượng sản phẩm không được để trống!',
                    number:'* Số lượng sản phẩm phải là số!'
                },
                product_width:{
                    required: '* Chiều rộng sản phẩm không được để trống!',
                    noSpace: '* Chiều rộng sản phẩm không được để trống!',
                    number:'* Chiều rộng sản phẩm phải là số!'
                },
                product_height:{
                    required: '* Chiều cao sản phẩm không được để trống!',
                    noSpace: '* Chiều cao sản phẩm không được để trống!',
                    number:'* Chiều cao sản phẩm phải là số!'
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

 <!--begin::Page Vendors(used by this page)-->
 <script src="{{asset('/admin/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
 <!--end::Page Vendors-->
 <!--begin::Page Scripts(used by this page)-->
 <script src="{{asset('/admin/assets/js/pages/crud/forms/editors/ckeditor-classic.js')}}"></script>
@endsection
