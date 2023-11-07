<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="font-bold text-xl mb-4">予約一覧</h2>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">キャンプ場名</th>
                    <th scope="col" class="px-6 py-3">開始日</th>
                    <th scope="col" class="px-6 py-3">終了日</th>
                    <th scope="col" class="px-6 py-3">予約日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $reservation->campground->name }}</td>
                        <td class="px-6 py-4">{{ $reservation->start_date->format('Y-m-d') }}</td>
                        <td class="px-6 py-4">{{ $reservation->end_date->format('Y-m-d') }}</td>
                        <td class="px-6 py-4">{{ $reservation->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
