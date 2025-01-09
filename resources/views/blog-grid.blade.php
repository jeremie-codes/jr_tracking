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
                                 <li class="axil-breadcrumb-item active" aria-current="page">Blogs</li>
                             </ul>
                             <h1 class="title">Blog Grid</h1>
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
         <!-- Start Blog Area  -->
         <div class="axil-blog-area axil-section-gap">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-8">
                         <div class="row g-5">
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-10.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Digital Art's</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Keeping yourself safe when
                                                     buying NFTs on eTrade</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-11.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Photography</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Important updates for listing
                                                     and delisting your NFTs</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-12.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Music</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">10 tips for avoiding scams and
                                                     staying safe on the decentralized web</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-10.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Sports</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Keeping yourself safe when
                                                     buying NFTs on eTrade</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-11.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Virtual Studio</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Important updates for listing
                                                     and delisting your NFTs</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-12.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Utility</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">10 tips for avoiding scams and
                                                     staying safe on the decentralized web</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-10.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Sketch</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Keeping yourself safe when
                                                     buying NFTs on eTrade</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-11.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Digital Art's</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Important updates for listing
                                                     and delisting your NFTs</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-10.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Digital Art's</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Keeping yourself safe when
                                                     buying NFTs on eTrade</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="content-blog blog-grid">
                                     <div class="inner">
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/blog/blog-11.png" alt="Blog Images">
                                             </a>
                                             <div class="blog-category">
                                                 <a href="#">Photography</a>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <h5 class="title"><a href="blog-details.html">Important updates for listing
                                                     and delisting your NFTs</a></h5>

                                             <div class="read-more-btn">
                                                 <a class="axil-btn right-icon" href="blog-details.html">Read More <i
                                                         class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="post-pagination">
                             <nav class="navigation pagination" aria-label="Products">
                                 <ul class="page-numbers">
                                     <li><span aria-current="page" class="page-numbers current">1</span></li>
                                     <li><a class="page-numbers" href="#">2</a></li>
                                     <li><a class="page-numbers" href="#">3</a></li>
                                     <li><a class="page-numbers" href="#">4</a></li>
                                     <li><a class="page-numbers" href="#">5</a></li>
                                     <li><a class="next page-numbers" href="#"><i
                                                 class="fal fa-arrow-right"></i></a></li>
                                 </ul>
                             </nav>
                         </div>
                     </div>
                     <div class="col-lg-4">
                         <!-- Start Sidebar Area  -->
                         <aside class="axil-sidebar-area">

                             <!-- Start Single Widget  -->
                             <div class="axil-single-widget mt--40">
                                 <h6 class="widget-title">Latest Posts</h6>

                                 <!-- Start Single Post List  -->
                                 <div class="content-blog post-list-view mb--20">
                                     <div class="thumbnail">
                                         <a href="blog-details.html">
                                             <img src="assets/images/blog/blog-04.png" alt="Blog Images">
                                         </a>
                                     </div>
                                     <div class="content">
                                         <h6 class="title"><a href="blog-details.html">Dubai’s FRAME Offers its Take on
                                                 the</a></h6>
                                         <div class="axil-post-meta">
                                             <div class="post-meta-content">
                                                 <ul class="post-meta-list">
                                                     <li>Mar 27, 2022</li>
                                                     <li>300k Views</li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- End Single Post List  -->

                                 <!-- Start Single Post List  -->
                                 <div class="content-blog post-list-view mb--20">
                                     <div class="thumbnail">
                                         <a href="blog-details.html">
                                             <img src="assets/images/blog/blog-05.png" alt="Blog Images">
                                         </a>
                                     </div>
                                     <div class="content">
                                         <h6 class="title"><a href="blog-details.html">Apple presents App Best of 2020
                                                 winners</a></h6>
                                         <div class="axil-post-meta">
                                             <div class="post-meta-content">
                                                 <ul class="post-meta-list">
                                                     <li>Mar 20, 2022</li>
                                                     <li>300k Views</li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- End Single Post List  -->

                                 <!-- Start Single Post List  -->
                                 <div class="content-blog post-list-view">
                                     <div class="thumbnail">
                                         <a href="blog-details.html">
                                             <img src="assets/images/blog/blog-06.png" alt="Blog Images">
                                         </a>
                                     </div>
                                     <div class="content">
                                         <h6 class="title"><a href="blog-details.html">Gallaudet University innovation in
                                                 education</a></h6>
                                         <div class="axil-post-meta">
                                             <div class="post-meta-content">
                                                 <ul class="post-meta-list">
                                                     <li>Mar 15, 2022</li>
                                                     <li>300k Views</li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- End Single Post List  -->

                             </div>
                             <!-- End Single Widget  -->
                             <!-- Start Single Widget  -->
                             <div class="axil-single-widget mt--40">
                                 <h6 class="widget-title">Recent Viewed Products</h6>
                                 <ul class="product_list_widget recent-viewed-product">
                                     <!-- Start Single product_list  -->
                                     <li>
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/product/product-12.jpg" alt="Blog Images">
                                             </a>
                                         </div>
                                         <div class="content">
                                             <h6 class="title"><a href="blog-details.html">Men's Fashion Tshirt</a></h6>
                                             <div class="product-meta-content">
                                                 <span class="woocommerce-Price-amount amount">
                                                     <del>$30</del>
                                                     $20
                                                 </span>
                                             </div>
                                         </div>
                                     </li>
                                     <!-- End Single product_list  -->
                                     <!-- Start Single product_list  -->
                                     <li>
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/product/product-10.jpg" alt="Blog Images">
                                             </a>
                                         </div>
                                         <div class="content">
                                             <h6 class="title"><a href="blog-details.html">Nike Shoes</a></h6>
                                             <div class="product-meta-content">
                                                 <span class="woocommerce-Price-amount amount">
                                                     <del>$200</del>
                                                     $150
                                                 </span>
                                             </div>
                                         </div>
                                     </li>
                                     <!-- End Single product_list  -->
                                     <!-- Start Single product_list  -->
                                     <li>
                                         <div class="thumbnail">
                                             <a href="blog-details.html">
                                                 <img src="assets/images/product/product-11.jpg" alt="Blog Images">
                                             </a>
                                         </div>
                                         <div class="content">
                                             <h6 class="title"><a href="blog-details.html">Addidas Shoes</a></h6>
                                             <div class="product-meta-content">
                                                 <span class="woocommerce-Price-amount amount">
                                                     <del>$300</del>
                                                     $200
                                                 </span>
                                             </div>
                                         </div>
                                     </li>
                                     <!-- End Single product_list  -->
                                 </ul>

                             </div>
                             <!-- End Single Widget  -->

                             <!-- Start Single Widget  -->
                             <div class="axil-single-widget mt--40 widget_search">
                                 <h6 class="widget-title">Search</h6>
                                 <form class="blog-search" action="#">
                                     <button class="search-button"><i class="fal fa-search"></i></button>
                                     <input type="text" placeholder="Search">
                                 </form>
                             </div>
                             <!-- End Single Widget  -->

                             <!-- Start Single Widget  -->
                             <div class="axil-single-widget mt--40 widget_archive">
                                 <h6 class="widget-title">Archives List</h6>
                                 <ul>
                                     <li><a href="#">January 2020</a></li>
                                     <li><a href="#">February 2020</a></li>
                                     <li><a href="#">March 2020</a></li>
                                     <li><a href="#">April 2020</a></li>
                                 </ul>
                             </div>
                             <!-- End Single Widget  -->

                             <!-- Start Single Widget  -->
                             <div class="axil-single-widget mt--40 widget_archive_dropdown">
                                 <h6 class="widget-title">Archives Dropdown</h6>
                                 <select>
                                     <option>Select Month</option>
                                     <option>April 2020 (4)</option>
                                     <option>May 2020 (4)</option>
                                     <option>June 2020 (4)</option>
                                     <option>July 2020 (4)</option>
                                 </select>
                             </div>
                             <!-- End Single Widget  -->

                             <!-- Start Single Widget  -->
                             <div class="axil-single-widget mt--40 widget_tag_cloud">
                                 <h6 class="widget-title">Tags</h6>
                                 <div class="tagcloud">
                                     <a href="#">Design</a>
                                     <a href="#">HTML</a>
                                     <a href="#">Graphic</a>
                                     <a href="#">Development</a>
                                     <a href="#">UI/UX Design</a>
                                     <a href="#">eCommerce</a>
                                     <a href="#">CSS</a>
                                     <a href="#">JS</a>
                                 </div>
                             </div>
                             <!-- End Single Widget  -->

                         </aside>
                         <!-- End Sidebar Area -->
                     </div>
                 </div>
                 <!-- End post-pagination -->
             </div>
             <!-- End .container -->
         </div>
         <!-- End Blog Area  -->

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
     <!-- Start Footer Area  -->
     <footer class="axil-footer-area footer-style-2">
         <!-- Start Footer Top Area  -->
         <div class="footer-top separator-top">
             <div class="container">
                 <div class="row">
                     <!-- Start Single Widget  -->
                     <div class="col-lg-3 col-sm-6">
                         <div class="axil-footer-widget">
                             <h5 class="widget-title">Support</h5>
                             <!-- <div class="logo mb--30">
                                            <a href="{{ route('home') }}">
                                                <img class="light-logo" src="assets/images/logo/logo.png" alt="Logo Images">
                                            </a>
                                        </div> -->
                             <div class="inner">
                                 <p>685 Market Street, <br>
                                     Las Vegas, LA 95820, <br>
                                     United States.
                                 </p>
                                 <ul class="support-list-item">
                                     <li><a href="mailto:example@domain.com"><i class="fal fa-envelope-open"></i>
                                             example@domain.com</a></li>
                                     <li><a href="tel:(+01)850-315-5862"><i class="fal fa-phone-alt"></i> (+01)
                                             850-315-5862</a></li>
                                     <!-- <li><i class="fal fa-map-marker-alt"></i> 685 Market Street,  <br> Las Vegas, LA 95820, <br> United States.</li> -->
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <!-- End Single Widget  -->
                     <!-- Start Single Widget  -->
                     <div class="col-lg-3 col-sm-6">
                         <div class="axil-footer-widget">
                             <h5 class="widget-title">Account</h5>
                             <div class="inner">
                                 <ul>
                                     <li><a href="my-account.html">My Account</a></li>
                                     <li><a href="{{ route('sign_up') }}">Login / Register</a></li>
                                     <li><a href="cart.html">Cart</a></li>
                                     <li><a href="wishlist.html">Wishlist</a></li>
                                     <li><a href="{{ route('shop') }}">Shop</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <!-- End Single Widget  -->
                     <!-- Start Single Widget  -->
                     <div class="col-lg-3 col-sm-6">
                         <div class="axil-footer-widget">
                             <h5 class="widget-title">Quick Link</h5>
                             <div class="inner">
                                 <ul>
                                     <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                     <li><a href="terms-of-service.html">Terms Of Use</a></li>
                                     <li><a href="#">FAQ</a></li>
                                     <li><a href="contact.html">Contact</a></li>
                                     <li><a href="contact.html">Contact</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <!-- End Single Widget  -->
                     <!-- Start Single Widget  -->
                     <div class="col-lg-3 col-sm-6">
                         <div class="axil-footer-widget">
                             <h5 class="widget-title">Download App</h5>
                             <div class="inner">
                                 <span>Save $3 With App & New User only</span>
                                 <div class="download-btn-group">
                                     <div class="qr-code">
                                         <img src="assets/images/others/qr.png" alt="Axilthemes">
                                     </div>
                                     <div class="app-link">
                                         <a href="#">
                                             <img src="assets/images/others/app-store.png" alt="App Store">
                                         </a>
                                         <a href="#">
                                             <img src="assets/images/others/play-store.png" alt="Play Store">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- End Single Widget  -->
                 </div>
             </div>
         </div>
         <!-- End Footer Top Area  -->
         <!-- Start Copyright Area  -->
         <div class="copyright-area copyright-default separator-top">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-xl-4">
                         <div class="social-share">
                             <a href="#"><i class="fab fa-facebook-f"></i></a>
                             <a href="#"><i class="fab fa-instagram"></i></a>
                             <a href="#"><i class="fab fa-twitter"></i></a>
                             <a href="#"><i class="fab fa-linkedin-in"></i></a>
                             <a href="#"><i class="fab fa-discord"></i></a>
                         </div>
                     </div>
                     <div class="col-xl-4 col-lg-12">
                         <div class="copyright-left d-flex flex-wrap justify-content-center">
                             <ul class="quick-link">
                                 <li>© 2023. All rights reserved by <a target="_blank"
                                         href="https://axilthemes.com/">Axilthemes</a>.</li>
                             </ul>
                         </div>
                     </div>
                     <div class="col-xl-4 col-lg-12">
                         <div
                             class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                             <span class="card-text">Accept For</span>
                             <ul class="payment-icons-bottom quick-link">
                                 <li><img src="assets/images/icons/cart/cart-1.png" alt="paypal cart"></li>
                                 <li><img src="assets/images/icons/cart/cart-2.png" alt="paypal cart"></li>
                                 <li><img src="assets/images/icons/cart/cart-5.png" alt="paypal cart"></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- End Copyright Area  -->
     </footer>
     <!-- End Footer Area  -->
 @endsection
