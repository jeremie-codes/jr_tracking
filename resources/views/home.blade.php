@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <main class="main-wrapper">
        <div class="axil-main-slider-area main-slider-style-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-sm-6">
                        <div class="main-slider-content">
                            <div class="slider-content-activation-one">
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="400"
                                    data-sal-duration="800">
                                    <h1 class="title">Bienvenue sur E-GALERIA</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('shop') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Articles</a>
                                        </div>
                                        <div class="item-rating">
                                            <div class="thumb">
                                                <ul>
                                                    <li><img src="assets/images/others/author1.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author2.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author3.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author4.png" alt="Author"></li>
                                                </ul>
                                            </div>
                                            <div class="content">
                                                <span class="rating-icon">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fal fa-star"></i>
                                                </span>
                                                <span class="review-text">
                                                    <span>100+</span> Review
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <span class="subtitle"><i class="fas fa-fire"></i> RDC</span>
                                    <h1 class="title">Guichet unique des Articless digitales</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('shop') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Articles</a>
                                        </div>
                                        <div class="item-rating">
                                            <div class="thumb">
                                                <ul>
                                                    <li><img src="assets/images/others/author1.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author2.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author3.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author4.png" alt="Author"></li>
                                                </ul>
                                            </div>
                                            <div class="content">
                                                <span class="rating-icon">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fal fa-star"></i>
                                                </span>
                                                <span class="review-text">
                                                    <span>100+</span> Reviews
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <h1 class="title">Bienvenue sur E-GALERIA</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('shop') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Articles</a>
                                        </div>
                                        <div class="item-rating">
                                            <div class="thumb">
                                                <ul>
                                                    <li><img src="assets/images/others/author1.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author2.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author3.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author4.png" alt="Author"></li>
                                                </ul>
                                            </div>
                                            <div class="content">
                                                <span class="rating-icon">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fal fa-star"></i>
                                                </span>
                                                <span class="review-text">
                                                    <span>100+</span> Reviews
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <h1 class="title">Guichet unique des Articless digitales</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('shop') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Articles</a>
                                        </div>
                                        <div class="item-rating">
                                            <div class="thumb">
                                                <ul>
                                                    <li><img src="assets/images/others/author1.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author2.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author3.png" alt="Author"></li>
                                                    <li><img src="assets/images/others/author4.png" alt="Author"></li>
                                                </ul>
                                            </div>
                                            <div class="content">
                                                <span class="rating-icon">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fal fa-star"></i>
                                                </span>
                                                <span class="review-text">
                                                    <span>100+</span> Reviews
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="main-slider-large-thumb">
                            <div class="slider-thumb-activation-one axil-slick-dots">
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600"
                                    data-sal-duration="1500">
                                    <img src="{{ asset('assets/images/banner/manteau.png') }}" alt="Product" width="1000px">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600"
                                    data-sal-duration="1500">
                                    <img src="{{ asset('assets/images/banner/par-dessus.png') }}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <img src="{{ asset('assets/images/banner/phone.png') }}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <img src="{{ asset('assets/images/banner/manteau.png') }}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1"><img src="assets/images/others/shape-1.png" alt="Shape"></li>
                <li class="shape-2"><img src="assets/images/others/shape-2.png" alt="Shape"></li>
            </ul>
        </div>

        <!-- Start Categorie Area  -->
        <div class="axil-categorie-area bg-color-white axil-section-gapcommon">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-secondary"> <i class="far fa-tags"></i> Catégories</span>
                    <h2 class="title">Parcourir par catégorie</h2>
                </div>
                <div class="categrie-product-activation slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">
                @forelse ($categories as $category)
                    <div class="slick-single-layout">
                        <div class="categrie-product" data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500">
                            <form action="{{ route('products.filter') }}" method="POST">
                                @csrf
                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                                <button type="submit" class="category-button">
                                    <img class="img-fluid category-image" src="{{ '/storage/' . $category->image }}"
                                        alt="catégorie produit">
                                    <h6 class="cat-title">{{ $category->name }}</h6>
                                </button>
                            </form>
                        </div>
                        <!-- Fin .categrie-product -->
                    </div>
                @empty
                    <p>Aucune catégorie disponible.</p>
                @endforelse

                </div>
            </div>
        </div>
        <!-- End Categorie Area  -->

        <!-- Poster Countdown Area  -->
        <div class="axil-poster-countdown">
            <div class="container">
                <div class="poster-countdown-wrap bg-lighter">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7">
                            <div class="poster-countdown-content">
                                <div class="section-title-wrapper">
                                    <h2 class="title">Découvrez les meilleurs produits de la ville</h2>
                                </div>
                                <a href="{{ route('shop') }}" class="axil-btn btn-bg-primary">Go !</a>
                                {{-- <div class="poster-countdown countdown mb--40"></div> --}}
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5">
                            <div class="poster-countdown-thumbnail">
                                <img src="{{ asset('assets/images/banner/products.jpg') }}" alt="Poster Produit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Poster Countdown Area  -->

        <!-- Start Expolre Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i>Nos
                        Articles</span>
                    <h2 class="title">Découvrez nos produits</h2>
                </div>
                <div
                    class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                    <div class="slick-single-layout">
                        <div class="row row--15">
                            @forelse ($products as $product)
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <div class="axil-product product-style-one has-color-pick mt--40">
                                        <div class="thumbnail">
                                            <a href="{{ route('detail_product', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                            </a>
                                            <div class="product-hover-action">
                                                <ul class="cart-action">
                                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                                    </li>
                                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <li class="select-option"><button class="bg-transparent" type="submit">Commander </button> </li>
                                                    </form>
                                                    <li class="quickview"><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i
                                                                class="far fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="inner">
                                                <h5 class="title"><a href="{{ route('detail_product', $product->slug) }}">{{ $product->name }}</a>
                                                </h5>
                                                <div class="product-price-variant">
                                                    <span class="price current-price">{{ $product->price }}$</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 mt-4">
                                    <div class="p-3 my-4 alert alert-success">Aucun produit trouvé</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                         <div class="row row--15">
                            @forelse ($products as $product)
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <div class="axil-product product-style-one has-color-pick mt--40">
                                        <div class="thumbnail">
                                            <a href="{{ route('detail_product', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                            </a>
                                            <div class="product-hover-action">
                                                <ul class="cart-action">
                                                    <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                                    </li>
                                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <li class="select-option"><button class="bg-transparent" type="submit">Commander </button> </li>
                                                    </form>
                                                    <li class="quickview"><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i
                                                                class="far fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="inner">
                                                <h5 class="title"><a href="{{ route('detail_product', $product->slug) }}">{{ $product->name }}</a>
                                                </h5>
                                                <div class="product-price-variant">
                                                    <span class="price current-price">{{ $product->price }}$</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 mt-4">
                                    <div class="p-3 my-4 alert alert-success">Aucun produit trouvé</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center mt--20 mt_sm--0">
                        <a href="{{ route('shop') }}" class="axil-btn btn-bg-lighter btn-load-more">Voir plus</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Expolre Product Area  -->

        <!-- Start Testimonila Area  -->
        <div class="axil-testimoial-area axil-section-gap bg-vista-white">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-secondary"> <i class="fal fa-quote-left"></i>Témoignages</span>
                    <h2 class="title">Avis des utilisateurs</h2>
                </div>
                <!-- Fin .section-title -->
                <div
                    class="testimonial-slick-activation testimonial-style-one-wrapper slick-layout-wrapper--20 axil-slick-arrow arrow-top-slide">
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ C’est incroyable à quel point il est devenu plus facile de rencontrer de nouvelles personnes et
                                de créer des connexions instantanées. J’ai exactement la même personnalité, la seule chose qui a
                                changé, c’est mon état d’esprit et quelques comportements. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="./assets/images/testimonial/image-1.png" alt="image témoignage">
                            </div>
                            <div class="media-body">
                                <span class="designation">Responsable des idées</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- Fin .thumbnail -->
                    </div>
                    <!-- Fin .slick-single-layout -->
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ C’est incroyable à quel point il est devenu plus facile de rencontrer de nouvelles personnes et
                                de créer des connexions instantanées. J’ai exactement la même personnalité, la seule chose qui a
                                changé, c’est mon état d’esprit et quelques comportements. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="./assets/images/testimonial/image-2.png" alt="image témoignage">
                            </div>
                            <div class="media-body">
                                <span class="designation">Responsable des idées</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- Fin .thumbnail -->
                    </div>
                    <!-- Fin .slick-single-layout -->
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ C’est incroyable à quel point il est devenu plus facile de rencontrer de nouvelles personnes et
                                de créer des connexions instantanées. J’ai exactement la même personnalité, la seule chose qui a
                                changé, c’est mon état d’esprit et quelques comportements. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="./assets/images/testimonial/image-3.png" alt="image témoignage">
                            </div>
                            <div class="media-body">
                                <span class="designation">Responsable des idées</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- Fin .thumbnail -->
                    </div>
                    <!-- Fin .slick-single-layout -->
                    <div class="slick-single-layout testimonial-style-one">
                        <div class="review-speech">
                            <p>“ C’est incroyable à quel point il est devenu plus facile de rencontrer de nouvelles personnes et
                                de créer des connexions instantanées. J’ai exactement la même personnalité, la seule chose qui a
                                changé, c’est mon état d’esprit et quelques comportements. “</p>
                        </div>
                        <div class="media">
                            <div class="thumbnail">
                                <img src="./assets/images/testimonial/image-2.png" alt="image témoignage">
                            </div>
                            <div class="media-body">
                                <span class="designation">Responsable des idées</span>
                                <h6 class="title">James C. Anderson</h6>
                            </div>
                        </div>
                        <!-- Fin .thumbnail -->
                    </div>
                    <!-- Fin .slick-single-layout -->
                </div>
            </div>
        </div>
        <!-- End Testimonila Area  -->

        <!-- Start New Arrivals Product Area  -->
        <div class="axil-new-arrivals-product-area bg-color-white axil-section-gap pb--0">
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i>Cette semaine</span>
                        <h2 class="title">Nouveautés</h2>
                    </div>
                    <div
                        class="new-arrivals-product-activation slick-layout-wrapper--30 axil-slick-arrow  arrow-top-slide">
                        @forelse ($latestProducts as $latest)
                            <div class="slick-single-layout">
                                <div class="axil-product product-style-two">
                                    <div class="thumbnail">
                                        <a href="single-product.html">
                                            <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500"
                                                src="{{ asset('storage/' . $latest->image) }}" alt="{{ $latest->name }}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a href="single-product.html">{{ $latest->name }}</a></h5>
                                            <div class="product-price-variant">
                                                <span class="price current-price">{{ $latest->price }}$</span>
                                            </div>
                                            <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                                </li>
                                                <form action="{{ route('cart.add', $latest) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <li class="select-option"><button class="bg-transparent" type="submit">Commander </button> </li>
                                                </form>
                                                <li class="quickview"><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i
                                                            class="far fa-eye"></i></a></li>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 mt-4">
                                <div class="p-3 my-4 alert alert-success">Aucun produit trouvé</div>
                            </div>
                        @endforelse
                        
                        {{-- <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-two">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="300" data-sal-duration="500"
                                            src="assets/images/product/electric/product-06.png" alt="Product Images">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h5 class="title"><a href="single-product.html">Google Home</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price old-price">$50</span>
                                            <span class="price current-price">$40</span>
                                        </div>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a>
                                            </li>
                                            <li class="select-option"><a href="single-product.html">Select Option</a>
                                            </li>
                                            <li class="wishlist"><a href="wishlist.html"><i
                                                        class="far fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-two">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="400" data-sal-duration="500"
                                            src="assets/images/product/electric/product-07.png" alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget">15% OFF</div>
                                    </div>

                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h5 class="title"><a href="single-product.html">Netfilx Remot</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price old-price">$60</span>
                                            <span class="price current-price">$45</span>
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view-modal"><i
                                                            class="far fa-eye"></i></a></li>
                                                <li class="select-option"><a href="single-product.html">Add to Cart</a>
                                                </li>
                                                <li class="wishlist"><a href="wishlist.html"><i
                                                            class="far fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-two">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="500" data-sal-duration="500"
                                            src="assets/images/product/electric/product-08.png" alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget">30% OFF</div>
                                    </div>

                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h5 class="title"><a href="single-product.html">Digital Accessories</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price old-price">$30</span>
                                            <span class="price current-price">$20</span>
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view-modal"><i
                                                            class="far fa-eye"></i></a></li>
                                                <li class="select-option"><a href="single-product.html">Add to Cart</a>
                                                </li>
                                                <li class="wishlist"><a href="wishlist.html"><i
                                                            class="far fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .slick-single-layout -->
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-two">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-out" data-sal-delay="100" data-sal-duration="500"
                                            src="assets/images/product/electric/product-04.png" alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget">50% OFF</div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <li class="color-extra-01 active"><span><span
                                                            class="color"></span></span>
                                                </li>
                                                <li class="color-extra-02"><span><span class="color"></span></span>
                                                </li>
                                                <li class="color-extra-03"><span><span class="color"></span></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h5 class="title"><a href="single-product.html">PS5 Smart Remote</a></h5>
                                        <div class="product-price-variant">
                                            <span class="price old-price">$50</span>
                                            <span class="price current-price">$25</span>
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="quickview"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view-modal"><i
                                                            class="far fa-eye"></i></a></li>
                                                <li class="select-option"><a href="single-product.html">Add to Cart</a>
                                                </li>
                                                <li class="wishlist"><a href="wishlist.html"><i
                                                            class="far fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .slick-single-layout --> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End New Arrivals Product Area  -->

        <!-- Start Most Sold Product Area  -->
        <div class="axil-most-sold-product axil-section-gap">
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper section-title-center">
                        <span class="title-highlighter highlighter-primary"><i class="fas fa-star"></i> Most Sold</span>
                        <h2 class="title">Most Sold in eTrade Store</h2>
                    </div>
                    <div class="row row-cols-xl-2 row-cols-1 row--15">
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="100" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-09.png"
                                            alt="Yantiti Leather Bags">
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
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="200" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-10.png"
                                            alt="Yantiti Leather Bags">
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
                                        <span class="rating-number"><span>50+</span> Reviews</span>
                                    </div>
                                    <h6 class="product-title"><a href="single-product.html">HD Camera</a></h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">$49.99</span>
                                    </div>
                                    <div class="product-cart">
                                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                        <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="300" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-11.png"
                                            alt="Yantiti Leather Bags">
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
                                        <span class="rating-number"><span>120+</span> Reviews</span>
                                    </div>
                                    <h6 class="product-title"><a href="single-product.html">Gaming Controller</a></h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">$50.00</span>
                                    </div>
                                    <div class="product-cart">
                                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                        <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="400" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-12.png"
                                            alt="Yantiti Leather Bags">
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
                                        <span class="rating-number"><span>30+</span> Reviews</span>
                                    </div>
                                    <h6 class="product-title"><a href="single-product.html">Wall Mount </a></h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">$19.00</span>
                                    </div>
                                    <div class="product-cart">
                                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                        <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="500" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-13.png"
                                            alt="Yantiti Leather Bags">
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
                                        <span class="rating-number"><span>700+</span> Reviews</span>
                                    </div>
                                    <h6 class="product-title"><a href="single-product.html">Lenevo Laptop</a></h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">$999.99</span>
                                    </div>
                                    <div class="product-cart">
                                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                        <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="600" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-14.png"
                                            alt="Yantiti Leather Bags">
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
                                        <span class="rating-number"><span>300+</span> Reviews</span>
                                    </div>
                                    <h6 class="product-title"><a href="single-product.html">Juice Grinder Machine</a>
                                    </h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">$99.00</span>
                                    </div>
                                    <div class="product-cart">
                                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                        <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="400" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-15.png"
                                            alt="Yantiti Leather Bags">
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
                                    <h6 class="product-title"><a href="single-product.html">Wireless Headphone</a></h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">$59.99</span>
                                    </div>
                                    <div class="product-cart">
                                        <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                                        <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">
                                    <a href="single-product.html">
                                        <img data-sal="zoom-in" data-sal-delay="500" data-sal-duration="1500"
                                            src="./assets/images/product/electric/product-16.png"
                                            alt="Yantiti Leather Bags">
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
                                    <h6 class="product-title"><a href="single-product.html">Asus Zenbook Laptop</a></h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">$899.00</span>
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
        </div>
        <!-- End Most Sold Product Area  -->

    </main>
@endsection
