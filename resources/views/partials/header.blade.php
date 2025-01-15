<header class="header axil-header header-style-5">
    <!-- Start Mainmenu Area -->
    <div class="axil-mainmenu">
        <div class="container">
            <div class="header-navbar">
                <div class="header-brand">
                    <a href="{{ route('home') }}" class="logo logo-dark">
                        <img src="assets/images/logo/logo.png" alt="Logo du site">
                    </a>
                    <a href="{{ route('home') }}" class="logo logo-light">
                        <img src="assets/images/logo/logo-light.png" alt="Logo du site">
                    </a>
                </div>
                <div class="header-main-nav">
                    <!-- Start Mainmenu Nav -->
                    <nav class="mainmenu-nav">
                        <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                        <div class="mobile-nav-brand">
                            <a href="{{ route('home') }}" class="logo">
                                <img src="assets/images/logo/logo.png" alt="Logo du site">
                            </a>
                        </div>
                        <ul class="mainmenu">
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="{{ route('shop') }}">Articles</a></li>
                            <li><a href="{{ route('about') }}">À propos</a></li>
                            {{-- <li><a href="{{ route('boutique') }}">Boutique</a></li> --}}
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- End Mainmenu Nav -->
                </div>
                <div class="header-action">
                    <ul class="action-list">
                        <li class="axil-search">
                            <a href="javascript:void(0)" class="header-search-icon" title="Rechercher">
                                <i class="flaticon-magnifying-glass"></i>
                            </a>
                        </li>
                        <li class="shopping-cart">
                            <a href="#" class="cart-dropdown-btn">
                                <span class="cart-count">3</span>
                                <i class="flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li class="my-account">
                            <a href="javascript:void(0)">
                                <i class="flaticon-person"></i>
                            </a>
                            <div class="my-account-dropdown">
                                <span class="title">LIENS RAPIDES</span>
                                <ul>
                                    <li>
                                        <a href="{{ route('my_account') }}">Mon compte</a>
                                    </li>
                                    <li>
                                        <a href="#">Retourner un article</a>
                                    </li>
                                    <li>
                                        <a href="#">Assistance</a>
                                    </li>
                                    <li>
                                        <a href="#">Langue</a>
                                    </li>
                                </ul>
                                @auth
                                    <div class="login-btn">
                                        <form method="post" action={{ route('logout') }}>
                                            @csrf

                                            <button type="submit" class="axil-btn btn-bg-primary">Se déconnecter</button>
                                        </form>
                                    </div>
                                @endauth
                                @guest
                                    <div class="login-btn">
                                    <a href="{{ route('login') }}" class="axil-btn btn-bg-primary">Se connecter</a>

                                    <div class="reg-footer text-center">Pas encore de compte ?
                                        <a href="{{ route('register') }}" class="btn-link">INSCRIVEZ-VOUS ICI.</a>
                                    </div>
                                    </div>
                                @endguest
                            </div>
                        </li>
                        <li class="axil-mobile-toggle">
                            <button class="menu-btn mobile-nav-toggler">
                                <i class="flaticon-menu-2"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
