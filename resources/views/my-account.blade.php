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
                                  <li class="axil-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                  <li class="separator"></li>
                                  <li class="axil-breadcrumb-item active" aria-current="page">My Account</li>
                              </ul>
                              <h1 class="title">Explore All Products</h1>
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
                                  <img src="./assets/images/product/author1.png" alt="Hello Annie">
                              </div>
                              <div class="media-body">
                                  <h5 class="title mb-0">Hello Annie</h5>
                                  <span class="joining-date">eTrade Member Since Sep 2020</span>
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
                                          <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-downloads"
                                              role="tab" aria-selected="false"><i
                                                  class="fas fa-shopping-bag"></i>Boutique</a>
                                          <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders"
                                              role="tab" aria-selected="false"><i
                                                  class="fas fa-shopping-basket"></i>Commandes</a>
                                          {{-- <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-address"
                                              role="tab" aria-selected="false"><i
                                                  class="fas fa-bags-shopping"></i>Produits</a> --}}
                                          <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-account"
                                              role="tab" aria-selected="false"><i class="fas fa-user"></i>Account
                                              Details</a>
                                          <a class="nav-item nav-link" href="{{ route('login') }}"><i
                                                  class="fal fa-sign-out"></i>Logout</a>
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
                                  <div class="tab-pane fade" id="nav-orders" role="tabpanel">
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
                                                      <tr>
                                                          <th scope="row">#6523</th>
                                                          <td>September 10, 2020</td>
                                                          <td>Processing</td>
                                                          <td>$326.63 for 3 items</td>
                                                          <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                      </tr>
                                                      <tr>
                                                          <th scope="row">#6523</th>
                                                          <td>September 10, 2020</td>
                                                          <td>On Hold</td>
                                                          <td>$326.63 for 3 items</td>
                                                          <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                      </tr>
                                                      <tr>
                                                          <th scope="row">#6523</th>
                                                          <td>September 10, 2020</td>
                                                          <td>Processing</td>
                                                          <td>$326.63 for 3 items</td>
                                                          <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                      </tr>
                                                      <tr>
                                                          <th scope="row">#6523</th>
                                                          <td>September 10, 2020</td>
                                                          <td>Processing</td>
                                                          <td>$326.63 for 3 items</td>
                                                          <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                      </tr>
                                                      <tr>
                                                          <th scope="row">#6523</th>
                                                          <td>September 10, 2020</td>
                                                          <td>Processing</td>
                                                          <td>$326.63 for 3 items</td>
                                                          <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade show active" id="nav-downloads" role="tabpanel">
                                      <div class="axil-dashboard-overview">
                                          <div class=""
                                              style="display: flex; flex-direction:row; justify-content:space-between;">
                                              <div class="welcome-text">Votre Boutique</div>
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
                                                          <a href="{{ route('detail_product') }}">
                                                              <img src="assets/images/product/electric/product-02.png"
                                                                  alt="Product Images">
                                                          </a>
                                                          <div class="product-hover-action">
                                                              <ul class="cart-action">
                                                                  {{-- <li class="wishlist"><a href="wishlist.html"><i
                                                                          class="far fa-heart"></i></a></li> --}}
                                                                  <li class="quickview"><a href="#"
                                                                          data-bs-toggle="modal"
                                                                          data-bs-target="#quick-view-modal"><i
                                                                              class="far fa-eye"></i></a></li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                      <div class="product-content">
                                                          <div class="inner">
                                                              <h5 class="title"><a
                                                                      href="{{ route('detail_product') }}">Media
                                                                      remote</a></h5>
                                                              <div class="product-price-variant">
                                                                  <span class="price current-price">$40</span>
                                                                  <span class="price old-price">$50</span>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          @empty
                                              <div class="mt-4">
                                                  <div class="p-3 mb-2 bg-secondary rounded text-white">
                                                      Aucun produit trouvé
                                                  </div>
                                              </div>
                                          @endforelse
                                      </div>
                                  </div>
                                  {{-- <div class="tab-pane fade" id="nav-address" role="tabpanel">
                                      <div class="axil-dashboard-address">
                                          <p class="notice-text">The following addresses will be used on the checkout page
                                              by default.</p>
                                          <div class="row row--30">
                                              <div class="col-lg-6">
                                                  <div class="address-info mb--40">
                                                      <div
                                                          class="addrss-header d-flex align-items-center justify-content-between">
                                                          <h4 class="title mb-0">Shipping Address</h4>
                                                          <a href="#" class="address-edit"><i
                                                                  class="far fa-edit"></i></a>
                                                      </div>
                                                      <ul class="address-details">
                                                          <li>Name: Annie Mario</li>
                                                          <li>Email: annie@example.com</li>
                                                          <li>Phone: 1234 567890</li>
                                                          <li class="mt--30">7398 Smoke Ranch Road <br>
                                                              Las Vegas, Nevada 89128</li>
                                                      </ul>
                                                  </div>
                                              </div>
                                              <div class="col-lg-6">
                                                  <div class="address-info">
                                                      <div
                                                          class="addrss-header d-flex align-items-center justify-content-between">
                                                          <h4 class="title mb-0">Billing Address</h4>
                                                          <a href="#" class="address-edit"><i
                                                                  class="far fa-edit"></i></a>
                                                      </div>
                                                      <ul class="address-details">
                                                          <li>Name: Annie Mario</li>
                                                          <li>Email: annie@example.com</li>
                                                          <li>Phone: 1234 567890</li>
                                                          <li class="mt--30">7398 Smoke Ranch Road <br>
                                                              Las Vegas, Nevada 89128</li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div> --}}
                                  <div class="tab-pane fade" id="nav-account" role="tabpanel">
                                      <div class="col-lg-9">
                                          <div class="axil-dashboard-account">
                                              <form class="account-details-form">
                                                  <div class="row">
                                                      <div class="col-lg-6">
                                                          <div class="form-group">
                                                              <label>Nom</label>
                                                              <input type="text" name="name" class="form-control"
                                                                  placeholder="Entrez votre nom" value="">
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-group">
                                                              <label>Email</label>
                                                              <input type="email" name="email" class="form-control"
                                                                  placeholder="Entrez votre email" value="">
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-group">
                                                              <label>Numéro de téléphone</label>
                                                              <input type="text" name="phone_number"
                                                                  class="form-control"
                                                                  placeholder="Entrez votre numéro de téléphone"
                                                                  value="">
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-group">
                                                              <label>Adresse</label>
                                                              <input type="text" name="address" class="form-control"
                                                                  placeholder="Entrez votre adresse" value="">
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-group">
                                                              <label>Genre</label>
                                                              <select name="gender" class="form-control">
                                                                  <option value="">Sélectionnez votre genre</option>
                                                                  <option value="male">Homme</option>
                                                                  <option value="female">Femme</option>
                                                              </select>
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-group">
                                                              <label>Date de naissance</label>
                                                              <input type="date" name="date_of_birth"
                                                                  class="form-control" value="">
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-12">
                                                          <div class="form-group">
                                                              <label>Avatar</label>
                                                              <input type="file" name="avatar" class="form-control">
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <div class="form-group mb--40">
                                                              <label>Country/ Region</label>
                                                              <select class="select2">
                                                                  <option value="1">United Kindom (UK)</option>
                                                                  <option value="1">United States (USA)</option>
                                                                  <option value="1">United Arab Emirates (UAE)
                                                                  </option>
                                                                  <option value="1">Australia</option>
                                                              </select>
                                                              <p class="b3 mt--10">This will be how your name will be
                                                                  displayed in the account section and in reviews</p>
                                                          </div>
                                                      </div>
                                                      <div class="col-12">
                                                          <h5 class="title">Password Change</h5>
                                                          <div class="form-group">
                                                              <label>Password</label>
                                                              <input type="password" class="form-control"
                                                                  value="123456789101112131415">
                                                          </div>
                                                          <div class="form-group">
                                                              <label>New Password</label>
                                                              <input type="password" class="form-control">
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Confirm New Password</label>
                                                              <input type="password" class="form-control">
                                                          </div>
                                                          <div class="form-group mb--0">
                                                              <input type="submit" class="axil-btn"
                                                                  value="Save Changes">
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

          <!-- Start Axil Newsletter Area  -->
          <div class="axil-newsletter-area axil-section-gap pt--0">
              <div class="container">
                  <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                      <div class="newsletter-content">
                          <span class="title-highlighter highlighter-primary2"><i
                                  class="fas fa-envelope-open"></i>Newsletter</span>
                          <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                          <div class="input-group newsletter-form">
                              <div class="position-relative newsletter-inner mb--15">
                                  <input placeholder="example@gmail.com" type="text">
                              </div>
                              <button type="submit" class="axil-btn mb--15">Subscribe</button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- End .container -->
          </div>
          <!-- End Axil Newsletter Area  -->
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
