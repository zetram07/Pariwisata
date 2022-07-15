<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store($placeId, StoreReviewRequest $request)
    {
        Review::create([
            'place_id' => $placeId,
            'user_id' => auth()->id(),
            'rate' => $request->rate,
            'review' => $request->review,
        ]);

        return back()->with('status', 'Berhasil memberikan ulasan');
    }
}
