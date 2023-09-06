<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ='tbl_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'price',
    ];

    public $timestamps = false;

    /**
     * product Creation
     *
     * @param array|null $productData
     * @return void
     */
    public function productCreate(array $productData) {
        return  $this->insert($productData);
    }

    /**
     * get all productd
     *
     * 
     * @return void
     */
    public function getProductList() {
        return  $this->get()->toArray();
    }

    /**
     * get product item
     * @param integer $productId
     * @return object
     */
    public function getProduct($productId) {
        return  $this->where('id', $productId)->first();
    }

    /**
     * update product item
     * @param integer $productId
     * @param array $productData
     * @return void
     */
    public function productUpdate(array $productData, int $productId) {
        return  $this->where('id', $productId)->update($productData);
    }

    /**
     * delete product item
     * @param integer $productId
     * @return void
     * 
     */
    public function productDelete(int $productId) {
        return  $this->where('id', $productId)->delete($productId);
    }
}
