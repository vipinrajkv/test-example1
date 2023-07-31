<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;
    protected $table ='order_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'tax_amount',
        'quantity',
    ];

    /**
     * orders List Creation
     *
     * @param integer|null $userId
     * @param array|null $orderItems
     * @return void
     */
    public function createOrderList(array $orderItems, int $userId) {
        return  $this->insertGetId($orderItems);
    }
}
