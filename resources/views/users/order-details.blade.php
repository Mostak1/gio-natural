@extends('users.layouts.main')
@section('styles')
    <style>
        .order-message {
            padding: 15px;
            font-size: 25px;
            color: #F28123;
            border: 2px solid #F28123;
            text-align: center;
            font-weight: 600;
            border-radius: 15px;
            border-style: dashed;
        }
    </style>
@endsection
@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Find Your Order And Details</p>
                        <h1>Your Order Details</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="order-message">
            Thank You, Your order has been received.
        </div>
        <div class="row row-cols-4 my-5">
            <div class="col text-center border-end">
                <div class="">Order number:</div>
                <div class=""><strong>{{ $item->invoice_number }}</strong></div>
            </div>
            <div class="col text-center border-end">
                <div class="">Date:</div>
                <div class=""><strong>{{ $item->created_at->format('F d, Y') }}</strong></div>
            </div>
            <div class="col text-center border-end">
                <div class="">Total:</div>
                <div class=""><strong>{{ $item->subtotal }}</strong></div>
            </div>
            <div class="col text-center">
                <div class="">Payment Method:</div>
                <div class="">
                    <strong>
                        @if ($item->pay_method == 1)
                            Cash On Delivery
                        @elseif($item->pay_method == 2)
                            bKash
                        @elseif($item->pay_method == 3)
                            Nagod
                        @elseif($item->pay_method == 4)
                            Rocket
                        @elseif($item->pay_method == 5)
                            Card
                        @endif
                    </strong>
                </div>
            </div>
        </div>
        <div class="my-4 fs-1 fw-bold">ORDER DETAILS</div>
        <div class="row row-cols-3 border-bottom fs-5">
            <div class="col "><strong>PRODUCT</strong></div>
            <div class="col "><strong>QTY</strong></div>
            <div class="col text-end"><strong>TOTAL</strong></div>
        </div>
        @foreach ($details as $item)
            <div class="row row-cols-3 border-bottom fs-5">
                <div class="col">{{$item->product->title}}</div>
                <div class="col">{{$item->quantity}}</div>
                <div class="col text-end">{{$item->item_total}}</div>
            </div>
        @endforeach
       

    </div>
@endsection
@section('scripts')
@endsection
