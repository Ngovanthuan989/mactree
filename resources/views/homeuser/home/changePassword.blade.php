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
                    <li><a href="/home/account">Đổi mật khẩu</a></li>
                </ul>
        </div>
        <h1>Đổi mật khẩu cho tài khoản của bạn</h1>
    </div>
    <!-- /page_header -->
        <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-8">
            <div class="box_account">
                <h3 class="client" style="padding: 30px;">Đổi mật khẩu</h3>
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
