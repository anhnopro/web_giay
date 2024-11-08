@extends('client.layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Xác nhận đơn hàng</h2>
    <p class="text-center">Cảm ơn bạn đã đặt hàng! Đây là thông tin đơn hàng của bạn:</p>

    <h4>Ghi chú:</h4>
    <p>{{ $order['customer_notes'] ?? 'Không có ghi chú' }}</p>

    <h4>Sản phẩm:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order['items'] as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($item['qty'] * $item['price'], 0, ',', '.') }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <h4>Tổng cộng:</h4>
        <h4>{{ number_format($order['total_payment'], 0, ',', '.') }} VNĐ</h4>
    </div>
</div>
@endsection
