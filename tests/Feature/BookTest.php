<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Book CRUD — Feature Tests
|--------------------------------------------------------------------------
*/

// ── Guest ─────────────────────────────────────────────────────

it('allows guests to view the home page', function () {
    $this->get(route('home'))
        ->assertStatus(200);
});

it('allows guests to view a book page', function () {
    $book = Book::factory()->create();

    $this->get(route('books.show', $book))
        ->assertStatus(200)
        ->assertSee($book->title);
});

it('redirects guests from create page to login', function () {
    $this->get(route('books.create'))
        ->assertRedirect(route('login'));
});

it('prevents guests from storing a book', function () {
    $this->post(route('books.store'), [])
        ->assertRedirect(route('login'));
});

// ── Authenticated ─────────────────────────────────────────────

it('allows authenticated users to view create form', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('books.create'))
        ->assertStatus(200);
});

it('allows authenticated users to store a book', function () {
    $user   = User::factory()->create();
    $author = Author::factory()->create();

    $this->actingAs($user)
        ->post(route('books.store'), [
            'title'       => 'Test Book',
            'description' => 'A great book.',
            'author_id'   => $author->id,
            'year'        => 2024,
            'price'       => 19.99,
        ])
        ->assertRedirect(route('home'));

    $this->assertDatabaseHas('books', [
        'title'   => 'Test Book',
        'user_id' => $user->id,
    ]);
});

// ── Authorization (Policy) ─────────────────────────────────────

it('allows the owner to edit their book', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->get(route('books.edit', $book))
        ->assertStatus(200);
});

it('prevents non-owners from editing a book', function () {
    $owner   = User::factory()->create();
    $other   = User::factory()->create();
    $book    = Book::factory()->create(['user_id' => $owner->id]);

    $this->actingAs($other)
        ->get(route('books.edit', $book))
        ->assertStatus(403);
});

it('allows the owner to update their book', function () {
    $user   = User::factory()->create();
    $author = Author::factory()->create();
    $book   = Book::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->put(route('books.update', $book), [
            'title'       => 'Updated Title',
            'description' => 'Updated description.',
            'author_id'   => $author->id,
            'year'        => 2025,
            'price'       => 29.99,
        ])
        ->assertRedirect(route('home'));

    $this->assertDatabaseHas('books', [
        'id'    => $book->id,
        'title' => 'Updated Title',
    ]);
});

it('prevents non-owners from updating a book', function () {
    $owner  = User::factory()->create();
    $other  = User::factory()->create();
    $author = Author::factory()->create();
    $book   = Book::factory()->create(['user_id' => $owner->id]);

    $this->actingAs($other)
        ->put(route('books.update', $book), [
            'title'       => 'Hacked Title',
            'description' => 'Hacked.',
            'author_id'   => $author->id,
        ])
        ->assertStatus(403);
});

it('allows the owner to delete their book', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->delete(route('books.destroy', $book))
        ->assertRedirect(route('home'));

    $this->assertDatabaseMissing('books', ['id' => $book->id]);
});

it('prevents non-owners from deleting a book', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $book  = Book::factory()->create(['user_id' => $owner->id]);

    $this->actingAs($other)
        ->delete(route('books.destroy', $book))
        ->assertStatus(403);
});

// ── Validation ────────────────────────────────────────────────

it('validates required fields when storing a book', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('books.store'), [])
        ->assertSessionHasErrors(['title', 'description', 'author_id']);
});

// ── Filtering ─────────────────────────────────────────────────

it('filters books by author on home page', function () {
    $author1 = Author::factory()->create();
    $author2 = Author::factory()->create();

    $book1 = Book::factory()->create(['author_id' => $author1->id]);
    $book2 = Book::factory()->create(['author_id' => $author2->id]);

    $this->get(route('home', ['author_id' => $author1->id]))
        ->assertSee($book1->title)
        ->assertDontSee($book2->title);
});
