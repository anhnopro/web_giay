@extends('client.layouts.main')
@section('tilte','Trang chi tiết')
@section('content')
<section>
    <div class="container mt-4">
        <div class="row">
            <!-- Phần hiển thị hình ảnh chính của sản phẩm -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image) }}" width="465px" height="400" id="main-img" class="img-fluid" alt="Hình ảnh chính">
                <p>
                    @if($product->additional_images)
                        @foreach (explode(',', $product->additional_images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" width="90" class="img-thumbnail" alt="Ảnh phụ">
                        @endforeach

                    @endif
                </p>
            </div>

            <!-- Phần hiển thị chi tiết sản phẩm -->
            <div class="col-md-6">
                <h4>{{ $product->product_name }}</h4>
                <p>Danh mục: {{ $product->category_name }}</p>
                <hr>
                <h4>
                    @if(isset($product->min_price) && $product->min_price > 0)
                        @if($product->min_price == $product->max_price)
                            {{ number_format($product->min_price, 0, ',', '.') }} VND
                        @else
                            {{ number_format($product->min_price, 0, ',', '.') }} - {{ number_format($product->max_price, 0, ',', '.') }} VND
                        @endif
                    @else
                        <span>Giá không có sẵn</span>
                    @endif
                </h4>
                <hr>

                <!-- Hiển thị giá khuyến mãi (nếu có) -->
                @if(!empty($product->sale_prices))
                    <p>Giá khuyến mãi: {{ implode(' VND, ', explode(',', $product->sale_prices)) }} VND</p>
                @endif

                <!-- Lựa chọn màu sắc -->
                <p>Màu sắc</p>
                <div class="color-selection">
                    @if($product->color_hex_codes)
                        @foreach (explode(',', $product->color_hex_codes) as $color)
                            <button type="button" class="color-option border rounded-circle m-1"
                                    style="width: 20px; height: 20px; background-color: {{ $color }};"
                                    data-color="{{ $color }}"></button>
                        @endforeach
                    @else
                        <span>Không có màu sắc</span>
                    @endif
                </div>
                <hr>

                <!-- Lựa chọn kích thước -->
                <p>Size giày</p>
                <div class="size-selection">
                    @if($product->size_values)
                        @foreach (explode(',', $product->size_values) as $size)
                            <button type="button" class="size-option bg-primary border m-1"
                                    data-size="{{ $size }}">{{ $size }}</button>
                        @endforeach
                    @else
                        <span>Không có kích thước</span>
                    @endif
                </div>
                <hr>

                <p>Số lượng tồn kho: {{ $product->total_quantity ?? 'Không có sẵn' }}</p>

                <!-- Form thêm vào giỏ hàng -->
                <form id="add-to-cart-form" method="post" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                    <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                    <input type="hidden" name="price" value="{{ $product->min_price }}">
                    <input type="hidden" name="image" value="{{ $product->image }}">
                    <input type="hidden" id="selected-color" name="color">
                    <input type="hidden" id="selected-size" name="size">
                    <div class="group-button">
                        <button type="button" class="soluong border" onclick="thaydoisoluong('-')" style="width: 30px;">-</button>
                        <input type="tel" class="soluong1 text-center border" value="1" id="soluong" name="qty" style="width: 90px; height: 30px;">
                        <button type="button" class="soluong border" onclick="thaydoisoluong('+')" style="width: 30px;">+</button>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary-button btn-block mt-4">Thêm vào giỏ hàng</button>
                    </div>
                </form>

                <!-- Mô tả sản phẩm -->
                <div class="mt-4 mota">
                    <h4>Mô tả</h4>
                    <p>{{ $product->describe }}</p>
                    <ul>
                        <li>Chất liệu cao cấp EVA, PU, Cushlon, Phylon.</li>
                        <li>Bền đẹp, tăng tính đàn hồi, giày nhẹ và êm ái hơn. Mũi giày đầy đặn, form dáng chuẩn.</li>
                        <li>Bảo vệ đầu ngón chân khi hoạt động.</li>
                        <li>Bên trong có lớp lót êm.</li>
                        <li>Giúp bảo vệ và hạn chế đau chân, có độ đàn hồi cao khi vận động, di chuyển. Cổ giày ôm sát theo chân.</li>
                        <li>Thiết kế ôm theo vùng mắt cá, có lớp đệm bảo vệ cổ chân. Đế cao su công nghệ đệm êm ái.</li>
                        <li>Bền, thoải mái khi mang.</li>
                        <li>Lớp lót trong có đệm êm ái kết hợp với công nghệ thoáng khí Air Cooled Memory Foam vừa ngăn mùi, vừa không gây bí chân</li>
                        <li>Đế cao su nhẹ bền có độ đàn hồi tốt giúp giảm tối đa chấn thương khi bạn tập luyện hoặc chơi thể thao.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="container mt-5">
        <h4 class="text-center"> Sản phẩm liên quan </h4>
        <div class="row">
            <div class="col-md-2 mb-3">
                <img src="images/sp1.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp2.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp3.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp4.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp5.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp6.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp7.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp8.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp2.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp1.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp6.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
            <div class="col-md-2 mb-3">
                <img src="images/sp7.jpg" width="200" height="200">
                <h4>Tên sản phẩm</h4>
                <span>400.000VNĐ</span>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    // Xử lý chọn màu sắc
    const colorOptions = document.querySelectorAll('.color-option');
    colorOptions.forEach(option => {
        option.addEventListener('click', function() {
            colorOptions.forEach(opt => opt.classList.remove('selected-border'));
            this.classList.add('selected-border');
            document.getElementById('selected-color').value = this.dataset.color;
        });
    });

    // Xử lý chọn kích thước
    const sizeOptions = document.querySelectorAll('.size-option');
    sizeOptions.forEach(option => {
        option.addEventListener('click', function() {
            sizeOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('selected-size').value = this.dataset.size;
        });
    });

    // Thay đổi số lượng
    function thaydoisoluong(action) {
        const quantityInput = document.getElementById('soluong');
        let currentValue = parseInt(quantityInput.value, 10);

        if (action === '-' && currentValue > 1) {
            quantityInput.value = currentValue - 1;
        } else if (action === '+') {
            quantityInput.value = currentValue + 1;
        }
    }

    // Kiểm tra màu sắc và kích thước trước khi submit form
    document.getElementById('add-to-cart-form').addEventListener('submit', function(e) {
        const selectedColor = document.getElementById('selected-color').value;
        const selectedSize = document.getElementById('selected-size').value;

        if (!selectedColor) {
            alert("Vui lòng chọn màu sắc.");
            e.preventDefault();
        }

        if (!selectedSize) {
            alert("Vui lòng chọn kích thước.");
            e.preventDefault();
        }
    });
});

// Tạo style cho viền nổi bật
const style = document.createElement('style');
style.innerHTML = `
    .selected-border {
        border: 2px solid #007bff !important; /* Viền màu xanh nổi bật */
    }
    .size-option.selected {
        border: 2px solid #007bff !important; /* Viền màu xanh cho kích thước */
        color: #fff;
    }
`;
document.head.appendChild(style);

</script>


@endsection
