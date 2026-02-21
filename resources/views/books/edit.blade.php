<x-layout>
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-gray-900 mb-8">Edit Book</h2>

            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-gray-700">Book Title</label>
                        <input type="text" name="title" id="title" value="{{ $book->title }}" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>{{ $book->description }}</textarea>
                    </div>

                    <div>
                        <label for="author_id" class="block text-gray-700">Author</label>
                        <select name="author_id" id="author_id" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="year" class="block text-gray-700">Year of Publication</label>
                        <input type="number" name="year" id="year" value="{{ $book->year }}" class="w-full mt-2 p-3 border border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label for="price" class="block text-gray-700">Price ($)</label>
                        <input type="number" name="price" id="price" value="{{ $book->price }}" class="w-full mt-2 p-3 border border-gray-300 rounded-md" step="0.01">
                    </div>

                    <div>
                        <label for="cover_image" class="block text-gray-700">Cover Image</label>
                        <input type="file" name="cover_image" id="cover_image" class="w-full mt-2 p-3 border border-gray-300 rounded-md">
                        @if ($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" alt="Cover Image" class="mt-4 w-48 rounded-lg shadow">
                        @endif
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-gray-800 text-white p-4 rounded-md shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                            Update Book
                        </button>


                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layout>
