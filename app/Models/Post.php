<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [//代入を許可するカラムを指定
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
