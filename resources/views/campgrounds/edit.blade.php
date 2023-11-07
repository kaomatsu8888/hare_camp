{{-- 例: resources/views/campgrounds/edit.blade.php --}}
<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md">
        <h2 class="text-center text-lg font-bold pt-6 tracking-widest">キャンプ場編集</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('campgrounds.update', $campground) }}" method="POST" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            @method('PUT')
            {{-- タイトル、説明などの入力フィールド --}}
            <div class="mb-4">
                {{-- タイトル入力フィールド --}}
            </div>
            <div class="mb-4">
                {{-- 説明入力フィールド --}}
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    キャンプ場画像
                </label>
                @if($campground->image)
                    <img src="{{ asset('storage/' . $campground->image) }}" alt="キャンプ場画像" class="mb-4 md:w-2/5 sm:auto">
                @endif
                <input type="file" name="image" class="border-gray-300">
            </div>
            <input type="submit" value="更新"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
