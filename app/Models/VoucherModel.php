<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherModel extends Model
{
    use HasFactory;

    protected $table = 'vouchers'; // Đảm bảo tên bảng đúng

    protected $primaryKey = 'id_voucher'; // Nếu khóa chính không phải 'id'

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name_voucher',
        'applicable_to',
        'discount_type',
        'discount_amount',
        'start_date',
        'expiration_date',
        'usage_limit',
        'status',
    ];

    // Nếu muốn liên kết với model User để tracking sử dụng voucher
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vouchers', 'voucher_id', 'user_id');
    }
}
