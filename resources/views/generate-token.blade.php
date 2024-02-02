@extends('users.layouts.main')
@section('title', 'Contact- Gio-Natural')
@section('content')
<h1>Generate Token</h1>
@include('flash')
<div>
    <form action="{{ url('/generate-token') }}" method="GET">
        @csrf
        <button type="submit">Generate Token</button>
    </form>

    @isset($tokenResponse)
        <p>Status Code: {{ $tokenResponse['status_code'] }}</p>
        <p>Status: {{ $tokenResponse['status'] }}</p>
        <p>Message: {{ $tokenResponse['message'] }}</p>
        <p>Token: {{ $tokenResponse['token'] }}</p>
    @endisset
</div>
@endsection