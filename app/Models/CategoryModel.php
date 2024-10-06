<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $primaryKey = 'id_category';
    protected $fillable=[
        'id_category',
        'name',
        'image',
    ];
    public function products()
    {
        return $this->hasMany(ProductModel::class, 'id_category'); // This should match the foreign key in ProductModel
    }
}
