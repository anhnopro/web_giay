<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        .bgtop1 {
            background-color: rgb(233, 233, 233);
        }

        .maulogo {
            color: rgb(230, 56, 230);
        }

        .list-ds ul {
            list-style: none;
        }

        .list-ds ul li a {
            font-size: 16px;
            color: black;
            text-decoration: none;
        }

        .icon-size a,
        i {
            font-size: 25px;
            padding: 0 5px;
        }

        .container2 {
            margin: 0 auto;
        }

        .bgtop1 .row .col-md-3 {
            border: 0.5px solid rgb(214, 213, 213);
            padding: 15px 10px;
            background-color: white;
        }

        .bgtop1 .row .col-md-3 h3 {
            font-size: 16px;
        }

        .bg-new {
            box-shadow: 0px 0px 39px 0px rgba(0, 0, 0, 0.1);
            height: 450px;
            width: 400px;
            position: relative;
            margin-left: 50px;
        }

        .zoom-img {
            transition: transform 0.5s ease;
        }

        .zoom-img:hover {
            transform: scale(1.01);
        }

        .bg-new img {
            position: absolute;
            top: 150px;
            left: -60px;
        }

        .bg-new:hover img {
            transform: translateY(20px);
        }

        .bg-new h1 {
            padding: 60px;
            font-size: 100px;
            font-style: italic;
            font-family: sans-serif !important;
            color: #f0f0f0;
            font-weight: 900;
        }

        .bg-new1 {
            margin-top: 70px;
        }

        .size-footer h4 {
            font-size: 15px;
        }

        .size-footer p {
            font-size: 10px;
        }

        .size-footer ul {
            list-style: none;
        }

        .size-footer ul li a {
            text-decoration: none;
            font-size: 10px;
            color: black;
        }

        .form-icon i,
        span {
            font-size: 13px;
        }

        .text-left {
            padding: 0 30px;
        }

        p img {
            border: 2px solid white;
        }

        p img:hover {
            border: 2px solid red;
        }

        .mota ul li,
        p {
            font-size: 10px;
        }

        .btn-primary-button {
            position: relative;
            overflow: hidden;
            color: #fff;
            background-color: #58a8fc;
            border: 0.1px solid gray;
            cursor: pointer;
            transition: color 0.9s, background-color 0.9s;
        }

        .btn-primary-button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            transition: left 0.9s ease;
        }

        .btn-primary-button:hover::before {
            left: 100%;
            background-color: white;
        }

        .btn-primary-button:hover {
            color: #00060c;
            background-color: #fff;
            border: 0.1px solid gray;
        }

        .edit-ds h4 {
            font-size: 12px;
        }

        .edit-ds p {
            font-size: 10px;
        }

        .edit-ds p:hover {
            color: aqua;
        }

        .edit-ds input:hover {
            border: 0.4 solid black;
        }
    </style>
</head>

<body>

<header>
    <div class="container-fluid bgtop1">
        <h4><i class='bx bxs-phone small'></i> ĐIỆN THOẠI:</h4>
        <span class="small text-warning">09771*4545</span>
    </div>

    <div class="container">
        <div class="row mt-4 align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1 class="text-center maulogo">Mega Shoes</h1>
            </div>
            <div class="col-md-4 d-flex justify-content-end mt-2">
                <div class="d-flex align-items-center">
                    <span class="me-3">UserNickname</span>
                    <a href="admin/product/list" class="btn btn-primary btn-sm me-2">Truy cập trang quản trị</a>
                    <a href="user/logout" class="btn btn-outline-danger btn-sm">Logout</a>
                    <a href="/" class="me-1 nav-link">
                        <i class='bx bx-search'></i>
                    </a>
                    <a href="order/addCart" class="me-1 nav-link">
                        <i class='bx bx-shopping-bag'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="list-ds mt-3">
            <ul class="list-inline d-flex justify-content-center">
                <li><a href="home" class="m-3">Trang chủ</a></li>
                <li><a href="#" class="m-3">Giới thiệu</a></li>
                <li><a href="list/productCategory" class="m-3">Danh mục sản phẩm</a></li>
                <li><a href="tintuc.html" class="m-3">Tin tức</a></li>
                <li><a href="lienhe.html" class="m-3">Liên hệ</a></li>
            </ul>
        </div>
    </div>

    <section>
        <div class="container-fluid bgtop1 text-right">
            <img src="{{ asset('storage/images/banner3.jpg') }}" style="width: 100%; height: auto;" alt="Banner">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('storage/images/support_1_ic.png') }}" alt="Giao Hàng Miễn Phí" width="70" height="40">
                    <h3>Giao Hàng Miễn Phí</h3>
                    <span>Cho đơn hàng trên 599k</span>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('storage/images/support_1_ic.png') }}" alt="Miễn Phí Đổi Trả" width="70" height="40">
                    <h3>Miễn Phí Đổi Trả</h3>
                    <span>Trong vòng 7 ngày</span>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('storage/images/support_3_ic.png') }}" alt="Đặt Hàng Trực Tuyến" width="70" height="40">
                    <h3>Đặt Hàng Trực Tuyến</h3>
                    <span>Hotline : 1900.XXX.XXX</span>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('storage/images/support_4_ic.png') }}" alt="Hỗ Trợ 24/7" width="70" height="40">
                    <h3>Hỗ Trợ 24/7</h3>
                    <span>Hỗ Trợ online /offline 24/7</span>
                </div>
            </div>
        </div>
    </section>
</header>

