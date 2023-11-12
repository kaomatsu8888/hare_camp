{{-- resources/views/campgrounds/index.blade.php --}}
<x-app-layout>
    {{-- スタイルを定義 --}}
    <style>
        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .campground-container {
            width: 30%; /* 各アイテムの幅 */
            background: #fff; /* 背景色 */
            border-radius: 8px; /* 角丸 */
            overflow: hidden; /* コンテナ外のコンテンツを隠す */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 影を追加 */
            margin: 10px; /* アイテム間の余白 */
            transition: transform 0.3s ease-in-out; /* アニメーション効果 */
        }

        .campground-container:hover {
            transform: translateY(-5px); /* ホバー時に上に少し移動 */
        }

        .image-fit {
            max-width: 100%; /* コンテナの幅に合わせる */
            max-height: 200px; /* 画像の高さの最大値を設定 */
            height: auto; /* 画像の高さを自動調整 */
            object-fit: cover; /* 画像のアスペクト比を保持 */
        }

        .campground-title {
            color: #FFFFFF; /* 白色に変更 */
            font-weight: bold; /* 文字を太くする */
}

    </style>

    <div class="bg-campground">
        <div class="container mx-auto mt-8 opacity-75">
            <h1 class="text-xl mb-4 text-yellow campground-title">キャンプ場一覧</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex-container"> <!-- flex-container クラスを追加 -->
                    @foreach ($campgrounds as $campground)
                        <div class="campground-container"> <!-- 各キャンプ場コンテナ -->
                            <a href="{{ route('campgrounds.show', $campground) }}" class="text-blue-500 hover:underline">
                                {{ $campground->name }}
                            </a>
                            <p>価格: ¥{{ number_format($campground->price) }}</p>
                            <div>
                                <img src="{{ strpos($campground->image, 'images/') === 0 ? asset($campground->image) : asset('images/' . $campground->image) }}" alt="キャンプ場の画像" class="image-fit">
                                <p>ホームセンターまでの距離: {{ $campground->distance_to_home_center }} km</p>
                                <p>スーパーまでの距離: {{ $campground->distance_to_supermarket }} km</p>
                                <p>コンビニまでの距離: {{ $campground->distance_to_convenience_store }} km</p>
                                <p>温泉までの距離: {{ $campground->distance_to_onsen }} km</p>
                            </div>
                            <div class="weather-info">
                                <p>天気: {{ $campground->weather['main'] }} ({{ $campground->weather['description'] }})</p>
                                <p>気温: {{ $campground->weather['temp'] }}°C</p>
                                <img src="http://openweathermap.org/img/w/{{ $campground->weather['icon'] }}.png" alt="{{ $campground->weather['main'] }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
