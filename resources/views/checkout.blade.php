 @extends('layouts.app')

 @section('content')
     <main class="main-wrapper">

         <!-- Start Checkout Area  -->
         <div class="axil-checkout-area axil-section-gap">
             <div class="container">
                 <form method="POST" action="{{ route('order.pay') }}">
                    @csrf
                    {{-- <input type="hidden" id="product_id" name="product_id" value="{{$price->event->id}}">
                    <input type="hidden" id="currency" name="currency" value="{{$price->currency}}">
                    <input type="hidden" id="montant" name="montant" value="{{$price->amount}}">
                    <input type="hidden" id="quantity" name="quantity" value="{{$quantity}}"> --}}
                    <input type="hidden" id="total" name="total" value={{ number_format($total, 2) }}>

                     <div class="row">
                        <div class="col-lg-6">
                            <div class="axil-checkout-billing">
                                <h4 class="title mb--40">Détails de facturation</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Nom complet <span>*</span></label>
                                            <input type="text" id="fullname" name="fullname" placeholder="Adam" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nom de famille <span>*</span></label>
                                            <input type="text" id="last-name" placeholder="John">
                                        </div>
                                    </div> --}}
                                </div>
                                <div class=" form-group">
                                            <label>Pays / Région <span>*</span></label>
                                            <select id="Region" name="country">
                                                <option value="1">France</option>
                                                <option value="2">Belgique</option>
                                                <option value="3">Canada</option>
                                                <option value="4">Suisse</option>
                                                <option value="5">Algérie</option>
                                                <option value="6">Maroc</option>
                                                <option value="7">Sénégal</option>
                                                <option value="8">Côte d'Ivoire</option>
                                                <option value="9">Tunisie</option>
                                                <option value="10">Cameroun</option>
                                                <option value="11">Nigeria</option>
                                                <option value="12">Afrique du Sud</option>
                                                <option value="13">Kenya</option>
                                                <option value="14">Bénin</option>
                                                <option value="15">Togo</option>
                                                <option value="16">Mali</option>
                                                <option value="17">Burkina Faso</option>
                                                <option value="18">République Démocratique du Congo</option>
                                                <option value="19">Gabon</option>
                                                <option value="20">Madagascar</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Adresse <span>*</span></label>
                                            <input type="text" id="address" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label>Téléphone <span>*</span></label>
                                            <input type="tel" id="phone_number" name="phone" value="{{ $user->phone_number }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Adresse e-mail <span>*</span></label>
                                            <input type="email" id="email" name="email" value="{{ $user->email }}">
                                        </div>
                                        {{-- <div class="form-group different-shippng">
                                            <div class="toggle-bar">
                                                <a href="javascript:void(0)" class="toggle-btn">
                                                    <input type="checkbox" id="checkbox2" name="diffrent-ship">
                                            <label for=" checkbox2">Livrer à une adresse différente ?</label>
                                                </a>
                                            </div>
                                            <div class="toggle-open">
                                                <div class="form-group">
                                                    <label>Pays / Région <span>*</span></label>
                                                    <select id="Region">
                                                        <option value="1">France</option>
                                                        <option value="2">Belgique</option>
                                                        <option value="3">Canada</option> <option value="4">Suisse</option>
                                                        <option value="5">Algérie</option>
                                                        <option value="6">Maroc</option>
                                                        <option value="7">Sénégal</option>
                                                        <option value="8">Côte d'Ivoire</option>
                                                        <option value="9">Tunisie</option>
                                                        <option value="10">Cameroun</option>
                                                        <option value="11">Nigeria</option>
                                                        <option value="12">Afrique du Sud</option>
                                                        <option value="13">Kenya</option>
                                                        <option value="14">Bénin</option>
                                                        <option value="15">Togo</option>
                                                        <option value="16">Mali</option>
                                                        <option value="17">Burkina Faso</option>
                                                        <option value="18">République Démocratique du Congo</option>
                                                        <option value="19">Gabon</option>
                                                        <option value="20">Madagascar</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Adresse <span>*</span></label>
                                                    <input type="text" id="address1" class="mb--15"
                                                        placeholder="Numéro de rue et nom de la rue">
                                                    <input type="text" id="address2" placeholder="Appartement, suite, unité, etc. (optionnel)">
                                                </div>
                                                <div class="form-group">
                                                    <label>Ville <span>*</span></label>
                                                    <input type="text" id="town">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pays</label>
                                                    <input type="text" id="country">
                                                </div>
                                                <div class="form-group">
                                                    <label>Téléphone <span>*</span></label>
                                                    <input type="tel" id="phone">
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <label>Notes (optionnel)</label>
                                            <textarea id="notes" rows="2" name="notes"
                                                placeholder="Notes sur votre commande, par exemple des instructions spéciales pour la livraison."></textarea>
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
                                                @endforeach @else <tr>
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
                                    <h4 class="title mb--40">Contacter le vendeur</h4>
                                    <!-- WhatsApp -->
                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <a href="https://wa.me/243815229941?text=Bonjour, je souhaite passer une commande." target="_blank"
                                                class="whatsapp-btn">
                                                <img src="{{ asset('/assets/images/logo/whatsapp.png') }}" alt="WhatsApp"
                                                    style="width: 24px; height: 24px; margin-right: 10px;">
                                                Cliquez pour nous contacter sur WhatsApp et finaliser votre commande.
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            <div class="order-payment-method bg-white rounded mb--15" style="padding: 30px">
                                <h4 class="title mb--40">Payer par E-GALERIA CASH</h4>

                                <!-- Mobile Money -->
                                <div class="single-payment">
                                    <div class="input-group justify-content-between align-items-center">
                                        <input type="radio" id="radio4" name="type" value="mobile" required>
                                        <input type="hidden" name="currency" value="usd" required>
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
 @endsection
