@extends('layouts.app')
@section('header')

@endsection
@section('content')
    

    <div class="container mx-auto">


        <div class="my-5 text-center text-3xl">Product Order Controll</div>
        <div class="text-end">
            {{-- <button type="button"
            class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            <a href="{{ route('order.create') }}">+ Add</a>
        </button> --}}
    </div>
    @include('flash')
    <div class="my-4 text-center">
        {{-- {{ $categories->onEachSide(1)->links() }} --}}
    </div>
        <div class="relative overflow-x-auto shadow-xl sm:rounded-xl ">
            <table id="dataTable" class="w-full text-sm text-left rtl:text-right text-teal-500 dark:text-teal-400 my-10">
                <thead class="text-xs text-gray-700 uppercase bg-teal-50 dark:bg-teal-200 dark:text-teal-400">
                    <tr>
                        <th colspan="12" class="tablebtn"></th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3">
                             Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                             Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            customer_email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            billing_address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            shipping_address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            message
                        </th>
                        <th scope="col" class="px-6 py-3">
                            invoice_number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            subtotal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            trx_id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Modified By
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->created_at->format('dM g:ia') }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->customer_name }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->customer_email }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->billing_address }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->shipping_address }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->phone }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->message }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->invoice_number }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->subtotal }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->trx_id }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->status }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->modified_by }}
                            </th>
                            

                            <td class="px-6 py-4 flex">
                                <a href="{{ url('order/' . $item->id . '/edit') }}"
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Edit</a>
                                <a href="{{ url('order/' . $item->id) }}" title="See Order Details"
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Details</a>
                                <form method="POST" action="{{ route('order.destroy', $item->id) }}" id="deleteform">
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
            
        </div>
        <div class="my-8">
            {{-- {{ $categories->onEachSide(1)->links() }} --}}
        </div>
    </div>
@endsection
@section('footer')


@endsection
