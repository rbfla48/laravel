<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    use HasFactory;
    
    // 모든 값 대용량 할당 허용
    protected $guarded = [];
}
