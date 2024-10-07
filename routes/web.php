<?php

use App\Http\Controllers\Admin\CategoryController;
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
        Route::get('edit-product/{prd}', [ProductController::class, 'editProduct'])->name('edit.product');
        Route::put('edit-product/{prd}', [ProductController::class, 'updateProduct'])->name('update.product');

        // Cập nhật biến thể sản phẩm
        Route::put('edit-product/variants/{variant}', [ProductController::class, 'updateVariant'])->name('update.product.variant');
});
Route::prefix('category/')->group(function(){
     Route::get('list-category',[CategoryController::class,'listCategory'])->name('list.category');
     Route::post('add-category',[CategoryController::class,'addCategory'])->name('add.category');
     Route::put('update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
});

}
)
;
