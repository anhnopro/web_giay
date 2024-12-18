<?php

// app/Models/OrderDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_orderDetail';
    protected $table = 'order_details';
    protected $fillable = [
        'id_order', 'name_product', 'total', 'qty', 'id_product', 'total_payment','date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product', 'id_product');
    }

}
