<x-layout>
    <!-- Hero Section -->
    <section class="bg-blue-900 text-white py-20 text-center">
        <h1 class="text-4xl font-bold">Welcome to Readers</h1>
        <p class="text-xl mt-2">Explore a world of books, reviews, and more!</p>
    </section>

    <!-- Book Collection Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Search Bar -->
            <section class="py-4 bg-gray-100">
                <div class="max-w-7xl mx-auto px-6 flex justify-center">
                    <form method="GET" action="{{ route('home') }}" class="flex items-center space-x-4">
                        <select name="author_id" class="select2 w-72 p-2 border border-gray-300 rounded">
                            <option value="">All Authors</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
                    </form>
                </div>
            </section>

            <h2 class="text-3xl font-semibold text-gray-900 mb-8">Our Collection</h2>

            <!-- Book Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($books as $book)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $book->title }}</h3>
                            <p class="text-lg font-bold text-green-600 mt-2">${{ number_format($book->price, 2) }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800">Read more</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} Readers. All Rights Reserved.</p>
        </div>
    </footer>
</x-layout>
