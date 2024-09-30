<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttrModel extends Model
{
    protected $table = 'product_attr';
    protected $fillable = [
        'id_product',
        'id_attribute',
        'quantity',
    ];

}
