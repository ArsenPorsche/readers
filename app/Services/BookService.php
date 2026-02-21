<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\UploadedFile;

class BookService
{
    public function getFilteredBooks(?int $authorId = null)
    {
        $query = Book::with(['author', 'user']);

        if ($authorId) {
            $query->where('author_id', $authorId);
        }

        return $query->latest()->get();
    }

    public function createBook(array $data, ?UploadedFile $coverImage = null): Book
    {
        $book = new Book($data);
        $book->user_id = auth()->id();

        if ($coverImage) {
            $book->cover_image = $this->uploadCover($coverImage);
        }

        $book->save();

        return $book;
    }

    public function updateBook(Book $book, array $data, ?UploadedFile $coverImage = null): Book
    {
        $book->fill($data);

        if ($coverImage) {
            $this->deleteCover($book->cover_image);
            $book->cover_image = $this->uploadCover($coverImage);
        }

        $book->save();

        return $book;
    }

    public function deleteBook(Book $book): void
    {
        $this->deleteCover($book->cover_image);
        $book->delete();
    }

    /**
     * Store cover image in public/covers and return its path.
     */
    private function uploadCover(UploadedFile $file): string
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('covers'), $fileName);

        return 'covers/' . $fileName;
    }

    private function deleteCover(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
