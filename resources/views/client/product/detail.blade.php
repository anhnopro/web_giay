@include('client.header')
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
                        @else
                            <span>Không có ảnh phụ</span>
                        @endif
                    </p>
                </div>

                <!-- Phần hiển thị chi tiết sản phẩm -->
                <div class="col-md-6">
                    <h4>{{ $product->product_name }}</h4>
                    <p>Danh mục: {{ $product->category_name ?? 'Không có danh mục' }}</p>
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
                    <form id="add-to-cart-form" method="post">
                        @csrf
                        <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                        <div class="group-button">
                            <button type="button" class="soluong border" onclick="thaydoisoluong('-')" style="width: 30px;">-</button>
                            <input type="tel" class="soluong1 text-center border" value="1" id="soluong" name="qty" style="width: 90px; height: 30px;">
                            <button type="button" class="soluong border" onclick="thaydoisoluong('+')" style="width: 30px;">+</button>
                        </div>
                        <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                        <input type="hidden" name="price" value="{{ $product->min_price }}">
                        <input type="hidden" name="image" value="{{ $product->image }}">
                        <input type="hidden" id="selected-color" name="color">
                        <input type="hidden" id="selected-size" name="size">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-button btn-block mt-4" id="add-to-cart-btn">Thêm vào giỏ hàng</button>
                        </div>
                    </form>

                    <!-- Mô tả sản phẩm -->
                    <div class="mt-4 mota">
                        <h4>Mô tả</h4>
                        <p>{{ $product->describe ?? 'Không có mô tả' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('p img').mouseenter(function() {
            let imgPath = $(this).attr('src');
            $('#main-img').attr('src', imgPath);
        });

        $('p img').click(function() {
            let imgPath = $(this).attr('src');
            $('#main-img').attr('src', imgPath);
        });

        // Color selection
        const colorOptions = document.querySelectorAll('.color-option');
        colorOptions.forEach(option => {
            option.addEventListener('click', function() {
                colorOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('selected-color').value = this.dataset.color;
                checkFormValidity();
            });
        });

        // Size selection
        const sizeOptions = document.querySelectorAll('.size-option');
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                sizeOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                document.getElementById('selected-size').value = this.dataset.size;
                checkFormValidity();
            });
        });

        // Check form validity to enable/disable Add to Cart button
        function checkFormValidity() {
            const selectedColor = document.getElementById('selected-color').value;
            const selectedSize = document.getElementById('selected-size').value;
            const addToCartBtn = document.getElementById('add-to-cart-btn');
            if (selectedColor && selectedSize) {
                addToCartBtn.disabled = false;
            } else {
                addToCartBtn.disabled = true;
            }
        }

        // Handle quantity change
        const quantityInput = document.getElementById('soluong');
        const decreaseBtn = document.querySelector('button.soluong:nth-child(1)');
        const increaseBtn = document.querySelector('button.soluong:nth-child(3)');

        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value, 10);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue + 1;
        });

        // Ensure the input field allows only valid numeric values and within specified range
        quantityInput.addEventListener('input', function() {
            let value = parseInt(this.value, 10);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > 10) {
                this.value = 10;
            }
        });
    });
</script>
@include('client.header')
