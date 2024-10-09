@include('admin.headerAdmin')
<div class="container mt-4">
    <h2>Danh Sách Voucher</h2>
    <a href="{{route('add.voucher')}}" class="btn btn-primary mb-3">Thêm Voucher Mới</a>
    <div class="alert alert-success" style="display:none;">Thành công!</div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Voucher</th>
                <th>Tên</th>
                <th>Kiểu</th>
                <th>Loại Giảm Giá</th>
                <th>Giá Trị Giảm Giá</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Hết Hạn</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchers as $voucher)
            <tr>
                <td>{{$voucher->id_voucher}}</td>
                <td>{{$voucher->code}}</td>
                <td>{{$voucher->name_voucher}}</td>
                <td>
                    @if($voucher->applicable_to === 'public')
                        <p class="badge bg-info">Công khai</p>
                    @else
                        <p class="badge bg-primary">Cá nhân</p>
                    @endif
                </td>
                <td>
                    @if($voucher->discount_type === 'percentage')
                        Phần trăm
                    @else
                        Cố định
                    @endif
                </td>
                <td>
                    @if($voucher->discount_type === 'percentage')
                        {{$voucher->discount_amount}}%
                    @else
                        {{ number_format($voucher->discount_amount, 0, ',', '.') }}đ
                    @endif
                </td>
                <td>{{$voucher->start_date}}</td>
                <td>{{$voucher->expiration_date}}</td>
                <td>
                    @if($voucher->status === 'active')
                        <p class="badge bg-success">Đang diễn ra</p>
                    @else
                        <p class="badge bg-danger">Kết thúc</p>
                    @endif
                </td>
                <td>
                    <a href="/admin/vouchers/edit/{{$voucher->id_voucher}}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="/admin/vouchers/{{$voucher->id_voucher}}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa voucher này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.footerAdmin')
