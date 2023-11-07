<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campground;

class CampgroundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     */
    public function run(): void
    {
        // ここにテストデータを挿入するコードを追加
        Campground::create([
            'name' => '山のふもとキャンプ場',
            'description' => '美しい山々に囲まれたキャンプ場です。',
            'location' => '山のふもと',
            'price' => 2000,
            // 'image_url' => '画像のURL', // もし画像URLを含む場合
        ]);
        // 他にもデータを追加...
    }
}
