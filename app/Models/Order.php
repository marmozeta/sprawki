<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    
    public function getOrders() {
        return DB::table('orders')
            ->select(DB::raw('sum(order_items.price*order_items.quantity) as sum, (sum(order_items.price*order_items.quantity)*elements.vat/100) AS vat, orders.*, users.name AS user_name'))
            ->join('users', 'orders.user_id', '=', 'users.id')    
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('elements', 'elements.element_id', '=', 'order_items.element_element_id')
            ->whereNull('orders.deleted_at')
            ->groupBy('orders.id')
            ->get();
    }
}
