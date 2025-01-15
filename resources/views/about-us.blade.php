@extends('layouts.app')

@section('content')
<main class="main-wrapper">
    <!-- Début de la section Fil d'Ariane -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">À propos de nous</li>
                        </ul>
                        <h1 class="title">À propos de notre boutique</h1>
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
    <!-- Fin de la section Fil d'Ariane -->

    <!-- Début de la section À propos -->
    <div class="axil-about-area about-style-1 axil-section-gap ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="about-thumbnail">
                        <div class="thumbnail">
                            <img src="./assets/images/about/about-01.png" alt="À propos de nous">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6">
                    <div class="about-content content-right">
                        <span class="title-highlighter highlighter-primary2"> <i class="far fa-shopping-basket"></i>À
                            propos de la boutique</span>
                        <h3 class="title">Le shopping en ligne inclut l'achat de produits en ligne.</h3>
                        <span class="text-heading">E-GALERIA vous permet de créer des expériences de commerce numérique
                            unifiées et intelligentes, que ce soit en ligne ou en magasin.</span>
                        <div class="row">
                            <div class="col-xl-6">
                                <p>Donnez à vos équipes de vente les outils nécessaires avec des solutions adaptées à
                                    l'industrie, soutenant les fabricants dans leur transition numérique et leur
                                    permettant de s'adapter plus rapidement aux marchés et aux clients en constante
                                    évolution.</p>
                            </div>
                            <div class="col-xl-6">
                                <p class="mb--0">E-GALERIA offre aux acheteurs une expérience fluide et en
                                    libre-service, similaire à celle du shopping en ligne, tout en répondant aux besoins
                                    des entreprises B2B.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la section À propos -->

    <!-- Début de la section Newsletter -->
    <div class="axil-newsletter-area axil-section-gap">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i
                            class="fas fa-envelope-open"></i>Newsletter</span>
                    {{-- <h2 class="title mb--40 mb_sm--30">Recevez des mises à jour hebdomadaires</h2> --}}
                    <div class="input-group newsletter-form">
                        <div class="position-relative newsletter-inner mb--15">
                            <input placeholder="exemple@gmail.com" type="text">
                        </div>
                        <button type="submit" class="axil-btn mb--15">S'abonner</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin .container -->
    </div>
    <!-- Fin de la section Newsletter -->
</main>

<!-- Début de la section Services -->
@endsection
