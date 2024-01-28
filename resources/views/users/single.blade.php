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
                           
                                <input type="number" name="quantity" placeholder="0">
                                <a type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                           
                            <p><strong>Categories: </strong>{{ $product->category->name }}</p>
                        </div>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
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