@extends('users.layouts.main')
@section('title', 'Single-Page')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>See more Details</p>
                        <h1>Single Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->title }}">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{ $product->title }}</h3>
                        <p class="single-product-pricing"><span>Per Kg</span> {{ $product->price }} TK</p>
                        <p>{{ $product->description }}</p>
                        <div class="single-product-form">

                            {{-- <input type="number" name="quantity" placeholder="0"> --}}
                            <a type="submit" data-id="{{$product->id}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                            <a type="submit" data-id="{{$product->id}}" class="cart-btn buy-btn"><i class="fas fa-shopping-bag"></i> Buy Now</a>

                            <p><strong>Categories: </strong>{{ $product->category->name }}</p>
                        </div>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end single product -->

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Product Add to cart....
            // $('#productContainer').on('click', '.cart-btn', function(event) {
            $('.cart-btn').click(function(event) {
                event.preventDefault();
                var productId = $(this).data('id');

                // Check if 'cart' key exists in session, if not, initialize it as an empty array
                var cart = JSON.parse(sessionStorage.getItem('cart')) || [];

                if (cart.includes(productId)) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Oops...',
                        text: 'This product is already in your cart!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000 // 3 seconds

                    });
                    console.log('This product is already in your cart!');
                } else {
                    // Add the product ID to the cart array
                    cart.push(productId);

                    // Save the updated cart array to the session
                    sessionStorage.setItem('cart', JSON.stringify(cart));

                    // Provide user feedback
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Product added to cart!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000 // 3 seconds

                    });
                    updateCartItemCount();
                }
            });
            function updateCartItemCount() {
                var cartItemCount = JSON.parse(sessionStorage.getItem('cart')).length;
                $('#totalCart').text(cartItemCount);
				console.log('cartItemCount');
            }
        });
    </script>
@endsection
