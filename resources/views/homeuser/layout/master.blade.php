<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>MacTree</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('/PageUser/img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('/PageUser/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('/PageUser/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('/PageUser/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('/PageUser/img/apple-touch-icon-144x144-precomposed.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('/PageUser/css/bootstrap.custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('/PageUser/css/style.css')}}" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="{{asset('/PageUser/css/home_1.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('/PageUser/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
    <script src="{{asset('/PageUser/js/common_scripts.min.js')}}"></script>
    <script src="{{asset('/PageUser/js/main.js')}}"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="{{asset('/PageUser/js/carousel-home.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('elements.toastr')

    @yield('javascript')

</body>
</html>
