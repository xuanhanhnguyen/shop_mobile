@extends('admin.layout.admin')

@section('app')
@section('title', 'Dashboard')

@section('content_header')
    <h5>Danh sách hóa đơn</h5>
@stop

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo</h4>
            {{ session('message') }}
        </div>
    @endif
    <div class="callout-top callout-top-danger col-md-12 table-responsive">
        <table id="data-table" align="center" width="100%"
               class="table table-hover table-striped table-bordered border text-center">
            <thead>
            <tr class="bg-primary">
                <th>Mã hóa đơn</th>
                <th>Tên khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>
                    {{--<button class="btn btn-sm btn-success" onclick="location.href = 'order/create'">+Thêm</button>--}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $key=>$val)
                <tr>
                    <td style="min-width: 100px">HĐ00{{$val->id}}</td>
                    <td style="min-width: 300px" class="text-left">
                        <p>Họ & tên: {{$val->khach_hang->ten_kh}}</p>
                        <p>Email: {{$val->khach_hang->email}}</p>
                        <p>SĐT: {{$val->khach_hang->dien_thoai}}</p>
                        <p>Địa chỉ: {{$val->khach_hang->dia_chi}}</p>
                    </td>
                    <td style="min-width: 150px">
                        {{date_format(date_create($val['created_at']), "H:i d/m/yy")}}<br>
                        <span style="color: silver">{{$val->user ? $val->user->name: ''}}</span>
                    </td>
                    <td style="min-width: 100px">{{_manny($val->tong_tien)}}đ</td>
                    <td>
                        <form action="/admin/order/{{$val->id}}" method="post">
                            @method('put')
                            @csrf
                            @if($val->trang_thai == 0)
                                <p class="text-info">Đơn hàng mới</p>
                                <input type="text" name="trang_thai" value="1" class="d-none">
                                <button class="badge badge-info" >Xuất hóa đơn</button>
                            @elseif($val->trang_thai == 1)
                                <p class="text-danger">Đã xuất hóa đơn</p>
                                <input type="text" name="trang_thai" value="2" class="d-none">
                                <button class="badge badge-success" >Đã thanh toán</button>
                            @else
                                <p class="text-success">Đã thanh toán</p>
                            @endif
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info"
                                onclick="location.href = 'order-detail/{{$val->id}}'">Xem
                        </button>
                        <button class="btn btn-sm btn-outline-danger"
                                onclick="confirm('Đồng ý xóa?') ? document.getElementById('{{"delete".$val->id}}').submit():''">
                            Xóa
                        </button>
                        <form id="delete{{$val->id}}" action="order/{{$val->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@stop
@stop
