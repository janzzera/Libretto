<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index(Book $book) {
        $reviews = $book->reviews()->latest()->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    public function show(Book $book, Review $review) {
        return response()->json([
            'success' => true,
            'data' => $review
        ]);
    }

    public function store(Request $request, Book $book) {
        $validator = Validator::make($request->only('content', 'rating'), [
            'content' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $review = $book->reviews()->create([
            'content' => $data['content'],
            'rating' => $data['rating'],
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review published successfully.'
        ], 201);
    }

    public function update(Request $request, Book $book, Review $review) {
        $validator = Validator::make($request->only('content', 'rating'), [
            'content' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $review->update([
            'content' => $data['content'],
            'rating' => $data['rating']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully.',
        ]);
    }

    public function destroy(Book $book, Review $review) {
        if ($review->book_id !== $book->id) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found for this book'
            ], 404);
        }
        
        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully.'
        ]);
    }
}
