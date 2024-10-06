<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantModel extends Model
{
    use HasFactory;

    protected $table = 'product_variants'; // Ensure this is the correct table name

    protected $primaryKey = 'id_variant'; // Ensure this is the correct primary key

    protected $fillable = [
        'id_product',
        'quantity',
        'price',
        'sale_price',
        'id_color',
        'id_size',
        'image',
        'describe',
        'id_category',
        'status',
        'view',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product'); // Use the correct foreign key
    }

    public function color()
    {
        return $this->belongsTo(ColorModel::class, 'id_color');
    }

    public function size()
    {
        return $this->belongsTo(SizeModel::class, 'id_size');
    }

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'id_category');
    }
}
