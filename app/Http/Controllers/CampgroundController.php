<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campground;
use Illuminate\Support\Facades\Auth;//Authを使う場合は、必要。

class CampgroundController extends Controller
{

    // キャンプ場一覧を表示する
    public function index()
    {
        $campgrounds = Campground::latest()->paginate(10); // キャンプ場を新しい順に取得し、ページネーションを適用

        return view('campgrounds.index', compact('campgrounds')); // 取得したキャンプ場をビューに渡す
    }

    // キャンプ場の詳細を表示する
    public function show(Campground $campground)
    {
        return view('campgrounds.show', compact('campground')); // 取得したキャンプ場をビューに渡す
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



}
