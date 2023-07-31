<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table ='order';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'trucking_number',
        'payment_mode',
        'payment_status',
        'order_status',
    ];

    /**
     * order Creation
     *
     * @param integer|null $userId
     * @param array|null $userData
     * @return void
     */
    public function orderCreate(array $userData, int $userId) {
        return  $this->insertGetId($userData);
    }
}
