<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Phương thức hiển thị giỏ hàng
    public function index()
    {
        $cart = Session::get('cart', []);
        $totalPayment = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['qty'] * $item['price']);
        }, 0);

        return view('client.cart.index', compact('cart', 'totalPayment'));
    }

    // Phương thức thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request)
    {
        $cart = Session::get('cart', []);

        $productId = $request->input('id_product');
        $productName = $request->input('product_name');
        $color = $request->input('color');
        $size = $request->input('size');
        $qty = (int) $request->input('qty', 1);
        $price = (int) $request->input('price');
        $image = $request->input('image');

        $index = $productId . '-' . $color . '-' . $size;

        if (isset($cart[$index])) {
            $cart[$index]['qty'] += $qty;
        } else {
            $cart[$index] = [
                'id_product' => $productId,
                'product_name' => $productName,
                'color' => $color,
                'size' => $size,
                'qty' => $qty,
                'price' => $price,
                'image' => $image,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateQuantity(Request $request)
    {
        $index = $request->input('index');
        $quantity = $request->input('qty', 1);

        $cart = Session::get('cart', []);

        if (isset($cart[$index])) {
            $cart[$index]['qty'] = $quantity;
            Session::put('cart', $cart);
        }

        return response()->json([
            'status' => 'success',
            'total' => number_format($cart[$index]['qty'] * $cart[$index]['price'], 0, ',', '.') . ' VNĐ',
            'total_payment' => number_format(array_reduce($cart, function ($carry, $item) {
                return $carry + $item['qty'] * $item['price'];
            }, 0), 0, ',', '.') . ' VNĐ'
        ]);
    }

    // Xóa sản phẩm khỏi giỏ hàng và cập nhật lại tổng tiền
    public function deleteProductCart($id_product, $color, $size)
{
    $cart = Session::get('cart', []);

    // Giải mã `color` nếu nó được mã hóa
    $color = urldecode($color);

    // Tìm và xóa sản phẩm dựa trên id_product, color, và size
    foreach ($cart as $index => $item) {
        if ($item['id_product'] == $id_product && $item['color'] == $color && $item['size'] == $size) {
            unset($cart[$index]);
            Session::put('cart', $cart);
            break;
        }
    }

    // Tính toán lại tổng tiền sau khi xóa sản phẩm
    $totalPayment = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['qty'] * $item['price']);
    }, 0);

    return response()->json([
        'status' => 'success',
        'total_payment' => number_format($totalPayment, 0, ',', '.') . ' VNĐ'
    ]);
}
public function checkout()
{
    $cart = Session::get('cart', []);
    $totalPayment = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['qty'] * $item['price']);
    }, 0);

    return view('client.cart.checkout', compact('cart', 'totalPayment'));
}
public function processCheckout(Request $request)
{
    // Lấy giỏ hàng từ session
    $cart = session('cart', []);

    // Kiểm tra giỏ hàng có trống không
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống. Vui lòng thêm sản phẩm!');
    }

    // Tính tổng tiền thanh toán
    $totalPayment = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['qty'] * $item['price']);
    }, 0);

    // Lưu thông tin đơn hàng
    $order = Order::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'date' => now()->toDateString(),
        'invoice_type'=>0,
    ]);

    // Lưu chi tiết đơn hàng
    foreach ($cart as $item) {
        OrderDetail::create([
            'id_order' => $order->id_order,
            'name_product' => $item['product_name'],
            'total' => $item['qty'] * $item['price'],
            'qty' => $item['qty'],
            'id_product' => $item['id_product'],
            'total_payment' => $totalPayment, // Dùng tổng thanh toán đã tính
        ]);
    }

    // Xóa giỏ hàng sau khi thanh toán thành công
    session()->forget('cart');

    return redirect()->route('client.order.show', ['id' => $order->id_order])->with('success', 'Thanh toán thành công!');
}
public function show($id)
    {
        // Lấy thông tin đơn hàng
        $order = Order::with('orderDetails')->findOrFail($id);
        return view('client.order.show', compact('order'));
    }

}
