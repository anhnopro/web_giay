@extends('client.layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('cart.processCheckout') }}" method="POST">
                @csrf
                <h2>Mega Shoes</h2>
                <p>Giỏ hàng/Thông tin thanh toán giao hàng</p>
                <h4>Thông tin giao hàng</h4>
                <input type="text" name="name" placeholder="Họ và Tên" class="form-control" required><br>
                <div class="d-flex">
                    <input type="email" name="email" placeholder="Email" class="form-control" style="width: 350px;" required>
                    <div class="ms-2">
                        <input type="text" name="phone_number" placeholder="Số điện thoại" class="form-control" style="width: 200px;" required>
                    </div>
                </div><br>
                <input type="text" name="address" placeholder="Địa chỉ" class="form-control" required><br>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Giỏ hàng</a>
                    <button class="btn btn-primary" type="submit">Thanh Toán Sản Phẩm</button>
                </div>
            </form>
        </div>

        <div class="col-md-6 d-flex">
            <div class="vertical-line"></div>
            <div class="ms-3">
                @foreach($cart as $item)
                    <table class="table">
                        <tr>
                            <td class="align-middle text-center" style="width: 80px;">
                                <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid" width="70px">
                            </td>
                            <td class="align-middle">
                                <div class="ms-4">
                                    <h5 class="mb-1">{{ $item['product_name'] }}</h5>
                                    <p class="mb-1">{{ $item['color'] }} / {{ $item['size'] }}</p>
                                </div>
                            </td>
                            <td class="align-middle text-end">
                                <p class="mb-0">{{ number_format($item['qty'] * $item['price'], 0, ',', '.') }} VNĐ</p>
                            </td>
                        </tr>
                    </table>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between">
                    <div>Tổng cộng</div>
                    <div>
                        <h3>{{ number_format($totalPayment, 0, ',', '.') }} VNĐ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
