<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-md shadow-md">
        <div class="flex justify-between">
            <h2 class="text-2xl font-semibold mb-6">Edit Category</h2>
            <button type="button"
                class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-large rounded-lg text-xl px-5 py-1.5 text-center me-2 mb-2">
                <a href="{{ route('category.index') }}"><-- Back</a>
            </button>
        </div>
        @include('flash')
        <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 mb-4 md:grid-cols-2">


                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ old('name',$category->name) }}" required>
                </div>


                <div class="">
                    <label for="active" class="block text-sm font-medium text-gray-600">Active</label>
                    <select name="active" id="active" class="mt-1 p-2 w-full border rounded-md" required>
                        <option value="0" {{ $category->active == 0 ? 'selected' : '' }}>Deactive</option>
                        <option value="1" {{ $category->active == 1 ? 'selected' : '' }}>Active</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update
                    Category</button>
            </div>
        </form>
    </div>
</x-app-layout>
