<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage()
    {
        $user = auth()->user();
        $reservations = $user->reservations()->with('campground')->get();

        return view('mypage', compact('reservations'));
    }
}
