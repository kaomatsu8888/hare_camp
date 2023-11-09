<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'campground_id',
        'start_date',
        'end_date'
    ];

    // 日付をCarbonインスタンスに自動的にキャストする
protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
];


    // 予約をしたユーザー
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 予約されたキャンプ場
    public function campground(): BelongsTo
    {
        return $this->belongsTo(Campground::class);
    }
}
