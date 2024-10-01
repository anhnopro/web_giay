<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantModel extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    protected $fillable=[
        'quantity',
        'price',
        'id_product',
        'id_color',
        'id_size',
        'image',
    ];
}
