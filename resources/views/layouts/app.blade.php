@php

    $cart = session('cart', []);
    $totalItems = 0;
    $subtotal = 0;

    // Calculer le nombre total d'articles et le sous-total
    foreach ($cart as $item) {
        $totalItems += $item['quantity'];
        $subtotal += $item['price'] * $item['quantity'];
    }

@endphp

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', config('app.name')) | {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="E-GALERIA" />
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}" />

    {{-- Meta --}}
    <meta name="theme-color" content="#888">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="E-GALERIA">
    <meta name="description"
        content="E-GALERIA est une plateforme e-commerce qui permet aux vendeurs de créer des boutiques en ligne et de vendre leurs produits facilement. Découvrez une expérience d'achat unique et sécurisée." />
    <meta name="keywords"
        content="E-GALERIA, boutique en ligne, e-commerce, vente en ligne, produits, vendeurs, acheteurs, shopping en ligne, marketplace, vente sécurisée, expérience d'achat" />
    <link rel="canonical" href="#">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="E-GALERIA - Votre boutique en ligne préférée" />
    <meta property="og:description"
        content="E-GALERIA est une plateforme e-commerce qui permet aux vendeurs de créer des boutiques en ligne et de vendre leurs produits facilement. Découvrez une expérience d'achat unique et sécurisée." />
    <meta property="og:image" content="{{ asset('assets/images/logo/logo.png') }}" />
    <meta property="og:url" content="#" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="1024" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('assets/images/logo/logo.png') }}">
    <meta name="twitter:title" content="E-GALERIA - Votre boutique en ligne préférée">
    <meta name="twitter:description"
        content="E-GALERIA est une plateforme e-commerce qui permet aux vendeurs de créer des boutiques en ligne et de vendre leurs produits facilement. Découvrez une expérience d'achat unique et sécurisée.">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>


<body class="sticky-header newsletter-popup-modal">

    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <!-- Start Header -->
    @include('partials.header')

    @yield('content')

    <!-- Start Footer Area  -->
    @include('partials.footer')
    <!-- End Footer Area  -->

    <!-- Header Search Modal End -->
    <div class="header-search-modal" id="header-search-modal">
        <button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
        <div class="header-search-wrap">
            <div class="card-header">
                <form action="#">
                    <div class="input-group">
                        <input type="search" class="form-control" name="prod-search" id="prod-search"
                            placeholder="Write Something....">
                        <button type="submit" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="search-result-header">
                    <h6 class="title">24 Result Found</h6>
                    <a href="{{ route('shop') }}" class="view-all">View All</a>
                </div>
                <div class="psearch-results">
                    <div class="axil-product-list">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('assets/images/product/electric/product-09.png') }}" alt="Yantiti Leather Bags">
                            </a>
                        </div>
                        <div class="product-content">
                            <div class="product-rating">
                                <span class="rating-icon">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                </span>
                                <span class="rating-number"><span>100+</span> Reviews</span>
                            </div>
                            <h6 class="product-title"><a href="single-product.html">Media Remote</a></h6>
                            <div class="product-price-variant">
                                <span class="price current-price">$29.99</span>
                                <span class="price old-price">$49.99</span>
                            </div>
                            <div class="product-cart">
                                <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="axil-product-list">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img src="{{ asset('assets/images/product/electric/product-09.png') }}" alt="Yantiti Leather Bags">
                            </a>
                        </div>
                        <div class="product-content">
                            <div class="product-rating">
                                <span class="rating-icon">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                </span>
                                <span class="rating-number"><span>100+</span> Reviews</span>
                            </div>
                            <h6 class="product-title"><a href="single-product.html">Media Remote</a></h6>
                            <div class="product-price-variant">
                                <span class="price current-price">$29.99</span>
                                <span class="price old-price">$49.99</span>
                            </div>
                            <div class="product-cart">
                                <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Search Modal End -->


    <div class="cart-dropdown" id="cart-dropdown">
        <div class="cart-content-wrap">
            <div class="cart-header">
                <h2 class="header-title">Révision du panier</h2>
                <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="cart-body">
                <ul class="cart-item-list">
                    @if(session('cart') && count(session('cart')) > 0)
                        @foreach(session('cart') as $key => $item)
                            <li class="cart-item">
                                <div class="item-img">
                                    <a href="single-product.html">
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                    </a>
                                    <a class="close-btn" href="{{ route('cart.remove', $key) }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <div class="item-content">
                                    <div class="product-rating">
                                        <span class="icon">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </span>
                                        <span class="rating-number">(64)</span>
                                    </div>
                                    <h3 class="item-title">
                                        <a href="single-product-3.html">{{ $item['name'] }}</a>
                                    </h3>
                                    <div class="item-price">
                                        {{-- <span class="currency-symbol">$</span>{{ number_format($item['price'], 2) }} --}}
                                    </div>
                                    <form action="{{ route('cart.add', $key) }}" method="POST" class="update-form">
                                        @csrf
                                        <div class="pro-qty item-quantity">
                                            <input type="number" name="quantity" class="quantity-input"
                                                value="{{ $item['quantity'] }}">
                                        </div>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="cart-item">
                            <div class="item-content">
                                <h3 class="item-title">Votre panier est vide.</h3>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="cart-footer">
                  <div class="update-btn my-4">
                    <button type="button" class="axil-btn btn-outline" id="update-cart-dropdown">Mettre à jour le
                        panier</button>
                </div>

                <h3 class="cart-subtotal">
                    <span class="subtotal-title">Sous-total:</span>
                    <span class="subtotal-amount">${{ number_format($subtotal, 2) }}</span>
                </h3>
                <div class="group-btn">
                    <a href="{{ route('cart') }}" class="axil-btn btn-bg-primary viewcart-btn">Voir le panier</a>
                    <a href="{{ route('checkout') }}" class="axil-btn btn-bg-secondary checkout-btn">Payer</a>
                </div>              
            </div>
        </div>
    </div>

    <!-- Offer Modal Start -->
    <div class="offer-popup-modal" id="offer-popup-modal">
        <div class="offer-popup-wrap">
            <div class="card-body">
                <button class="popup-close"><i class="fas fa-times"></i></button>
                <div class="content">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i>
                            Don’t Miss!!</span>
                        <h3 class="title">Best Sales Offer<br> Grab Yours</h3>
                    </div>
                    <div class="poster-countdown countdown"></div>
                    <a href="{{ route('shop') }}" class="axil-btn btn-bg-primary">Boutique <i
                            class="fal fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="closeMask"></div>
    <!-- Offer Modal End -->
    <!-- JS
============================================ -->
    <script src="{{ asset('assets/js/vendor/modernizr.min.js') }}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/js.cookie.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/vendor/jquery.style.switcher.js') }}"></script> -->
    <script src="{{ asset('assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/sal.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.getElementById('update-cart-dropdown').addEventListener('click', function () {
                // Soumettre tous les formulaires de mise à jour
                document.querySelectorAll('.update-form').forEach(form => {
                    form.submit();
                });
            });
    </script>

</body>

</html>
