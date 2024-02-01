@extends('users.layouts.main')
@section('title', 'Cart- Gio-Natural')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

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
                                <hr class="border border-danger border-2 opacity-50">
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

                    <div class="coupon-section">
                        <h3>Apply Coupon</h3>
                        <div class="coupon-form-wrap">
                            <form action="">
                                <p><input type="text" placeholder="Coupon"></p>
                                <p><input type="submit" value="Apply"></p>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">

                    <div class="card-header">

                        <div class="">Customer Information</div>
                    </div>
                    <div class="card-body">
                        <div class="billing-address-form">
                            <form action="">
                                <p><input id="billname" type="text" placeholder="Name"></p>
                                <p><input id="billemail" type="email" placeholder="Email"></p>
                                <p><input id="billBaddress" type="text" placeholder="Billing Address"></p>
                                <p><input id="billSaddress" type="text" placeholder="Shipping Address"></p>
                                <p><input id="billphone" type="tel" placeholder="Phone"></p>
                                <p>
                                    <textarea name="billmessage" id="billmessage" cols="30" rows="10" placeholder="Say Something"></textarea>
                                </p>
                            </form>
                        </div>
                    </div>
                    <a class="boxed-btn" id="placeOrder">Place Order</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->

@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            $('#placeOrder').click(function() {
                // Collect customer information
                var billname = $('#billname').val();
                var billemail = $('#billemail').val();
                var billBaddress = $('#billBaddress').val();
                var billSaddress = $('#billSaddress').val();
                var billphone = $('#billphone').val();
                var billmessage = $('#billmessage').val();

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
                var subtotal = parseFloat($('#totalAmount').text());

                // Additional details like shipping can be added as needed

                // Prepare data to send to the server
                var orderData = {
                    customer: {
                        name: billname,
                        email: billemail,
                        billingAddress: billBaddress,
                        shippingAddress: billSaddress,
                        phone: billphone,
                        message: billmessage
                    },
                    cartDetails: cartDetails,
                    subtotal: subtotal
                    // Add more fields as needed
                };

                // Send data to the server using AJAX
                $.ajax({
                    url: "{{ url('place-order') }}", // Replace with your actual route
                    method: 'POST',
                    data: orderData,
                    success: function(response) {
                        // Handle success (e.g., show a success message)
                        console.log(response);
                    },
                    error: function(error) {
                        // Handle error (e.g., show an error message)
                        console.error('Error placing order:', error);
                    }
                });
            });
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
                            '<td class="product-name">' + product.title + '</td>' +
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
                $('#totalAmount').text(total.toFixed(2));
                $('#subTotal').text(subtotal.toFixed(2));
            }
        });
    </script>
@endsection
