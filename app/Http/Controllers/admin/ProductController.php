<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ColorModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel; // Assuming you have a model for product variants
use App\Models\SizeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function listProduct()
    {
        $products = new ProductModel();
        $data=[
           'products'=>$products->getProductAll(),
        ];

        return view('admin.product.listPrd', $data);
    }

    public function addProduct()
    {
        $categories = CategoryModel::all();
        $colors = ColorModel::all();
        $sizes = SizeModel::all();

        return view('admin.product.addPrd', [
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
    }
    public function postAddProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_category' => 'required|exists:categories,id_category',
            'name' => 'required|string|max:255',
            'describe' => 'nullable|string',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id_color',
            'sizes' => 'required|array',
            'sizes.*' => 'array',
            'sizes.*.*' => 'exists:sizes,id_size',
            'quantities' => 'required|array',
            'quantities.*' => 'array',
            'quantities.*.*' => 'integer|min:1',
            'prices' => 'required|array',
            'prices.*' => 'array',
            'prices.*.*' => 'numeric|min:0',
            'images' => 'nullable|array',
            'images.*.*.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'id_category' => $request->input('id_category'),
            'name' => $request->input('name'),
            'describe' => $request->input('describe'),
            'status' => 1,
            'view' => 0,
        ];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePaths = $file->store('images', 'public');
            }
        }
        $data['image'] = $imagePaths;
        $product = ProductModel::create($data);

        if ($product) {
            $colors = $request->input('colors', []);
            $sizesArray = $request->input('sizes', []);
            $quantities = $request->input('quantities', []);
            $prices = $request->input('prices', []);
            $images = $request->file('images', []);

            foreach ($colors as $color) {
                if (!isset($sizesArray[$color])) continue;
                foreach ($sizesArray[$color] as $size) {
                    $quantity = $quantities[$color][$size] ?? 0;
                    $price = $prices[$color][$size] ?? 0;

                    if (isset($images[$color][$size])) {
                        foreach ($images[$color][$size] as $file) {
                            $variantImagePaths = $file->store('images', 'public');
                        }
                    }
                    ProductVariantModel::create([
                        'id_product' => $product->id_product,
                        'id_size' => $size,
                        'id_color' => $color,
                        'quantity' => $quantity,
                        'price' => $price,
                        'image' => $variantImagePaths,
                    ]);
                }
            }
            return redirect()->route('list.product')->with('success', 'Product added successfully.');
        }

        return redirect()->back()->with('error', 'Failed to add the product. Please try again.');
    }


    public function editProduct($id_product)
{
    $product = ProductModel::with(['variants.color', 'variants.size', 'category'])->findOrFail($id_product);
    $categories = CategoryModel::all();
    $colors = ColorModel::all();
    $sizes = SizeModel::all();

    return view('admin.product.detailPrd', [
        'categories' => $categories,
        'product' => $product,
        'colors' => $colors,
        'sizes' => $sizes,
    ]);

}
public function updateProduct(Request $request, $prd)
    {
        $product = ProductModel::with('variants')->findOrFail($prd);

        $validator = Validator::make($request->all(), [
            'id_category' => 'required|exists:categories,id_category',
            'name' => 'required|string|max:255',
            'describe' => 'nullable|string',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'variants' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product->id_category = $request->input('id_category');
        $product->name = $request->input('name');
        $product->describe = $request->input('describe');

        if ($request->hasFile('image')) {
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }

            $product->image = $request->file('image')->store('images', 'public');
        }

        $product->save();

        $this->updateVariants($request, $product);
        return redirect()->route('admin.products.edit', $prd)->with('success', 'Product updated successfully.');
    }

    // Update specific variant
    public function updateVariant(Request $request, $prd)
    {
        $variant = ProductVariantModel::findOrFail($prd);

        $validator = Validator::make($request->all(), [
            'id_category' => 'required|exists:categories,id_category',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'id_color' => 'required|exists:colors,id_color',
            'id_size' => 'required|exists:sizes,id_size',
            'status' => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $variant->update($request->only(['quantity', 'price', 'sale_price', 'id_color', 'id_size', 'status']));

        if ($request->hasFile('image')) {
            if ($variant->image && \Storage::disk('public')->exists($variant->image)) {
                \Storage::disk('public')->delete($variant->image);
            }

            $variant->image = $request->file('image')->store('images', 'public');
        }

        return redirect()->route('admin.products.edit', $variant->id_product)->with('success', 'Variant updated successfully.');
    }
}













