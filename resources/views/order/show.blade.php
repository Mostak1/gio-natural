@extends('layouts.app')
@section('header')
@endsection
@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 my-10">
        <div class="flex flex-col md:flex-row">
            <!-- First Column -->
            <div class="md:w-1/2 px-4">
                <h2 class="text-xl font-semibold mb-4">Order Information</h2>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Customer Name:</label>
                    <p class="text-gray-900">{{ $order->customer_name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Customer Email:</label>
                    <p class="text-gray-900">{{ $order->customer_email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Billing Address:</label>
                    <p class="text-gray-900">{{ $order->billing_address }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Shipping Address:</label>
                    <p class="text-gray-900">{{ $order->shipping_address }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                    <p class="text-gray-900">{{ $order->phone }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Message:</label>
                    <p class="text-gray-900">{{ $order->message }}</p>
                </div>
            </div>

            <!-- Second Column -->
            <div class="md:w-1/2 px-4">
                <h2 class="text-xl font-semibold mb-4">Invoice Information</h2>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Invoice Number:</label>
                    <p class="text-gray-900">{{ $order->invoice_number }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Subtotal:</label>
                    <p class="text-gray-900">{{ $order->subtotal }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Transaction ID:</label>
                    <p class="text-gray-900">{{ $order->trx_id }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Modified By:</label>
                    <p class="text-gray-900">{{ $order->modified_by }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                    <p class="text-gray-900">{{ $order->status }}</p>
                </div>
            </div>
        </div>
        <div class="my-3">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="dataTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th colspan="4" class="tablebtn"></th>
                        </tr>
                        
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderProducts as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->product->title}} - ({{ $item->product->weight}}{{$item->product->unit}} )
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->product->price}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->quantity}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->item_total}}TK
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>



    </div>
@endsection
@section('footer')
@endsection
