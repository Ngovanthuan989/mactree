<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="/home"><img src="{{asset('/uploads/images/cacParis.png')}}" alt="" style="width: 50%;"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="/home"><img src="{{asset('/uploads/images/cacParis.png')}}" alt="" style="width: 50%;"></a>
                            <a href="/home" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li class="">
                                <a href="/home" class="show-submenu">Trang chủ</a>
                                <!-- <ul>
                                    <li><a href="index.html">Slider</a></li>
                                    <li><a href="index-2.html">Video Background</a></li>
                                    <li><a href="index-3.html">Vertical Slider</a></li>
                                    <li><a href="index-4.html">GDPR Cookie Bar</a></li>
                                </ul> -->
                            </li>
                            @foreach ($get_category as $category)
                            <li class="">
                                <a href="javascript:void(0);" class="show-submenu">{{$category->category_name}}</a>
                                <ul>
                                    @foreach ($get_product as $product)
                                        @if ($category->id == $product->category_id)
                                            <li><a href="/home/product-detail/{{$product->id}}">{{$product->product_name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach

                            <!-- <li class="megamenu submenu">
                                <a href="javascript:void(0);" class="show-submenu-mega">Pages</a>
                                <div class="menu-wrapper">
                                    <div class="row small-gutters">
                                        <div class="col-lg-3">
                                            <h3>Listing grid</h3>
                                            <ul>
                                                <li><a href="listing-grid-1-full.html">Grid Full Width</a></li>
                                                <li><a href="listing-grid-2-full.html">Grid Full Width 2</a></li>
                                                <li><a href="listing-grid-3.html">Grid Boxed</a></li>
                                                <li><a href="listing-grid-4-sidebar-left.html">Grid Sidebar Left</a></li>
                                                <li><a href="listing-grid-5-sidebar-right.html">Grid Sidebar Right</a></li>
                                                <li><a href="listing-grid-6-sidebar-left.html">Grid Sidebar Left 2</a></li>
                                                <li><a href="listing-grid-7-sidebar-right.html">Grid Sidebar Right 2</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <h3>Listing row &amp; Product</h3>
                                            <ul>
                                                <li><a href="listing-row-1-sidebar-left.html">Row Sidebar Left</a></li>
                                                <li><a href="listing-row-2-sidebar-right.html">Row Sidebar Right</a></li>
                                                <li><a href="listing-row-3-sidebar-left.html">Row Sidebar Left 2</a></li>
                                                <li><a href="listing-row-4-sidebar-extended.html">Row Sidebar Extended</a></li>
                                                <li><a href="product-detail-1.html">Product Large Image</a></li>
                                                <li><a href="product-detail-2.html">Product Carousel</a></li>
                                                <li><a href="product-detail-3.html">Product Sticky Info</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <h3>Other pages</h3>
                                            <ul>
                                                <li><a href="cart.html">Cart Page</a></li>
                                                <li><a href="checkout.html">Check Out Page</a></li>
                                                <li><a href="confirm.html">Confirm Purchase Page</a></li>
                                                <li><a href="account.html">Create Account Page</a></li>
                                                <li><a href="track-order.html">Track Order</a></li>
                                                <li><a href="help.html">Help Page</a></li>
                                                <li><a href="help-2.html">Help Page 2</a></li>
                                                <li><a href="leave-review.html">Leave a Review</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                            <div class="banner_menu">
                                                <a href="#0">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/banner_menu.jpg" width="400" height="550" alt="" class="img-fluid lazy">
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- /row -->
                                <!-- </div> -->
                                <!-- /menu-wrapper -->
                            <!-- </li>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu">Extra Pages</a>
                                <ul>
                                    <li><a href="header-2.html">Header Style 2</a></li>
                                    <li><a href="header-3.html">Header Style 3</a></li>
                                    <li><a href="header-4.html">Header Style 4</a></li>
                                    <li><a href="header-5.html">Header Style 5</a></li>
                                    <li><a href="404.html">404 Page</a></li>
                                    <li><a href="sign-in-modal.html">Sign In Modal</a></li>
                                    <li><a href="contacts.html">Contact Us</a></li>
                                    <li><a href="about.html">About 1</a></li>
                                    <li><a href="about-2.html">About 2</a></li>
                                    <li><a href="modal-advertise.html">Modal Advertise</a></li>
                                    <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="blog.html">Blog</a>
                            </li> -->

                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
                    <a class="phone_top" href="tel://0974613637"><strong><span>Liên hệ</span>+84974618888</strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            <li><span>
                                    <a href="#">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </span>
                                        Danh mục
                                    </a>
                                </span>
                                <div id="menu">
                                    <ul>
                                        {{-- <li><span><a>Bộ sưu tập</a></span>
                                            <ul>
                                                <li><a href="/home/collection/2">Sản phẩm bán chạy</a></li>
                                                <li><a href="/home/collection/2">Sản phẩm mới</a></li>

                                            </ul>
                                        </li> --}}

                                        @foreach ($get_category as $category)
                                            <li><span><a href="javascript:void(0);">{{$category->category_name}}</a></span>
                                                <ul>

                                                    @foreach ($get_product as $product)
                                                        @if ($category->id == $product->category_id)
                                                            <li><a href="/home/product-detail/{{$product->id}}">{{$product->product_name}}</a></li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <form action="/home" method="get">
                        <div class="custom-search-input">
                            @if (isset($product_name))
                                <input type="text" name="product_name" placeholder="Tìm kiếm sản phẩm" value="{{$product_name}}">
                            @else
                                 <input type="text" name="product_name" placeholder="Tìm kiếm sản phẩm" value="">
                            @endif
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </div>
                    </form>
                </div>
                <?php
                    $content = Cart::content();
                ?>
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="cart.html" class="cart_bt"><strong>{{count($content)}}</strong></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        @foreach($content as $v_content)
                                            <li>
                                                <a href="/home/product-detail/{{$v_content->id}}">
                                                    <figure><img src="{{asset('/uploads/images/'.$v_content->options->image.'')}}" data-src="{{asset('/uploads/images/'.$v_content->options->image.'')}}" alt="" width="50" height="50" class="lazy"></figure>
                                                    <strong><span>{{$v_content->name}}</span>{{number_format($v_content->price).' vnd'}}</strong>
                                                </a>
                                                <a type="button" class="action deleteCart" data-id="{{$v_content->rowId}}"><i class="ti-trash"></i></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="total_drop">
                                        <div class="clearfix"><strong>Tổng tiền</strong><span>{{Cart::subtotal().' '.'vnd'}}</span></div>
                                        @if (count($content)>0)
                                            <a href="/home/show-cart" class="btn_1 outline">Xem giỏ hàng</a><a href="/home/checkout" class="btn_1">Thanh Toán</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="/home/profile" class="access_link"><span>Account</span></a>
                                <div class="dropdown-menu">
                                    @if ($userHome)
                                        <a href="/home/logout" class="btn_1">Đăng xuất</a>
                                    @else
                                        <a href="/home/account" class="btn_1">Đăng nhập hoặc đăng ký</a>
                                    @endif
                                    @if ($userHome)
                                        <ul>
                                            <li>
                                                <a href="/home/order/show"><i class="ti-package"></i>Đơn hàng của tôi</a>
                                            </li>
                                            <li>
                                                <a href="/home/profile"><i class="ti-user"></i>Thông tin cá nhân</a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        {{-- <li>
                            <a href="javascript:void(0);" class="btn_search_mob"><span>Tìm kiếm</span></a>
                        </li>
                        <li>
                            <a href="#menu" class="btn_cat_mob">
                                <div class="hamburger hamburger--spin" id="hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                Categories
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>

            <div class="search_mob_wp">
                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm">
                <input type="submit" class="btn_1 full-width" value="Tìm kiếm">
            </div>

        <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>
