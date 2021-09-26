@extends('homeuser.layout.master')
@section('link')
    <link href="{{asset('/pageuser/css/product_page.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://devtest.baokim.vn:9403/css/bk.css">
    <style>
        header .main_header {
            position: relative;
            z-index: 0 !important;
        }
        header .main_nav {
            position: relative;
            z-index: 0 !important;
        }
    </style>
@endsection
 <!-- BK MODAL -->
 <div id='bk-modal'></div>
 <!-- END BK MODAL -->
@section('home')
    <div class="container margin_30">

        <form action="{{ route('homePage.cart.save') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <input name="productId_hidden" type="hidden" value="{{$get_product->id}}" />
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                <div style="background-image: url({{asset('/uploads/images/'.$get_product->product_img.'')}});" class="item-box"></div>

                                @foreach ($get_product->productImg as $item)
                                    <div style="background-image: url({{$item->image}});" class="item-box"></div>
                                @endforeach
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                <div style="background-image: url({{asset('/uploads/images/'.$get_product->product_img.'')}});" class="item active"></div>
                                @foreach ($get_product->productImg as $item)
                                    <div style="background-image: url({{$item->image}});" class="item active"></div>
                                @endforeach
                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Category</a></li>
                            <li>Page active</li>
                        </ul>
                    </div>
                    <!-- /page_header -->
                    <div class="prod_info">
                        <h1 class="bk-product-name">{{$get_product->product_name}}</h1>
                        {{-- <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><em>4 reviews</em></span> --}}
                        <p><small>Mã sản phẩm: {{$get_product->product_code}}</small><br>{{$get_product->product_description}}</p>
                        <img class="bk-product-image d-none" src="{{asset('/uploads/images/'.$get_product->product_img.'')}}" alt="">
                        <div class="prod_options">
                            <div class="row">
                                {{-- <label class="col-xl-5 col-lg-5  col-md-6 col-6 pt-0"><strong>Color</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
                                    <ul>
                                        <li><a href="#0" class="color color_1 active"></a></li>
                                        <li><a href="#0" class="color color_2"></a></li>
                                        <li><a href="#0" class="color color_3"></a></li>
                                        <li><a href="#0" class="color color_4"></a></li>
                                    </ul>
                                </div> --}}
                            </div>
                            {{-- <div class="row">
                                <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Size</strong> - Size Guide <a href="#0" data-toggle="modal" data-target="#size-modal"><i class="ti-help-alt"></i></a></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="custom-select-form">
                                        <select class="wide">
                                            <option value="" selected>Small (S)</option>
                                            <option value="">M</option>
                                            <option value=" ">L</option>
                                            <option value=" ">XL</option>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Số lượng</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="numbers-row">
                                        <input type="text" value="1" class="bk-product-qty" id="quantity_1" class="qty2" name="qty">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="bk-product-property" type="hidden" value="{{$get_product->product_code}}" />
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main"><span class="new_price bk-product-price">{{ number_format($get_product->price_sale) }}đ</span><span class="percentage">Giảm giá</span> <span class="old_price">{{ number_format($get_product->unit_price) }}đ</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class=""><button type="submit" class="btn_1">Thêm giỏ hàng</button></div>
                            </div>
                            <!-- BK BUTTON -->
                            <div class='bk-btn'></div>
                            <!-- END BK BUTTON -->

                        </div>
                    </div>
                    <!-- /prod_info -->
                    {{-- <div class="product_actions">
                        <ul>
                            <li>
                                <a href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="ti-control-shuffle"></i><span>Add to Compare</span></a>
                            </li>
                        </ul>
                    </div> --}}
                    <!-- /product_actions -->
                </div>
            </div>
        </form>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Chi tiết</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Mô tả ngắn</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                Chi tiết
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <h3>Chi tiết sản phẩm</h3>
                                    <div class="content_product">
                                        <p class="product_content">{{$get_product->product_content}}</p>
                                    </div>

                                </div>
                                <div class="col-lg-5">
                                    <h3>Thông số kĩ thuật</h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <tbody>
                                                {{-- <tr>
                                                    <td><strong>Color</strong></td>
                                                    <td>Blue, Purple</td>
                                                </tr> --}}
                                                <tr>
                                                    <td><strong>Kích thước</strong></td>
                                                    <td>{{$get_product->product_length}}x{{$get_product->product_width}}x{{$get_product->product_height}}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td><strong>Weight</strong></td>
                                                    <td>0.6kg</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Manifacturer</strong></td>
                                                    <td>Manifacturer</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                Reviews
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
                                            {{-- <em>Published 54 minutes ago</em> --}}
                                        </div>
                                        <h4>"Mô tả ngắn sản phầm"</h4>
                                        <p>{{$get_product->product_description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm liên quan</h2>
            <span>Products</span>
            <p></p>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            @foreach ($get_product_lq as $product_lq)
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="/home/product-detail/{{$product_lq->id}}">
                                <img class="owl-lazy" src="{{asset('/uploads/images/'.$product_lq->product_img.'')}}" data-src="{{asset('/uploads/images/'.$product_lq->product_img.'')}}" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="/home/product-detail/{{$product_lq->id}}">
                            <h3>{{$product_lq->product_name}}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">{{number_format($product_lq->unit_price,0,'','.')}}đ</span>
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

    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>Free Shipping</h3>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>Secure Payment</h3>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>Hỗ trợ 24/7</h3>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

@endsection
@section('javascript')
    <!-- BK JS -->
    <script src="https://pc.baokim.vn/js/bk_plus_v2.popup.js"></script>
    <!-- END BK JS -->
    <script src="{{asset('/pageuser/js/carousel_with_thumbs.js')}}"></script>
    <script>
        var id = '{{$get_product->product_code}}';
        var meta = {"product": {"id": id}};
    </script>
    <script>
        var html  = $('.product_content').text();
        html.outerHTML;
        $('.content_product').html(html);
    </script>
@endsection
