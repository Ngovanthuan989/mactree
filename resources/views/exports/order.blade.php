<table>
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Mã vận chuyển</th>
            <th>Khách hàng</th>
            <th>Số điện thoại</th>
            <th>Doanh thu</th>
            <th>Người xử lý</th>
            <th>Trạng thái</th>
            <th>Vận chuyển</th>
            <th>Ngày cập nhập</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $get_orders)
        <tr>
            <td>
                {{$get_orders->order_code}}
            </td>
            @if (isset($get_orders->ship_code))
                <td>{{$get_orders->ship_code}}</td>
            @else
                <td></td>
            @endif
            <td>{{$get_orders->customer[0]->full_name}}</td>
            <td>{{$get_orders->phone}}</td>
            <td>{{$get_orders->total_money}}</td>
            <td></td>
            @if ($get_orders->status == 1)
                <td>Đang chờ duyệt</td>
            @elseif($get_orders->status == 2)
                <td>Đã duyệt</td>
            @elseif($get_orders->status == 3)
                <td>Đang vận chuyển</td>
            @elseif($get_orders->status == 4)
                <td>Giao hàng thành công</td>
            @elseif($get_orders->status == 5)
                <td>Hoàn hàng</td>
            @elseif($get_orders->status == 0)
                <td>Đơn huỷ</td>
            @endif

            @if (isset($get_orders->ship[0]))
                <td>{{$get_orders->ship[0]->ship_name}}</td>
            @else
                <td></td>
            @endif
            <td>{{ date('d/m/Y H:i', strtotime($get_orders->updated_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
