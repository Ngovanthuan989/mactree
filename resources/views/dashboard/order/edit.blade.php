
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

        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">Chi tiết đơn hàng</h1>
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    {{-- <!--begin::Logo-->
                                    <a href="/" class="mb-5">
                                        <img src="{{asset('/uploads/images/logo_mactree_thaihoang.png')}}" alt="" />
                                    </a>
                                    <!--end::Logo--> --}}
                                    <span class="d-flex flex-column align-items-md-end opacity-70">
                                        <p>Khách hàng: <span class="customer_name">{{$get_order->customer[0]->full_name}}</span></p>
                                        <input type="hidden"class="id_customer" value="{{$get_order->customer[0]->id}}">
                                        <p>Sđt: <span class="customer_phone">{{$get_order->phone}}</span></p>
                                    </span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Ngày cập nhập</span>
                                    <span class="opacity-70">{{ date('d/m/Y H:i', strtotime($get_order->updated_at)) }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Mã đơn hàng</span>
                                    <span class="opacity-70">{{$get_order->order_code}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Địa chỉ</span>
                                    <div class="province" style="margin-bottom: 10px">
                                        <select class="form-control select2bs4" name="province" id="province">
                                                <option value="" selected>Thành phố*</option>
                                                @foreach ($data_province as $province)
                                                    <option value="{{$province->ProvinceID}}" @if ($get_order->province_id == $province->ProvinceID)
                                                        selected
                                                    @endif>{{$province->ProvinceName}}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="district" style="margin-bottom: 10px">
                                        <select class="form-control select2bs4" name="district" id="district">
                                                <option value="" selected>Quận, huyện*</option>
                                                @foreach ($data_district as $district)
                                                    <option value="{{$district->DistrictID}}" @if ($get_order->district_id == $district->DistrictID)
                                                        selected
                                                    @endif>{{$district->DistrictName}}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="ward" style="margin-bottom: 10px">
                                        <select class="form-control select2bs4" name="ward" id="ward">
                                                <option value="" selected>Phường, xã*</option>
                                                @foreach ($data_ward as $ward)
                                                    <option value="{{$ward->WardCode}}" @if ($get_order->ward_id == $ward->WardCode)
                                                        selected
                                                    @endif>{{$ward->WardName}}</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px">
                                        <input type="text" name="address" class="form-control address" placeholder="Địa chỉ chi tiết" value="{{$get_order->address}}">
                                      </div>
                                      <input type="hidden" name="id" class="form-control id" value="{{$get_order->id}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Sản phẩm</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Số lượng</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Giá sản phẩm</th>
                                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($get_order_product as $order_product)
                                        <input type="hidden" class="id_product" value="{{$order_product->product_id}}">
                                            <tr class="font-weight-boldest">
                                                <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                    @foreach ($order_product->product as $pro_img)
                                                        <div class="symbol-label" style="background-image: url({{asset('/uploads/images/'.$pro_img->product_img.'')}})"></div>
                                                    @endforeach
                                                </div>
                                                <!--end::Symbol-->
                                                {{$order_product->product_name}}</td>
                                                <td class="text-right pt-7 align-middle product_quantity">{{$order_product->product_quantity}}</td>
                                                <td class="text-right pt-7 align-middle">{{number_format($order_product->product_price).' đ'}}</td>
                                                <td class="text-primary pr-0 pt-7 text-right align-middle">{{number_format($order_product->product_price*$order_product->product_quantity).' đ'}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold text-muted text-uppercase">Phương thức thanh toán</th>
                                            <th class="font-weight-bold text-muted text-uppercase">Trạng thái đơn hàng</th>
                                            <th class="font-weight-bold text-muted text-uppercase">Đơn vị vận chuyển</th>
                                            <th class="font-weight-bold text-muted text-uppercase">Phí ship</th>
                                            <th class="font-weight-bold text-muted text-uppercase text-right">Giá trị đơn hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-bolder">
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" id="payment_methods" style="width: 80%;">
                                                        @foreach ($get_pay as $pay)
                                                            <option value="{{$pay->id}}"@if ($get_order->payment_methods ==$pay->id)
                                                                selected
                                                            @endif>{{$pay->pay_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" id="status" style="width: 80%;">
                                                        <option value="1" @if ($get_order->status==1)
                                                            selected
                                                        @endif>Chờ duyệt</option>
                                                        <option value="2"@if ($get_order->status==2)
                                                            selected
                                                        @endif>Đã duyệt</option>
                                                        <option value="3"@if ($get_order->status==3)
                                                            selected
                                                        @endif>Đang vận chuyển</option>
                                                        <option value="4"@if ($get_order->status==4)
                                                            selected
                                                        @endif>Giao hàng thành công</option>
                                                        <option value="5"@if ($get_order->status==5)
                                                            selected
                                                        @endif>Hoàn hàng</option>
                                                        <option value="0"@if ($get_order->status==0)
                                                            selected
                                                        @endif>Đã huỷ</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" id="ship_id" style="width: 100%;">
                                                        <option value="">Chọn</option>
                                                        @foreach ($get_ship as $ship)
                                                            <option value="{{$ship->id}}" @if ($get_order->ship_id == $ship->id)
                                                                selected
                                                            @endif>{{$ship->ship_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="ship_fee font-weight-boldest text-right">{{number_format($get_order->ship_fee)}}</td>
                                            <td class="text-primary font-size-h4 font-weight-boldest text-right">{{$get_order->total_money}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-between">
                                @if ($get_order->status!=1)
                                    <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">In đơn hàng</button>
                                @endif
                                @if ($get_order->ship_code)
                                    <button type="button" class="btn btn-danger font-weight-bold cancel_ship" data-ship="{{$get_order->ship_code}}">Huỷ vận đơn:{{$get_order->ship_code}}</button>
                                @else
                                    <button type="button" class="btn btn-success font-weight-bold create_ship">Tạo vận đơn</button>
                                @endif
                                <button type="button" class="btn btn-primary font-weight-bold edit-order">Cập nhập đơn hàng</button>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
@endsection
@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    $(document).on("change","#province",function() {
        Loading.show();
        var province_id = $(this).val();

        axios({
            method: 'post',
            url: '/home/district2',
            data: {
                province_id:province_id,
            }
        }).then(function (response) {
            $("#district").html('');
            $("#district").append(response.data);
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>


<script>
    $(document).on("change","#district",function() {
        Loading.show();
        var district_id = $(this).val();

        axios({
            method: 'post',
            url: '/home/ward2',
            data: {
                district_id:district_id,
            }
        }).then(function (response) {
            $("#ward").html('');
            $("#ward").append(response.data);
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>

<script>
    $(document).on("click",".edit-order",function() {
        Loading.show();
        var id = $('.id').val();
        var district_id = $('#district').val();
        var province_id = $('#province').val();
        var ward_id = $('#ward').val();
        var address = $('.address').val();
        var payment_methods = $('#payment_methods').val();
        var status = $('#status').val();
        var ship_id = $('#ship_id').val();
        var ship_fee = $('.ship_fee').text();

        axios({
            method: 'post',
            url: '/order/update',
            data: {
                id:id,
                district_id:district_id,
                province_id:province_id,
                ward_id:ward_id,
                address:address,
                payment_methods:payment_methods,
                status:status,
                ship_id:ship_id,
                ship_fee:ship_fee
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
    $(document).on("click",".cancel_ship",function() {
        Loading.show();
        var id = $('.id').val();
        var order_codes = $(this).attr('data-ship');
        axios({
            method: 'post',
            url: '/order/cancelShip',
            data: {
                id:id,
                order_codes:order_codes
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
    $(document).on("change","#ship_id",function() {
        Loading.show();
        var ship_id     = $(this).val();
        var district_id = $('#district').val();
        var ward_id     = $('#ward').val();
        if (ship_id==1) {
            axios({
                method: 'post',
                url: '/order/shipFee',
                data: {
                    district_id:district_id,
                    ward_id:ward_id
                }
            }).then(function (response) {
                $('.ship_fee').text(response.data)
            }).catch(function(error) {
                Toastr.error(error.response.data);
            }).finally(function() {
                Loading.hide();
            });
        }else{
            Toastr.error('Hiện tại có GHN đang hỗ trợ bạn hãy chọn GHN nhé!');
        }
    });
</script>

<script>
    $(document).on("click",".create_ship",function() {
        Loading.show();
        var id = $('.id').val();
        var district_id = $('#district').val();
        var province_id = $('#province').val();
        var ward_id = $('#ward').val();
        var address = $('.address').val();
        var customer_name = $('.customer_name').text();
        var customer_phone = $('.customer_phone').text();
        var id_product = $('.id_product').val();
        var product_quantity = $('.product_quantity').text();
        var payment_methods = $('#payment_methods').val();
        var status = $('#status').val();
        var ship_id = $('#ship_id').val();
        var ship_fee = $('.ship_fee').text();
        if (ship_id==1) {
            axios({
                method: 'post',
                url: '/order/createShip',
                data: {
                    id:id,
                    district_id:district_id,
                    payment_methods:payment_methods,
                    status:status,
                    ship_id:ship_id,
                    ship_fee:ship_fee,
                    province_id:province_id,
                    ward_id:ward_id,
                    address:address,
                    id_product:id_product,
                    product_quantity:product_quantity,
                    customer_name:customer_name,
                    customer_phone:customer_phone
                }
            }).then(function (response) {
                Toastr.success(response.data);
                location.reload();
            }).catch(function(error) {
                Toastr.error(error.response.data);
            }).finally(function() {
                Loading.hide();
            });
        }else{
            Toastr.error('Hiện tại có GHN đang hỗ trợ bạn hãy chọn GHN nhé!');
        }


    });
</script>

@endsection
