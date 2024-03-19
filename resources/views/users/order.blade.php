@extends('users.layouts.main')
@section('content')
    <!-- breadcrumb-section -->
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
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Have you any Order? If You Have Please, Check</h2>

                    </div>


                    <div class="contact-form">
                        {{-- <form type="POST"  onSubmit="return valid_datas( this );"> --}}
                        <form method="" id="GIO Naturals-contact">
                            <p>
                                <input type="tel" placeholder="Phone" value="{{ old('phone') }}" name="phone"
                                    id="phone">
                                <input type="submit" id="checkOrder" value="Check Order">
                            </p>
                            {{-- <input type="hidden" name="token" value="FsWga4&@f6aw" /> --}}
                        </form>
                    </div>
                    <div id="form_status"></div>

                </div>
                <div class="col-lg-4">
                    <div class="contact-form-wrap">
                        <div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> Shop Address</h4>
                            <p>Islam Tower,2nd Floor,Dhanmondi-32<br> Dhaka-1206 <br> Bangladesh</p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> Shop Hours</h4>
                            <p>Everyday: 10am to 8pm </p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> Contact</h4>
                            <p>Phone: +8809666-747470 <br> Email: gionatural@gmail.com </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var orderData;
            $('#checkOrder').click(function(e) {
                e.preventDefault();
                $('#form_status').empty();
                var phone = $('#phone').val();
                if (phone == '') {
                    alert('Please Enter Your Phone Number');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('orderjson') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "phone": phone
                    },
                    success: function(data) {
                        console.log(data);
                        orderData = data;
                        var order = '';
                        $.each(data, function(index, item) {
                            order += `
                        <div class="card my-2">
                        <div class="card-body">
                        <h5 class="card-title">Invoice Number: ${item.invoice_number} and Id ${item.id}</h5>
                        <div class="card-subtitle mb-2 text-body-secondary row row-cols-2">
                            <div class="col text-warning-emphasis">Status: ${item.status}</div>
                            <div class="col">Total Payment: ${item.subtotal}</div>
                            </div>
                            <a href="{{url('orderDetails/3')}}" class="cart-btn">Order Details</a>

                        <hr/>`;
                            // Assuming orderDetails is available and contains product details
                            var orderDetails = item.order_details;

                            $.each(orderDetails, function(index1, itemD) {
                                order += `
                         <div class="card-text">
                        Product Name: ${itemD.product.title} <br>
                        Quantity: ${itemD.quantity}
                        <hr/> </div>
                                 `;
                            });
                            order += `
                                     </div>
                                    </div>
                                             `;
                        });
                        $('#form_status').append(order);
                    }
                });

            });
            console.log(orderData);
        });
    </script>
@endsection
