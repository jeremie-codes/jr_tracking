@php
use Illuminate\Support\Facades\Auth;

$client = Auth::user();
@endphp

@extends('layouts.app')

  @section('content')
      <main class="main-wrapper">
          <!-- Start Breadcrumb Area  -->
          <div class="axil-breadcrumb-area">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-lg-6 col-md-8">
                          <div class="inner">
                              <ul class="axil-breadcrumb">
                                  <li class="axil-breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                                  <li class="separator"></li>
                                  <li class="axil-breadcrumb-item active" aria-current="page">Mon compte</li>
                              </ul>
                              <h1 class="title">Gérer votre compte</h1>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-4">
                          <div class="inner">
                              <div class="bradcrumb-thumb">
                                  <img src="assets/images/product/product-45.png" alt="Image">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- End Breadcrumb Area  -->

          <!-- Start My Account Area  -->
          <div class="axil-dashboard-area axil-section-gap">
              <div class="container">
                  <div class="axil-dashboard-warp">
                      <div class="axil-dashboard-author">
                          <div class="media">
                              <div class="thumbnail">
                                  <img src="{{ $client->avatar ? '/storage/' . $client->avatar : asset('assets/images/product/author1.png') }}" alt="Hello Annie">
                              </div>
                              <div class="media-body">
                                  <h5 class="title mb-0">{{ $client->name }}</h5>
                                  <span class="joining-date {{ $client->role == 'customer' ? 'd-none' : '' }}">Boutique : {{ $client->shop?->name }}</span>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xl-3 col-md-4">
                              <aside class="axil-dashboard-aside">
                                  <nav class="axil-dashboard-nav">
                                      <div class="nav nav-tabs" role="tablist">
                                          {{-- <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-dashboard"
                                              role="tab" aria-selected="true"><i
                                                  class="fas fa-th-large"></i>Dashboard</a> --}}
                                          <a class="nav-item nav-link {{ $client->role == 'customer' ? 'd-none' : 'active' }}" data-bs-toggle="tab" href="#nav-downloads"
                                              role="tab" aria-selected="false"><i
                                                  class="fas fa-shopping-bag"></i>Boutique</a>
                                          <a class="nav-item nav-link {{ $client->role == 'customer' ? 'active' : '' }}" data-bs-toggle="tab" href="#nav-orders"
                                              role="tab" aria-selected="false"><i
                                                  class="fas fa-shopping-basket"></i>Commandes</a>
                                          {{-- <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-address"
                                              role="tab" aria-selected="false"><i
                                                  class="fas fa-bags-shopping"></i>Produits</a> --}}
                                          <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-account"
                                              role="tab" aria-selected="false"><i class="fas fa-user"></i>Détails du
                                              compte</a>
                                          <a class="nav-item nav-link" href="{{ route('login') }}"><i
                                                  class="fal fa-sign-out"></i>Se déconnecter</a>
                                      </div>
                                  </nav>
                              </aside>
                          </div>
                          <div class="col-xl-9 col-md-8">
                              <div class="tab-content">
                                  {{-- <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                                      <div class="axil-dashboard-overview">
                                          <div class="welcome-text">Hello Annie (not <span>Annie?</span> <a
                                                  href="{{ route('login') }}">Log Out</a>)</div>
                                          <p>From your account dashboard you can view your recent orders, manage your
                                              shipping and billing addresses, and edit your password and account details.
                                          </p>
                                      </div>
                                  </div> --}}
                                  <div class="tab-pane fade {{ $client->role == 'customer' ? 'active show' : '' }}" id="nav-orders" role="tabpanel">
                                      <div class="axil-dashboard-order">
                                          <div class="table-responsive">
                                              <table class="table">
                                                  <thead>
                                                      <tr>
                                                          <th scope="col">Order</th>
                                                          <th scope="col">Date</th>
                                                          <th scope="col">Status</th>
                                                          <th scope="col">Total</th>
                                                          <th scope="col">Actions</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                @forelse ($orders as $order)
                                                    <tr>
                                                        <th scope="row">#{{ $order->number }}</th> <!-- Affiche le numéro de commande -->
                                                        <td>{{ $order->created_at->translatedFormat('j F Y') }}</td> <!-- Format de date -->
                                                        <td>{{ $order->status }}</td>
                                                        <td>{{ $order->total_price }}$</td>
                                                        <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">Aucune commande trouvée.</td>
                                                    </tr>
                                                @endforelse
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade  {{ $client->role == 'customer' ? 'd-none' : 'active show' }}" id="nav-downloads" role="tabpanel">
                                      <div class="axil-dashboard-overview">
                                          <div class=""
                                              style="display: flex; flex-direction:row; justify-content:space-between;">
                                              <div class="welcome-text">Boutique : {{ $client->shop?->name }}</div>
                                              <div class="">
                                                  <a href="{{ route('create_product') }}"
                                                      class="bg-primary px-4 py-2 rounded text-white">Ajouter</a>
                                              </div>
                                          </div>
                                          <p>Depuis le tableau de bord de votre compte, vous pouvez consulter vos commandes
                                              récentes, gérer vos adresses de livraison et de facturation et modifier votre
                                              mot de passe et les détails de votre compte.
                                          </p>
                                      </div>
                                      <div class="row row--15">
                                          @forelse ($products as $product)
                                              <div class="col-lg-4 col-sm-6">
                                                  <div class="axil-product product-style-one has-color-pick mt--40">
                                                      <div class="thumbnail">
                                                          <a href="{{ route('detail_product', $product->id) }}">
                                                              <img src="{{ asset('storage/' . $product->image) }}"
                                                                  alt="{{ $product->name }}">
                                                          </a>
                                                          <div class="product-hover-action">
                                                              <ul class="cart-action">
                                                                  {{-- <li class="wishlist"><a href="wishlist.html"><i
                                                                          class="far fa-heart"></i></a></li> --}}
                                                                  <li class="quickview"><a
                                                                          href="{{ route('detail_product', $product->id) }}"
                                                                          data-bs-toggle="modal"
                                                                          data-bs-target="#quick-view-modal"><i
                                                                              class="far fa-eye"></i></a></li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                      <div class="product-content">
                                                          <div class="inner">
                                                              <h5 class="title"><a
                                                                      href="{{ route('detail_product', $product->id) }}">{{ $product->name }}
                                                                  </a></h5>
                                                              <div class="product-price-variant">
                                                                  <span class="price current-price">{{ $product->price }}$
                                                                  </span>
                                                                  {{-- <span class="price old-price">$50</span> --}}
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          @empty
                                              <div class="mt-4">
                                                  <div class="p-3 mb-2 bg-secondary rounded text-white">
                                                {{ $client->role == 'admin' ? 'Pour voir vos produits connectez-vous sur ' . url('/admin/products/') : 'Aucun produit trouvé' }}
                                                  </div>
                                              </div>
                                          @endforelse
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="nav-account" role="tabpanel">
                                      <div class="col-lg-9">
                                          <div class="axil-dashboard-account">
                                               <form class="singin-form" method="POST" action="{{ route('update', $client->id) }}" enctype="multipart/form-data" id="avatar-form">
                                                    @csrf
                                                    @method('POST')

                                                    <div class="row">
                                                        <!-- Avatar -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="avatar">Avatar</label>
                                                                <input type="file" name="avatar" id="avatar" class="form-control">
                                                                @error('avatar')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Nom complet -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="name">Nom complet</label>
                                                                <input type="text" name="name" id="name" class="form-control"
                                                                    value="{{ $client->name }}" required maxlength="255">
                                                                @error('name')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Email -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" name="email" id="email" class="form-control"
                                                                    value="{{ $client->email }}" required maxlength="255">
                                                                @error('email')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Téléphone -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="phone_number">Téléphone</label>
                                                                <input type="text" name="phone_number" id="phone_number"
                                                                    class="form-control" value="{{ $client->phone_number }}" required
                                                                    maxlength="20">
                                                                @error('phone_number')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Adresse -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="address">Adresse</label>
                                                                <input type="text" name="address" id="address" class="form-control"
                                                                    value="{{ $client->address }}" required maxlength="255">
                                                                @error('address')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Genre -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="gender">Genre</label>
                                                                <select name="gender" id="gender" class="form-control">
                                                                    <option value="male" {{ $client->gender == 'male' ? 'selected' : '' }}>
                                                                        Homme</option>
                                                                    <option value="female" {{ $client->gender == 'female' ? 'selected' : '' }}>
                                                                        Femme</option>
                                                                </select>
                                                                @error('gender')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Date de naissance -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="date_of_birth">Date de naissance</label>
                                                                <input type="date" name="date_of_birth" id="date_of_birth"
                                                                    class="form-control" value="{{ $client->date_of_birth }}">
                                                                @error('date_of_birth')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="role">Type de compte</label>
                                                                <select name="role" id="role" class="form-control">
                                                                    <option value="customer" {{ $client->role == 'customer' ? 'selected' : '' }}>Client</option>
                                                                    <option value="seller" {{ $client->role == 'seller' ? 'selected' : '' }}>Vendeur</option>
                                                                </select>
                                                                @error('role')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-12" id="shop_name_field" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="shop_name">Nom de la boutique</label>
                                                                <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{ $client->shop->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <h5 class="title">Changer le mot de passe</h5>
                                                            <div class="form-group">
                                                                <label for="old_password">Ancien mot de passe</label>
                                                                <input type="password" name="old_password" id="old_password" class="form-control" minlength="8">
                                                                @error('old_password')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_password">Confirmation du mot de passe</label>
                                                                <input type="password" name="new_password" id="new_password" class="form-control"
                                                                    minlength="8">
                                                                @error('new_password')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password_confirmation">Confirmation du mot de passe</label>
                                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                                                                    minlength="8">
                                                                @error('password_confirmation')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Bouton de soumission -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Mettre à jour</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- End My Account Area  -->
      </main>

       <script>
        // Sélectionner les éléments du DOM
        const roleSelect = document.getElementById('role');
        const shopNameField = document.getElementById('shop_name_field');

        // Fonction pour afficher ou masquer le champ shop_name
        function toggleShopNameField() {
            if (roleSelect.value === 'seller') {
                shopNameField.style.display = 'block'; // Afficher le champ
            } else {
                shopNameField.style.display = 'none'; // Masquer le champ
            }
        }

        // Écouter les changements sur le champ role
        roleSelect.addEventListener('change', toggleShopNameField);

        // Appliquer la logique au chargement de la page (si un rôle est déjà sélectionné)
        document.addEventListener('DOMContentLoaded', toggleShopNameField);
    </script>
  @endsection
