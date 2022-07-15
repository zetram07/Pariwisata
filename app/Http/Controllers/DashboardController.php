<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $places = Place::all();

        return view('dashboard', compact('places'));
    }
}
