{{-- resources/views/weather/sunny_days.blade.php --}}
<x-app-layout>
    {{-- ... --}}
    <div>
        <h1>晴れの日のキャンプ場一覧</h1>
        @foreach ($sunnyCampgrounds as $campground)
            <div>
                <h2>{{ $campground->name }}</h2>
                @if ($campground->weather && isset($campground->weather['description']))
                    <p>{{ $campground->weather['description'] }}</p>
                @endif
                @if ($campground->weather && isset($campground->weather['temp_max']))
                    <p>最高気温: {{ $campground->weather['temp_max'] }}°C</p>
                @endif
                @if ($campground->weather && isset($campground->weather['temp_min']))
                    <p>最低気温: {{ $campground->weather['temp_min'] }}°C</p>
                @endif
                {{-- ...その他の情報... --}}
            </div>
        @endforeach
    </div>
</x-app-layout>
