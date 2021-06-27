@extends('homeuser.layout.master')
@section('link')
    <link href="{{asset('/pageuser/css/checkout.css')}}" rel="stylesheet">

@endsection
@section('home')
    @include('elements.show_error')
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/home">Trang chủ</a></li>
                    <li><a href="/home/checkout">Thanh toán</a></li>
                </ul>
            </div>
            <h1>Thanh toán</h1>
    </div>
<!-- /page_header -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="step first">
                    <h3>1. Địa chỉ nhận hàng</h3>
                <div class="tab-content checkout">
                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                        <!-- /row -->
                        <div class="row no-gutters">
                            <div class="col-md-12 form-group">
                                <div class="custom-select-form province">
                                    <select class="wide add_bottom_10" name="province" id="province">
                                            <option value="" selected>Thành phố*</option>
                                            @foreach ($data_province as $province)
                                                <option value="{{$province->ProvinceID}}">{{$province->ProvinceName}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row no-gutters">
                            <div class="col-md-12 form-group">
                                <div class="form-group">
                                    <div class="custom-select-form district">
                                        <select class="wide add_bottom_10" name="district" id="district">
                                            <option value="" selected>Quận , Huyện*</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-md-12 form-group">
                                <div class="form-group">
                                    <div class="custom-select-form ward">
                                        <select class="wide add_bottom_10" name="ward" id="ward">
                                                <option value="" selected>Phường , Xã*</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row no-gutters">
                            <div class="col-md-12 form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control address" placeholder="Địa chỉ*">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control phone" placeholder="Số điện thoại">
                        </div>



                        <div id="other_addr_c" class="pt-2">

                        </div>
                        <!-- /other_addr_c -->
                        <hr>
                    </div>
                    <!-- /tab_1 -->
                </div>
                </div>
                <!-- /step -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step middle payments">
                    <h3>2. Phương thức thanh toán</h3>
                        <ul>
                            @foreach ($get_pay as $pay)
                                <li>
                                    <label class="container_radio">{{$pay->pay_name}}
                                        <input type="radio" name="payment_methods" id="payment_methods" value="{{$pay->id}}">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                </div>
                <!-- /step -->
            </div>
            <?php
                $content = Cart::content();
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="step last">
                    <h3>3. Đơn hàng của bạn</h3>
                <div class="box_general summary">
                        <ul>
                            @foreach($content as $v_content)
                                <li class="clearfix"><em>{{$v_content->qty}}x {{$v_content->name}}</em>  <span>{{number_format($v_content->price*$v_content->qty).' đ'}}</span></li>
                            @endforeach
                        </ul>
                    <ul>
                        <li class="clearfix"><em><strong>Subtotal</strong></em>  <span>{{Cart::subtotal().' '.'đ'}}</span></li>
                    </ul>
                    <div class="total clearfix ">Thanh toán <span>{{Cart::subtotal().' '.'đ'}}</span></div>

                    <a href="#" class="btn_1 full-width addOrder">Đặt hàng</a>
                </div>
                <!-- /box_general -->
                </div>
                <!-- /step -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection
@section('javascript')

<script>
    $(document).on("click",".province .option",function() {
        Loading.show();
        var province_id = $(this).attr('data-value');

        axios({
            method: 'post',
            url: '/home/district',
            data: {
                province_id:province_id,
            }
        }).then(function (response) {
            $(".district ul").html('');
            $(".district ul").append(response.data);
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>


<script>
    $(document).on("click",".district .option",function() {
        Loading.show();
        var district_id = $(this).attr('data-value');

        axios({
            method: 'post',
            url: '/home/ward',
            data: {
                district_id:district_id,
            }
        }).then(function (response) {
            $(".ward ul").html('');
            $(".ward ul").append(response.data);
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>


<script>
    $(document).on("click",".addOrder",function() {
        Loading.show();
        var address         = $('.address').val();
        var province        = $('.province ul .selected').attr('data-value');
        var district        = $('.district ul .selected').attr('data-value');
        var ward            = $('.ward ul .selected').attr('data-value');
        var payment_methods = $("input[name='payment_methods']:checked").val();
        var phone           = $('.phone').val();

        axios({
            method: 'post',
            url: '/home/addOrder',
            data: {
                province:province,
                district:district,
                ward:ward,
                address:address,
                payment_methods:payment_methods,
                phone:phone
            }
        }).then(function (response) {
            Toastr.success(response.data);
            window.location='/home';
        }).catch(function(error) {
            Toastr.error(error.response.data);
        }).finally(function() {
            Loading.hide();
        });
    });
</script>

@endsection
