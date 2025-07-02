<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;

class ReviewController extends Controller
{
    public function index() {
        return view('reviews.index', [
            'reviews' => Review::latest()->paginate(5)
        ]);
    }

    public function show(Review $review) {
        return view('reviews.show', compact('review'));
    }

    public function create() {
        $books = Book::all();
        return view('reviews.create', compact('books'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'book' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);

        Review::create([
            'book_id' => $data['book'],
            'content' => $data['content'],
            'rating' => $data['rating']
        ]);

        return redirect()->route('reviews.index');
    }

    public function edit(Review $review) {
        $books = Book::all();
        return view('reviews.edit', compact('review', 'books'));
    }

    public function update(Request $request,Review $review) {
        $data = $request->validate([
            'book' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review->update([
            'book_id' => $data['book'],
            'content' => $data['content'],
            'rating' => $data['rating']
        ]);

        return redirect()->back()->withSuccess('Review is updated successfully.');
    }


    public function destroy(Review $review) {
        $review->delete();

        return redirect()->route('reviews.index')->withSuccess('Review is deleted successfully.');
    }
}
