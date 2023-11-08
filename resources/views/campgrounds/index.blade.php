{{-- resources/views/campgrounds/index.blade.php --}}
<x-app-layout>
    <div class="bg-campground">
        <div class="container mx-auto mt-8 opacity-75">
            <h1 class="text-xl mb-4 text-white">キャンプ場一覧</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-disc space-y-2">
                        @foreach ($campgrounds as $campground)
                            <li class="mb-4">
                                <a href="{{ route('campgrounds.show', $campground) }}" class="text-blue-500 hover:underline">
                                    {{ $campground->name }}
                                </a>
                                <p>価格: ¥{{ number_format($campground->price) }}</p>
                                <!-- 新しい情報の表示 -->
                                <div>
                                    <img src="{{ asset('images/' . $campground->image) }}" alt="キャンプ場の画像" class="w-full h-auto">
                                    <p>ホームセンターまでの距離: {{ $campground->distance_to_home_center }} km</p>
                                    <p>スーパーまでの距離: {{ $campground->distance_to_supermarket }} km</p>
                                    <p>コンビニまでの距離: {{ $campground->distance_to_convenience_store }} km</p>
                                    <p>温泉までの距離: {{ $campground->distance_to_onsen }} km</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
