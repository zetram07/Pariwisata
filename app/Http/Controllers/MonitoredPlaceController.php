<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitoredPlaceController extends Controller
{
    public function show($id) {
        $place = Place::with('photos', 'reviews.user')->findOrFail($id);
        $place->reviewCounts = $place->reviews->count();
        $place->averageRate = number_format($place->reviews->sum('rate') / ($place->reviews->count() > 0 ? $place->reviews->count() : 1), 1);
        $rateSeries = [0, 0, 0, 0, 0];
        for ($i = 0; $i < 5; $i++) {
            $rateSeries[$i] = $place->reviews->where('rate', 5 - $i)->count();
        }
        $ageSeries = [0, 0, 0];
        foreach ($place->reviews as $review) {
            $userBirthDate = $review->user->birth_date;
            $userAge = Carbon::parse($userBirthDate)->age;
            if ($userAge > 18) {
                $ageSeries[0]++;
            } elseif ($userAge >= 13) {
                $ageSeries[1]++;
            } else {
                $ageSeries[2]++;
            }
        }

        return view('monitored-places.show', compact('place', 'rateSeries', 'ageSeries'));
    }
}
