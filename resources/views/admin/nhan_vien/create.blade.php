@extends('admin.layout.admin')

@section('app')
@section('title', 'Dashboard')

@section('content_header')
    <h5><a href="#" onclick="window.history.back();">Quản lý nhân viên</a> / Thêm nhân viên</h5>
@stop

@section('content')
    <div class="callout-top callout-top-danger col-md-12">
        <form action="/admin/nv" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Họ & tên:</label>
                <input type="text" class="form-control" name="ho_ten" required>
            </div>
            <div class="form-group">
                <label for="title">Ngày sinh:</label>
                <input type="date" class="form-control" name="ngay_sinh" required>
            </div>
            <div class="form-group">
                <label for="title">Điện thoại:</label>
                <input type="text" class="form-control" name="dien_thoai" required>
            </div>
            <div class="form-group">
                <label for="title">Địa chỉ:</label>
                <textarea type="text" class="form-control" name="dia_chi" required></textarea>
            </div>
            <div class="text-center">
                <button class="btn btn-sm btn-outline-success" type="submit">+Thêm</button>
            </div>
        </form>
    </div>
@stop
@stop
