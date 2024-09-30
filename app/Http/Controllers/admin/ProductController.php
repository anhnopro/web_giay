<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeModel;
use App\Models\CategoryModel;
use App\Models\ProductAttrModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listProduct(){
        $products=new ProductModel();


        $data=[
            'products'=>$products->getProductAll(),


        ];

        return view('admin.product.listPrd',$data);
    }
    public function addProduct(){
        $categories=new CategoryModel();
        $sizes=AttributeModel::where('name','=','size')->get();
        $colors=AttributeModel::where('name','=','color')->get();
        $data=[
            'categories'=>$categories->all(),
            'sizes'=>$sizes,
            'colors'=>$colors,
        ];

        return view('admin.product.addPrd',$data);
    }
    public function PostAddProduct(Request $request){
        $data = [
            'id_category' => $request->input('id_category'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'sale_price' => $request->input('sale_price'),
            'describe' => $request->input('describe'),

            'status' => 1,
            'view' => 0,
        ];
        if($request->hasFile('image')){
            $path_image = $request->file('image')->store('images', 'public');
            $data['image'] = $path_image;
        }
        $product = ProductModel::create($data);
        if ($product) {
            $sizes = $request->input('sizes') ?? [];
            $colors = $request->input('colors') ?? [];
            $quantity = $request->input('quantity');


            foreach ($sizes as $size) {
                ProductAttrModel::create(['id_product' => $product->id, 'id_attribute' => $size, 'quantity' => $quantity]);
            }

            foreach ($colors as $color) {
                ProductAttrModel::create(['id_product' => $product->id, 'id_attribute' => $color, 'quantity' => $quantity]);
            }
        }


           return redirect()->route('list.product');

    }
}
