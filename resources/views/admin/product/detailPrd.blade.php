@include('admin.headerAdmin')
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Danh mục -->
    <div>
        <p>Danh mục</p>
        <select name="id_category" class="form-control">
            <option value="1">-Danh mục-</option>
            @foreach ($category as $cate )
            <option value="{{ $cate->id_category }}" @if($cate->id_category === $product->id_category) selected @endif>
                {{ $cate->name }}
            </option>
            @endforeach
        </select>
    </div>

    <!-- Tên sản phẩm -->
    <div class="mb-2 mt-2">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->product_name }}" placeholder="Enter name" required>
    </div>

    <!-- Mô tả -->
    <div class="mb-2 mt-2">
        <label for="describe" class="form-label">Mô tả</label>
        <textarea class="col-12 rol2 border rounded-2" name="describe" required>{{ $product->describe }}</textarea>
    </div>

    <!-- Giá -->
    <div class="mb-2 mt-2">
        <label for="price" class="form-label">Giá</label>
        <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" placeholder="Enter price" required>
    </div>

    <!-- Giá giảm -->
    <div class="mb-2 mt-2">
        <label for="sale_price" class="form-label">Giá giảm</label>
        <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ $product->sale_price }}" placeholder="Enter sale price">
    </div>

    <!-- Ảnh sản phẩm -->
    <div class="mb-2 mt-2">
        <label for="image" class="form-label">Ảnh</label><br>
        <img src="{{ asset('storage/'.$product->image) }}" alt="product image" style="width: 100px; height: auto;">
        <input type="file" class="form-control" id="image" name="image" placeholder="Chọn ảnh mới">
    </div>

    <!-- Kích cỡ -->
    <div class="mb-2 mt-2">
        <label for="size" class="form-label">Kích cỡ</label>
        <div id="size-inputs" class="row g-2">
            @foreach (explode(',', $product->attribute_values) as $index => $size)
                <div class="col-auto">
                    <input type="number" class="form-control" id="size_{{ $index }}" name="sizes[]" value="{{ $size }}">
                </div>
            @endforeach
        </div>
    </div>

    <!-- Màu sắc -->
    <div class="mb-2 mt-2">
        <label for="color" class="form-label">Màu sắc</label>
        @foreach (explode(',', $product->attribute_values) as $color)
            <input type="color" class="form-control" name="color[]" value="{{ $color }}"><br>
        @endforeach
    </div>

    <!-- Số lượng -->
    <div class="mb-2 mt-2">
        <label for="soluong" class="form-label">Số lượng</label>
        <input type="number" class="form-control" id="soluong" name="soluong" value="10" required>
    </div>

    <!-- Trạng thái -->
    <div class="mb-2 mt-2">
        <p>Trạng thái</p>
        <select name="status" class="form-control">
            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>-Trạng thái-</option>
            <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Còn hàng</option>
            <option value="3" {{ $product->status == 3 ? 'selected' : '' }}>Hết hàng</option>
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@include('admin.footerAdmin')
