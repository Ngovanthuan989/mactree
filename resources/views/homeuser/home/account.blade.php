@extends('homeuser.layout.master')
<style>
    .box_account h3.new_client {
        background: url('{{asset('/pageuser/img/new_user.svg')}}') center left no-repeat;
    }
    .box_account h3.client {
        background: url('{{asset('/pageuser/img/user.svg')}}') center left no-repeat;
    }
</style>
@section('home')
    @include('elements.show_error')
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/home">Trang chủ</a></li>
                    <li><a href="/home/account">Đăng nhập hoặc đăng ký</a></li>
                </ul>
        </div>
        <h1>Đăng nhập hoặc đăng ký tài khoản</h1>
    </div>
    <!-- /page_header -->
        <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-8">
            <div class="box_account">
                <h3 class="client" style="padding: 30px;">Đăng nhập</h3>
                <div class="form_container">
                    {{-- <div class="row no-gutters">
                        <div class="col-lg-6 pr-lg-1">
                            <a href="#0" class="social_bt facebook">Login with Facebook</a>
                        </div>
                        <div class="col-lg-6 pl-lg-1">
                            <a href="#0" class="social_bt google">Login with Google</a>
                        </div>
                    </div> --}}
                    <div class="divider"></div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email_login" placeholder="Email*">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password_login" placeholder="Mật khẩu*">
                    </div>
                    <div class="clearfix add_bottom_15">
                        {{-- <div class="checkboxes float-left">
                            <label class="container_check">Remember me
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div> --}}
                        <div class="float-right"><a id="forgot" href="javascript:void(0);">Quên mật khẩu?</a></div>
                    </div>
                    <div class="text-center"><input type="submit" value="Đăng nhập" class="btn_1 full-width login"></div>
                    <div id="forgot_pw">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
                        </div>
                        <p>A new password will be sent shortly.</p>
                        <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                    </div>
                </div>
                <!-- /form_container -->
            </div>
            <!-- /box_account -->

            <!-- /row -->
        </div>
        <div class="col-xl-6 col-lg-6 col-md-8">
            <div class="box_account">
                <h3 class="new_client" style="padding: 30px;">Đăng ký</h3> <small class="float-right pt-2">* Required Fields</small>
                <div class="form_container">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email_2" placeholder="Email*">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_in_2" id="password_in_2" value="" placeholder="Mật khẩu*">
                    </div>
                    <div class="form-group">
                        {{-- <label class="container_radio" style="display: inline-block; margin-right: 15px;">Private
                            <input type="radio" name="client_type" checked value="private">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container_radio" style="display: inline-block;">Company
                            <input type="radio" name="client_type" value="company">
                            <span class="checkmark"></span>
                        </label> --}}
                    </div>
                    <div class="private box">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control full_name" placeholder="Họ Tên*">
                                </div>
                            </div>

                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control address" placeholder="Địa chỉ*">
                                </div>
                            </div> --}}
                        </div>
                        <!-- /row -->
                        {{-- <div class="row no-gutters">
                            <div class="col-6 pr-1">
                                <div class="form-group">
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
                            <div class="col-6 pr-1">
                                <div class="form-group">
                                    <div class="custom-select-form ward">
                                        <select class="wide add_bottom_10" name="ward" id="ward">
                                                <option value="" selected>Phường , Xã*</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->

                        <div class="row no-gutters">
                            <div class="col-6 pr-1">
                                <div class="form-group">
                                    <div class="custom-select-form district">
                                        <select class="wide add_bottom_10" name="district" id="district">
                                            <option value="" selected>Quận , Huyện*</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <input type="text" class="form-control phone" placeholder="Số điện thoại *">
                                </div>
                            </div>
                        </div> --}}
                        <!-- /row -->

                    </div>
                    <!-- /private -->
                    <div class="company box" style="display: none;">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Company Name*">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Full Address">
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row no-gutters">
                            <div class="col-6 pr-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="City*">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Postal Code*">
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row no-gutters">
                            <div class="col-6 pr-1">
                                <div class="form-group">
                                    <div class="custom-select-form">
                                        <select class="wide add_bottom_10" name="country" id="country_2">
                                                <option value="" selected>Country*</option>
                                                <option value="Europe">Europe</option>
                                                <option value="United states">United states</option>
                                                <option value="Asia">Asia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Telephone *">
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /company -->
                    <hr>
                    <div class="form-group">
                        {{-- <label class="container_check">Accept <a href="#0">Terms and conditions</a>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label> --}}
                    </div>
                    <div class="text-center"><input type="submit" value="Đăng ký" class="btn_1 full-width register"></div>
                </div>
                <!-- /form_container -->
            </div>
            <!-- /box_account -->
        </div>
    </div>
    <!-- /row -->
    </div>
        <!-- /container -->
@endsection

@section('javascript')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

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
    $(document).on("click",".register",function() {
        Loading.show();
        var email     = $('#email_2').val();
        var password  = $('#password_in_2').val();
        var full_name = $('.full_name').val();
        var address   = $('.address').val();
        var phone     = $('.phone').val();
        var province  = $('.province ul .selected').attr('data-value');
        var district  = $('.district ul .selected').attr('data-value');
        var ward      = $('.ward ul .selected').attr('data-value');

        axios({
            method: 'post',
            url: '/home/register',
            data: {
                email:email,
                password:password,
                full_name:full_name,
                address:address,
                phone:phone,
                province:province,
                district:district,
                ward:ward
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
    $(document).on("click",".login",function() {
        Loading.show();
        var email     = $('#email_login').val();
        var password  = $('#password_login').val();
        axios({
            method: 'post',
            url: '/home/login',
            data: {
                email:email,
                password:password
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
