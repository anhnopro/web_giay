@extends('client.layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Thông tin đơn hàng</h5>
                            <p class="card-text"><strong>Tên khách hàng:</strong> {{ $order->name }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $order->email }}</p>
                            <p class="card-text"><strong>Số điện thoại:</strong> {{ $order->phone_number }}</p>
                            <p class="card-text"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">Danh sách sản phẩm</h5>
                            @foreach($order->orderDetails as $product)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $product->name_product }}</h6>
                                    <p class="card-text">Số lượng: {{ $product->qty }}</p>
                                    <p class="card-text">Giá: {{ number_format($product->total / $product->qty, 0, ',', '.') }} VNĐ</p>
                                    <p class="card-text">Tổng tiền: {{ number_format($product->total, 0, ',', '.') }} VNĐ</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Tổng đơn hàng</h5>
                            <p class="card-text"><strong>Tổng đơn hàng:</strong>     {{ number_format($order->orderDetails->sum('total'), 0, ',', '.') }} VNĐ</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">Trạng thái đơn hàng</h5>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Chờ xác nhận</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
