<x-app-layout>
    <div class="container mx-auto">


        <div class="my-5 text-center text-3xl">Product Controll</div>
        <div class="text-end"><button type="button"
                class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                <a href="{{ route('product.create') }}">+ Add</a>
            </button>
        </div>
        @include('flash')
        <div class="my-4 text-center">
            {{ $products->onEachSide(1)->links() }}
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->title }}
                            </th>
                            <td class="px-6 py-4">
                                <img class="rounded-full w-16 h-16" src="{{ asset('storage/' . $item->thumbnail) }}"
                                    alt="image description">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->category->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->stock }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->price }}
                            </td>
                            <td class="px-6 py-4 flex">

                                <a href="{{ url('product/' . $item->id . '/edit') }}"
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Edit</a>
                                <form method="POST" action="{{ route('product.destroy', $item->id) }}" id="deleteform">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)"
                                        onclick="event.preventDefault(); if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();"
                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-4">
                {{ $products->onEachSide(1)->links('pagination.custom') }}



            </div>

        </div>
    </div>
</x-app-layout>