@extends('client.layouts.main')

@section('content')
<div class="container">
    <h1 class="text-center mt-4">Giỏ hàng của bạn</h1>

    @if(count($cart) > 0)
        @foreach($cart as $index => $item)
            <div class="container mt-4 cart-item" data-index="{{ $index }}">
                <div class="row d-flex justify-content-between align-items-center">
                    <!-- Hình ảnh và thông tin sản phẩm -->
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="border border-danger me-3">
                            <img src="{{ asset('/storage/' . $item['image']) }}" height="130px" class="mh-100">
                        </div>
                        <div>
                            <h5>{{ $item['product_name'] }}</h5>
                            <p class="price">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</p>
                            <p>Màu sắc: {{ $item['color'] }} / Kích thước: {{ $item['size'] }}</p>

                            <!-- Nút tăng giảm số lượng -->
                            <div class="group-button mt-2">
                                <button type="button" class="soluong border" onclick="updateQuantity('{{ $index }}', -1)" style="width: 30px;">-</button>
                                <input type="number" value="{{ $item['qty'] }}" id="quantity-{{ $index }}" class="soluong1 text-center border mx-1" style="width: 60px;" min="1" onchange="updateQuantity('{{ $index }}')">
                                <button type="button" class="soluong border" onclick="updateQuantity('{{ $index }}', 1)" style="width: 30px;">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tổng tiền cho sản phẩm và nút xóa -->
                    <div class="col-md-2 text-end">
                        <p class="total">{{ number_format($item['qty'] * $item['price'], 0, ',', '.') }} VNĐ</p>
                        <a href="{{ route('cart.delete', ['id_product' => $item['id_product'], 'color' => urlencode($item['color']), 'size' => $item['size']]) }}" class="text-danger fs-4 delete-item">X</a>

                    </div>
                </div>
                <hr>
            </div>
        @endforeach
    @else
        <p class="text-center mt-5">Không có sản phẩm trong giỏ hàng</p>
    @endif

    <!-- Hiển thị tổng thanh toán và các nút điều khiển -->
    <div class="row d-flex justify-content-between mt-3">
        <div class="col-md-6">
            <textarea class="form-control w-100" rows="3" placeholder="Ghi chú đơn hàng"></textarea>
        </div>
        <div class="col-md-4 text-end">
            <p>Tổng tiền:</p>
            <h3 class="total_payment">Tổng tiền: {{ number_format($totalPayment, 0, ',', '.') }} VNĐ</h3>
            <div class="d-flex justify-content-end mt-3">
                <a href="" class="btn btn-secondary me-2">Tiếp tục mua hàng</a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Tiếp tục đặt hàng</a>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Hàm cập nhật số lượng sản phẩm
    function updateQuantity(index, delta) {
        let quantityInput = document.getElementById(`quantity-${index}`);
        let newQuantity = parseInt(quantityInput.value) + delta;

        // Giới hạn số lượng từ 1 đến 10
        if (newQuantity < 1) newQuantity = 1;
        if (newQuantity > 10) newQuantity = 10;
        quantityInput.value = newQuantity;

        // Gửi yêu cầu AJAX để cập nhật giỏ hàng
        $.ajax({
            url: '{{ route("cart.updateQuantity") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                index: index,
                qty: newQuantity
            },
            success: function(response) {
                $(`#quantity-${index}`).closest('.cart-item').find(".total").html(response.total + ' VNĐ');
                $(".total_payment").text('Tổng tiền: ' + response.total_payment);
            }
        });
    }

    // Sử dụng AJAX để xóa sản phẩm và cập nhật lại tổng tiền
    $(document).on('click', '.delete-item', function (e) {
    e.preventDefault();

    let url = $(this).attr('href');  // Lấy URL từ liên kết xóa

    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            if (response.status === 'success') {
                $(e.target).closest('.cart-item').remove();
                $(".total_payment").text('Tổng tiền: ' + response.total_payment);
            }
        }
    });
});

</script>
@endsection
