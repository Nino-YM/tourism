<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_content' => 'required|string',
            'review_date' => 'required|date',
            'id_event' => 'required|exists:events,id_event'
        ]);

        $review = Review::create([
            'rating' => $request->rating,
            'review_content' => $request->review_content,
            'review_date' => $request->review_date,
            'id_event' => $request->id_event,
            'id_user' => Auth::id()
        ]);

        return response()->json($review, 201);
    }

    public function show($id)
    {
        return Review::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'integer|min:1|max:5',
            'review_content' => 'string',
            'review_date' => 'date',
            'id_event' => 'exists:events,id_event'
        ]);

        $review = Review::findOrFail($id);


        if ($review->id_user != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($request->has('rating')) {
            $review->rating = $request->rating;
        }
        if ($request->has('review_content')) {
            $review->review_content = $request->review_content;
        }
        if ($request->has('review_date')) {
            $review->review_date = $request->review_date;
        }
        if ($request->has('id_event')) {
            $review->id_event = $request->id_event;
        }

        $review->save();

        return response()->json($review, 200);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->id_user != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $review->delete();

        return response()->json(null, 204);
    }
}
