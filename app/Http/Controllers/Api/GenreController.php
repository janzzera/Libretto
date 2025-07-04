<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::latest()->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $genres
        ]);
    }

    public function show(Genre $genre) {
        return response()->json([
            'success' => true,
            'data' => $genre
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->only('name'), [
            'name' => 'required|unique:genres,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $genre = Genre::create([
            'name' => $data['name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Genre created successfully.'
        ], 201);
    }

    public function update(Request $request, Genre $genre) {
        $validator = Validator::make($request->only('name'), [
            'name' => 'required|unique:genres,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $genre->update([
            'name' => $data['name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Genre updated successfully.',
        ]);
    }

    public function destroy(Genre $genre) {
        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre deleted successfully.'
        ]);
    }
}
