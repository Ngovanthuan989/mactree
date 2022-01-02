<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>MacTreeThoangThoang</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('/pageuser/img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('/pageuser/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('/pageuser/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('/pageuser/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('/pageuser/img/apple-touch-icon-144x144-precomposed.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('/uploads/images/icon.svg')}}" />
    <!-- BASE CSS -->
    <link href="{{asset('/pageuser/css/bootstrap.custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('/pageuser/css/style.css')}}" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    @yield('link')

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('/pageuser/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <style>
        header.version_1 .main_header {
            background-color: #ffffff;
        }
        header.version_1 .main-menu > ul > li > a {
            color: #000000;
        }
        header.version_1 .main_header a.phone_top {
            color: #000000;
        }
    </style>
</head>

<body>
    @include('elements.loading')
	<div id="page">

    @include('homeuser.layout.header')
	<!-- /header -->

	<main>




		<!--/banners_grid -->
    @yield('home')



		<!-- /container -->
	</main>
	<!-- /main -->

    @include('homeuser.layout.footer')
	<!--/footer-->
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
    <script src="{{asset('/pageuser/js/common_scripts.min.js')}}"></script>
    <script src="{{asset('/pageuser/js/main.js')}}"></script>

	<!-- SPECIFIC SCRIPTS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('elements.toastr')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    @yield('javascript')

    <script>
        $(document).on("click",".deleteCart",function() {
            let id = $(this).attr('data-id');
            $.confirm({
                title: 'Xác nhận xoá',
                content: '<p style="color:red;">Bạn có chắc chắn muốn xoá không?</p>',
                buttons: {
                    'Có': {
                        action: function () {
                            Loading.show();
                            axios({
                                method: 'post',
                                url: '/home/delete-cart',
                                data: {
                                    id:id,
                                }
                            }).then(function (response) {
                                Toastr.success(response.data);
                                location.reload();
                            }).catch(function(error) {
                                Toastr.error(error.response.data);
                            }).finally(function() {
                                Loading.hide();
                            });
                        }
                    },
                    'Không':{
                        action: function () {

                        }
                    }

                }
            });

        });
    </script>
    <script lang="javascript">var __vnp = {code : 6752,key:'', secret : 'c5ff0fd2b489c23b849a58544d02e246'};(function() {var ga = document.createElement('script');ga.type = 'text/javascript';ga.async=true; ga.defer=true;ga.src = '//core.vchat.vn/code/tracking.js';var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script>
</body>
</html>
