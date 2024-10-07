<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ColorModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel; // Assuming you have a model for product variants
use App\Models\SizeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

public function updateProduct(Request $request, $id)
{
    // Find the product to update
    $product = ProductModel::findOrFail($id);

    // Validate the main product data
    $request->validate([
        'name' => 'required|string|max:255',
        'id_category' => 'required|exists:categories,id_category',
        'describe' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|boolean',
        // Variant fields will be handled separately
    ]);

    // Update product attributes
    $product->name = $request->input('name');
    $product->id_category = $request->input('id_category');
    $product->describe = $request->input('describe');
    $product->status = $request->input('status');

    // Handle product image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        // Store new image
        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
    }

    $product->save();

    // Handle variant updates
    if ($request->has('variants')) {
        foreach ($request->variants as $variantData) {
            // Find the variant
            $variant = ProductVariantModel::findOrFail($variantData['id_variant']);

            // Update variant attributes
            $variant->quantity = $variantData['quantity'];
            $variant->price = $variantData['price'];
            $variant->sale_price = $variantData['sale_price'] ?? null;
            $variant->id_color = $variantData['id_color'];
            $variant->id_size = $variantData['id_size'];

            // Note: Variant images are handled via the modal, not here

            $variant->save();
        }
    }

    // Handle variant deletions
    if ($request->has('selected_variants')) {
        foreach ($request->selected_variants as $variantId) {
            $variant = ProductVariantModel::findOrFail($variantId);

            // Delete variant image if exists
            if ($variant->image) {
                Storage::disk('public')->delete($variant->image);
            }

            // Delete the variant
            $variant->delete();
        }
    }

    return redirect()->route('admin.product.edit', $product->id_product)
                     ->with('success', 'Cập nhật sản phẩm thành công!');
}

/**
 * Update the specified product variant in storage.
 */
public function updateVariant(Request $request, $id)
{
    // Find the variant to update
    $variant = ProductVariantModel::findOrFail($id);

    // Validate variant data
    $request->validate([
        'quantity' => 'required|integer|min:0',
        'price' => 'required|integer|min:0',
        'sale_price' => 'nullable|integer|min:0',
        'id_color' => 'required|exists:colors,id_color',
        'id_size' => 'required|exists:sizes,id_size',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update variant attributes
    $variant->quantity = $request->input('quantity');
    $variant->price = $request->input('price');
    $variant->sale_price = $request->input('sale_price') ?? null;
    $variant->id_color = $request->input('id_color');
    $variant->id_size = $request->input('id_size');

    // Handle variant image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($variant->image) {
            Storage::disk('public')->delete($variant->image);
        }
        // Store new image
        $path = $request->file('image')->store('variants', 'public');
        $variant->image = $path;
    }

    $variant->save();

    return redirect()->route('update.product', $variant->id_product)
                     ->with('success', 'Cập nhật biến thể sản phẩm thành công!');
}


}
















