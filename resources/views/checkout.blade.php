 @extends('layouts.app')

 @section('content')
     <main class="main-wrapper">

         <!-- Start Checkout Area  -->
         <div class="axil-checkout-area axil-section-gap">
             <div class="container">
                 <form action="#">
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="axil-checkout-billing">
                                 <h4 class="title mb--40">Billing details</h4>
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="form-group">
                                             <label>First Name <span>*</span></label>
                                             <input type="text" id="first-name" placeholder="Adam">
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="form-group">
                                             <label>Last Name <span>*</span></label>
                                             <input type="text" id="last-name" placeholder="John">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label>Company Name</label>
                                     <input type="text" id="company-name">
                                 </div>
                                 <div class="form-group">
                                     <label>Country/ Region <span>*</span></label>
                                     <select id="Region">
                                         <option value="3">Australia</option>
                                         <option value="4">England</option>
                                         <option value="6">New Zealand</option>
                                         <option value="5">Switzerland</option>
                                         <option value="1">United Kindom (UK)</option>
                                         <option value="2">United States (USA)</option>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label>Street Address <span>*</span></label>
                                     <input type="text" id="address1" class="mb--15"
                                         placeholder="House number and street name">
                                     <input type="text" id="address2"
                                         placeholder="Apartment, suite, unit, etc. (optonal)">
                                 </div>
                                 <div class="form-group">
                                     <label>Town/ City <span>*</span></label>
                                     <input type="text" id="town">
                                 </div>
                                 <div class="form-group">
                                     <label>Country</label>
                                     <input type="text" id="country">
                                 </div>
                                 <div class="form-group">
                                     <label>Phone <span>*</span></label>
                                     <input type="tel" id="phone">
                                 </div>
                                 <div class="form-group">
                                     <label>Email Address <span>*</span></label>
                                     <input type="email" id="email">
                                 </div>
                                 <div class="form-group input-group">
                                     <input type="checkbox" id="checkbox1" name="account-create">
                                     <label for="checkbox1">Create an account</label>
                                 </div>
                                 <div class="form-group different-shippng">
                                     <div class="toggle-bar">
                                         <a href="javascript:void(0)" class="toggle-btn">
                                             <input type="checkbox" id="checkbox2" name="diffrent-ship">
                                             <label for="checkbox2">Ship to a different address?</label>
                                         </a>
                                     </div>
                                     <div class="toggle-open">
                                         <div class="form-group">
                                             <label>Country/ Region <span>*</span></label>
                                             <select id="Region">
                                                 <option value="3">Australia</option>
                                                 <option value="4">England</option>
                                                 <option value="6">New Zealand</option>
                                                 <option value="5">Switzerland</option>
                                                 <option value="1">United Kindom (UK)</option>
                                                 <option value="2">United States (USA)</option>
                                             </select>
                                         </div>
                                         <div class="form-group">
                                             <label>Street Address <span>*</span></label>
                                             <input type="text" id="address1" class="mb--15"
                                                 placeholder="House number and street name">
                                             <input type="text" id="address2"
                                                 placeholder="Apartment, suite, unit, etc. (optonal)">
                                         </div>
                                         <div class="form-group">
                                             <label>Town/ City <span>*</span></label>
                                             <input type="text" id="town">
                                         </div>
                                         <div class="form-group">
                                             <label>Country</label>
                                             <input type="text" id="country">
                                         </div>
                                         <div class="form-group">
                                             <label>Phone <span>*</span></label>
                                             <input type="tel" id="phone">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label>Other Notes (optional)</label>
                                     <textarea id="notes" rows="2" placeholder="Notes about your order, e.g. speacial notes for delivery."></textarea>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="axil-order-summery order-checkout-summery">
                                <h5 class="title mb--20">Ta commande</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Sous-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(session('cart') && count(session('cart')) > 0)
                                                @foreach(session('cart') as $key => $item)
                                                    <tr class="order-product">
                                                        <td>{{ $item['name'] }} <span class="quantity">x{{ $item['quantity'] }}</span></td>
                                                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2">Votre panier est vide.</td>
                                                </tr>
                                            @endif
                                                                
                                            <!-- Total -->
                                            <tr class="order-total">
                                                <td>Total</td>
                                                <td class="order-total-amount">${{ number_format($total, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <div class="order-payment-method bg-white rounded mb--15" style="padding: 30px">
                                <!-- Mobile Money -->
                                <div class="single-payment">
                                    <div class="input-group justify-content-between align-items-center">
                                        <input type="radio" id="radio4" name="type" value="mobile" required>
                                        <label for="radio4">Mobile Money</label>
                                        <img src="{{ asset('/assets/images/others/mobile.png') }}" alt="Mobile Money">
                                    </div>
                                    <p>
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input type="text" id="company-name" name="phone">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    </p>
                                </div>
                            
                                <!-- Carte Bancaire -->
                                <div class="single-payment">
                                    <div class="input-group justify-content-between align-items-center">
                                        <input type="radio" id="radio6" name="type" value="card">
                                        <label for="radio6">Carte Bancaire</label>
                                        <img src="{{ asset('/assets/images/others/payment.png') }}" alt="Carte Bancaire">
                                    </div>
                                    <p>Vous pouvez payer avec votre carte de crédit.</p>
                                </div>
                            
                                <!-- WhatsApp -->
                                <div class="single-payment">
                                    <div class="input-group justify-content-between align-items-center">
                                        <a href="https://wa.me/2250707070707?text=Bonjour, je souhaite passer une commande." target="_blank"
                                            class="whatsapp-btn">
                                            <img src="{{ asset('/assets/images/others/whatsapp.png') }}" alt="WhatsApp"
                                                style="width: 24px; height: 24px; margin-right: 10px;">
                                            Payer via WhatsApp
                                        </a>
                                    </div>
                                    <p>Cliquez pour nous contacter sur WhatsApp et finaliser votre commande.</p>
                                </div>
                            </div>
                                 <button type="submit" class="axil-btn btn-bg-primary checkout-btn">Paiement</button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
         <!-- End Checkout Area  -->

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
 @endsection
