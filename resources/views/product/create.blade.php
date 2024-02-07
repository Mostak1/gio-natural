@extends('layouts.app')
@section('content')
    

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-md shadow-md">
        <div class="flex justify-between">
            <h2 class="text-2xl font-semibold mb-6">Add Product</h2>
            <button type="button"
                class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-large rounded-lg text-xl px-5 py-1.5 text-center me-2 mb-2">
                <a href="{{ route('product.index') }}"><-- Back</a>
            </button>
        </div>
        @include('flash')
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 md:grid-cols-2">


                <div class="">
                    <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ old('title') }}" required>
                </div>
                <div class="">
                    <label for="price" class="block text-sm font-medium text-gray-600">Product Price</label>
                    <input type="text" name="price" id="price" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ old('price') }}" required>
                </div>
                <div class="">
                    <label for="stock" class="block text-sm font-medium text-gray-600">Initial Stock</label>
                    <input type="text" name="stock" id="stock" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ old('stock') }}" required>
                </div>
                <div class="">
                    <label for="weight" class="block text-sm font-medium text-gray-600">Weight</label>
                    <input type="text" name="weight" id="weight" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ old('weight') }}" required>
                </div>
                <div class="">
                    <label for="unit" class="block text-sm font-medium text-gray-600">Unit</label>
                    <input type="text" name="unit" id="unit" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ old('unit') }}" required>
                </div>
                <div class="">
                    <label for="category_id" class="block text-sm font-medium text-gray-600">Category</label>
                    <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-md" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                {{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-4">

                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Description</label>
                <textarea id="description" name="description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write description here..."></textarea>
            </div>


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
@endsection
