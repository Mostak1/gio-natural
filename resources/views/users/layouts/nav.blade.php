<!--PreLoader-->
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
<!--PreLoader Ends-->

<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="{{ url('/') }}">
                            <img src="assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('shop') }}">Shop</a></li>
                            <li><a href="{{ url('about') }}">About</a></li>
                            <li><a href="{{ url('contact') }}">Contact</a></li>
                            <li><a href="{{ url('cart') }}">Cart</a></li>
                            <li><a href="{{ url('userOrder') }}">Order Check</a></li>
                            <li><a href="{{ url('news') }}">News</a></li>

                            <li>
                                <div class="header-icons">
                                    <a class="shopping-cart position-relative" href="{{ url('cart') }}">
                                        <i class="fas fa-shopping-cart"></i>

                                        <span id="totalCart"
                                            class="totalCart position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">

                                        </span>
                                    </a>
                                    <a class="shopping-cart" href="tel:09666-747470">09666-747470</a>

                                    {{-- <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a> --}}
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="{{ url('cart') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span id=""
                            class="totalCart position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">

                        </span>
                    </a>
                    <div class="mobile-menu"></div>

                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mBtnCon container">
    <div class="mobileButton mx-auto">
        <a href="tel:09666-747470">
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script><dotlottie-player
                src="https://lottie.host/54f067e1-3bb2-4d68-b6d6-22da9ee77fcf/HTK7huocy2.lottie" background
                speed="1" style="width: 100px; height: 100px" direction="1" playMode="normal" loop
                autoplay></dotlottie-player>
        </a>
    </div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>Search For:</h3>
                        <input type="text" placeholder="Keywords">
                        <button type="submit">Search <i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->
