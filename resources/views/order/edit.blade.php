@extends('layouts.app')
@section('content')
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-md shadow-md">
        <div class="flex justify-between">
            <h2 class="text-2xl font-semibold mb-6">Edit Order Of {{$order->customer_name}}</h2>
            <button type="button"
                class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-large rounded-lg text-xl px-5 py-1.5 text-center me-2 mb-2">
                <a href="{{ route('order.index') }}"><-- Back</a>
            </button>
        </div>
        @include('flash')
        <form action="{{ route('order.update',$order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 mb-4 md:grid-cols-2">
                <div class="">
                    <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                    <select name="status" id="status" class="mt-1 p-2 w-full border rounded-md" required>
                        <option value="Not Pay" {{ $order->status == 'Not Pay' ? 'selected' : '' }}>Not Pay</option>
                        <option value="Received" {{ $order->status == 'Received' ? 'selected' : '' }}>Received</option>
                        <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="On the Way" {{ $order->status == 'On the Way' ? 'selected' : '' }}>On the Way</option>
                        <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update
                    Order</button>
            </div>
        </form>
    </div>
@endsection
