<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order';
    protected $table = 'orders';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'date',
        'invoice_type',
        'total_payment'

    ];

    public function findOrder($orderId) {
        $result = DB::table('orders as o')
            ->join('order_details as od', 'od.id_order', '=', 'o.id_order')
            ->join('product as p', 'od.id_product', '=', 'p.id_product')
            ->join('product_variants as pv', 'pv.id_product', '=', 'p.id_product')
            ->join('colors as c', 'pv.id_color', '=', 'c.id_color')
            ->join('sizes as s', 'pv.id_size', '=', 's.id_size')
            ->select(
                'o.id_order',
                'o.phone_number',
                'o.address',
                'o.name as customer_name',
                'o.date',
                'o.condition',
                DB::raw('SUM(od.total_payment) as total_order_amount'),
                DB::raw('GROUP_CONCAT(p.id_product ORDER BY p.id_product) as product_ids'),
                DB::raw('GROUP_CONCAT(p.name ORDER BY p.id_product) as product_names'),
                DB::raw('GROUP_CONCAT(pv.price ORDER BY p.id_product) as product_prices'),
                DB::raw('GROUP_CONCAT(od.qty ORDER BY od.id_orderDetail) as quantities'),
                DB::raw('GROUP_CONCAT(DISTINCT c.id_color ORDER BY c.id_color) as color_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT c.name ORDER BY c.id_color) as color_names'),
                DB::raw('GROUP_CONCAT(DISTINCT s.id_size ORDER BY s.id_size) as size_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT s.size_value ORDER BY s.id_size) as size_values')
            )
            ->groupBy(
                'o.id_order',
                'o.phone_number',
                'o.address',
                'o.name',
                'o.date',
                'o.condition'
            )
            ->where('o.id_order', '=', $orderId)
            ->first();

        return $result;
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id_order');
    }
    public $timestamps = true;
}
