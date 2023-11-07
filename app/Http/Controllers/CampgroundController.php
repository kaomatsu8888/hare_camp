<?php

namespace App\Http\Controllers;

use App\Models\Campground;

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

    // その他のCRUD操作（create, store, edit, update, destroy）も同様に定義可能
    // public function index()
    // {
    //     $campgrounds = Campground::all();
    //     return view('campgrounds.index', compact('campgrounds'));
    // }

    // public function show(Campground $campground)
    // {
    //     return view('campgrounds.show', compact('campground'));
    // }


}