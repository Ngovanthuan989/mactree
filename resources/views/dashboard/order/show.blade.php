@extends('dashboard.layout.master')
<style>
    .label.label-lg {
        font-size: 8px !important;
    }
</style>
@section('main')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Danh sách đơn hàng</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <!--end::Actions-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->

            <!--end::Toolbar-->
        </div>
    </div>

    <div class="container">
        <div class="col-xs-12" id="show_success_mss" style="display: none;"></div>
        @include('elements.show_error')
        <!--begin::Card-->
        <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Tìm kiếm đơn hàng</h3>
            </div>
            <!-- /.card-header -->
            <form id="form" method="get">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Mã đơn hàng</label>
                        <input type="text" name="order_code" class="form-control order_code" placeholder="Mã đơn hàng" value="">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                        <label>Mã vận chuyển</label>
                        <input type="text" name="ship_code" class="form-control ship_code" placeholder="Mã vận chuyển" value="">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control select2bs4" id="status" name="status" style="width: 80%;">
                            <option value="1" @if (isset($status) && $status==1)
                                selected
                            @endif>Chờ duyệt</option>
                            <option value="2"@if (isset($status) && $status==2)
                                selected
                            @endif>Đã duyệt</option>
                            <option value="3"@if (isset($status) && $status==3)
                                selected
                            @endif>Đang vận chuyển</option>
                            <option value="4"@if (isset($status) && $status==4)
                                selected
                            @endif>Giao hàng thành công</option>
                            <option value="5"@if (isset($status) && $status==5)
                                selected
                            @endif>Hoàn hàng</option>
                            <option value="0"@if (isset($status) && $status==0)
                                selected
                            @endif>Đã huỷ</option>
                        </select>
                        </div>
                        <!-- /.form-group -->
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Thời gian tạo đơn</label>
                            <div class="input-daterange input-group js-datepicker-enabled" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control"
                                        id="daterange-st" name="created_at_from"
                                        placeholder="Từ ngày"
                                        data-week-start="1"
                                        data-autoclose="true"
                                        data-today-highlight="true"
                                        value="{{ request('created_at_from') }}"
                                        autocomplete="off">
                                 <input type="text" class="form-control"
                                        id="daterange-nd" name="created_at_to"
                                        placeholder="Đến ngày" data-week-start="1"
                                        data-autoclose="true" data-today-highlight="true"
                                        value="{{ request('created_at_to') }}"
                                        autocomplete="off">
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm</button>
                </div>
            </form>
        </div>
        <br>
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Đơn hàng
                    <div class="text-muted pt-2 font-size-sm">Số lượng: </div></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                {{-- <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-print"></i>
                                        </span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-copy"></i>
                                        </span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li> --}}
                                <li class="navi-item">
                                    <a href="/order/export" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                {{-- <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-text-o"></i>
                                        </span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li> --}}
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                    <!--begin::Button-->

                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="kt_datatable_length"><label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                <table class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info">
                    <thead>
                        <tr role="row">
                            <th>Mã đơn hàng</th>
                            <th>Mã vận chuyển</th>
                            <th>Khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Doanh thu</th>
                            <th>Người xử lý</th>
                            <th>Trạng thái</th>
                            <th>Vận chuyển</th>
                            <th>Ngày cập nhập</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 105px;" aria-label="Actions">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($get_order as $get_orders)
                        {{-- @dd($get_orders->customer[0]->full_name); --}}
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">
                                <div class="d-flex align-items-center">
                                    <div class="ml-3">
                                        <a href="{{ route('dashboard.order.edit', ['id' => $get_orders->order_code]) }}" class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">{{$get_orders->order_code}}</a>
                                    </div>
                                </div>
                            </td>
                            @if (isset($get_orders->ship_code))
                                <td>{{$get_orders->ship_code}}</td>
                            @else
                                <td></td>
                            @endif
                            @if (isset($get_orders->customer[0]))
                                <td>{{$get_orders->customer[0]->full_name}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$get_orders->phone}}</td>
                            <td>{{$get_orders->total_money}}</td>
                            <td></td>
                            @if ($get_orders->status == 1)
                                <td><span class="label label-lg font-weight-bold label-light-primary label-inline">Đang chờ duyệt</span></td>
                            @elseif($get_orders->status == 2)
                                <td><span class="label label-lg font-weight-bold label-inline" style="color: white;
                                    background-color: orange;">Đã duyệt</span></td>
                            @elseif($get_orders->status == 3)
                                <td><span class="label label-lg font-weight-bold label-light-info label-inline">Đang vận chuyển</span></td>
                            @elseif($get_orders->status == 4)
                                <td><span class="label label-lg font-weight-bold label-light-success label-inline">Giao hàng thành công</span></td>
                            @elseif($get_orders->status == 5)
                                <td><span class="label label-lg font-weight-bold label-light-warning label-inline">Hoàn hàng</span></td>
                            @elseif($get_orders->status == 0)
                                <td><span class="label label-lg font-weight-bold label-light-danger label-inline">Đơn huỷ</span></td>
                            @endif

                            @if (isset($get_orders->ship[0]))
                                <td>{{$get_orders->ship[0]->ship_name}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ date('d/m/Y H:i', strtotime($get_orders->updated_at)) }}</td>
                            <td nowrap="nowrap">
                                <a href="{{ route('dashboard.order.edit', ['id' => $get_orders->order_code]) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                    <i class="la la-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$get_order->links()}}
            </div>
        </div>
    </div>
</div>
</div>
<!--end::Card-->
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="https://devtest.baokim.vn:9408/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?v=6"></script>


<script>
    $('#daterange-st').datepicker();
    $('#daterange-nd').datepicker();

</script>

@endsection


