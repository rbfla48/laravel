<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //use HasFactory;

    //Model::preventLazyLoading(! $this->app->isProduction);
    protected $table = 'menus';
    public $timestamps = false;
}
