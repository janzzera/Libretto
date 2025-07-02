<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::latest()->paginate(5);

        return response()->json([
            'status' => "Success",
            'data' => $authors
        ]);
    }

    public function show(Author $author) {
        return response()->json([
            'status' => "Success",
            'data' => $author
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|unique:authors,name'
        ]);

        $author = Author::create([
            'name' => $data['name']
        ]);

        return response()->json([
            'status' => "Success",
            'message' => 'Author created successfully.'
        ], 201);
    }

    public function update(Request $request, Author $author) {
        $data = $request->validate([
            'name' => 'required|unique:authors,name,' . $author->id
        ]);

        $author->update([
            'name' => $data['name']
        ]);

        return response()->json([
            'status' => "Success",
            'message' => 'Author updated successfully.'
        ]);
    }

    public function destroy(Author $author) {
        $author->delete();

        return response()->json([
            'status' => "Success",
            'message' => 'Author deleted successfully.'
        ]);
    }
}
