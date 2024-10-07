@include('admin.headerAdmin')

<div style="width: calc(100% - 220px);">
    <div class="row mt-3 mt-2">
        <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themmoi">
                Thêm mới
            </button>
        </div>
        <div class="mt-2">
            <table class="table border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Ảnh</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $cate)
                        <tr>
                            <td>{{ $cate->id_category }}</td>
                            <td>{{ $cate->name }}</td>
                            <td>
                                <div style="height: 60px;">
                                    <img src="{{ asset('/storage/'.$cate->image) }}" style="width: 100px; height: auto;" alt="{{ $cate->name }}">
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal"
                                               data-category-id="{{ $cate->id_category }}"
                                               data-category-name="{{ $cate->name }}">
                                                Xóa
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#update"
                                                data-category-id="{{ $cate->id_category }}"
                                                data-category-name="{{ $cate->name }}"
                                                data-category-image="{{ asset('/storage/'.$cate->image) }}">
                                                Sửa
                                            </button>
                                        </li>
                                        <!-- Add other actions if needed -->
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#"><i class='bx bx-chevrons-left'></i></a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class='bx bx-chevrons-right'></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Add New Category Modal -->
<div class="modal" id="themmoi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('add.category') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mới thương hiệu</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_category_name" class="form-label">Tên thương hiệu</label>
                        <input type="text" name="name" id="new_category_name" placeholder="Nhập tên thương hiệu" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_category_image" class="form-label">Ảnh thương hiệu</label>
                        <input type="file" name="image" id="new_category_image" class="form-control">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Category Modal -->
<div class="modal" id="update">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT method for updates -->

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thương hiệu</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <input type="hidden" name="id_category" id="category_id">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Tên thương hiệu</label>
                        <input type="text" name="name" id="category_name" placeholder="Nhập tên thương hiệu" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_image" class="form-label">Ảnh thương hiệu</label>
                        <input type="file" name="image" id="category_image" class="form-control">
                        <img id="current_image" src="#" alt="Current Image" class="mt-2" style="max-height: 100px; display: none;">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal (Optional) -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Xóa sản phẩm</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                Bạn có muốn xóa không?
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <form id="deleteForm" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">OK</button>
                </form>
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Modal Data Population -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Update Modal
        var updateModal = document.getElementById('update');
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            // Extract info from data-* attributes
            var categoryId = button.getAttribute('data-category-id');
            var categoryName = button.getAttribute('data-category-name');
            var categoryImage = button.getAttribute('data-category-image');

            // Update the modal's content.
            var modal = updateModal.querySelector('.modal-content');

            // Set the form action dynamically
            var form = modal.querySelector('#updateForm');
            form.action = '{{ route("update.category", ":id") }}'.replace(':id', categoryId);

            // Populate the form fields
            modal.querySelector('#category_id').value = categoryId;
            modal.querySelector('#category_name').value = categoryName;

            var currentImage = modal.querySelector('#current_image');
            if (categoryImage) {
                currentImage.src = categoryImage;
                currentImage.style.display = 'block';
            } else {
                currentImage.style.display = 'none';
            }
        });

        // Delete Modal (Optional)
        var deleteModal = document.getElementById('myModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var categoryId = button.getAttribute('data-category-id');

            var modal = deleteModal.querySelector('.modal-content');
            var form = modal.querySelector('#deleteForm');
            form.action = '/category/delete/' + categoryId;
        });
    });
</script>

@include('admin.footerAdmin')
