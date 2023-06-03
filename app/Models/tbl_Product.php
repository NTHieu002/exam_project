<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class tbl_Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'product_id', 'product_name', 'category_id', 'product_price', 'product_quantity', 'product_status', 'product_image'
    ];
    protected $primaryKey = 'product_id';
    public $table = 'tbl_products';
}
