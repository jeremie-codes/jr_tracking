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
                          <div class="col-lg-12">
                              <div class="axil-dashboard-account">
                                  <form class="account-details-form">
                                      <div class="row">
                                          <!-- Upload d'image -->
                                          <div class="col-lg-12">
                                              <div class="form-group">
                                                  <label for="image">Image</label>
                                                  <input type="file" name="image" id="image" class="form-control"
                                                      required>
                                              </div>
                                          </div>

                                          <!-- Sélection de la boutique -->
                                          <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label for="shop_id">Boutique</label>
                                                  <select name="shop_id" id="shop_id" class="form-control" required>
                                                      <option value="">Sélectionnez une boutique</option>
                                                      <!-- Options dynamiques via une relation -->
                                                  </select>
                                              </div>
                                          </div>

                                          <!-- Sélection de la catégorie -->
                                          <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label for="category_id">Catégorie</label>
                                                  <select name="category_id" id="category_id" class="form-control" required>
                                                      <option value="">Sélectionnez une catégorie</option>
                                                      <!-- Options dynamiques via une relation -->
                                                  </select>
                                              </div>
                                          </div>

                                          <!-- Disponibilité -->
                                          <div class="col-lg-12">
                                              <div class="form-group">
                                                  <label for="available">Disponible</label>
                                                  <select name="available" id="available" class="form-control" required>
                                                      <option value="1">Actif</option>
                                                      <option value="0">Inactif</option>
                                                  </select>
                                              </div>
                                          </div>

                                          <!-- Nom et slug -->
                                          <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label for="name">Nom</label>
                                                  <input type="text" name="name" id="name" class="form-control"
                                                      required autofocus>
                                              </div>
                                          </div>

                                          <!-- Prix -->
                                          <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label for="price">Prix</label>
                                                  <input type="number" name="price" id="price" class="form-control"
                                                      required>
                                              </div>
                                          </div>

                                          <!-- Description -->
                                          <div class="col-lg-12">
                                              <div class="form-group">
                                                  <label for="description">Description</label>
                                                  <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                                              </div>
                                          </div>

                                          <!-- Bouton de soumission -->
                                          <div class="col-lg-12">
                                              <div class="form-group">
                                                  <input type="submit" class="btn btn-primary" value="Enregistrer">
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
