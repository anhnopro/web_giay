<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    use HasFactory;
    protected $table='product';
    protected $fillable=[
        'name',
        'price',
        'sale_price',
        'describe',
        'image',
        'view',
        'status',
        'updated_at',
        'id_category',
    ];
    public function getProductAll() {
        $result = DB::table('product as p')
            ->join('product_attr as pa', 'pa.id_product', '=', 'p.id_product')
            ->join('attribute as a', 'pa.id_attribute', '=', 'a.id_attribute')
            ->select(
                'p.id_product',
                'p.name as product_name',
                'p.image',
                'p.price',
                'p.sale_price',
                'p.describe',
                'p.status',
                'p.view',
                'p.updated_at',
                DB::raw('GROUP_CONCAT(DISTINCT a.id_attribute ORDER BY a.id_attribute) as attribute_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT a.name ORDER BY a.id_attribute) as attribute_names'),
                DB::raw('GROUP_CONCAT(DISTINCT a.value ORDER BY a.id_attribute) as attribute_values'),
                DB::raw('GROUP_CONCAT(pa.quantity ORDER BY a.id_attribute) as attribute_quantities')
            )
            ->groupBy(
                'p.id_product',
                'p.name',
                'p.image',
                'p.price',
                'p.sale_price',
                'p.describe',
                'p.status',
                'p.view',
                'p.updated_at'
            )
            ->get();

        return $result;
    }



}
