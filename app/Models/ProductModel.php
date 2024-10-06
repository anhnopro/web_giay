<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'name',
        'describe',
        'image',
        'view',
        'status',
        'updated_at',
        'id_category',
    ];

    public function getProductAll() {
        $result = DB::table('product as p')
            ->join('product_variants as pv', 'pv.id_product', '=', 'p.id_product')
            ->join('colors as c', 'pv.id_color', '=', 'c.id_color')
            ->join('sizes as s', 'pv.id_size', '=', 's.id_size')
            ->select(
                'p.id_product',
                'p.name as product_name',
                'p.image',
                'p.describe',
                'p.status',
                'p.view',
                'p.updated_at',
                DB::raw('GROUP_CONCAT(DISTINCT c.id_color ORDER BY c.id_color) as color_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT c.name ORDER BY c.id_color) as color_names'),
                DB::raw('GROUP_CONCAT(DISTINCT s.id_size ORDER BY s.id_size) as size_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT s.size_value ORDER BY s.id_size) as size_values'),
                DB::raw('SUM(pv.quantity) as total_quantity')
            )
            ->groupBy(
                'p.id_product',
                'p.name',
                'p.image',
                'p.describe',
                'p.status',
                'p.view',
                'p.updated_at'
            )
            ->get();

       return $result;
    }

    public function findProduct($idproduct) {
        $result = DB::table('product as p')
            ->join('product_variants as pv', 'pv.id_product', '=', 'p.id_product')
            ->join('colors as c', 'pv.id_color', '=', 'c.id_color')
            ->join('sizes as s', 'pv.id_size', '=', 's.id_size')
            ->join('category as cat', 'cat.id_category', '=', 'p.id_category')
            ->select(
                'p.id_product',
                'p.name as product_name',
                'p.image',
                'pv.price', // Make sure to include price from variants if needed
                'pv.sale_price',
                'p.describe',
                'p.status',
                'p.view',
                'p.updated_at',
                'cat.id_category',
                'cat.name as category_name',
                DB::raw('GROUP_CONCAT(DISTINCT c.id_color ORDER BY c.id_color) as color_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT c.name ORDER BY c.id_color) as color_names'),
                DB::raw('GROUP_CONCAT(DISTINCT s.id_size ORDER BY s.id_size) as size_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT s.size_value ORDER BY s.id_size) as size_values'),
                DB::raw('GROUP_CONCAT(pv.quantity ORDER BY pv.id_variant) as quantities')
            )
            ->groupBy(
                'p.id_product',
                'p.name',
                'p.image',
                'pv.price', // Ensure this is referencing the correct price
                'pv.sale_price',
                'p.describe',
                'p.status',
                'p.view',
                'p.updated_at',
                'cat.id_category',
                'cat.name'
            )
            ->where('p.id_product', '=', $idproduct)
            ->first();

        return $result;
    }

    // ProductModel.php
    public function variants()
    {
        return $this->hasMany(ProductVariantModel::class, 'id_product'); // This should reference 'id_product'
    }
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'id_category'); // Use the correct foreign key
    }


}
