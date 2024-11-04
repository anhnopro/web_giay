<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderDetails')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function saveOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            // Tạo đơn hàng mới
            $order = new Order();
            $order->phone_number = $request->input('phone_number', 'Không xác định');
            $order->address = $request->input('address', 'Không xác định');
            $order->name = $request->input('name', 'Khách lẻ');
            $order->email = $request->input('email', 'no_email@example.com');
            $order->date = now();
            $order->condition = 'chờ xử lý';
            $order->total_payment = $request->input('total_payment', 0);
            $order->save();

            // Lưu từng sản phẩm trong giỏ hàng vào bảng `order_details`
            foreach ($request->input('order_items', []) as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->id_order = $order->id_order;
                $orderDetail->id_product = $item['id_product'];
                $orderDetail->id_variant = $item['id_variant'] ?? null;
                $orderDetail->qty = $item['quantity'];
                $orderDetail->total = $item['price'] * $item['quantity'];
                $orderDetail->total_payment = $item['price'] * $item['quantity'];
                $orderDetail->save();
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Đơn hàng đã được lưu thành công.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Có lỗi xảy ra khi lưu đơn hàng.', 'error' => $e->getMessage()]);
        }
    }
}
