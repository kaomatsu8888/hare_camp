{{-- resources/views/campgrounds/index.blade.php --}}
<x-app-layout>
    {{-- スタイルを定義 --}}
    <style>
        .image-fit {
            max-width: 100%; /* コンテナの幅に合わせる */
            max-height: 200px; /* 画像の高さの最大値を設定 */
            height: auto; /* 画像の高さを自動調整 */
            object-fit: cover; /* 画像のアスペクト比を保持 */
        }
        .campground-container {
            width: 300px; /* コンテナの固定横幅 */
            background: #fff; /* 背景色 */
            border-radius: 8px; /* 角丸 */
            overflow: hidden; /* コンテナ外のコンテンツを隠す */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 影を追加 */
            transition: transform 0.3s ease-in-out; /* アニメーション効果 */
        }
        .campground-container:hover {
            transform: translateY(-5px); /* ホバー時に上に少し移動 */
        }
    </style>

    <div class="bg-campground">
        <div class="container mx-auto mt-8 opacity-75">
            <h1 class="text-xl mb-4 text-yellow">キャンプ場一覧</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-disc space-y-2">
                        @foreach ($campgrounds as $campground)
                            <li class="mb-4 campground-container">
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
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
