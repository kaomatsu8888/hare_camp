<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campground;
use GuzzleHttp\Client; //Guzzleを使う場合は、必要。
use Illuminate\Support\Facades\Auth; //Authを使う場合は、必要。

class CampgroundController extends Controller
{
    // キャンプ場一覧を表示する
    public function index()
    {
        $campgrounds = Campground::latest()->paginate(10);
        $client = new Client();
        $apiKey = env('OPENWEATHERMAP_API_KEY'); // APIキーをセット

        foreach ($campgrounds as $campground) {
            $cityName = $campground->location; // キャンプ場の場所を取得
            $url = "http://api.openweathermap.org/data/2.5/weather?q={$cityName}&units=metric&lang=ja&appid={$apiKey}";
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            // 天気データをキャンプ場のデータに追加
            $campground->weather = [
                'main' => $data['weather'][0]['main'],
                'description' => $data['weather'][0]['description'],
                'icon' => $data['weather'][0]['icon'],
                'temp' => $data['main']['temp'],
                'temp_min' => $data['main']['temp_min'],
                'temp_max' => $data['main']['temp_max']
            ];
        }

        return view('campgrounds.index', compact('campgrounds'));
    }



    // 天気情報のため改変中
    public function show(Campground $campground)
    {
        $cityName = $campground->location; // キャンプ場の場所
        $apiKey = env('OPENWEATHERMAP_API_KEY'); // APIキー
        $url = "http://api.openweathermap.org/data/2.5/weather?units=metric&lang=ja&q=$cityName&appid=$apiKey";

        $client = new Client();
        $response = $client->request('GET', $url);
        $weatherData = json_decode($response->getBody(), true);

        // 必要な天気データを抽出
        $weather = [
            'main' => $weatherData['weather'][0]['main'],
            'description' => $weatherData['weather'][0]['description'],
            'temp' => $weatherData['main']['temp'],
            'temp_min' => $weatherData['main']['temp_min'],
            'temp_max' => $weatherData['main']['temp_max'],
            // その他の必要なデータ...
        ];

        return view('campgrounds.show', compact('campground', 'weather'));
    }

    // キャンプ場の新規登録フォームを表示する
    public function update(Request $request, Campground $campground)
    {
        $data = $request->validate([
            // ...他のバリデーションルール...
            'image' => 'sometimes|image|max:5000', // 画像ファイルであること、最大5MB
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campground_images', 'public');
            $data['image'] = $imagePath;
        }

        $campground->update($data);

        return redirect()->route('campgrounds.show', $campground);
    }

    public function sunnyDays()
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY'); // OpenWeatherMap APIキー
        $client = new Client();
        $sunnyCampgrounds = [];

        $campgrounds = Campground::all(); // すべてのキャンプ場を取得

        foreach ($campgrounds as $campground) {
            $cityName = $campground->location; // キャンプ場の場所（都市名）
            $url = "http://api.openweathermap.org/data/2.5/weather?q={$cityName}&appid={$apiKey}";

            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            // 天気の状態をチェック（ここでは「Clear」が晴れと仮定）
            if ($data['weather'][0]['main'] === 'Clear') {
                // 晴れているキャンプ場だけを追加
                $sunnyCampgrounds[] = $campground;
            }
        }

        // 晴れの日のキャンプ場のみをビューに渡す
        return view('weather.sunny_days', compact('sunnyCampgrounds'));
    }
}
