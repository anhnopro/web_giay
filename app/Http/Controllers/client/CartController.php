<?php


namespace App\Http\Controllers\client;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $totalPayment = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['qty'] * $item['price']);
        }, 0);

        return view('client.cart.index', compact('cart', 'totalPayment'));
    }
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
                'color' => $color, // Luôn lưu màu sắc vào giỏ hàng
                'size' => $size,   // Luôn lưu kích thước vào giỏ hàng
                'qty' => $qty,
                'price' => $price,
                'image' => $image,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // Phương thức hiển thị giỏ hàng


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

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeItem($index)
    {
        $cart = Session::get('cart', []);
        unset($cart[$index]);
        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
}
