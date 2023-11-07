<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'campground_id' => 'required|exists:campgrounds,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);
    
    $reservation = new Reservation($request->all());
    $reservation->user_id = auth()->id(); // 現在認証されているユーザーID
    $reservation->save();

    return redirect()->route('reservations.index')->with('success', 'Reservation has been made.');
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
