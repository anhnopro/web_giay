<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products=new ProductModel();
        $data=[
            'products'=>$products->getProductHome(),
        ];

        
        return view('client.product.home',$data);
    }
    public function showProductDetail($productId)
    {
        $productModel = new ProductModel();
        $product = $productModel->getProductDetails($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        return view('client.product.detail', compact('product'));
    }

}
