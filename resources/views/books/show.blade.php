<x-layout>
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-6 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-auto rounded-lg shadow-md">
                </div>

                <div class="md:w-2/3 md:pl-8">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $book->title }}</h1>
                    <p class="text-gray-700 mt-4">{{ $book->description }}</p>

                    <div class="mt-4">
                        <p class="text-lg text-gray-800"><strong>Author:</strong> {{ $book->author->name }}</p>
                        <p class="text-lg text-gray-800"><strong>Year:</strong> {{ $book->year }}</p>
                        <p class="text-lg text-gray-800"><strong>Price:</strong> ${{ $book->price }}</p>
                        <p class="text-lg text-gray-800"><strong>Seller:</strong> {{ $book->user->name }}</p>
                    </div>

                    @auth
                        @if (auth()->id() === $book->user_id)
                            <div class="mt-6 flex space-x-4">
                                <a href="{{ $book->id.'/edit' }}" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700">
                                    Edit
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md shadow hover:bg-red-800">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="mt-8 p-6 bg-gray-100 rounded-lg">
                <h3 class="text-2xl font-semibold text-gray-900">Contact Seller</h3>
                <p class="text-gray-700 mt-2">If you're interested in purchasing this book, contact the seller:</p>
                <p class="text-lg text-gray-800 mt-2"><strong>Email:</strong> {{ $book->user->email }}</p>
            </div>
        </div>
    </section>
</x-layout>
