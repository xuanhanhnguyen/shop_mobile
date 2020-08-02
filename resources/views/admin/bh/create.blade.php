@extends('admin.layout.admin')

@section('app')
@section('title', 'Dashboard')

@section('content_header')
    <h5><a href="#" onclick="window.history.back();">Quản lý báo hành</a> / Thêm sản phẩm bảo hành</h5>
@stop

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <div class="callout-top callout-top-danger col-md-12">
        <form action="/admin/bh" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Mã bảo hành:</label>
                <select class="form-control" onchange="loadData(event)" name="hoa_don_id" required>
                    @foreach($hd as $item)
                        <option value="{{$item->id}}">HĐ00{{$item->id}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Tên sản phẩm:</label>
                <select class="form-control" name="san_pham_id" required id="data">
                    {{--@foreach($sp as $item)--}}
                        {{--<option value="{{$item->id}}">{{$item->ten_sp}}</option>--}}
                    {{--@endforeach--}}
                </select>

            </div>
            <div class="form-group">
                <label for="">Lý do bảo hành:</label>
                <textarea type="text"
                          class="form-control" name="ly_do_bao_hanh" aria-describedby="helpId" placeholder=""
                          required></textarea>
            </div>
            <div class="text-center">
                <button class="btn btn-sm btn-outline-success" type="submit">+Thêm</button>
            </div>
        </form>
    </div>
    <script>
        function loadData(e) {
            var id = e.target.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get("/admin/bh/" + id + "/edit", function (data) {
                var str = "";
                for (var i = 0; i < data.length; i++) {
                    str += "<option value='"+ data[i].san_pham.id +"'>"+ data[i].san_pham.ten_sp+"</option>";
                }
                $("#data").html(str);
            })
        }

        // $.ajax({
        //     url: '/admin/store',
        //     method: 'GET',
        //     data: {
        //         ncc_id: $('select[name="ncc_id"]').val(),
        //         ngay_nhap: $('input[name="ngay_nhap"]').val(),
        //         manny: manny,
        //         san_pham: san_pham
        //     }
        // }).done(function (data) {
        //     console.log(data);
        //     alert("Giao dịch thành công!");
        //     location.href = "/admin/store";
        // }).fail(function () {
        //     alert("Giao dịch không thành công!")
        // })
    </script>
@stop
@stop
