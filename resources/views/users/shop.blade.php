@extends('users.layouts.main')
@section('title', 'Shop-Gio-Natural')

@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="product-section mt-150 mb-150">

        <div class="container">
            {{-- <div id="product-list" class="row product-lists"></div> --}}

            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                         <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $category)

                            <li data-filter=".cat{{ $category->id }}">{{ $category->name }}</li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> --}}

            <div class="">
                <div class="text-center fs-1 fw-bold">All Products</div>
                <div class="row" id="productContainer">

                </div>

            </div>
            <div class="my-4">

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap" id="awcPagination">
                        <ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->

@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            var data;
            var itemsPerPage = 9;
            $.getJSON("{{ url('productjson') }}", function(jsonData) {
                data = jsonData; // Assign jsonData to the outer data variable
                // Display the first page
                displayPage(1);
            });

            function displayPage(pageNumber) {
                console.log("Displaying page", pageNumber);
                // var itemsPerPage = 10; // Set the number of items per page
                var startIndex = (pageNumber - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;

                var pageData = data.products.slice(startIndex, endIndex);

                // Display products on the page
                $('#productContainer').empty();
                console.log(pageData);
                $.each(pageData, function(index, product) {
                    var productHtml = '<div class="col-lg-4 col-md-6 text-center cat'+ product.category_id +' ">' +
                        '<div class="single-product-item">' +
                        '<div class="product-image">' +
                        '<a href="{{ url('product') }}/' + product.id +
                        '"><img src="{{ asset('storage/') }}/' +
                        product.thumbnail + '" alt=""></a>' +
                        '</div>' +
                        '<a href="{{ url('product') }}/' + product.id + '"><h3 class="text-truncate">' +
                        product.title + '</h3></a>' +
                        '<p class="product-price"><span>Per Kg</span> ' + product.price + ' TK </p>' +
                        '<a href="" class="cart-btn" data-id="' + product.id +
                        '"><i class="fas fa-shopping-cart"></i> Add to Cart</a>' +
                        '</div>' +
                        '</div>';

                    $('#productContainer').append(productHtml);
                });

                // Display pagination links
                displayPagination(pageNumber, Math.ceil(data.products.length / itemsPerPage));
            }

            function displayPagination(currentPage, totalPages) {
                var paginationWrap = $('#awcPagination ul');
                paginationWrap.empty();

                // Add "Prev" link
                paginationWrap.append('<li><a href="#" id="prev">Prev</a></li>');

                // Add numeric page links
                for (var i = 1; i <= totalPages; i++) {
                    var activeClass = (i === currentPage) ? 'active' : '';
                    paginationWrap.append('<li><a class="page ' + activeClass + '" href="#" data-pageid="' + i +
                        '">' + i + '</a></li>');
                }

                // Add "Next" link
                paginationWrap.append('<li><a href="#" id="next">Next</a></li>');
            }

            // Event delegation for dynamically created elements
            $('#awcPagination').on('click', '.page', function() {
                var pageNumber = $(this).data('pageid');
                displayPage(pageNumber);
            });

            // Event handling for "Prev" and "Next" links
            $('#awcPagination').on('click', '#prev', function() {
                var currentPage = parseInt($('#awcPagination .active').text());
                if (currentPage > 1) {
                    displayPage(currentPage - 1);
                }
            });

            $('#awcPagination').on('click', '#next', function() {
                var currentPage = parseInt($('#awcPagination .active').text());
                var totalPages = parseInt($('#awcPagination .page').last().data('pageid'));
                if (currentPage < totalPages) {
                    displayPage(currentPage + 1);
                }
            });
            // Product Add to cart....
            $('#productContainer').on('click', '.cart-btn', function(event) {
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


        //     // projects filters isotop
        //     $(".product-filters li").on('click', function () {

        //     $(".product-filters li").removeClass("active");
        //     $(this).addClass("active");

        //     var selector = $(this).attr('data-filter');

        //     $(".product-lists").isotope({
        //         filter: selector,
        //     });

        // });

        // // isotop inner
        // $(".product-lists").isotope();

    </script>




@endsection
