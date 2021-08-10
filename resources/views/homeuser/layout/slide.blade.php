<div id="carousel-home">
    <div class="owl-carousel owl-theme">
        @foreach ($get_slider as $slider)
            <div class="owl-slide cover" style="background-image: url({{asset('/uploads/images/'.$slider->slider_img.'')}});">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-right white">
                                    <h2 class="owl-slide-animated owl-slide-title">{{$slider->name}}<br></h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        {{$slider->content}}
                                    </p>
                                    {{-- <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Mua ngay</a></div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!--/owl-slide-->
        {{-- <div class="owl-slide cover" style="background-image: url({{asset('/pageuser/img/slides/slideTH/2.png')}});">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-lg-6 static">
                            <div class="slide-text white">
                                <h2 class="owl-slide-animated owl-slide-title">iPhone 12 Pro max<br></h2>
                                <p class="owl-slide-animated owl-slide-subtitle">
                                    Thời thượng, đẳng cấp hiệu năng, pro vjp
                                </p>
                                <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Mua ngay</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>Mua ngay
        </div>
        <!--/owl-slide-->
        <div class="owl-slide cover" style="background-image: url({{asset('/pageuser/img/slides/slideTH/3.png')}});">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(255, 255, 255, 0.5)">
                <div class="container">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-lg-12 static">
                            <div class="slide-text text-center black">
                                <h2 class="owl-slide-animated owl-slide-title">mac book air<br></h2>
                                <p class="owl-slide-animated owl-slide-subtitle">
                                    Mỏng nhẹ, thời thượng cho dân văn phòng
                                </p>
                                <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Mua ngay</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/owl-slide-->
        </div> --}}
    </div>
	<div id="icon_drag_mobile"></div>
</div>
