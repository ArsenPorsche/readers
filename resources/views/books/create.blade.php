<x-layout>
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-gray-900 mb-8">Add New Book</h2>

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-gray-700">Book Title</label>
                        <input type="text" name="title" id="title" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required></textarea>
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="author_id" class="block text-gray-700">Author</label>
                        <select name="author_id" id="author_id" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>
                            <option value="">Select Author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year -->
                    <div>
                        <label for="year" class="block text-gray-700">Year of Publication</label>
                        <input type="number" name="year" id="year" class="w-full mt-2 p-3 border border-gray-300 rounded-md" min="1000" max="{{ date('Y') }}">
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-gray-700">Price</label>
                        <input type="number" name="price" id="price" class="w-full mt-2 p-3 border border-gray-300 rounded-md" min="0" step="0.01">
                    </div>

                    <!-- Cover Image -->
                    <div>
                        <label for="cover_image" class="block text-gray-700">Cover Image</label>
                        <input type="file" name="cover_image" id="cover_image" class="w-full mt-2 p-3 border border-gray-300 rounded-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-gray-800 text-white p-4 rounded-md shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 w-full md:w-auto">
                            Add Book
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layout>
