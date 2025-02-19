<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('author')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        return Book::create($validated);
    }

    public function show(Book $book)
    {
        return $book->load('author');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'author_id' => 'exists:authors,id'
        ]);

        $book->update($validated);
        return $book;
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response(null, 204);
    }
}
