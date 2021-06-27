@extends('homeuser.layout.master')
@section('link')
    <link href="{{asset('/pageuser/css/cart.css')}}" rel="stylesheet">
    <style>
        .table.cart-list td .numbers {
            background-color: #fff;
        }
        .numbers {
            position: relative;
            width: 100%;
            height: 40px;
            overflow: visible;
            border: 1px solid #dddddd;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            border-radius: 3px;
            background-color: #fff;
            text-align: left !important;
        }
    </style>
@endsection
@section('home')
    @include('elements.show_error')

    <div class="container margin_30">
    <div class="page_header">
        <div class="breadcrumbs">
            <ul>
                <li><a href="/home">Trang chủ</a></li>
                <li><a href="/home/show-cart">Giỏ hàng</a></li>
            </ul>
        </div>
        <h1>Chi tiết giỏ hàng</h1>
    </div>
    <?php
        $content = Cart::content();

    ?>
    <!-- /page_header -->
    <table class="table table-striped cart-list">
        <thead>
            <tr>
                <th>
                    Sản phẩm
                </th>
                <th>
                    Đơn giá
                </th>
                <th>
                    Số lượng
                </th>
                <th>
                    Thành tiền
                </th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($content as $v_content)
                <tr>
                    <td>
                        <div class="thumb_cart">
                            <img src="{{asset('/uploads/images/'.$v_content->options->image.'')}}" data-src="{{asset('/uploads/images/'.$v_content->options->image.'')}}" class="lazy" alt="Image">
                        </div>
                        <span class="item_cart">{{$v_content->name}}</span>
                    </td>
                    <td>
                        <strong>{{number_format($v_content->price).' vnd'}}</strong>
                    </td>
                    <td>
                        <div class="numbers">
                            <input type="number" value="{{$v_content->qty}}" id="qty_{{$v_content->rowId}}" class="qty2" name="qty">
                            <div class="inc button_inc" row-id="{{$v_content->rowId}}">+</div>
                            <div class="dec button_inc" row-id="{{$v_content->rowId}}">-</div>
                        </div>
                    </td>
                    <td>
                        <strong>{{number_format($v_content->price * $v_content->qty).' vnd'}}</strong>
                    </td>
                    <td class="options">
                        <a type="button" class="delete_cart" data-id="{{$v_content->rowId}}"><i class="ti-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

        <div class="row add_top_30 flex-sm-row-reverse cart_actions">
            {{-- <div class="col-sm-4 text-right">
                <button type="button" class="btn_1 gray">Update Cart</button>
            </div>
                <div class="col-sm-8">
                <div class="apply-coupon">
                    <div class="form-group form-inline">
                        <input type="text" name="coupon-code" value="" placeholder="Promo code" class="form-control"><button type="button" class="btn_1 outline">Apply Coupon</button>
                    </div>
                </div>
            </div> --}}
        </div>
                <!-- /cart_actions -->

    </div>
    <!-- /container -->
    @if (count($content)>0)
        <div class="box_cart">
            <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
            <ul>
                <li>
                    <span>Tổng giá trị đơn hàng</span> {{Cart::subtotal().' '.'vnd'}}
                </li>
                {{-- <li>
                    <span>Shipping</span> $7.00
                </li> --}}
                <li>
                    <span>Thanh Toán</span> {{Cart::subtotal().' '.'vnd'}}
                </li>
            </ul>

                <a href="/home/checkout" class="btn_1 full-width cart">Thanh Toán</a>

            {{-- <a href="/home/checkout" class="btn_1 full-width cart">Thanh Toán</a> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- /box_cart -->


@endsection
@section('javascript')
    <script>
        $(document).on("click",".delete_cart",function() {
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


<script>
    $(document).on("click",".dec",function() {
        Loading.show();
        var id  = $(this).attr('row-id');
        var qty = $('#qty_'+id+'').val();
        axios({
            method: 'post',
            url: '/home/update-cart',
            data: {
                id:id,
                qty:qty
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
    $(document).on("click",".inc",function() {
        Loading.show();
        var id  = $(this).attr('row-id');
        var qty = $('#qty_'+id+'').val();
        axios({
            method: 'post',
            url: '/home/update-cart',
            data: {
                id:id,
                qty:qty
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
@endsection
