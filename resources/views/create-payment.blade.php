@extends('users.layouts.main')
@section('title', 'Contact- Gio-Natural')
@section('content')
<h1>Create Payment</h1>
@include('flash')
<div>
    <form action="{{ url('/create-payment') }}" method="POST">
        @csrf
        <label for="invoice_number">Invoice Number:</label>
        <input type="text" id="invoice_number" name="invoice_number" required><br>

        <!-- Add other input fields as needed -->

        <button type="submit">Create Payment</button>
    </form>

    @isset($paymentResponse)
        <p>Status Code: {{ $paymentResponse['status_code'] }}</p>
        <p>Status: {{ $paymentResponse['status'] }}</p>
        <p>Message: {{ $paymentResponse['message'] }}</p>
        <p>Payment URL: {{ $paymentResponse['payment_url'] }}</p>
    @endisset
</div>
@endsection