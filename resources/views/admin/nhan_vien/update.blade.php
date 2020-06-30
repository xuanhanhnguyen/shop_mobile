@extends('admin.layout.admin')

@section('app')
@section('title', 'Dashboard')

@section('content_header')
    <h5><a href="#" onclick="window.history.back();">Quản lý tin tức</a> / Cập nhật tin tức</h5>
@stop

@section('content')
    <div class="callout-top callout-top-danger col-md-12">
        <form action="/admin/nv/{{$nv->id}}" method="POST"
              enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="title">Họ & tên:</label>
                <input type="text" class="form-control" value="{{$nv->ho_ten}}" name="ho_ten" required>
            </div>
            <div class="form-group">
                <label for="title">Ngày sinh:</label>
                <input type="date" class="form-control" value="{{$nv->ngay_sinh}}" name="ngay_sinh" required>
            </div>
            <div class="form-group">
                <label for="title">Điện thoại:</label>
                <input type="text" class="form-control" value="{{$nv->dien_thoai}}" name="dien_thoai" required>
            </div>
            <div class="form-group">
                <label for="title">Địa chỉ:</label>
                <textarea type="text" class="form-control" name="dia_chi" required>{{$nv->dia_chi}}</textarea>
            </div>
            <div class="text-center">
                <button class="btn btn-sm btn-warning" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
@stop
@stop
