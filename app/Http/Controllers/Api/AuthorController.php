<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::latest()->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $authors
        ]);
    }

    public function show(Author $author) {
        return response()->json([
            'success' => true,
            'data' => $author
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->only('name'), [
            'name' => 'required|unique:authors,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $author = Author::create([
            'name' => $data['name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Author created successfully.'
        ], 201);
    }

    public function update(Request $request, Author $author) {
        $validator = Validator::make($request->only('name'), [
            'name' => 'required|unique:authors,name,' . $author->id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $author->update([
            'name' => $data['name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Author updated successfully.'
        ]);
    }

    public function destroy(Author $author) {
        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Author deleted successfully.'
        ]);
    }
}
