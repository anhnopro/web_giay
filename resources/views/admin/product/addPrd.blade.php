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

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('post.add.product') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Thương hiệu -->
            <div class="mb-3">
                <label for="category" class="form-label">Thương hiệu</label>
                <select name="id_category" id="category" class="form-select" required>
                    <option value="" disabled selected>- Chọn Thương Hiệu -</option>
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id_category }}" {{ old('id_category') == $cate->id_category ? 'selected' : '' }}>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tên sản phẩm -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên sản phẩm" name="name" value="{{ old('name') }}" required>
            </div>

            <!-- Màu sắc và Kích cỡ -->
            <div class="mb-3 d-flex align-items-center">
                <label for="colors" class="form-label me-3">Màu sắc & Kích cỡ:</label>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#colorSizeModal">
                    <i class="fas fa-plus"></i> Thêm Màu và Kích Cỡ
                </button>
            </div>

            <div id="colorSizeTablesContainer">
                <!-- Các bảng sẽ được thêm động ở đây -->
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" id="description" name="describe" rows="4" placeholder="Nhập mô tả sản phẩm" required>{{ old('describe') }}</textarea>
            </div>

            <!-- Ảnh sản phẩm -->
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh sản phẩm</label>
                <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple required>
            </div>

            <!-- Button Submit -->
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
            <a href="{{ route('list.product') }}" class="btn btn-secondary ms-2">Hủy Bỏ</a>
        </form>

    </div>
</div>

<!-- Modal chọn màu và kích cỡ -->
<div class="modal fade" id="colorSizeModal" tabindex="-1" aria-labelledby="colorSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="colorSizeModalLabel">Chọn Màu và Kích Cỡ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Chọn màu sắc -->
                <div class="mb-3">
                    <label class="form-label">Màu sắc</label>
                    <div id="colorSelection">
                        @foreach ($colors as $color)
                            <div class="form-check">
                                <input class="form-check-input color-radio" type="radio" id="color{{ $color->id_color }}" name="selected_color" value="{{ $color->id_color }}">
                                <label class="form-check-label" for="color{{ $color->id_color }}">{{ $color->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Chọn kích cỡ -->
                <div class="mb-3">
                    <label class="form-label">Kích cỡ</label>
                    <div id="sizeSelection">
                        @foreach ($sizes as $size)
                            <div class="form-check">
                                <input class="form-check-input size-checkbox" type="checkbox" id="size{{ $size->id_size }}" value="{{ $size->id_size }}">
                                <label class="form-check-label" for="size{{ $size->id_size }}">{{ $size->size_value }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="confirmSelectionBtn">Xác nhận lựa chọn</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for handling color and size -->
<script>
    document.getElementById('confirmSelectionBtn').addEventListener('click', function() {
        const selectedColor = document.querySelector('input.color-radio:checked');
        const selectedSizes = Array.from(document.querySelectorAll('input.size-checkbox:checked')).map(checkbox => checkbox.value);

        if (selectedColor && selectedSizes.length > 0) {
            const colorId = selectedColor.value;
            const colorName = selectedColor.nextElementSibling.innerText;

            // Prevent adding the same color multiple times
            if (document.querySelector(`input[name="colors[]"][value="${colorId}"]`)) {
                alert('Màu đã được thêm.');
                return;
            }

            // Add a hidden input for the color
            const hiddenColorInput = `<input type="hidden" name="colors[]" value="${colorId}">`;
            document.getElementById('colorSizeTablesContainer').insertAdjacentHTML('beforeend', hiddenColorInput);

            const tableId = `colorTable${colorId}`;
            let tableHTML = `
                <div class="mb-3" id="colorSection${colorId}">
                    <h5>${colorName}</h5>
                    <table class="table table-bordered" id="${tableId}">
                        <thead>
                            <tr>
                                <th>Kích cỡ</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Ảnh</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            selectedSizes.forEach(size => {
                tableHTML += `
                    <tr>
                        <td>${size} <input type="hidden" name="sizes[${colorId}][]" value="${size}"></td>
                        <td><input type="number" class="form-control" name="quantities[${colorId}][${size}]" min="1" placeholder="Nhập số lượng" required></td>
                        <td><input type="number" class="form-control" name="prices[${colorId}][${size}]" min="0" placeholder="Nhập giá" required></td>
                        <td><input type="file" class="form-control" name="images[${colorId}][${size}][]" accept="image/*" multiple></td>
                        <td><button type="button" class="btn btn-danger btn-sm deleteSizeRowBtn">Xóa</button></td>
                    </tr>
                `;
            });

            tableHTML += `
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger btn-sm mt-2 deleteColorBtn" data-color-id="${colorId}">Xóa Màu Này</button>
                </div>
            `;

            document.getElementById('colorSizeTablesContainer').insertAdjacentHTML('beforeend', tableHTML);

            // Reset the inputs after adding
            document.querySelectorAll('input.size-checkbox:checked').forEach(checkbox => checkbox.checked = false);

            // Close the modal
            const colorSizeModal = new bootstrap.Modal(document.getElementById('colorSizeModal'));
            colorSizeModal.hide();
        } else {
            alert('Vui lòng chọn màu sắc và ít nhất một kích cỡ.');
        }
    });

    // Event handler to delete size rows and color sections
    document.getElementById('colorSizeTablesContainer').addEventListener('click', function(event) {
        if (event.target.classList.contains('deleteSizeRowBtn')) {
            event.target.closest('tr').remove();
        }

        // Handle deleting the entire color section
        if (event.target.classList.contains('deleteColorBtn')) {
            const colorId = event.target.getAttribute('data-color-id');
            // Remove the entire color section
            document.getElementById(`colorSection${colorId}`).remove();
            // Remove the hidden color input
            const hiddenColorInput = document.querySelector(`input[name="colors[]"][value="${colorId}"]`);
            if (hiddenColorInput) hiddenColorInput.remove();
        }
    });
</script>
