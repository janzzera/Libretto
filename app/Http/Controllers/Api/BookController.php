<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index() {
        $books = Book::latest()->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    public function show(Book $book) {
        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->only('title', 'author', 'genres'), [
            'title' => 'required|unique:books,title',
            'author' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $book = Book::create([
            'title' => $data['title'],
            'author_id' => $data['author']
        ]);

        $book->genres()->attach($data['genres']);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully.'
        ], 201);
    }

    public function update(Request $request, Book $book) {
        $validator = Validator::make($request->only('title', 'author', 'genres'), [
            'title' => 'required|unique:books,title,' . $book->id,
            'author' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $book->update([
            'title' => $data['title'],
            'author_id' => $data['author']
        ]);

        $book->genres()->sync($data['genres']);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully.',
        ]);
    }

    public function destroy(Book $book) {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully.'
        ]);
    }
}
