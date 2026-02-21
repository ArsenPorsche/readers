<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        private BookService $bookService
    ) {}

    public function index(Request $request)
    {
        $books = $this->bookService->getFilteredBooks($request->integer('author_id') ?: null);
        $authors = Author::orderBy('name')->get();

        return view('home', compact('books', 'authors'));
    }

    public function show(Book $book)
    {
        $book->load(['author', 'user']);

        return view('books.show', compact('book'));
    }

    public function create()
    {
        $authors = Author::orderBy('name')->get();

        return view('books.create', compact('authors'));
    }

    public function store(StoreBookRequest $request)
    {
        $this->bookService->createBook(
            $request->validated(),
            $request->file('cover_image')
        );

        return redirect()->route('home')->with('success', 'Book added successfully!');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);

        $authors = Author::orderBy('name')->get();

        return view('books.edit', compact('book', 'authors'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->authorize('update', $book);

        $this->bookService->updateBook(
            $book,
            $request->validated(),
            $request->file('cover_image')
        );

        return redirect()->route('home')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        $this->bookService->deleteBook($book);

        return redirect()->route('home')->with('success', 'Book deleted successfully.');
    }
}
