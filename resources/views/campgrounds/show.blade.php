{{-- resources/views/campgrounds/show.blade.php --}}
<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">
        {{-- フラッシュメッセージの表示 --}}
        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <article class="mb-2">
            {{-- キャンプ場の名前と説明を表示 --}}
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">{{ $campground->name }}</h2>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                {{ $campground->location }}
            </p>
            <img src="{{ $campground->image_url }}" alt="" class="mb-4">

            {{-- キャンプ場の説明 --}}
            <p class="text-gray-700 text-base">{!! nl2br(e($campground->description)) !!}</p>
        </article>

        {{-- 予約ボタンを表示 --}}
        <div class="flex flex-row text-center my-4">
            <a href="{{ route('reservations.create', $campground) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">このキャンプ場を予約する</a>
</a>{{-- このキャンプ場を予約するボタンを表示する --}} 
        </div>

        {{-- ...その他のキャンプ場の詳細情報... --}}
        <p>価格: ¥{{ number_format($campground->price) }}</p>
        {{-- ...その他のコンテンツ... --}}

        @if ($campground->image)
        <img src="{{ asset('storage/' . $campground->image) }}" alt="キャンプ場の画像">
        @endif

    </div>
</x-app-layout>
