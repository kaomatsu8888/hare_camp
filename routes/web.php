<?php

use App\Http\Controllers\CommentController; //CommentControllerを追加
use App\Http\Controllers\PostController; //PostControllerを追加
use App\Http\Controllers\ProfileController; //ProfileControllerを追加
use Illuminate\Support\Facades\Route; //Routeを追加
use App\Http\Controllers\CampgroundController; //CampgroundControllerを追加
use App\Http\Controllers\ReservationController; //ReservationControllerを追加



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('reservations', ReservationController::class)->middleware('auth'); //認証ミドルウェアを追加


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () { //authミドルウェアをグループ化
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth');

Route::resource('posts', PostController::class) //PostControllerに対してのルーティングを追加
    ->only(['show', 'index']);

Route::resource('posts.comments', CommentController::class) //posts.commentsに対してのルーティングを追加
    ->only(['create', 'store', 'edit', 'update', 'destroy']) //必要なルーティングのみに絞る
    ->middleware('auth'); //ミドルウェアを追加

// キャンプ場の一覧（ログインユーザーのみアクセス可能にする）
Route::get('/campgrounds', [CampgroundController::class, 'index'])
    ->name('campgrounds.index')
    ->middleware('auth'); // この行を追加

Route::resource('reservations', ReservationController::class)->middleware('auth'); //認証ミドルウェアを追加

// キャンプ場の詳細（ログインユーザーのみアクセス可能にする）
Route::get('/campgrounds/{campground}', [CampgroundController::class, 'show'])
    ->name('campgrounds.show')
    ->middleware('auth'); // この行を追加（詳細ページもログイン必須にする場合）

// キャンプ場の予約フォームのルート
Route::get('/campgrounds/{campground}/reserve', [ReservationController::class, 'create'])
    ->name('reservations.create');

Route::get('/', [PostController::class, 'index']) //PostControllerのindexメソッドを呼び出すように変更
    ->name('root'); //名前付きルーティングを追加

//予約データを処理するためのPOSTルートを設定します。
Route::post('/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store');


require __DIR__ . '/auth.php';
