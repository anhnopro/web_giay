@include('admin.headerAdmin')

<div class="container-fluid" style="width: calc(100% - 220px);">
    <div class="container p-4">
        <h3 class="mb-4">Thêm Sản Phẩm Mới</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('post.add.product') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Thương hiệu -->
            <div class="mb-3">
                <label for="category" class="form-label">Thương hiệu</label>
                <select name="id_category" id="category" class="form-select" required>
                    <option value="" disabled selected>- Chọn Danh Mục -</option>
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id_category }}">{{ $cate->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tên sản phẩm -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên sản phẩm" name="name" value="{{ old('name') }}" required>
            </div>

            <!-- Ảnh sản phẩm -->
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh sản phẩm</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
            </div>

            <!-- Giá -->
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <div class="input-group">
                    <span class="input-group-text">₫</span>
                    <input type="number" class="form-control" id="price" placeholder="Nhập giá" name="price" min="0" value="{{ old('price') }}" required>
                </div>
            </div>

            <!-- Giá ưu đãi -->
            <div class="mb-3">
                <label for="sale_price" class="form-label">Giá ưu đãi</label>
                <div class="input-group">
                    <span class="input-group-text">₫</span>
                    <input type="number" class="form-control" id="sale_price" placeholder="Nhập giá ưu đãi" name="sale_price" min="0" value="{{ old('sale_price') }}">
                </div>
            </div>

            <!-- Size -->
            <div class="mb-3">
                <label class="form-label">Size</label>
                <div class="d-flex flex-wrap">
                    @foreach ($sizes as $size)
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="sizes[]" value="{{ $size->id_attribute }}" id="size{{ $size->id_attribute }}">
                            <label class="form-check-label" for="size{{ $size->id_attribute }}">{{ $size->value }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Color -->
            <div class="mb-3">
                <label class="form-label">Color</label>
                <div class="d-flex flex-wrap">
                    @foreach ($colors as $color)
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="colors[]" value="{{ $color->id_attribute }}" id="color{{ $color->id_attribute }}"  >
                            <label class="form-check-label" for="color{{ $color->id_attribute }}">
                                <i class='bx bxs-brush' style="color:{{ $color->value }}; font-size:20px;"></i>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Số lượng -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="quantity" placeholder="Nhập số lượng sản phẩm" name="quantity" min="0" value="{{ old('quantity') }}" required>
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label for="describe" class="form-label">Mô tả</label>
                <textarea class="form-control" id="describe" name="describe" rows="5" placeholder="Nhập mô tả sản phẩm">{{ old('describe') }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
            <a href="{{ route('list.product') }}" class="btn btn-secondary ms-2">Hủy Bỏ</a>
        </form>
    </div>
</div>

@include('admin.footerAdmin')
