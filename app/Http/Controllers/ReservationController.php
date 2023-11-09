<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Campground; 
use Illuminate\Support\Facades\Auth;//必要か不明

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
public function create($campground_id)
{
    // キャンプ場のモデルを見つける
    $campground = Campground::findOrFail($campground_id);

    // 予約フォームビューにキャンプ場の情報を渡す
    return view('reservations.create', compact('campground'));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // バリデーションルール
    $validatedData = $request->validate([
        'campground_id' => 'required|exists:campgrounds,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        // 他に必要なフィールドがあれば追加
    ]);
    
    // 予約データの保存
    $reservation = new Reservation($validatedData);
    $reservation->user_id = auth()->id(); // 予約ユーザーのID
    $reservation->save();

     // 予約が保存されたら、ユーザーをマイページ（または任意のページ）にリダイレクトします。
        return redirect()->route('mypage')->with('success', '予約が完了しました。');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
