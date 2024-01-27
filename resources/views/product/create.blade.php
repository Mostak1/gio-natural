<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Add Product</h2>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
                <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md"
                    value="{{ old('title') }}" required>
            </div>

            <!-- Repeat similar blocks for other fields -->

            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-600">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="mt-1 p-2 w-full border rounded-md"
                    accept="image/*" required>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add
                    Product</button>
            </div>
        </form>
    </div>
</x-app-layout>
