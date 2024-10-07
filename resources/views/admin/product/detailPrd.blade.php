@include('admin.headerAdmin')

<div class="container mt-4">
    <h2>Cập Nhật Sản Phẩm</h2>

    <!-- Display Success and Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('update.product', $product->id_product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Main Product Information -->
        <div class="mb-4">
            <h4>Thông Tin Sản Phẩm</h4>
            <div class="row">
                <!-- Product Name -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>
                </div>
                <!-- Product Category -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Danh Mục</label>
                        <select name="id_category" id="productCategory" class="form-control" required>
                            <option value="">-Chọn danh mục-</option>
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id_category }}" {{ $product->id_category == $cate->id_category ? 'selected' : '' }}>
                                    {{ $cate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- Product Description -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="productDescription" name="describe" rows="3" required>{{ old('describe', $product->describe) }}</textarea>
            </div>
            <!-- Product Image -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Ảnh Sản Phẩm</label>
                <input type="file" class="form-control" id="productImage" name="image">
                @if($product->image)
                    <img src="{{ asset('/storage/'.$product->image) }}" alt="Ảnh sản phẩm" style="width: 100px; height: auto; margin-top: 10px;">
                @endif
            </div>
            <!-- Product Status -->
            <div class="mb-3">
                <label for="productStatus" class="form-label">Trạng Thái</label>
                <select name="status" id="productStatus" class="form-control" required>
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>
        </div>

        <!-- Product Variants Management -->
        <div class="mb-4">
            <h4>Quản Lý Biến Thể Sản Phẩm</h4>
           
            <table class="table table-bordered mt-2" id="product-variants-table">
                <thead>
                    <tr>
                        <th>Chọn</th>
                        <th>Ảnh biến thể</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Giá giảm</th>
                        <th>Màu sắc</th>
                        <th>Kích cỡ</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->variants as $index => $variant)
                        <tr class="variant-row">
                            <td>
                                <input type="checkbox" name="selected_variants[]" value="{{ $variant->id_variant }}" class="variant-checkbox">
                                <input type="hidden" name="variants[{{ $index }}][id_variant]" value="{{ $variant->id_variant }}">
                            </td>
                            <td>
                                <img src="{{ asset('/storage/'.$variant->image) }}" alt="Ảnh biến thể" style="width: 50px; height: auto;" class="mb-2">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="variants[{{ $index }}][quantity]" value="{{ $variant->quantity }}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="variants[{{ $index }}][price]" value="{{ $variant->price }}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="variants[{{ $index }}][sale_price]" value="{{ $variant->sale_price }}" placeholder="Giá giảm">
                            </td>
                            <td>
                                <select name="variants[{{ $index }}][id_color]" class="form-control" required>
                                    <option value="">-Chọn màu sắc-</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id_color }}" {{ $variant->id_color == $color->id_color ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="variants[{{ $index }}][id_size]" class="form-control" required>
                                    <option value="">-Chọn kích cỡ-</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id_size }}" {{ $variant->id_size == $size->id_size ? 'selected' : '' }}>
                                            {{ $size->size_value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <!-- Button to Open Modal for Editing Variant -->
                                <button type="button" class="btn btn-info btn-sm edit-variant-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#variantModal"
                                        data-variant-id="{{ $variant->id_variant }}"
                                        data-variant-quantity="{{ $variant->quantity }}"
                                        data-variant-price="{{ $variant->price }}"
                                        data-variant-sale-price="{{ $variant->sale_price }}"
                                        data-variant-color="{{ $variant->id_color }}"
                                        data-variant-size="{{ $variant->id_size }}"
                                        data-variant-image="{{ asset('/storage/'.$variant->image) }}">
                                    Xem chi tiết
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Main Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Cập nhật tất cả</button>
        </div>
    </form>
</div>

@include('admin.footerAdmin')

<!-- Modal for Adding/Editing Variant -->
<div class="modal fade" id="variantModal" tabindex="-1" aria-labelledby="variantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Use modal-lg for larger modal -->
        <form id="variantForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa chi tiết biến thể sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Variant Image -->
                                <div class="mb-3">
                                    <label for="modalVariantImage" class="form-label">Ảnh biến thể</label>
                                    <input type="file" class="form-control" id="modalVariantImage" name="image">
                                    <img id="currentVariantImage" src="" alt="Ảnh biến thể" style="width: 100px; height: auto; margin-top: 10px; display: none;">
                                </div>
                                <!-- Number of Views (Read-Only) -->
                                <div class="mb-3">
                                    <label for="modalVariantView" class="form-label">Số lượt xem</label>
                                    <input type="number" class="form-control" id="modalVariantView" name="view" readonly>
                                </div>
                                <!-- Quantity -->
                                <div class="mb-3">
                                    <label for="modalVariantQuantity" class="form-label">Số lượng</label>
                                    <input type="number" class="form-control" id="modalVariantQuantity" name="quantity" required>
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Price -->
                                <div class="mb-3">
                                    <label for="modalVariantPrice" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="modalVariantPrice" name="price" required>
                                </div>
                                <!-- Sale Price -->
                                <div class="mb-3">
                                    <label for="modalVariantSalePrice" class="form-label">Giá giảm</label>
                                    <input type="number" class="form-control" id="modalVariantSalePrice" name="sale_price" placeholder="Giá giảm">
                                </div>
                                <!-- Color -->
                                <div class="mb-3">
                                    <label for="modalVariantColor" class="form-label">Màu sắc</label>
                                    <select name="id_color" id="modalVariantColor" class="form-control" required>
                                        <option value="">-Chọn màu sắc-</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id_color }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Size -->
                                <div class="mb-3">
                                    <label for="modalVariantSize" class="form-label">Kích cỡ</label>
                                    <select name="id_size" id="modalVariantSize" class="form-control" required>
                                        <option value="">-Chọn kích cỡ-</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id_size }}">{{ $size->size_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Define JavaScript Variable for Variant Update URL -->
<script>
    var updateVariantUrl = "{{ route('update.product.variant', '') }}/";
</script>

<!-- JavaScript for Handling Modal Data Population -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var variantModal = document.getElementById('variantModal');
    var variantForm = document.getElementById('variantForm');
    var currentImage = document.getElementById('currentVariantImage');

    variantModal.addEventListener('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = event.relatedTarget;

        // Extract variant data from data-* attributes
        var variantId = button.getAttribute('data-variant-id');
        var variantQuantity = button.getAttribute('data-variant-quantity');
        var variantPrice = button.getAttribute('data-variant-price');
        var variantSalePrice = button.getAttribute('data-variant-sale-price');
        var variantColor = button.getAttribute('data-variant-color');
        var variantSize = button.getAttribute('data-variant-size');
        var variantImage = button.getAttribute('data-variant-image');
        var variantView = button.getAttribute('data-variant-view'); // Assuming 'view' is relevant for variants

        // Populate the modal fields with variant data
        variantForm.action = updateVariantUrl + variantId;

        // Populate quantity, price, sale_price, color, and size
        document.getElementById('modalVariantQuantity').value = variantQuantity;
        document.getElementById('modalVariantPrice').value = variantPrice;
        document.getElementById('modalVariantSalePrice').value = variantSalePrice;
        document.getElementById('modalVariantColor').value = variantColor;
        document.getElementById('modalVariantSize').value = variantSize;

        // Handle variant image
        if (variantImage) {
            currentImage.src = variantImage;
            currentImage.style.display = 'block';
        } else {
            currentImage.src = '';
            currentImage.style.display = 'none';
        }

        // Handle view count if relevant
        if (variantView !== null) {
            document.getElementById('modalVariantView').value = variantView;
        } else {
            document.getElementById('modalVariantView').value = '';
        }
    });
});
</script>
