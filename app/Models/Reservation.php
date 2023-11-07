<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
        // これによって、代入が許可される属性を指定します
    protected $fillable = [
        'user_id',
        'campground_id',
        'start_date',
        'end_date'
    ];
}
