@include('client.layouts.header')

<section>
    <div class="container-fluid mt-4">
        <h1 class="text-center">Sản phẩm mới</h1>
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <img src="{{ asset('storage/images/sp15.jpg') }}" width="500" height="400" class="zoom-img img-fluid">
            </div>
            @foreach ($products as $product)
                <div class="col-md-2 mb-5">
                    <a href="{{ route('product.detail', $product->id_product) }}" class="nav-link">
                        <img src="{{ asset('/storage/'.$product->image) }}" width="100%" height="100%" class="zoom-img img-fluid">
                        <h6>{{ $product->product_name }}</h6>
                        <span>@if($product->min_price == $product->max_price)
                            {{ number_format($product->min_price, 0, ',', '.') }} VND
                        @else
                            {{ number_format($product->min_price, 0, ',', '.') }} - {{ number_format($product->max_price, 0, ',', '.') }} VND
                        @endif</span>
                    </a>
                </div>
            @endforeach
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
@include('client.layouts.footer')
