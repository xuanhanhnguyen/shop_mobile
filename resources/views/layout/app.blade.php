<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Shop Mobile</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./common/OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="./common/OwlCarousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<style>
    .nav__logo-link:hover, .nav__link:hover {
        text-decoration: none;
        color: var(--green-color);
    }

    .footer__social-item {
        margin: 0 5px;
    }

    footer {
        background: black;
        color: white;
    }

    footer p, footer i {
        color: white;
    }
</style>
<body>
<!-- NAVIGATION  -->
@if (session('error'))
    <p class="desc m-0 text-danger">{{session('error')}}</p>
@endif
<nav class="nav">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="nav__logo">
            <a href="/" class="text-light nav__logo-link">
                <img src="./images/logo.png" alt="ảnh">
            </a>
        </div>
        <div class="nav__icon-bar">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <ul class="nav__list d-flex ">
            <li class="nav__item">
                <a href="/" class="nav__link {{ (request()->is('/')) ? 'active' : '' }}">
                    Trang chủ
                </a>
            </li>
            @foreach($cat as $item)
                <li class="nav__item">
                    <a href="/home/?cat={{$item->id}}&search={{$item->ten_loai}}"
                       class="nav__link {{ isset($_GET['cat']) && $_GET['cat'] == $item->id ? 'active' : '' }}">
                        {{$item->ten_loai}}
                    </a>
                </li>
            @endforeach
            <li class="nav__item">
                <a href="#" data-toggle="modal" data-target="#cart" onclick="getCart()"
                   class="nav__link">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<script>
    function _money(str) {
        str = str.split('').reverse().join('');
        var tg = "";
        var i = 0;
        for (i; i < str.length; i++) {
            tg += str[i];
            if (i !== str.length - 1 && (i + 1) % 3 === 0) {
                tg += '.';
            }
        }
        return tg.split('').reverse().join('');
    }

    var obj = [];
    var ttien = 0;

    function getCart() {
        $.get('/cart', function (data) {
            var str =
                '<div class="row text-center">\n' +
                '    <div class="col-md-3">\n' +
                '        <p>Ảnh</p>\n' +
                '    </div>\n' +
                '    <div class="col-md-3"><p>Sản phẩm</p></div>\n' +
                '    <div class="col-md-3"><p>Số lượng</p></div>\n' +
                '    <div class="col-md-3"><p>Thành tiền</p></div>\n' +
                '</div>';
            var sl_mua = 0;
            ttien = 0;
            obj = [];
            data.map(v => {
                sl_mua = $('#item-' + v.id).val() > 0 ? $('#item-' + v.id).val() : 1;
                ttien += v.gia * sl_mua;
                obj = [...obj, {...v, sl_mua: sl_mua, don_gia: v.gia * sl_mua}];
                str += '<div class="row text-center">\n' +
                    '    <div class="col-md-3">\n' +
                    '        <img class="w-100" style="height: 50px" src="/uploads/product/' + v.hinh_anh + '" alt="ảnh">\n' +
                    '    </div>\n' +
                    '    <div class="col-md-3">\n' +
                    '        <p class="text-danger">' + v.ten_sp + '</p>\n' +
                    '    </div>\n' +
                    '    <div class="col-md-3">\n' +
                    '        <input class="form-control" onchange="getCart()" id="item-' + v.id + '" type="number" value="' + sl_mua + '">\n' +
                    '    </div>\n' +
                    '    <div class="col-md-3">\n' +
                    '        <p class="text-danger">' + _money((v.gia * sl_mua) + "") + 'đ</p>\n' +
                    '    </div>\n' +
                    '</div>' +
                    '';
            });
            str +=
                '<hr class="w-100"><div class="row text-center">\n' +
                '    <div class="col-md-3">\n' +
                '       \n' +
                '    </div>\n' +
                '    <div class="col-md-3"></div>\n' +
                '    <div class="col-md-3"><p>Tổng tiền:</p></div>\n' +
                '    <div class="col-md-3"><p class="text-danger">' + _money(ttien + "") + 'đ</p></div>\n' +
                '</div>';
            $('#data').html(str);
        });
    }
</script>
<div class="modal fade show" id="cart" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center text-info">GIỎ HÀNG</h3>
                <hr class="w-100">
                <div id="data">

                </div>
                <div class="form-group m-0">
                    <label for="title">Họ & tên:</label>
                    <input type="text" class="form-control m-0" name="_name" required="">
                </div>
                <div class="row">
                    <div class="form-group m-0 col-md-6">
                        <label for="title">Email:</label>
                        <input type="email" class="form-control m-0" name="_email" required="">
                    </div>
                    <div class="form-group m-0 col-md-6">
                        <label for="title">Điện thoại:</label>
                        <input type="number" class="form-control m-0" name="_phone" required="">
                    </div>
                </div>
                <div class="form-group m-0">
                    <label for="title">Địa chỉ:</label>
                    <input type="text" class="form-control m-0" name="_address" required="">
                </div>

                <div class="col-12 text-center mt-3">
                    <button id="book" onclick="orderr()"
                            class="btn btn-outline-danger">
                        Đặt hàng
                    </button>
                </div>

                <script>
                    function inputNull(name, text) {
                        if (name.trim() == '') {
                            alert(text + ' không được để trông!');
                            return true;
                        }
                        return false
                    }

                    function orderr() {
                        if (ttien === 0 && obj.length <= 0) {
                            alert("Giỏ hàng trống, vui lòng chọn sản phẩm!");
                            return;
                        }
                        const name = $('input[name="_name"]').val();
                        if (inputNull(name, 'Họ & tên')) {
                            return;
                        }
                        const email = $('input[name="_email"]').val();
                        if (inputNull(email, 'Email')) {
                            return;
                        }
                        const phone = $('input[name="_phone"]').val();
                        if (inputNull(phone, 'Điện thoại')) {
                            return;
                        }
                        const address = $('input[name="_address"]').val();
                        if (inputNull(address, 'Địa chỉ')) {
                            return;
                        }

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.post('/orderCart', {
                            ten_kh: name,
                            email: email,
                            dien_thoai: phone,
                            dia_chi: address,
                            san_pham: obj,
                            tong_tien: ttien
                        }, function (data) {
                            console.log(data);
                            if (data == 1) {
                                alert("Đặt hàng thành công, vui lòng chờ điện thoại xác nhận!");
                                $('#exampleModalCenter').modal('hide');
                            }else if(data == 0){
                                alert("Số lượng sản phẩm không đủ!");
                            } else {
                                alert("Đặt hàng thất bại, vui lòng thử lại!");
                            }
                        });
                    }
                </script>
                <style>
                    .form-group, .btn {
                        font-size: 15px;
                    }

                    .form-control {
                        height: calc(2.25rem + 10px) !important;
                        padding: .5rem .75rem;
                        font-size: 15px;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
<style>
    p, a {
        font-size: 15px !important;
    }
</style>
<!-- HEADER  -->
<header id="home" style="background-image: url('/images/banner.jpg')"
        class="header d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto text-center">
                <div class="header__content">
                    <h2 class="header__heading  heading-hero">
                        Welcome to Đức Huy Moblie
                    </h2>
                    <p class="header__desc desc desc-white">
                        Chào mừng bạn đến với website của chúng tôi, hay thử trải nghiệm nó nhé!
                    </p>

                    <form id="search" action="/" method="GET">
                        <input name="search" style="height: 40px;font-size: 15px;" type="text" placeholder="Tìm kiếm"
                               class="form-control" value="{{isset($_GET['search']) ? $_GET['search']: ''}}">
                        <a onclick="document.getElementById('search').submit()"
                           class="text-light header__get button button-green">
                            Tìm kiếm <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <!-- SECTION BRAND  -->
    <section class="brand py-2 mt-2">
        <div class="container">
            <div class="row border-bottom border-top">
                @foreach($cat as $item)
                    <div class="col-12 col-sm-4 col-lg-2 border-left border-right">
                        <div class="brand__item text-center">
                            <a href="/?cat={{$item->id}}&search={{$item->ten_loai}}"
                               class="d-block">
                                <img src="/uploads/cat/{{$item->hinh_anh}}" alt="ảnh"
                                     class="brand__img img-fluid">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <ul class="list-unstyled d-flex align-content-center justify-content-around ">
                <li><a class="text-primary" href="?manny=1">Dưới 2 triệu</a></li>
                <li><a class="text-primary" href="?manny=2">Từ 2 - 4 triệu</a></li>
                <li><a class="text-primary" href="?manny=3">Từ 4 - 7 triệu</a></li>
                <li><a class="text-primary" href="?manny=4">Từ 7 - 13 triệu</a></li>
                <li><a class="text-primary" href="?manny=5">Trên 13 triệu</a></li>
            </ul>
        </div>
    </section>
    @yield('content')
</main>
<!-- FOOTER  -->
<footer class="footer p-0">
    <div class="copyright m-0">
        <p><i class="fas fa-map-marker-alt"></i> 187A Đường 3/2, Phường 11, Quận 10, TP.HCM</p>
        <p><i class="fas fa-phone-volume"></i> 0962.85.85.85 - <i class="fas fa-phone-volume"></i> 0963.48.48.48</p>
        <div class="footer__item m-0">
            <div class="footer__item-head">
                <ul class="footer__list-social d-flex justify-content-around">
                    <li class="footer__social-item">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </li>
                    <li class="footer__social-item">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </li>
                    <li class="footer__social-item">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </li>
                    <li class="footer__social-item">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </li>
                    <li class="footer__social-item">
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                    </li>
                </ul>
            </div>
        </div>
        <p class="m-0">Copyright © 2020</p>
    </div>
</footer>

<script src="./common/jquery-3.4.1.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/2db88d342f.js" crossorigin="anonymous"></script>
<script src="./common/OwlCarousel/dist/owl.carousel.min.js"></script>
<script src="./js/main.js"></script>
<script>
    $(document).ready(function () {
        $('#in').click(function () {
            $('#sign-in').show();
            $('#sign-new').hide();
        });
        $('#up').click(function () {
            $('#sign-in').hide();
            $('#sign-new').show();
        })
        var url = window.location.href;
        if (url != "http://localhost:8000/") {
            $("html, body").animate({scrollTop: $('main').offset().top}, 1000);
        }

    });
</script>
</body>

</html>