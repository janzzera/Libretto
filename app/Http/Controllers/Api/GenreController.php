<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::latest()->paginate(5);

        return response()->json([
            'status' => 'Success',
            'data' => $genres
        ]);
    }

    public function show(Genre $genre) {
        return response()->json([
            'status' => 'Success',
            'data' => $genre
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'genre' => 'required|unique:genres,name'
        ]);

        $genre = Genre::create([
            'name' => $data['genre']
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Genre created successfully.',
        ], 201);
    }

    public function update(Request $request, Genre $genre) {
        $data = $request->validate([
            'genre' => 'required|unique:genres,name,' . $genre->id
        ]);

        $genre->update([
            'name' => $data['genre']
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Genre updated successfully.',
        ]);
    }

    public function destroy(Genre $genre) {
        $genre->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Genre deleted successfully.'
        ]);
    }
}
