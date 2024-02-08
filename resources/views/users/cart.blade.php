@extends('users.layouts.main')
@section('title', 'Cart- Gio-Natural')
@section('styles')
    <style>
        /* Define your custom styles here */
        .colorful-popup {
            background-color: #3498db;
            color: #ffffff;
        }

        .colorful-header {
            background-color: #2980b9;
            color: #ffffff;
        }

        .colorful-title {
            color: #4b2121;
        }

        .colorful-close-button {
            color: #ffffff;
        }

        .colorful-icon {
            color: #ffffff;
        }

        .colorful-content {
            color: #ffffff;
        }

        .colorful-confirm-button {
            background-color: #27ae60;
            color: #ffffff;
        }

        .colorful-footer {
            background-color: #3498db;
            color: #ffffff;
        }

        .awc-ci {
            background-color: #EFEFEF;
            padding: 15px 10px;
        }

        button.boxed-btn {
            font-family: 'Poppins', sans-serif;
            display: inline-block;
            border: 0px;
            border-radius: 20px;
            background-color: #F28123;
            color: #fff;
            padding: 10px 20px;
        }

        button.boxed-btn {
            -webkit-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }

        button.boxed-btn:hover {
            background-color: #051922;
            color: #F28123;
        }
    </style>
@endsection
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Cart</h1>
                        {{-- <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <button style="padding: 10px 20px; margin: 10px; border: 1px solid black;">Pay Now</button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    @include('flash');
    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove">Action</th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody id="cartTableBody">
                                <!-- Cart items will be displayed here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <hr class="border-danger border-2 opacity-50">
                                {{-- <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr> --}}
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Subtotal: </strong></td>
                                    <td><span id="totalAmount"></span><span> TK</span></td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Shipping: </strong></td>
                                    <td><span id="shippingCost"></span>80<span></span></td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td><span id="subTotal"></span><span> TK</span></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div class="cart-buttons">
                            <a href="{{ url('cart') }}" class="boxed-btn">Update Cart</a>
                            <a href="checkout.html" class="boxed-btn black">Check Out</a>
                        </div> --}}
                    </div>

                    {{-- <div class="coupon-section">
                        <h3>Apply Coupon</h3>
                        <div class="coupon-form-wrap">
                            <form action="">
                                <p><input type="text" placeholder="Coupon"></p>
                                <p><input type="submit" value="Apply"></p>
                            </form>
                        </div>
                    </div> --}}
                </div>

                <div class="col-lg-5">

                    <div class="card-header">

                        <div class="awc-ci">Customer Information</div>
                    </div>
                    <div class="card-body">
                        <div class="billing-address-form">
                            <form id="placeOrder" action="{{ route('checkout') }}" method="post">
                                {{-- {{ route('checkout') }} --}}
                                @csrf
                                <p><input name="customer_name" class="form-control" id="billname" type="text"
                                        placeholder="Name"></p>
                                <p><input name="customer_email" class="form-control" id="billemail" type="email"
                                        placeholder="Email"></p>
                                <p><input name="billing_address" class="form-control" id="billBaddress" type="text"
                                        placeholder="Billing Address"></p>
                                <p><input name="shipping_address" class="form-control" id="billSaddress" type="text"
                                        placeholder="Shipping Address"></p>
                                <p><input name="phone" class="form-control" id="billphone" type="tel"
                                        placeholder="Phone"></p>
                                <p>
                                    <textarea class="form-control" name="message" id="billmessage" cols="30" rows="10"
                                        placeholder="Say Something"></textarea>
                                </p>
                                <input type="text" name="invoice_number" id="invoice_number" hidden>
                                <input type="text" name="total" id="subTotalInput" hidden>
                                <button type="submit" class="boxed-btn"> Place
                                    Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->

@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#placeOrder').submit(function(e) {
                e.preventDefault();
                // Validate Name field
                var isNameValid = validateField($('#billname'), 'Name is required');

                // Validate Email field
                var isEmailValid = validateField($('#billemail'), 'Invalid email format',
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/);

                // Validate Billing Address field
                var isBAddressValid = validateField($('#billBaddress'), 'Address is required');

                // Validate Shipping Address field
                var isSAddressValid = validateField($('#billSaddress'), 'Address is required');

                // Validate Phone field
                var isPhoneValid = validateField($('#billphone'),
                    'The phone number must start with 01 and have a length of 11 characters.',
                    /^01\d{9}$/);



                // Collect customer information
                var billname = $('#billname').val();
                var billemail = $('#billemail').val();
                var billBaddress = $('#billBaddress').val();
                var billSaddress = $('#billSaddress').val();
                var billphone = $('#billphone').val();
                var billmessage = $('#billmessage').val();
                var invoice_number = $('#invoice_number').val();
                // Validate if any field is empty
                // Check if any field is empty or has validation errors
                console.log(isEmailValid);
                if (!isNameValid || !isEmailValid || !isBAddressValid || !isSAddressValid || !
                    isPhoneValid) {

                    Swal.fire({
                        // icon: 'error',
                        title: 'Error Placing Order',
                        text: 'Please fill in all required fields',
                        confirmButtonText: 'OK',
                        // imageUrl: 'https://image.shutterstock.com/z/stock-vector--exclamation-mark-exclamation-mark-hazard-warning-symbol-flat-design-style-vector-eps-444778462.jpg',
                        imageUrl: "{{ asset('alert/close.png') }}",
                        imageWidth: 100,
                        imageHeight: 100,
                        background: "#fff asset('alert/close.png')",
                        // background: '#fff url(https://image.shutterstock.com/z/stock-vector--exclamation-mark-exclamation-mark-hazard-warning-symbol-flat-design-style-vector-eps-444778462.jpg)',
                        customClass: {
                            popup: 'colorful-popup',
                            header: 'colorful-header',
                            title: 'colorful-title',
                            closeButton: 'colorful-close-button',
                            icon: 'colorful-icon',
                            content: 'colorful-content',
                            confirmButton: 'colorful-confirm-button',
                            footer: 'colorful-footer'
                        }
                    });
                    return;
                }

                // Collect cart details
                var cartDetails = [];
                $('#cartTableBody tr').each(function() {
                    var productId = $(this).find('.remove-item').data('id');
                    var quantity = parseInt($(this).find('.quantity-input').val());
                    var itemTotal = parseFloat($(this).find('.product-total').text());

                    cartDetails.push({
                        productId: productId,
                        quantity: quantity,
                        itemTotal: itemTotal
                    });
                });

                // Calculate subtotal
                var subtotal = parseFloat($('#subTotal').text());

                // Prepare data to send to the server
                var orderData = {
                    _token: '{{ csrf_token() }}',
                    customer_name: billname,
                    customer_email: billemail,
                    billing_address: billBaddress,
                    shipping_address: billSaddress,
                    phone: billphone,
                    message: billmessage,
                    cartDetails: cartDetails,
                    subtotal: subtotal,
                    invoice_number: invoice_number
                };
                console.log(orderData.cartDetails.length);
                if (orderData.cartDetails.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'No cart Product available',
                        text: 'Please Add Product To Cart First',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'colorful-popup',
                            header: 'colorful-header',
                            title: 'colorful-title',
                            closeButton: 'colorful-close-button',
                            icon: 'colorful-icon',
                            content: 'colorful-content',
                            confirmButton: 'colorful-confirm-button',
                            footer: 'colorful-footer'
                        }
                    });
                    return;
                }
                // Send data to the server using AJAX
                $.ajax({
                    url: "{{ route('place-order') }}",
                    method: 'POST',
                    data:  orderData, // Include your other data here
                    success: function(response) {
                        // Handle success with SweetAlert2
                        $('#placeOrder').unbind('submit').submit();
                            // Swal.fire({
                            //     icon: 'info',
                            //     title: 'Order Not Placed Successfully!',
                            //     text: ' ' + response,
                            //     confirmButtonText: 'OK'
                            // });
                        
                    },
                    error: function(xhr, status, error) {
                        // Handle error with SweetAlert2
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // If there are validation errors
                            var errorMessage = '';
                            $.each(xhr.responseJSON.errors, function(field, errors) {
                                errorMessage += errors[0] + '<br>';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Placing Order',
                                text: 'Please fix the following errors:',
                                html: errorMessage,
                                confirmButtonText: 'OK'
                            });
                            return;
                        } else {
                            // For general errors
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Placing Order',
                                text: 'Please try again later.' + error,
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                        return;
                    }
                });
                // $('#placeOrder').unbind('submit').submit();
            });

            // Function to validate a field
            function validateField(element, errorMessage, regex) {
                var value = element.val();
                if (regex && !regex.test(value) || !value.trim()) {
                    showValidationError(element, errorMessage);
                    return false;
                } else {
                    clearValidationError(element);
                    return true;
                }
            }

            // Function to show validation error
            function showValidationError(element, errorMessage) {
                element.css('border-color', 'red');
                // Create or update a span element to display the error message
                var errorSpan = element.next('.validation-error');
                if (!errorSpan.length) {
                    errorSpan = $('<span class="validation-error "></span>').css({
                        'font-size': '12px',
                        'color': 'red'
                    });
                    element.after(errorSpan);
                }
                errorSpan.text(errorMessage);
            }

            // Function to clear validation error
            function clearValidationError(element) {
                element.css('border-color', ''); // Reset border color
                // Remove the error message span
                element.next('.validation-error').remove();
            }

            var cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            var data;

            // Fetch product data using AJAX
            $.getJSON("{{ url('productjson') }}", function(jsonData) {
                data = jsonData.products; // Assuming 'products' is the key in your JSON data
                // Display the first page
                console.log(data);

                // Display cart items after fetching product data
                displayCartItems(cart);
            });

            function getProductDetails(productId) {
                // Find the product in the already fetched data
                var product = data.find(function(item) {
                    return item.id === productId;
                });

                return product;
            }

            function displayCartItems(cart) {
                var cartTableBody = $('#cartTableBody');
                cartTableBody.empty();

                // Loop through the cart items
                $.each(cart, function(index, productId) {
                    // Assuming you have a JavaScript function to retrieve product details by ID
                    var product = getProductDetails(productId);

                    // Check if product is found
                    if (product) {
                        // Display the product in the cart table
                        var cartItemHtml = '<tr>' +
                            '<td class="product-remove"><button class="btn btn-outline-danger remove-item" data-id="' +
                            productId +
                            '">Remove</button></td>' +
                            '<td class="product-image"><img src="{{ asset('storage/') }}/' + product
                            .thumbnail +
                            '" alt="Product Image" height="50px"></td>' +
                            '<td class="product-name">' + product.title + '('+product.weight + product.unit+')</td>' +
                            '<td class="product-price">' + product.price + ' TK</td>' +
                            '<td class="product-quantity"><input type="number" class="quantity-input" value="1" min="1"></td>' +
                            '<td class="product-total">' + product.price + ' TK</td>' +
                            '</tr>';

                        cartTableBody.append(cartItemHtml);
                    }
                });

                updateCartTotal();
            }

            // Event handling for removing an item from the cart
            $('#cartTableBody').on('click', '.remove-item', function() {
                var productId = $(this).data('id');
                removeItemFromCart(productId);
            });

            // Event handling for changing quantity
            $('#cartTableBody').on('change', '.quantity-input', function() {
                updateCartTotal();
            });

            function removeItemFromCart(productId) {
                // Remove the item from the cart array
                cart = cart.filter(function(item) {
                    return item !== productId;
                });

                // Update the session
                sessionStorage.setItem('cart', JSON.stringify(cart));

                // Update the displayed cart items
                displayCartItems(cart);
            }

            function updateCartTotal() {
                var total = 0;

                // Loop through the displayed items and update the total
                $('#cartTableBody tr').each(function() {
                    var price = parseFloat($(this).find('.product-price').text());
                    var quantity = parseInt($(this).find('.quantity-input').val());
                    var itemTotal = price * quantity;

                    total += itemTotal;
                    subtotal = 80 + total;

                    $(this).find('.product-total').text(itemTotal.toFixed(2) + ' TK');
                });
                // Update the total in your UI (replace '#totalAmount' with the actual selector)
                function generateReference() {
                    var now = new Date();
                    var day = now.getDate().toString().padStart(2, '0'); // Day of the month (01 to 31)
                    var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Month (01 to 12)
                    var year = now.getFullYear().toString(); // Year (e.g., 2024)
                    var hour = now.getHours().toString().padStart(2, '0'); // Hour (00 to 23)
                    var minute = now.getMinutes().toString().padStart(2, '0'); // Minute (00 to 59)
                    var second = now.getSeconds().toString().padStart(2, '0'); // Second (00 to 59)

                    var reference = 'GIO' + day + month + year + Math.floor(Math.random() * (999 - 111 + 1) + 111) +
                        hour + minute + second;

                    console.log(reference);
                    return reference;
                }
                var reference = generateReference();
                $('#totalAmount').text(total.toFixed(2));
                $('#subTotal').text(subtotal.toFixed(2));
                $('#subTotalInput').val(subtotal.toFixed(2));
                $('#invoice_number').val(reference);

            }
        });
    </script>
@endsection
