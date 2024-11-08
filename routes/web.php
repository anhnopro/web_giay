<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\CounterSaleController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\CartController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin/')->group(function(){
    Route::prefix('product/')->group(function(){
        Route::get('list-product',[ProductController::class,'listProduct'])->name('list.product');
        Route::get('add-product',[ProductController::class,'addProduct'])->name('add.product');
        Route::post('add-product',[ProductController::class,'PostAddProduct'])->name('post.add.product');
        Route::get('edit-product/{prd}', [ProductController::class, 'editProduct'])->name('edit.product');
        Route::put('edit-product/{prd}', [ProductController::class, 'updateProduct'])->name('update.product');


        Route::put('edit-product/variants/{variant}', [ProductController::class, 'updateVariant'])->name('update.product.variant');
});
Route::prefix('category/')->group(function(){
     Route::get('list-category',[CategoryController::class,'listCategory'])->name('list.category');
     Route::post('add-category',[CategoryController::class,'addCategory'])->name('add.category');
     Route::put('update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
});

/// voucher
Route::prefix('voucher')->group(function() {
    Route::get('/', [VoucherController::class, 'index'])->name('list.voucher');
    Route::get('add-voucher', [VoucherController::class, 'create'])->name('add.voucher');
    Route::post('add-voucher', [VoucherController::class, 'store'])->name('store.voucher');
    Route::get('edit-voucher/{id}', [VoucherController::class, 'edit'])->name('edit.voucher'); // Edit route
    Route::post('update-voucher/{id}', [VoucherController::class, 'update'])->name('update.voucher'); // Update route
    Route::delete('delete-voucher/{id}', [VoucherController::class, 'destroy'])->name('destroy.voucher');
});

//counter_sales
Route::prefix('counter-sales')->group(function(){
    Route::get('/',[CounterSaleController::class,'index'])->name('list.counter.sales');
    Route::post('counter-sale/store-order', [CounterSaleController::class, 'storeOrder'])->name('admin.counterSale.storeOrder');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});


Route::prefix('client/')->group(function(){
           Route::get('home',[HomeController::class,'index'])->name('home');
           Route::get('product/detail/{id}', [HomeController::class, 'showProductDetail'])->name('product.detail');

});
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('/cart/delete/{id_product}/{color}/{size}', [CartController::class, 'deleteProductCart'])->name('cart.delete');

Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
Route::get('/orders/{id}', [CartController::class, 'show'])->name('client.order.show');
