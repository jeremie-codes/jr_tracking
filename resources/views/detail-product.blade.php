@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
    <main class="main-wrapper">
        <!-- Start Shop Area  -->
        <div class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
            <div class="single-product-thumb mb--40">
                <div class="container">
                    @if ($user && ($user->role == 'admin' || $user->id == $product->shop->user_id))
                        <div class="row mb--40">
                            <div class="d-flex justify-content-end">
                                    <a href=" {{ route('update_product', $product) }}" class="axil-btn btn-bg-primary">Modifier</a>
                                <a href="{{ route('delete_product', $product) }}" class="axil-btn btn-bg-danger">Supprimer</a>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-7 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                    <div class="single-product-thumbnail-wrap zoom-gallery">
                                        <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">
                                            <div class="thumbnail">
                                                <a href="{{ asset('storage/' . $product->image) }}" class="popup-zoom">
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Images">
                                                </a>
                                            </div>
                                            @if ($product->image2)
                                                <div class="thumbnail">
                                                    <a href="{{ asset('storage/' . $product->image2) }}" class="popup-zoom">
                                                        <img src="{{ asset('storage/' . $product->image2) }}" alt="Product Images">
                                                    </a>
                                                </div>
                                            @endif
                                            @if ($product->image3)
                                                <div class="thumbnail">
                                                    <a href="{{ asset('storage/' . $product->image3) }}" class="popup-zoom">
                                                        <img src="{{ asset('storage/' . $product->image3) }}" alt="Product Images">
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 order-lg-1">
                                    <div class="product-small-thumb-3 small-thumb-wrapper">
                                        <div class="small-thumb-img">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="thumb image">
                                        </div>
                                        @if ($product->image2)
                                            <div class="small-thumb-img">
                                                <img src="{{ asset('storage/' . $product->image2) }}" alt="thumb image">
                                            </div>
                                        @endif
                                        @if ($product->image3)
                                            <div class="small-thumb-img">
                                                <img src="{{ asset('storage/' . $product->image3) }}" alt="thumb image">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h2 class="product-title">{{ $product->name }}</h2>
                                    <span class="price-amount">{{ $product->price }}$</span>
                                    <p class="description">{!! Str::markdown($product->description) !!}
</p>

                                    <!-- Start Product Action Wrapper  -->
                                    <div class="product-action-wrapper d-flex-center">
                                        <!-- Start Quentity Action  -->
                                        {{-- <div class="pro-qty"><input type="text" value="1"></div> --}}
                                        <!-- End Quentity Action  -->

                                        <!-- Start Product Action  -->
                                        <ul class="product-action d-flex-center mb--0">
                                            <form id="add_to_cart" action="{{ route('cart.add', $product) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <li class="add-to-cart">
                                                    <a id="submitcart" href="#" class="axil-btn btn-bg-primary">Commander</a>
                                                </li>
                                            </form>
                                        </ul>
                                        <!-- End Product Action  -->
                                        
                                        <script>
                                            // Récupérer les éléments
                                            let submitcart = document.getElementById('submitcart');
                                            let add_to_cart = document.getElementById('add_to_cart');

                                            // Ajouter un écouteur d'événements sur le lien
                                            submitcart.addEventListener('click', function (event) {
                                                // Empêcher le comportement par défaut du lien (ne pas suivre le href)
                                                event.preventDefault();

                                                // Soumettre le formulaire
                                                add_to_cart.submit();
                                            });
                                        </script>

                                    </div>
                                    <!-- End Product Action Wrapper  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .single-product-thumb -->


        </div>
        <!-- End Shop Area  -->
    </main>

        <!-- Product Quick View Modal Start -->
        <div class="modal fade quick-view-product" id="quick-view-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="far fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="single-product-thumb">
                            <div class="row">
                                <div class="col-lg-7 mb--40">
                                    <div class="row">
                                        <div class="col-lg-10 order-lg-2">
                                            <div
                                                class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                                <div class="thumbnail">
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Images">
                                                </div>
                                                <div class="thumbnail">
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Images">
                                                </div>
                                                <div class="thumbnail">
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Images">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 order-lg-1">
                                            <div class="product-small-thumb small-thumb-wrapper">
                                                <div class="small-thumb-img">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="thumb image">
                                                </div>
                                                <div class="small-thumb-img">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="thumb image">
                                                </div>
                                                <div class="small-thumb-img">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="thumb image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 mb--40">
                                    <div class="single-product-content">
                                        <div class="inner">
                                            <div class="product-rating">
                                                <div class="star-rating">
                                                    <img src="assets/images/icons/rate.png" alt="Rate Images">
                                                </div>
                                                <div class="review-link">
                                                    <a href="#">(<span>1</span> customer reviews)</a>
                                                </div>
                                            </div>
                                            <h3 class="product-title">Serif Coffee Table</h3>
                                            <span class="price-amount">$155.00 - $255.00</span>
                                            <ul class="product-meta">
                                                <li><i class="fal fa-check"></i>In stock</li>
                                                <li><i class="fal fa-check"></i>Free delivery available</li>
                                                <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>
                                            </ul>
                                            <p class="description">{!! Str::markdown($product->description) !!}</p>
        
                                            <div class="product-variations-wrapper">
        
                                                <!-- Start Product Variation  -->
                                                <div class="product-variation">
                                                    <h6 class="title">Colors:</h6>
                                                    <div class="color-variant-wrapper">
                                                        <ul class="color-variant mt--0">
                                                            <li class="color-extra-01 active"><span><span
                                                                        class="color"></span></span>
                                                            </li>
                                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                                            </li>
                                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- End Product Variation  -->
        
                                                <!-- Start Product Variation  -->
                                                <div class="product-variation">
                                                    <h6 class="title">Size:</h6>
                                                    <ul class="range-variant">
                                                        <li>xs</li>
                                                        <li>s</li>
                                                        <li>m</li>
                                                        <li>l</li>
                                                        <li>xl</li>
                                                    </ul>
                                                </div>
                                                <!-- End Product Variation  -->
        
                                            </div>
        
                                            <!-- Start Product Action Wrapper  -->
                                            <div class="product-action-wrapper d-flex-center">
                                                <!-- Start Quentity Action  -->
                                                <div class="pro-qty"><input type="text" value="1"></div>
                                                <!-- End Quentity Action  -->
        
                                                <!-- Start Product Action  -->
                                                <ul class="product-action d-flex-center mb--0">
                                                    <li class="add-to-cart"><a href="cart.html"
                                                            class="axil-btn btn-bg-primary">Commander</a></li>
                                                </ul>
                                                <!-- End Product Action  -->
        
                                            </div>
                                            <!-- End Product Action Wrapper  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Quick View Modal End -->
  @endsection
