<!-- Start Axil Product Poster Area  -->
<div class="axil-poster">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb--30">
                <div class="single-poster">
                    <a href="{{ route('articles') }}">
                        <img src="{{ asset('assets/images/bg/bg-image-5.jpg') }}" alt="eTrade promotion poster">
                        <div class="poster-content">
                        </div>
                        <!-- End .poster-content -->
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Axil Product Poster Area  -->

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
                            <p>info@e-galeria.com, <br>
                                +243 994 853 896
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">Compte</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="#">Mon Compte</a></li>
                                <li><a href="{{ route('register') }}">Se Connecter / S'inscrire</a></li>
                                {{-- <li><a href="wishlist.html">Boutique</a></li> --}}
                                <li><a href="{{ route('articles') }}">Articles</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">Liens rapides</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{ route('home') }}">Accueil</a></li>
                                <li><a href="{{ route('articles') }}">Articles</a></li>
                                {{-- <li><a href="#">Boutiques</a></li> --}}
                                <li><a href="{{ route('about') }}">À propos</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">Télécharger l'App</h5>
                        <div class="inner">
                            <div class="download-btn-group">
                                <div class="app-link">
                                    <a href="#">
                                        <img src="{{asset('assets/images/others/app-store.png')}}" alt="App Store">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('assets/images/others/play-store.png')}}" alt="Play Store">
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
            <div class="row d-flex justify-content-center align-items-center">
                {{-- <div class="col-xl-4">
                    <div class="social-share">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-discord"></i></a>
                    </div>
                </div> --}}
                <div class="col-xl-4 col-lg-12">
                    <div class="copyright-left d-flex flex-wrap justify-content-center">
                        <ul class="quick-link">
                            <li>© 2025. E-Galeria | Made by <a target="_blank"
                                    href="https://mastagate.com/">Mastagate</a>.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->
</footer>
