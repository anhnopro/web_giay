<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeModel extends Model
{
    use HasFactory;

    protected $table = 'sizes'; // Ensure this is the correct table name

    protected $primaryKey = 'id_size'; // Specify the correct primary key
}
