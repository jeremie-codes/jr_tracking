@extends('layouts.app')

@section('title', 'Commandes')

@section('content')
<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Mes commandes</li>
                        </ul>
                        <h1 class="title">Liste des commandes</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="{{ asset('assets/images/banner/chaussures-1.png') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Orders Area  -->
    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <!-- Afficher les détails des commandes -->
            @forelse ($orders as $order)
                        <div class="order-details mb-5">
                        <div class="order-header">
                            <h3 class="order-title">Commande #{{ $order->number }}</h3>
                            <div class="order-details">
                                <p class="order-date">📅 Date de commande : <span>{{ $order->created_at->translatedFormat('j F Y') }}</span></p>
                                <p class="order-status">📦 Statut : <span
                                        class="status-badge">{{ $statusTranslations[$order->status] ?? $order->status }}</span></p>
                                <p class="order-total">💰 Prix total : <span>{{ $order->total_price }}$</span></p>
                            </div>
                        </div>

                            <!-- Afficher les éléments de la commande -->
                            <div class="row row--15">
                                @forelse ($order->order_items as $item)
                                                @php
                // Récupérer les détails du produit associé à l'order_item
                $product = App\Models\Product::find($item->product_id);
                                                @endphp

                                                @if ($product)
                                                    <div class="col-xl-3 col-lg-4 col-sm-6">
                                                        <div class="axil-product product-style-one has-color-pick mt--40">
                                                            <div class="thumbnail">
                                                                <a href="{{ route('detail_product', $product->slug) }}">
                                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                                </a>
                                                            </div>
                                                            <div class="product-content">
                                                                <div class="inner">
                                                                    <h5 class="title">
                                                                        <a href="{{ route('detail_product', $product->slug) }}">{{ $product->name }}</a>
                                                                    </h5>
                                                                    <div class="product-price-variant">
                                                                        <span class="price current-price">{{ $product->price }}$</span>
                                                                    </div>
                                                                    <p>Quantité : {{ $item->qty }}</p>
                                                                    <p>Prix unitaire : {{ $item->unit_price }}$</p>
                                                                    <p>Total : {{ $item->qty * $item->unit_price }}$</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <p>Produit non trouvé pour cet élément de commande.</p>
                                                    </div>
                                                @endif
                                @empty
                                    <div class="col-12">
                                        <p>Aucun élément trouvé pour cette commande.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
            @empty
                <div class="col-12 mt-4">
                    <div class="p-3 my-4 alert alert-success">Aucune commande trouvée.</div>
                </div>
            @endforelse
        </div>
    </div>
    <!-- End Orders Area  -->
</main>
@endsection