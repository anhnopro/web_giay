<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/lib/font-fontawesome-ae333ffef2.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <style>
        /* Optional: Style for the dropdown */
        .dropdown-menu {
            display: none;
            position: absolute;
            min-width: 160px;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
    <title>Document</title>
</head>
<body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>

<div style="background-color: rgb(249, 247, 247);">
    <nav class="navbar navbar-expand-sm bg-light border shadow rounded-1" style="height: 60px;">
        <div class="container-fluid">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Mega Shoes</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Xin chào bạn:</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">User Nickname</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="d-flex justify-content-between">
        <div style="width: 220px; height: calc(100vh - 60px);" class="border bg-white">
            <ul class="navbar-nav ms-3 mt-5">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton">
                               Quản lí sản phẩm
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('list.product')}}">Sản phẩm</a>
                                <a class="dropdown-item" href="{{route('list.category')}}">Thương hiệu</a>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton">
                                Danh mục sản phẩm
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Danh sách</a>
                                <a class="dropdown-item" href="#">Tạo danh mục</a>
                                <a class="dropdown-item" href="#">Sửa tên danh mục</a>
                                <a class="dropdown-item" href="#">Thùng rác</a>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton">
                                Thuộc tính sản phẩm
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Danh sách</a>
                                <a class="dropdown-item" href="#">Tạo thuộc tính</a>
                                <a class="dropdown-item" href="#">Thùng rác</a>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton">
                                Quản lí đơn hàng
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Danh sách đơn hàng</a>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton">
                                Tài khoản
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Danh sách tài khoản</a>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div style="width: calc(100% - 220px);">


