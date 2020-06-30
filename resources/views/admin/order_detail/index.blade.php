@extends('admin.layout.admin')

@section('app')
@section('title', 'Dashboard')

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
        <div class="header text-center mb-2">
            <h5>CHI TIẾT HÓA ĐƠN</h5>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p>Mã hóa đơn: HD00{{$hd->id}}</p>
                <p>Họ tên khách hàng: {{$hd->khach_hang->ten_kh}}</p>
            </div>
            <div class="col-md-4">
                <p>Số điện thoại: {{$hd->khach_hang->dien_thoai}}</p>
                <p>Email: {{$hd->khach_hang->email}}</p>
            </div>
            <div class="col-md-4">
                <p>Địa chỉ: {{$hd->khach_hang->dia_chi}}</p>
            </div>
        </div>
        <table class="w-100 table table-bordered text-center" align="center">
            <thead>
            <tr class="bg-primary">
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cthd as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->san_pham->ten_sp}}</td>
                    <td>{{$item->sl_mua}}</td>
                    <td style="width: 100px">
                        <img class="w-100" src="/uploads/product/{{$item->san_pham->hinh_anh}}" alt="ảnh">
                    </td>
                    <td>{{_manny($item->don_gia)}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="border-right text-right">
                    <b>Tổng tiền(VNĐ)</b>
                </td>
                <td colspan="1" class="pl-2 border-right">
                    {{_manny($hd->tong_tien)}} VNĐ
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@stop
@stop
