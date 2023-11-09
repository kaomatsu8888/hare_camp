<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campground extends Model
{
    use HasFactory;

    public function index()
    {
        $campgrounds = Campground::all();
        return view('campgrounds.index', compact('campgrounds'));
    }

}
