<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;//モデルファクトリを使うために追加

    protected $fillable = [//fillableプロパティを追加
        'body',
    ];
        

    public function user()//ユーザーを取得するリレーション
    {
        return $this->belongsTo(User::class);//belongsToメソッドを使って、ユーザーを取得するリレーションを定義
    }

    public function post()//記事を取得するリレーション
    {
        return $this->belongsTo(Post::class);//belongsToメソッドを使って、記事を取得するリレーションを定義
    }
}
