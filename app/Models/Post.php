<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; //画像を保存するために追加

class Post extends Model
{
    use HasFactory;

    protected $fillable = [ //代入を許可するカラムを指定
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getImageUrlAttribute() //画像のURLを取得するアクセサ

    {
        return Storage::url($this->image_path); //storage/app/public/images/posts/20210701123456_hogehoge.jpg

    }

    public function getImagePathAttribute() //画像のパスを取得するアクセサ

    {
        return 'images/posts/' . $this->image; //20210701123456_hogehoge.jpg

    }
}
