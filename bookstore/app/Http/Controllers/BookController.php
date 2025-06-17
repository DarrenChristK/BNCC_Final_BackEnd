<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function index(Request $request)
    {

        $query = Book::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $books = $query->get();

        return view('books.index', compact('books'));
    }


    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('books.create');
    }


    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('book_images', 'public');
            $validated['image'] = $imagePath;
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }


    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }


    public function edit(Book $book)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('books.edit', compact('book'));
    }


    public function update(Request $request, Book $book)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('book_images', 'public');
            $validated['image'] = $imagePath;
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }


    public function destroy(Book $book)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
