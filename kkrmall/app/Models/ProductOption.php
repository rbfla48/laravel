<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    //use HasFactory;
    protected $table = 'product_option';
    public $timestamps = false;

    protected $fillable = ['product_id','option_no','name', 'add_price', 'stock', 'active', 'updated_at', 'created_at', 'created_by'];
}
