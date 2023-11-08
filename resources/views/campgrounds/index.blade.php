{{-- resources/views/campgrounds/index.blade.php --}}
<x-app-layout>
    <div class="bg-campground"> <!-- このdivに背景画像クラスを適用する -->
        <div class="container mx-auto mt-8 opacity-75"> <!-- 背景画像にコンテンツを重ねるために透明度を下げる -->
            <h1 class="text-xl mb-4 ">キャンプ場一覧</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-disc space-y-2">
                        @foreach ($campgrounds as $campground)
                            <li>
                                <a href="{{ route('campgrounds.show', $campground) }}" class="text-blue-500 hover:underline">
                                    {{ $campground->name }}
                                </a>
                                <p>価格: ¥{{ number_format($campground->price) }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
