<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::with('books')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        return Author::create($validated);
    }

    public function show(Author $author)
    {
        return $author->load('books');
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $author->update($validated);
        return $author;
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response(null, 204);
    }
}