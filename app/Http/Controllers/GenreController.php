<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index() {
        return view('genres.index', [
            'genres' => Genre::latest()->paginate(5)
        ]);
    }

    public function show(Genre $genre) {
        return view('genres.show', compact('genre'));
    }

    public function create() {
        return view('genres.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'genre' => 'required|unique:genres,name',
        ]);

        Genre::create([
            'name' => $data['genre'],
        ]);

        return redirect()->route('genres.index');
    }

    public function edit(Genre $genre) {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre) {
        $data = $request->validate([
            'genre' => 'required|unique:genres,name,' . $genre->id,
        ]);

        $genre->update([
            'name' => $data['genre']
        ]);

        return redirect()->back()->withSuccess('Genre is updated successfully.');
    }

    public function destroy(Genre $genre) {
        $genre->delete();

        return redirect()->route('genres.index')->withSuccess('Genre is deleted successfully.');
    }
}
