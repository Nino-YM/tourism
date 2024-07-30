<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

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
            'id_event' => 'required|exists:events,id_event',
            'id_user' => 'required|exists:users,id_user'
        ]);

        $review = Review::create([
            'rating' => $request->rating,
            'review_content' => $request->review_content,
            'review_date' => $request->review_date,
            'id_event' => $request->id_event,
            'id_user' => $request->id_user
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
            'id_event' => 'exists:events,id_event',
            'id_user' => 'exists:users,id_user'
        ]);

        $review = Review::findOrFail($id);

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
        if ($request->has('id_user')) {
            $review->id_user = $request->id_user;
        }

        $review->save();

        return response()->json($review, 200);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
