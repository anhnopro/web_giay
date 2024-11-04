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



<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 bg-white">
                <div class="bg-new">
                    <h1 class="text-center">NEW</h1>
                    <img src="{{asset('storage/images/sp9.png')}}" width="450" height="400" alt="Nike Navy Blue-White New">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h3 class="text-center">Nike Navy Blue-White New</h3>
                    <p class="text-center">Giày thể thao Nike luôn gắn liền với các dòng giày chạy bộ Nike Free,
                        Nike Zoom. Tiếp đến, dòng giày bóng rổ Nike Air Jordan không những thịnh hành trên các sân bóng rổ mà còn
                        tạo nguồn cảm hứng cho những đôi sneaker Nike đẹp như Nike Air Force 1 chẳng hạn.
                    </p>
                    <a href="#"><h5 class="text-center">Xem thêm</h5></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="margin-top: 130px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="position-relative">
                    <img src="{{asset('storage/images/mau1.jpg')}}" class="zoom-img g-0" style=" height: 400px;">
                    <div class="position-absolute text-white" style="top: 69%; left: 5%;">
                        <p>Khuyến mại tới 50%</p>
                        <h3>Phụ kiện thời trang</h3>
                        <button class="btn btn-light btn-sm">Mua ngay</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="position-relative">
                    <img src="{{asset('storage/images/mau2.jpg')}}" class="zoom-img g-0" style=" height: 400px;">
                    <div class="position-absolute text-white" style="top: 69%; left: 5%;">
                        <p>Khuyến mại tới 50%</p>
                        <h3>Phụ kiện thời trang</h3>
                        <button class="btn btn-light btn-sm">Mua ngay</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="position-relative">
                    <img src="{{asset('storage/images/mau3.jpg')}}" class="zoom-img g-0" style=" height: 400px;">
                    <div class="position-absolute text-white" style="top: 69%; left: 5%;">
                        <p>Khuyến mại tới 50%</p>
                        <h3>Phụ kiện thời trang</h3>
                        <button class="btn btn-light btn-sm">Mua ngay</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="position-relative">
                    <img src="{{asset('storage/images/mau4.jpg')}}" class="zoom-img g-0" style=" height: 400px;">
                    <div class="position-absolute text-white" style="top: 69%; left: 5%;">
                        <p>Khuyến mại tới 50%</p>
                        <h3>Phụ kiện thời trang</h3>
                        <button class="btn btn-light btn-sm">Mua ngay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid mt-4">
        <h1 class="text-center">Sản phẩm mới</h1>
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <img src="assets/images/sp15.jpg" width="500" height="400" class="zoom-img img-fluid" alt="Sản phẩm nổi bật">
            </div>
            <!-- Sản phẩm nổi bật (Giả định danh sách sản phẩm) -->
            <div class="col-md-2 mb-5">
                <a href="product/detail/3" class="nav-link">
                    <img src="assets/images/sp3.jpg" width="100%" height="100%" class="zoom-img img-fluid" alt="Sản phẩm">
                    <h6>Tên Sản Phẩm Nổi Bật 1</h6>
                    <span>Giá: 1.500.000 VND</span>
                </a>
            </div>
            <div class="col-md-2 mb-5">
                <a href="product/detail/4" class="nav-link">
                    <img src="assets/images/sp4.jpg" width="100%" height="100%" class="zoom-img img-fluid" alt="Sản phẩm">
                    <h6>Tên Sản Phẩm Nổi Bật 2</h6>
                    <span>Giá: 1.800.000 VND</span>
                </a>
            </div>
            <!-- Thêm nhiều sản phẩm hơn nếu có -->
        </div>
    </div>
</section>

<section>
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="row m-5">
            <div class="col-md-6 mt-4">
                <h5 class="text-center">Mega Shoes - Thương hiệu cùng thời gian</h5>
                <h1 class="text-center">Giày Thể Thao Chính Hãng</h1>
                <p class="text-center">Những đôi giày mang kiểu dáng thể thao khỏe khoắn đang ngày càng được giới trẻ ưa chuộng,
                    từ các dòng giày thi đấu chuyên nghiệp đến các sản phẩm thời trang đường phố dành cho giới trẻ. Mega Shoes đã và đang tiếp tục khẳng định vị trí
                    cũng như uy tín của mình trong việc hỗ trợ bạn mua sắm hàng hiệu dễ dàng và tiện lợi hơn bao giờ hết.
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{asset('storage/images/sp16.jpg')}}" width="600" height="400" alt="Mega Shoes">
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <img src="{{asset('storage/images/1.jpg')}}">
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/2.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/3.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/4.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/5.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/6.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/7.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/8.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/9.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/10.jpg')}}" >
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/11.jpg')}}">
            </div>
            <div class="col-md-2">
                <img src="{{asset('storage/images/5.jpg')}}" >
            </div>

        </div>
    </div>


</section>
@include('client.footer')
