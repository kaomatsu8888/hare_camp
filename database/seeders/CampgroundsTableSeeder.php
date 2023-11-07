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
        $campgrounds = [
            [
                'name' => '山のふもとキャンプ場',
                'description' => '美しい山々に囲まれたキャンプ場です。',
                'location' => '山のふもと',
                'price' => 2000,
                // 'image_url' => '画像のURL', // もし画像URLを含む場合
            ],
            [
                'name' => '海のふもとキャンプ場',
                'description' => '美しい海に囲まれたキャンプ場です。',
                'location' => '海のふもと',
                'price' => 3000,
                // 'image_url' => '画像のURL', // もし画像URLを含む場合
            ],
            [
                'name' => '川のふもとキャンプ場',
                'description' => '美しい川に囲まれたキャンプ場です。',
                'location' => '川のふもと',
                'price' => 4000,
                // 'image_url' => '画像のURL', // もし画像URLを含む場合
            ],
        ];
        foreach ($campgrounds as $campground) {
            Campground::create($campground);
            // 他にもデータを追加...
        }
    }
}
