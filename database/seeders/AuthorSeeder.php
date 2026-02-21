<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['name' => 'Leo Tolstoy'],
            ['name' => 'Jane Austen'],
            ['name' => 'George Orwell'],
            ['name' => 'Harper Lee'],
            ['name' => 'F. Scott Fitzgerald'],
            ['name' => 'Mark Twain'],
            ['name' => 'Charles Dickens'],
            ['name' => 'Emily Dickinson'],
            ['name' => 'Oscar Wilde'],
            ['name' => 'Stephen King'],
            ['name' => 'J.K. Rowling'],
            ['name' => 'J.R.R. Tolkien'],
            ['name' => 'George R.R. Martin'],
            ['name' => 'Agatha Christie'],
            ['name' => 'Paulo Coelho'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
