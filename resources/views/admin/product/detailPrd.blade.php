@include('admin.headerAdmin')

<div class="container mt-4">
    <h2>Cập Nhật Sản Phẩm</h2>

    <!-- Hiển thị thông báo thành công và lỗi -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.products.update', $product->id_product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Phần chỉnh sửa thông tin chính của sản phẩm -->
        <div class="mb-4">
            <h4>Thông Tin Sản Phẩm</h4>
            <div class="row">
                <!-- Tên sản phẩm -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>
                </div>
                <!-- Danh mục sản phẩm -->
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
            <!-- Mô tả sản phẩm -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="productDescription" name="describe" rows="3" required>{{ old('describe', $product->describe) }}</textarea>
            </div>
            <!-- Ảnh sản phẩm -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Ảnh Sản Phẩm</label>
                <input type="file" class="form-control" id="productImage" name="image">
                @if($product->image)
                    <img src="{{ asset('/storage/'.$product->image) }}" alt="Ảnh sản phẩm" style="width: 100px; height: auto; margin-top: 10px;">
                @endif
            </div>
            <!-- Trạng thái sản phẩm -->
            <div class="mb-3">
                <label for="productStatus" class="form-label">Trạng Thái</label>
                <select name="status" id="productStatus" class="form-control" required>
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>
        </div>

        <!-- Bảng chứa thông tin sản phẩm và biến thể -->
        <div class="mb-4">
            <h4>Quản Lý Biến Thể Sản Phẩm</h4>
            <div class="text-end mb-2">
                <!-- Nút mở Modal để thêm hoặc cập nhật biến thể -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailModal">Cập nhật biến thể</button>
            </div>
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
                                <button type="button" class="btn btn-info btn-sm view-detail"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailModal"
                                        data-variant-id="{{ $variant->id_variant }}"
                                        data-variant-name="{{ $product->name }}"
                                        data-variant-image="{{ asset('/storage/'.$variant->image) }}"
                                        data-variant-description="{{ $product->describe }}"
                                        data-variant-category="{{ $variant->id_category }}"
                                        data-variant-status="{{ $variant->status }}"
                                        data-variant-view="{{ $product->view }}"
                                        data-variant-price="{{ $variant->price }}"
                                        data-variant-sale-price="{{ $variant->sale_price }}"
                                        data-variant-quantity="{{ $variant->quantity }}"
                                        data-variant-color="{{ $variant->id_color }}"
                                        data-variant-size="{{ $variant->id_size }}">
                                    Xem chi tiết
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Nút Submit chính -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Cập nhật tất cả</button>
        </div>
    </form>
</div>

@include('admin.footerAdmin')

<!-- Modal để xem và chỉnh sửa chi tiết biến thể sản phẩm -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Sử dụng modal-lg để làm rộng modal -->
        <form id="variantDetailForm" action="" method="POST" enctype="multipart/form-data">
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
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <!-- Tên sản phẩm -->
                                <div class="mb-3">
                                    <label for="modalVariantName" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="modalVariantName" name="name" required>
                                </div>
                                <!-- Mô tả sản phẩm -->
                                <div class="mb-3">
                                    <label for="modalVariantDescription" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="modalVariantDescription" name="describe" rows="3"></textarea>
                                </div>
                                <!-- Danh mục sản phẩm -->
                                <div class="mb-3">
                                    <label for="modalVariantCategory" class="form-label">Danh mục</label>
                                    <select name="id_category" id="modalVariantCategory" class="form-control" required>
                                        <option value="">-Chọn danh mục-</option>
                                        @foreach ($categories as $cate)
                                            <option value="{{ $cate->id_category }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Trạng thái sản phẩm -->
                                <div class="mb-3">
                                    <label for="modalVariantStatus" class="form-label">Trạng thái</label>
                                    <select name="status" id="modalVariantStatus" class="form-control" required>
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Không hoạt động</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <!-- Ảnh biến thể -->
                                <div class="mb-3">
                                    <label for="modalVariantImage" class="form-label">Ảnh biến thể</label>
                                    <input type="file" class="form-control" id="modalVariantImage" name="image">
                                    <img id="currentVariantImage" src="" alt="Ảnh biến thể" style="width: 100px; height: auto; margin-top: 10px;">
                                </div>
                                <!-- Số lượt xem -->
                                <div class="mb-3">
                                    <label for="modalVariantView" class="form-label">Số lượt xem</label>
                                    <input type="number" class="form-control" id="modalVariantView" name="view" readonly>
                                </div>
                                <!-- Số lượng -->
                                <div class="mb-3">
                                    <label for="modalVariantQuantity" class="form-label">Số lượng</label>
                                    <input type="number" class="form-control" id="modalVariantQuantity" name="quantity" required>
                                </div>
                                <!-- Giá -->
                                <div class="mb-3">
                                    <label for="modalVariantPrice" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="modalVariantPrice" name="price" required>
                                </div>
                                <!-- Giá giảm -->
                                <div class="mb-3">
                                    <label for="modalVariantSalePrice" class="form-label">Giá giảm</label>
                                    <input type="number" class="form-control" id="modalVariantSalePrice" name="sale_price" placeholder="Giá giảm">
                                </div>
                                <!-- Màu sắc -->
                                <div class="mb-3">
                                    <label for="modalVariantColor" class="form-label">Màu sắc</label>
                                    <select name="id_color" id="modalVariantColor" class="form-control" required>
                                        <option value="">-Chọn màu sắc-</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id_color }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Kích cỡ -->
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

<!-- Định Nghĩa Biến JavaScript Cho URL Cập Nhật Biến Thể -->
<script>
    var updateVariantUrl = "{{ route('admin.products.variants.update', '') }}/";
</script>

<!-- JavaScript để điền dữ liệu vào modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var detailModal = document.getElementById('detailModal');
    detailModal.addEventListener('show.bs.modal', function (event) {
        // Lấy nút mà đã được nhấn
        var button = event.relatedTarget;

        // Lấy dữ liệu từ các thuộc tính data-*
        var variantId = button.getAttribute('data-variant-id');
        var variantName = button.getAttribute('data-variant-name');
        var variantImage = button.getAttribute('data-variant-image');
        var variantDescription = button.getAttribute('data-variant-description');
        var variantCategory = button.getAttribute('data-variant-category');
        var variantStatus = button.getAttribute('data-variant-status');
        var variantView = button.getAttribute('data-variant-view');
        var variantPrice = button.getAttribute('data-variant-price');
        var variantSalePrice = button.getAttribute('data-variant-sale-price');
        var variantQuantity = button.getAttribute('data-variant-quantity');
        var variantColor = button.getAttribute('data-variant-color');
        var variantSize = button.getAttribute('data-variant-size');

        // Cập nhật các trường trong modal
        var modal = detailModal.querySelector('.modal-content');
        modal.querySelector('#modalVariantName').value = variantName;
        modal.querySelector('#modalVariantDescription').value = variantDescription;
        modal.querySelector('#modalVariantCategory').value = variantCategory;
        modal.querySelector('#modalVariantStatus').value = variantStatus;
        modal.querySelector('#modalVariantView').value = variantView;
        modal.querySelector('#modalVariantQuantity').value = variantQuantity;
        modal.querySelector('#modalVariantPrice').value = variantPrice;
        modal.querySelector('#modalVariantSalePrice').value = variantSalePrice;
        modal.querySelector('#modalVariantColor').value = variantColor;
        modal.querySelector('#modalVariantSize').value = variantSize;

        // Cập nhật ảnh biến thể
        var currentImage = modal.querySelector('#currentVariantImage');
        if (variantImage) {
            currentImage.src = variantImage;
            currentImage.style.display = 'block';
        } else {
            currentImage.src = '';
            currentImage.style.display = 'none';
        }

        // Cập nhật action của form để gửi đến phương thức updateVariant
        var form = modal.querySelector('#variantDetailForm');
        form.action = updateVariantUrl + variantId;
    });
});
</script>
