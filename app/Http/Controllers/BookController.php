<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;


class BookController extends Controller
{
    public function index() {
        return view('books.index', [
            'books' => Book::latest()->paginate(5)
        ]);
    }

    public function show(Book $book) {
        return view('books.show', compact('book'));
    }

    public function create() {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|unique:books,title',
            'author' => 'required',
            'genres' => 'required|array'
        ]);

        $book = Book::create([
            'title' => $data['title'],
            'author_id' => $data['author']
        ]);

        $book->genres()->attach($request->genres);

        return redirect()->route('books.index');
    }

    public function edit(Book $book) {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book) {
        $data = $request->validate([
            'title' => 'required|unique:books,title,' . $book->id,
            'author' => 'required',
            'genres' => 'required|array'
        ]);

        $book->update([
            'title' => $data['title'],
            'author_id' => $data['author']
        ]);

        $book->genres()->sync($request->genres);

        return redirect()->back()->withSuccess('Book is updated successfully.');
    }

    public function destroy(Book $book) {
        $book->delete();

        return redirect()->route('books.index')->withSuccess('Book is deleted successfully.');
    }
}
