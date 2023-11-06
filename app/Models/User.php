<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;//モデルファクトリを使うために追加
use Illuminate\Foundation\Auth\User as Authenticatable;//ユーザー認証機能を使うために追加
use Illuminate\Notifications\Notifiable;//通知機能を使うために追加
use Laravel\Sanctum\HasApiTokens;//Laravel Sanctumを使うために追加

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;//HasApiTokens、HasFactory、Notifiableを使うために追加

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [//代入を許可するカラムを指定
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [//隠したいカラムを設定
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [//キャストを設定
        'email_verified_at' => 'datetime',//email_verified_atカラムをdatetime型に変換
        'password' => 'hashed',//passwordカラムをハッシュ化
    ];

    public function posts()//記事を取得するリレーション
    {
        return $this->hasMany(Post::class);//hasManyメソッドを使って、記事を取得するリレーションを定義
    }

        public function comments()//コメントを取得するリレーション
    {
        return $this->hasMany(Comment::class);//hasManyメソッドを使って、コメントを取得するリレーションを定義
    }
}
