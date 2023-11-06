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

    public function user()//ユーザーを取得するリレーション
    {
        return $this->belongsTo(User::class);//belongsToメソッドを使って、ユーザーを取得するリレーションを定義
    }

    public function comments()//コメントを取得するリレーション
    {
        return $this->hasMany(Comment::class);//hasManyメソッドを使って、コメントを取得するリレーションを定義
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
