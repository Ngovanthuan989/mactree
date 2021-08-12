@extends('homeuser.layout.master')
@section('link')
    <link href="{{asset('/pageuser/css/home_1.css')}}" rel="stylesheet">
@endsection
@section('home')
@include('homeuser.layout.slide')
@include('homeuser.layout.banner')
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm bán chạy</h2>
            <p><sp>Tốt nhất, rẻ nhất và được nhiều người mua nhất</sp></p>
        </div>
        <div class="row small-gutters">
            @foreach ($get_product as $product_2)
                @if ($product_2->status == 1 && $product_2->collection==2)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            <figure>
                                <span class="ribbon off">Hot</span>
                                <a href="/home/product-detail/{{$product_2->id}}">
                                    <img class="img-fluid lazy" src="{{asset('/uploads/images/'.$product_2->product_img.'')}}" data-src="{{asset('/uploads/images/'.$product_2->product_img.'')}}" alt="">
                                    <img class="img-fluid lazy" src="{{asset('/uploads/images/'.$product_2->product_img.'')}}" data-src="{{asset('/uploads/images/'.$product_2->product_img.'')}}" alt="">
                                </a>
                            </figure>
                            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                            <a href="/home/product-detail/{{$product_2->id}}">
                                <h3>{{$product_2->product_name}}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{number_format($product_2->unit_price,0,'','.')}}đ</span>
                                <span class="old_price">{{number_format($product_2->price_sale,0,'','.')}}đ</span>
                            </div>
                            {{-- <ul>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Thêm vào mục yêu thích"><i class="ti-heart"></i><span>Thêm vào mục yêu thích</span></a></li>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Thêm vào để so sánh"><i class="ti-control-shuffle"></i><span>Thêm vào để so sánh</span></a></li>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Thêm vào giỏ hàng"><i class="ti-shopping-cart"></i><span>Thêm vào giỏ hàng</span></a></li>
                            </ul> --}}
                        </div>
                        <!-- /grid_item -->
                    </div>
                @endif

            @endforeach
            <!-- /col -->

            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="featured lazy" data-bg="url({{asset('/pageuser/img/mactree1200x800.png')}})">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container margin_60">
                <div class="row justify-content-center justify-content-md-start">
                    <div class="col-lg-6 wow" data-wow-offset="150">
                        <h3>MacBook pro m1<br></h3>
                        <p>Hiệu năng đỉnh cao trong cái máy mỏng nhẹ</p>
                        <div class="feat_text_block">
                            <div class="price_box">
                                <span class="new_price">30.000.000đ</span>
                                <span class="old_price">35.000.000đ</span>
                            </div>
                            {{-- <a class="btn_1" href="listing-grid-1-full.html" role="button">Mua ngay</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /featured -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm mới</h2>
            <span>MACTREE</span>
            <p>Sản phẩm mới nhất</p>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            @foreach ($get_product as $product_1)
                @if ($product_1->status == 1 && $product_1->collection==1)
                    <div class="item">
                        <div class="grid_item">
                            <span class="ribbon new">Mới</span>
                            <figure>
                                <a href="/home/product-detail/{{$product_1->id}}">
                                    <img class="owl-lazy" src="{{asset('/uploads/images/'.$product_1->product_img.'')}}" data-src="{{asset('/uploads/images/'.$product_1->product_img.'')}}" alt="">
                                </a>
                            </figure>
                            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                            <a href="/home/product-detail/{{$product_1->id}}">
                                <h3>{{$product_1->product_name}}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{number_format($product_1->unit_price,0,'','.')}}đ</span>
                            </div>
                            {{-- <ul>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Thêm vào mục yêu thích"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="thêm vào để so sánh"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="thêm vào giỏ hàng"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                            </ul> --}}
                        </div>
                        <!-- /grid_item -->
                    </div>
                @endif
            @endforeach
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->
    @include('homeuser.layout.section')
@endsection
@section('javascript')
    <script src="{{asset('/pageuser/js/carousel-home.min.js')}}"></script>
@endsection
