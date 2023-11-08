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
                'name' => '焼走りキャンプ場',
                'description' => '美しい山々に囲まれたキャンプ場です。',
                'location' => '岩手県',
                'price' => 2000,
                'image' => 'images/campground1.jpg', // 画像のURLを設定
                'distance_to_home_center' => 1.2, // ホームセンターまでの距離
                'distance_to_supermarket' => 0.8, // スーパーまでの距離
                'distance_to_convenience_store' => 0.5, // コンビニまでの距離
                'distance_to_onsen' => 5.0, // 温泉までの距離
            ],
            [
                'name' => '九十九里オートキャンプ場',
                'description' => '美しい海に囲まれたキャンプ場です。',
                'location' => '千葉県',
                'price' => 3000,
                'image' => 'images/campground2.jpg', // 画像のURLを設定
                'distance_to_home_center' => 2.0, // ホームセンターまでの距離
                'distance_to_supermarket' => 1.0, // スーパーまでの距離
                'distance_to_convenience_store' => 5.0, // コンビニまでの距離
                'distance_to_onsen' => 5.0, // 温泉までの距離
            ],
            [
                'name' => 'オートキャンプ場 in 高千穂',
                'description' => '美しい川に囲まれたキャンプ場です。',
                'location' => '宮崎県',
                'price' => 4000,
                'image' => 'images/campground3.jpg', // 画像のURLを設定
                'distance_to_home_center' => 4.2, // ホームセンターまでの距離
                'distance_to_supermarket' => 5.8, // スーパーまでの距離
                'distance_to_convenience_store' => 1.5, // コンビニまでの距離
                'distance_to_onsen' => 1.0, // 温泉までの距離
            ],
        ];
        foreach ($campgrounds as $campground) {
            Campground::create($campground);
        }

        // foreach ($campgrounds as $campground) {
        //     Campground::create(array_merge($campground, [
        //         'distance_to_home_center' => 1.5, // 例：1.5km
        //         'distance_to_supermarket' => 2.0, // 例：2.0km
        //         'distance_to_convenience_store' => 0.5, // 例：0.5km
        //         'distance_to_onsen' => 3.5, // 例：3.5km
        //         ]));
        //         }
    }
}
