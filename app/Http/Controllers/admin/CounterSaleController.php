<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ColorModel;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductModel;
use App\Models\SizeModel;
use App\Models\VoucherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounterSaleController extends Controller
{
    public function index()
    {
        $products = ProductModel::with(['variants.color', 'variants.size', 'category'])->get();
        $vouchers = VoucherModel::where('status', 'active')
            ->where('expiration_date', '>=', now())
            ->get();
        $categories = CategoryModel::all();
        $colors = ColorModel::all();
        $sizes = SizeModel::all();

        return view('admin.counter_sale.index', compact('products', 'categories', 'colors', 'sizes', 'vouchers'));
    }
    
}
