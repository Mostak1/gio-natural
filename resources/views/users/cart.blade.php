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
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
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
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Subtotal: </strong></td>
									<td>$500</td>
								</tr>
								<tr class="total-data">
									<td><strong>Shipping: </strong></td>
									<td>$45</td>
								</tr>
								<tr class="total-data">
									<td><strong>Total: </strong></td>
									<td>$545</td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							<a href="{{url('cart')}}" class="boxed-btn">Update Cart</a>
							<a href="checkout.html" class="boxed-btn black">Check Out</a>
						</div>
					</div>

					<div class="coupon-section">
						<h3>Apply Coupon</h3>
						<div class="coupon-form-wrap">
							<form action="index.html">
								<p><input type="text" placeholder="Coupon"></p>
								<p><input type="submit" value="Apply"></p>
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
    <!-- ... (previous script code) ... -->

    <script>
        $(document).ready(function() {
            // Retrieve the cart data from the session
            var cart = JSON.parse(sessionStorage.getItem('cart')) || [];

            // Display cart items
            displayCartItems(cart);

            function displayCartItems(cart) {
                var cartTableBody = $('#cartTableBody');
                cartTableBody.empty();

                // Loop through the cart items
                $.each(cart, function(index, productId) {
                    // Assuming you have a JavaScript function to retrieve product details by ID
                    var product = getProductDetails(productId);

                    // Display the product in the cart table
                    var cartItemHtml = '<tr>' +
                        '<td class="product-remove"><button class="remove-item" data-id="' + productId + '">Remove</button></td>' +
                        '<td class="product-image"><img src="{{ asset('storage/') }}/' + product.thumbnail + '" alt="Product Image" height="50px"></td>' +
                        '<td class="product-name">' + product.title + '</td>' +
                        '<td class="product-price">' + product.price + ' TK</td>' +
                        '<td class="product-quantity"><input type="number" class="quantity-input" value="1" min="1"></td>' +
                        '<td class="product-total">' + product.price + ' TK</td>' +
                        '</tr>';

                    cartTableBody.append(cartItemHtml);
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

                    $(this).find('.product-total').text(itemTotal.toFixed(2) + ' TK');
                });

                // Update the total in your UI (replace '#totalAmount' with the actual selector)
                $('#totalAmount').text(total.toFixed(2) + ' TK');
            }

            // ... (remaining script code) ...
        });
    </script>
    @endsection