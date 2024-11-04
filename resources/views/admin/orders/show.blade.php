@include('admin.headerAdmin')
<div class="container my-4">
    <h2 class="mb-4">Chi tiết Đơn Hàng #{{ $order->id_order }}</h2>

    <!-- Thông tin khách hàng -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Thông tin Khách Hàng</h4>
            <p><strong>Tên:</strong> {{ $order->name ?? 'Khách lẻ' }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone_number }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            <p><strong>Ngày tạo:</strong> {{ $order->date }}</p>
            <p><strong>Loại hóa đơn:</strong> <span class="badge bg-success">{{ $order->condition === 'tại quầy' ? 'Tại quầy' : 'Trực tuyến' }}</span></p>
            <p><strong>Trạng thái:</strong>
                <span class="badge {{ $order->condition === 'hoàn thành' ? 'bg-primary' : ($order->condition === 'chờ giao hàng' ? 'bg-warning' : 'bg-danger') }}">
                    {{ ucfirst($order->condition) }}
                </span>
            </p>
        </div>
    </div>

    <!-- Chi tiết Sản Phẩm -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Chi tiết Sản Phẩm</h4>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Màu sắc</th>
                        <th>Kích thước</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->id_orderDetail }}</td>
                        <!-- Hiển thị ảnh sản phẩm (lấy ảnh đầu tiên nếu có) -->
                        <td>

                                <img src="{{ asset('/storage/' . $detail->product->images) }}" alt="Ảnh sản phẩm" style="width: 50px; height: 50px;">
                        </td>
                        <td>{{ $detail->name_product }}</td>

                        <td>{{ $detail->product->color->name ?? null  }}</td>

                        <td>{{ $detail->product->size->size_value  ?? null}}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>{{ number_format($detail->total, 0, ',', '.') }} đ</td>
                        <td>{{ number_format($detail->total_payment, 0, ',', '.') }} đ</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="7" class="text-end"><strong>Tổng đơn hàng:</strong></td>
                        <td><strong>{{ number_format($order->orderDetails->sum('total_payment'), 0, ',', '.') }} đ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    {{-- <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Quay lại</a> --}}
</div>
@include('admin.footerAdmin')
