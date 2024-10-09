@include('admin.headerAdmin')

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Form Add New Voucher -->
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thêm Voucher Mới</h4>
                </div>
                <div class="card-body p-4">
                    <!-- Display error messages if any -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Add voucher form -->
                    <form action="{{ route('store.voucher') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <!-- Voucher Code -->
                            <div class="col-md-6">
                                <label for="code" class="form-label">Mã Voucher</label>
                                <input type="text" name="code" class="form-control" placeholder="NHẬP MÃ VOUCHER" required>
                            </div>

                            <!-- Voucher Name -->
                            <div class="col-md-6">
                                <label for="name_voucher" class="form-label">Tên Voucher</label>
                                <input type="text" name="name_voucher" class="form-control" placeholder="NHẬP TÊN VOUCHER" required>
                            </div>

                            <!-- Applicable To -->
                            <div class="col-md-6">
                                <label for="applicable_to" class="form-label">Kiểu Áp Dụng</label>
                                <select name="applicable_to" id="applicable_to" class="form-select" required>
                                    <option value="public">Công khai</option>
                                    <option value="private">Cá nhân</option>
                                </select>
                            </div>

                            <!-- Discount Type -->
                            <div class="col-md-6">
                                <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                <select name="discount_type" class="form-select" required>
                                    <option value="percentage">Phần Trăm (%)</option>
                                    <option value="fixed">Số Tiền Cố Định (VND)</option>
                                </select>
                            </div>

                            <!-- Discount Amount -->
                            <div class="col-md-6">
                                <label for="discount_amount" class="form-label">Giá Trị Giảm Giá</label>
                                <input type="number" name="discount_amount" class="form-control" step="0.01" placeholder="Nhập giá trị giảm giá" required>
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>

                            <!-- Expiration Date -->
                            <div class="col-md-3">
                                <label for="expiration_date" class="form-label">Ngày Kết Thúc</label>
                                <input type="date" name="expiration_date" class="form-control" required>
                            </div>

                            <!-- Usage Limit -->
                            <div class="col-md-6">
                                <label for="usage_limit" class="form-label">Giới Hạn Sử Dụng</label>
                                <input type="number" name="usage_limit" class="form-control" placeholder="Nhập giới hạn sử dụng (nếu có)">
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Trạng Thái</label>
                                <select name="status" class="form-select" required>
                                    <option value="active">Đang diễn ra</option>
                                    <option value="inactive">Không hoạt động</option>
                                </select>
                            </div>
                        </div>

                        <!-- Account Selection Section (Displayed only when 'private' is selected) -->
                        <div class="row g-3 mt-4" id="accounts_section" style="display: none;">
                            <div class="col-12">
                                <div class="card shadow-lg border-0">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0">Chọn Tài Khoản Nhận Voucher</h5>
                                    </div>
                                    <div class="card-body p-3">
                                        <table class="table table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th><input type="checkbox" id="select_all"></th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Địa Chỉ</th>
                                                    <th>Số Điện Thoại</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($accounts as $account)
                                                    <tr>
                                                        <td><input type="checkbox" name="selected_users[]" value="{{ $account->id }}"></td>
                                                        <td>{{ $account->full_name }}</td>
                                                        <td>{{ $account->email }}</td>
                                                        <td>{{ $account->address }}</td>
                                                        <td>{{ $account->phone_number }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if($accounts->isEmpty())
                                            <p>Không có tài khoản nào.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success">Thêm Voucher</button>
                            <a href="{{ route('list.voucher') }}" class="btn btn-secondary ms-2">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footerAdmin')

<!-- JavaScript for handling account selection -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const applicableToSelect = document.getElementById('applicable_to');
        const accountsSection = document.getElementById('accounts_section');
        const selectAllCheckbox = document.getElementById('select_all');

        // Toggle account selection section based on applicable_to selection
        applicableToSelect.addEventListener('change', function() {
            accountsSection.style.display = (this.value === 'private') ? 'block' : 'none';
        });

        // Select/deselect all checkboxes
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = accountsSection.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });
</script>
