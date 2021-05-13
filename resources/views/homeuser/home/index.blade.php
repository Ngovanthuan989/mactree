@extends('homeuser.layout.master')
@section('home')
@include('homeuser.layout.slide')
@include('homeuser.layout.banner')
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm bán chạy</h2>
            <p><sp>Tốt nhất, rẻ nhất và được nhiều người mua nhất</sp></p>
        </div>
        <div class="row small-gutters">
            @foreach ($get_product as $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <figure>
                            <span class="ribbon off">-0%</span>
                            <a href="product-detail-1.html">
                                <img class="img-fluid lazy" src="{{asset('/uploads/images/'.$product->product_img.'')}}" data-src="{{asset('/uploads/images/'.$product->product_img.'')}}" alt="">
                                <img class="img-fluid lazy" src="{{asset('/uploads/images/'.$product->product_img.'')}}" data-src="{{asset('/uploads/images/'.$product->product_img.'')}}" alt="">
                            </a>
                            <div data-countdown="2021/09/15" class="countdown"></div>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="">
                            <h3>{{$product->product_name}}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">{{number_format($product->unit_price,0,'','.')}}đ</span>
                            <span class="old_price">{{number_format($product->price_sale,0,'','.')}}đ</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            @endforeach
            <!-- /col -->

            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="featured lazy" data-bg="url({{asset('/PageUser/img/mactree1200x800.png')}})">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container margin_60">
                <div class="row justify-content-center justify-content-md-start">
                    <div class="col-lg-6 wow" data-wow-offset="150">
                        <h3>MacBook pro m1<br></h3>
                        <p>Hiệu năng đỉnh cao trong cái máy mỏng nhẹ</p>
                        <div class="feat_text_block">
                            <div class="price_box">
                                <span class="new_price">$900.00</span>
                                <span class="old_price">$1700.00</span>
                            </div>
                            <a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
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
            @foreach ($get_product as $product)
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="{{asset('/uploads/images/'.$product->product_img.'')}}" data-src="{{asset('/uploads/images/'.$product->product_img.'')}}" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="product-detail-1.html">
                            <h3>{{$product->product_name}}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">{{number_format($product->unit_price,0,'','.')}}đ</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            @endforeach
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->
@endsection

