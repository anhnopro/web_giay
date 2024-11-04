
@include('admin.headerAdmin')
<div class="container my-4">
    <h2 class="mb-4">Danh sách Hóa Đơn</h2>

    <!-- Filter Section -->
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <input type="text" class="form-control me-2" placeholder="Tìm kiếm hóa đơn">
            <input type="date" class="form-control me-2">
            <input type="date" class="form-control me-2">
            <button class="btn btn-outline-secondary">Quét mã</button>
        </div>
        <div>
            <button class="btn btn-warning">+ Tạo hóa đơn</button>
        </div>
    </div>

    <!-- Orders Table -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã</th>
                <th>Tổng SP</th>
                <th>Tổng số tiền</th>
                <th>Tên khách hàng</th>
                <th>Ngày tạo</th>
                <th>Loại hóa đơn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id_order }}</td>
                <td><a href="#">{{ $order->id_order }}</a></td>
                <td>{{ $order->orderDetails->count() }}</td>
                <td>{{ number_format($order->orderDetails->sum('total_payment'), 0, ',', '.') }} đ</td>
                <td>{{ $order->name ?? 'Khách lẻ' }}</td>
                <td>{{ $order->date }}</td>
                <td><span class="badge bg-success">{{ $order->condition === 'tại quầy' ? 'Tại quầy' : 'Trực tuyến' }}</span></td>
                <td>
                    <span class="badge {{ $order->condition === 'hoàn thành' ? 'bg-primary' : ($order->condition === 'chờ giao hàng' ? 'bg-warning' : 'bg-danger') }}">
                        {{ ucfirst($order->condition) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('orders.show', $order->id_order) }}" class="btn btn-primary">Chi tiết </a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.footerAdmin')
