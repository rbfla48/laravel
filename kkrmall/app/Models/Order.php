<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Order extends Model
{
    //use HasFactory;
    use Searchable;
    protected $table = 'order';
    public $timestamps = false;

    public function searchableAs()
    {
        return 'orders_index';
    }

}
