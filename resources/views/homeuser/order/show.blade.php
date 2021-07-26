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
                <li><a href="/home/show-cart">Đơn hàng</a></li>
            </ul>
        </div>
        <h1>Đơn hàng của tôi</h1>
    </div>

    <!-- /page_header -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    Mã đơn hàng
                </th>
                <th>
                   Trạng thái
                </th>
                <th>
                    Giá trị đơn hàng
                </th>
                <th>
                    Ngày đặt hàng
                </th>
                {{-- <th>
                    Thao tác
                </th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($get_order as $order)
                <tr>
                    <td>
                        <a href="/home/order/detail/{{$order->order_code}}">{{$order->order_code}}</a>
                    </td>
                    @if ($order->status == 1)
                        <td><span class="label label-lg font-weight-bold label-light-primary label-inline">Đang chờ duyệt</span></td>
                    @elseif($order->status == 2)
                        <td><span class="label label-lg font-weight-bold label-inline" style="color: white;
                            background-color: orange;">Đã duyệt</span></td>
                    @elseif($order->status == 3)
                        <td><span class="label label-lg font-weight-bold label-light-info label-inline">Đang vận chuyển</span></td>
                    @elseif($order->status == 4)
                        <td><span class="label label-lg font-weight-bold label-light-success label-inline">Giao hàng thành công</span></td>
                    @elseif($order->status == 5)
                        <td><span class="label label-lg font-weight-bold label-light-warning label-inline">Hoàn hàng</span></td>
                    @elseif($order->status == 0)
                        <td><span class="label label-lg font-weight-bold label-light-danger label-inline">Đơn huỷ</span></td>
                    @endif
                    <td>
                        <strong>{{$order->total_money}}</strong>
                    </td>
                    <td>
                        {{ date('d/m/Y', strtotime($order->created_at)) }}
                    </td>
                    {{-- @if ($order->status == 1 || $order->status == 2)
                        <td class="options">
                            <a type="button" class="delete_order" data-id="{{$order->id}}"><i class="ti-trash"></i></a>
                        </td>
                    @else
                        <td></td>
                    @endif --}}
                </tr>
            @endforeach
        </tbody>
    </table>

        <div class="row add_top_30 flex-sm-row-reverse cart_actions">

        </div>

    </div>
@endsection
@section('javascript')

@endsection
