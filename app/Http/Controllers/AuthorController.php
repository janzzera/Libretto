<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() {
        return view('authors.index', [
            'authors' => Author::latest()->paginate(5)
        ]);
    }

    public function show(Author $author) {
        return view('authors.show', compact('author'));
    }

    public function create() {
        return view('authors.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|unique:authors,name'
        ]);

        Author::create([
            'name' => $data['name']
        ]);

        return redirect()->route('authors.index');
    }

    public function edit(Author $author) {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author) {
        $data = $request->validate([
            'name' => 'required|unique:authors,name,' . $author->id
        ]);

        $author->update([
            'name' => $data['name']
        ]);

        return redirect()->back()->withSuccess('Author is updated successfully.');
    }

    public function destroy(Author $author) {
        $author->delete();

        return redirect()->route('authors.index')->withSuccess('Author is deleted successfully.');
    }
}
