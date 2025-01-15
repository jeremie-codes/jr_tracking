 @extends('layouts.app')

 @section('content')
     <main class="main-wrapper">

         <!-- Start Cart Area  -->
         <div class="axil-product-cart-area axil-section-gap">
             <div class="container">
                 <div class="axil-product-cart-wrap">
                     <div class="product-table-heading">
                         <h4 class="title">Votre panier</h4>
                         <a href="#" class="cart-clear">Vider le panier</a>
                     </div>
                    @if (session()->has('message'))
                        <div id="success-alert" class="alert alert-primary p-4" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                   <div class="table-responsive">
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
                                @foreach (session("cart") as $key => $item)
                                    <tr>
                                        <td class="product-remove"><a href="{{ route('cart.remove', $key) }}" class="remove-wishlist"><i class="fal fa-times"></i></a></td>
                                        <td class="product-thumbnail"><a href="single-product.html"><img src="{{ asset('storage/' . $item['image']) }}" alt="Digital Product"></a></td>
                                        <td class="product-title"><a href="single-product.html">{{ $item['name'] }}</a></td>
                                        <td class="product-price" data-title="Price">{{ $item['price'] }} <span class="currency-symbol">$</span></td>
                                        <td class="product-quantity" data-title="Qty">
                                        <form action="{{ route('cart.add', $key) }}" method="POST" class="update-form" id="update-form-{{ $key }}">
                                            @csrf
                                            @method('POST')
                                            <div class="pro-qty">
                                                <input type="number" name="quantity" class="quantity" value="{{ $item['quantity'] }}">
                                            </div>
                                        </form>
                                        </td>
                                        <td class="product-subtotal" data-title="Subtotal">{{ $item['price'] * $item['quantity'] }} <span class="currency-symbol">$</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-update-btn-area">
                        <div class="update-btn">
                            <a href="#" class="axil-btn btn-outline" id="update-cart">Update Cart</a>
                        </div>
                    </div>
                     <div class="row">
                         <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                             <div class="axil-order-summery mt--80">
                                 <h5 class="title mb--20">Order Summary</h5>
                                 <div class="summery-table-wrap">
                                     <table class="table summery-table mb--30">
                                         <tbody>
                                             <tr class="order-subtotal">
                                                 <td>Subtotal</td>
                                                 <td>$117.00</td>
                                             </tr>
                                             <tr class="order-shipping">
                                                 <td>Shipping</td>
                                                 <td>
                                                     <div class="input-group">
                                                         <input type="radio" id="radio1" name="shipping" checked>
                                                         <label for="radio1">Free Shippping</label>
                                                     </div>
                                                     <div class="input-group">
                                                         <input type="radio" id="radio2" name="shipping">
                                                         <label for="radio2">Local: $35.00</label>
                                                     </div>
                                                     <div class="input-group">
                                                         <input type="radio" id="radio3" name="shipping">
                                                         <label for="radio3">Flat rate: $12.00</label>
                                                     </div>
                                                 </td>
                                             </tr>
                                             <tr class="order-tax">
                                                 <td>State Tax</td>
                                                 <td>$8.00</td>
                                             </tr>
                                             <tr class="order-total">
                                                 <td>Total</td>
                                                 <td class="order-total-amount">$125.00</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                                 <a href="checkout.html" class="axil-btn btn-bg-primary checkout-btn">Process to
                                     Checkout</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- End Cart Area  -->
     </main>

     <div class="service-area">
         <div class="container">
             <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                 <div class="col">
                     <div class="service-box service-style-2">
                         <div class="icon">
                             <img src="./assets/images/icons/service1.png" alt="Service">
                         </div>
                         <div class="content">
                             <h6 class="title">Fast &amp; Secure Delivery</h6>
                             <p>Tell about your service.</p>
                         </div>
                     </div>
                 </div>
                 <div class="col">
                     <div class="service-box service-style-2">
                         <div class="icon">
                             <img src="./assets/images/icons/service2.png" alt="Service">
                         </div>
                         <div class="content">
                             <h6 class="title">Money Back Guarantee</h6>
                             <p>Within 10 days.</p>
                         </div>
                     </div>
                 </div>
                 <div class="col">
                     <div class="service-box service-style-2">
                         <div class="icon">
                             <img src="./assets/images/icons/service3.png" alt="Service">
                         </div>
                         <div class="content">
                             <h6 class="title">24 Hour Return Policy</h6>
                             <p>No question ask.</p>
                         </div>
                     </div>
                 </div>
                 <div class="col">
                     <div class="service-box service-style-2">
                         <div class="icon">
                             <img src="./assets/images/icons/service4.png" alt="Service">
                         </div>
                         <div class="content">
                             <h6 class="title">Pro Quality Support</h6>
                             <p>24/7 Live support.</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

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
