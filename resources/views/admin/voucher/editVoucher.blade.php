
@include('admin.headerAdmin')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Chỉnh Sửa Voucher</h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('update.voucher', $voucher->id_voucher) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="code" class="form-label">Mã Voucher</label>
                                <input type="text" name="code" class="form-control" value="{{ $voucher->code }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="name_voucher" class="form-label">Tên Voucher</label>
                                <input type="text" name="name_voucher" class="form-control" value="{{ $voucher->name_voucher }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="applicable_to" class="form-label">Kiểu Áp Dụng</label>
                                <select name="applicable_to" id="applicable_to" class="form-select" required>
                                    <option value="public" {{ $voucher->applicable_to === 'public' ? 'selected' : '' }}>Công khai</option>
                                    <option value="private" {{ $voucher->applicable_to === 'private' ? 'selected' : '' }}>Cá nhân</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                <select name="discount_type" class="form-select" required>
                                    <option value="percentage" {{ $voucher->discount_type === 'percentage' ? 'selected' : '' }}>Phần Trăm (%)</option>
                                    <option value="fixed" {{ $voucher->discount_type === 'fixed' ? 'selected' : '' }}>Số Tiền Cố Định (VND)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="discount_amount" class="form-label">Giá Trị Giảm Giá</label>
                                <input type="number" name="discount_amount" class="form-control" value="{{ $voucher->discount_amount }}" step="0.01" required>
                            </div>
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $voucher->start_date }}" required>
                            </div>

                            <div class="col-md-3">
                                <label for="expiration_date" class="form-label">Ngày Kết Thúc</label>
                                <input type="date" name="expiration_date" class="form-control" value="{{ $voucher->expiration_date }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="usage_limit" class="form-label">Giới Hạn Sử Dụng</label>
                                <input type="number" name="usage_limit" class="form-control" value="{{ $voucher->usage_limit }}" placeholder="Nhập giới hạn sử dụng (nếu có)">
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Trạng Thái</label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ $voucher->status === 'active' ? 'selected' : '' }}>Đang diễn ra</option>
                                    <option value="inactive" {{ $voucher->status === 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success">Cập Nhật Voucher</button>
                            <a href="{{ route('list.voucher') }}" class="btn btn-secondary ms-2">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footerAdmin')

