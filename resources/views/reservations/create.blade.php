{{-- resources/views/reservations/create.blade.php --}}
<x-app-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-xl mb-4">予約フォーム</h1>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="campground_id" value="{{ $campground->id }}">

            <div class="mb-4">
                <label for="start_date">開始日:</label>
                <input type="date" name="start_date" required>
            </div>

            <div class="mb-4">
                <label for="end_date">終了日:</label>
                <input type="date" name="end_date" required>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    予約する
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
