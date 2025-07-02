<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

class BookController extends Controller
{
    public function index() {
        $books = Book::with('author', 'genres')->latest()->paginate(5);

        return response()->json([
            'status' => "Success",
            'data' => $books
        ]);
    }

    public function show(Book $book) {
        $book->load('author', 'genres');

        return response()->json([
            'status' => "Success",
            'data' => $book
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|unique:books,title',
            'author' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id'
        ]);

        $book = Book::create([
            'title' => $data['title'],
            'author_id' => $data['author']
        ]);

        $book->genres()->attach($data['genres']);

        return response()->json([
            'status' => "Success",
            'message' => 'Book created successfully.'
        ], 201);
    }

    public function update(Request $request, Book $book) {
        $data = $request->validate([
            'title' => 'required|unique:books,title,' . $book->id,
            'author' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id'
        ]);

        $book->update([
            'title' => $data['title'],
            'author_id' => $data['author']
        ]);

        $book->genres()->sync($data['genres']);

        return response()->json([
            'status' => "Success",
            'message' => 'Book updated successfully.',
        ]);
    }

    public function destroy(Book $book) {
        $book->delete();

        return response()->json([
            'status' => "Success",
            'message' => 'Book deleted successfully.'
        ]);
    }
}
