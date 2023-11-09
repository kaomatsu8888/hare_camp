{{-- resources/views/mypage.blade.php --}}

<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-700 text-center">マイ予約一覧</h2>

                    <div class="mt-4">
                        <table class="table-auto w-full mt-2">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border">キャンプ場</th>
                                    <th class="px-4 py-2 border">チェックイン</th>
                                    <th class="px-4 py-2 border">チェックアウト</th>
                                    <th class="px-4 py-2 border">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reservations as $reservation)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border text-center">{{ $reservation->campground->name ?? 'キャンプ場情報なし' }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $reservation->start_date->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $reservation->end_date->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            <a href="{{ route('campgrounds.show', $reservation->campground) }}" class="text-indigo-600 hover:text-indigo-900">詳細</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 border text-center">予約はありません。</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
