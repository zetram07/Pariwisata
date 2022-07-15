<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Models\Place;
use App\Models\PlacePhoto;
use App\Models\Review;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function show($id)
    {
        $place = Place::with('photos', 'reviews')->findOrFail($id);
        $place->reviewCounts = $place->reviews->count();
        $place->averageRate = number_format($place->reviews->sum('rate') / ($place->reviews->count() > 0 ? $place->reviews->count() : 1), 1);
        $myReview = $place->reviews->where('place_id', $place->id)->where('user_id', auth()->id())->first();
        if ($myReview) {
            $place->reviews = $place->reviews->diff([$myReview]);
        }

        return view('places.show', compact('place', 'myReview'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(StorePlaceRequest $request)
    {
        $operationTime = [];
        foreach ($request->operation_time as $operation_time) {
            if (isset($operation_time['day'])) {
                $operationTime[$operation_time['day']] = [
                    $operation_time['open_time'],
                    $operation_time['close_time'],
                ];
            }
        }
        $place = Place::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'ticket_price' => $request->ticket_price,
            'status' => $request->status,
            'operation_time' => $operationTime,
        ]);
        if ($request->hasFile('photo')) {
            $filePath = $request->photo->storeAs('images', $request->photo->hashName(), 'public');
            $filePath = 'storage/' . $filePath;
            PlacePhoto::create([
                'place_id' => $place->id, 
                'url' => $filePath,
            ]);
        }
        return to_route('monitored-places.show', $place);
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return to_route('dashboard');
    }
}
