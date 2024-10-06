<?php

use App\Http\Controllers\admin\ProductController;
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
        Route::get('edit-product/{prd}', [ProductController::class,'editProduct'])->name('edit.product');
        Route::put('edit-product/{prd}', [ProductController::class, 'updateProduct'])->name('admin.products.update');

        // Route để xử lý cập nhật biến thể sản phẩm
        Route::put('edit-product/variants/{prd}', [ProductController::class, 'updateVariant'])->name('admin.products.variants.update');
    });
});
