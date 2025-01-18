 @extends('layouts.app')

 @section('content')
     <main class="main-wrapper">

        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap">
                <div class="product-table-heading">
                    <h4 class="title">Votre panier</h4>
                    <a href="{{ route('cart.empty') }}" class="cart-clear">Vider le panier</a>
                </div>
                @if (session()->has('message'))
                    <div id="success-alert" class="alert alert-primary p-4" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <form action="{{ route('cart.update.multiple') }}" method="POST" id="update-cart-form">
                        @csrf
                        @method('PUT')
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-thumbnail">Produit</th>
                                    <th scope="col" class="product-title"></th>
                                    <th scope="col" class="product-price">Prix</th>
                                    <th scope="col" class="product-quantity">Quantité</th>
                                    <th scope="col" class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(session("cart") && is_array(session("cart")))
                                    @foreach (session("cart") as $key => $item)
                                        <tr>
                                            <td class="product-remove">
                                                <a href="{{ route('cart.remove', $key) }}" class="remove-wishlist">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="Digital Product">
                                                </a>
                                            </td>
                                            <td class="product-title">
                                                <a href="single-product.html">{{ $item['name'] }}</a>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                {{ $item['price'] }} <span class="currency-symbol">$</span>
                                            </td>
                                            <td class="product-quantity" data-title="Qty">
                                                <div class="pro-qty">
                                                    <input type="number" name="quantities[{{ $key }}]" class="quantity"
                                                        value="{{ $item['quantity'] }}">
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Subtotal">
                                                {{ $item['price'] * $item['quantity'] }} <span class="currency-symbol">$</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Votre panier est vide.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="cart-update-btn-area">
                    <div class="update-btn">
                        <button type="submit" form="update-cart-form" class="axil-btn btn-outline">Mettre à jour le panier</button>
                    </div>
                </div>
            <!-- Récapitulatif de la commande -->
            <div class="row">
                <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                    <div class="axil-order-summery mt--80">
                        <h5 class="title mb--20">Récapitulatif de la commande</h5>
                        <div class="summery-table-wrap">
                            <table class="table summery-table mb--30">
                                <tbody>
                                    <!-- Sous-total -->
                                    <tr class="order-subtotal">
                                        <td>Sous-total</td>
                                        <td>${{ number_format($subtotal, 2) }}</td>
                                    </tr>
            
                                    <!-- Frais de livraison -->
                                    {{-- <tr class="order-shipping">
                                        <td>Livraison</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="radio" id="radio1" name="shipping" checked>
                                                <label for="radio1">Livraison gratuite</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio2" name="shipping">
                                                <label for="radio2">Local : $35.00</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio3" name="shipping">
                                                <label for="radio3">Tarif fixe : $12.00</label>
                                            </div>
                                        </td>
                                    </tr> --}}
            
                                    <!-- Taxes -->
                                    {{-- <tr class="order-tax">
                                        <td>Taxes</td>
                                        <td>${{ number_format($tax, 2) }}</td>
                                    </tr> --}}
            
                                    <!-- Total -->
                                    <tr class="order-total">
                                        <td>Total</td>
                                        <td class="order-total-amount">${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('checkout') }}" class="axil-btn btn-bg-primary checkout-btn">Passer à la caisse</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <!-- End Cart Area  -->
     </main>

    <script>
        // Sélectionnez l'élément d'alerte
        var alertElement = document.getElementById('success-alert');

        // Définissez un délai de 3 secondes (3000 millisecondes)
        setTimeout(function () {
            // Masquez l'élément en définissant display à 'none'
            alertElement.style.display = 'none';
        }, 3000);
    </script>
    <script>
      document.getElementById('update-cart').addEventListener('click', function (event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien

            // Soumettre tous les formulaires de mise à jour un par un
            document.querySelectorAll('.update-form').forEach(function (form) {
                // Récupérer la valeur de l'input quantity
                const quantityInput = form.querySelector('.quantity');
                const newQuantity = quantityInput.value;

                // Vérifier si la quantité a changé
                if (newQuantity !== quantityInput.defaultValue) {
                    form.submit(); // Soumettre le formulaire si la quantité a changé
                }
            });
        });
    </script>
 @endsection
