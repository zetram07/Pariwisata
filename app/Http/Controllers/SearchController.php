<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$request->day && !$request->time && !$request->max_ticket_price) {
            return view('search');
        } else {
            $places = Place::all();
            $places = $places->filter(function ($place) use ($request) {
                $isFiltered = true;
                $operation_time = $place->operation_time;
                if ($request->day) {
                    $isFiltered = array_key_exists($request->day, $operation_time);
                    if ($isFiltered && $request->time) {
                        $openTime = $operation_time[$request->day][0];
                        $closeTime = $operation_time[$request->day][1];
                        $openTime = Carbon::createFromFormat('H:i', $openTime);
                        $closeTime = Carbon::createFromFormat('H:i', $closeTime);
                        $requestTime = Carbon::createFromFormat('H:i', $request->time);
                        $isFiltered = $openTime <= $requestTime && $requestTime <= $closeTime;
                    }
                }
                if ($request->max_ticket_price) {
                    $isFiltered = $place->ticket_price <= $request->max_ticket_price;
                }
                return $isFiltered;
            });
            return view('search-results', compact('places'));
        }
    }
}
