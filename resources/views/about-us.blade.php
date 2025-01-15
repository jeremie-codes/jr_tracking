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

    <!-- Début de la section Informations supplémentaires -->
    <div class="about-info-area">
        <div class="container">
            <div class="row row--20">
                <div class="col-lg-4">
                    <div class="about-info-box">
                        <div class="thumb">
                            <img src="assets/images/about/shape-01.png" alt="Forme">
                        </div>
                        <div class="content">
                            <h6 class="title">40 000+ clients satisfaits</h6>
                            <p>Donnez à vos équipes de vente les outils nécessaires avec des solutions adaptées à
                                l'industrie.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-info-box">
                        <div class="thumb">
                            <img src="assets/images/about/shape-02.png" alt="Forme">
                        </div>
                        <div class="content">
                            <h6 class="title">16 ans d'expérience</h6>
                            <p>Donnez à vos équipes de vente les outils nécessaires avec des solutions adaptées à
                                l'industrie.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-info-box">
                        <div class="thumb">
                            <img src="assets/images/about/shape-03.png" alt="Forme">
                        </div>
                        <div class="content">
                            <h6 class="title">12 récompenses gagnées</h6>
                            <p>Donnez à vos équipes de vente les outils nécessaires avec des solutions adaptées à
                                l'industrie.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la section Informations supplémentaires -->

    <!-- Début de la section Équipe -->
    <div class="axil-team-area bg-wild-sand">
        <div class="team-left-fullwidth">
            <div class="container ml--xxl-0">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"> <i class="fas fa-users"></i> Notre
                        équipe</span>
                    <h3 class="title">Équipe de gestion experte</h3>
                </div>
                <div class="team-slide-activation slick-layout-wrapper--20 axil-slick-arrow  arrow-top-slide">
                    <div class="slick-single-layout">
                        <div class="axil-team-member">
                            <div class="thumbnail"><img src="./assets/images/team/team-01.png" alt="Cody Fisher"></div>
                            <div class="team-content">
                                <span class="subtitle">Fondatrice</span>
                                <h5 class="title">Rosalina D. Willson</h5>
                            </div>
                        </div>
                    </div>
                    <div class="slick-single-layout">
                        <div class="axil-team-member">
                            <div class="thumbnail"><img src="./assets/images/team/team-02.png" alt="Cody Fisher"></div>
                            <div class="team-content">
                                <span class="subtitle">PDG</span>
                                <h5 class="title">Ukolilix X. Xilanorix</h5>
                            </div>
                        </div>
                    </div>
                    <div class="slick-single-layout">
                        <div class="axil-team-member">
                            <div class="thumbnail"><img src="./assets/images/team/team-03.png" alt="Cody Fisher"></div>
                            <div class="team-content">
                                <span class="subtitle">Designer</span>
                                <h5 class="title">Alonso M. Miklonax</h5>
                            </div>
                        </div>
                    </div>
                    <div class="slick-single-layout">
                        <div class="axil-team-member">
                            <div class="thumbnail"><img src="./assets/images/team/team-04.png" alt="Cody Fisher"></div>
                            <div class="team-content">
                                <span class="subtitle">Designer</span>
                                <h5 class="title">Alonso M. Miklonax</h5>
                            </div>
                        </div>
                    </div>
                    <div class="slick-single-layout">
                        <div class="axil-team-member">
                            <div class="thumbnail"><img src="./assets/images/team/team-02.png" alt="Cody Fisher">
                            </div>
                            <div class="team-content">
                                <span class="subtitle">Designer</span>
                                <h5 class="title">Alonso M. Miklonax</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la section Équipe -->

    <!-- Début de la section Fonctionnalités -->
    <div class="axil-about-area about-style-2">
        <div class="container">
            <div class="row align-items-center mb--80 mb_sm--60">
                <div class="col-lg-5">
                    <div class="about-thumbnail">
                        <img src="assets/images/about/about-02.png" alt="À propos">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-content content-right">
                        <span class="subtitle">Fonctionnalité #01</span>
                        <h4 class="title">Des solutions qui fonctionnent ensemble</h4>
                        <p>Publiez votre site e-commerce rapidement avec notre constructeur de boutique facile à
                            utiliser—aucun codage requis. Migrez vos articles depuis votre système de point de vente ou
                            transformez votre fil Instagram en une boutique en ligne et commencez à vendre rapidement.
                            E-GALERIA fonctionne pour tous les types d'entreprises—détaillants, restaurants, services.
                        </p>
                        <a href="contact.html" class="axil-btn btn-outline">Nous contacter</a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 order-lg-2">
                    <div class="about-thumbnail">
                        <img src="assets/images/about/about-03.png" alt="À propos">
                    </div>
                </div>
                <div class="col-lg-7 order-lg-1">
                    <div class="about-content content-left">
                        <span class="subtitle">Fonctionnalité #01</span>
                        <h4 class="title">Des solutions qui fonctionnent ensemble</h4>
                        <p>Publiez votre site e-commerce rapidement avec notre constructeur de boutique facile à
                            utiliser—aucun codage requis. Migrez vos articles depuis votre système de point de vente ou
                            transformez votre fil Instagram en une boutique en ligne et commencez à vendre rapidement.
                            E-GALERIA fonctionne pour tous les types d'entreprises—détaillants, restaurants, services.
                        </p>
                        <a href="contact.html" class="axil-btn btn-outline">Nous contacter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la section Fonctionnalités -->

    <!-- Début de la section Newsletter -->
    <div class="axil-newsletter-area axil-section-gap">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i
                            class="fas fa-envelope-open"></i>Newsletter</span>
                    <h2 class="title mb--40 mb_sm--30">Recevez des mises à jour hebdomadaires</h2>
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
<div class="service-area">
    <div class="container">
        <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="./assets/images/icons/service1.png" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">Livraison rapide et sécurisée</h6>
                        <p>Parlez de votre service.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="./assets/images/icons/service2.png" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">Garantie de remboursement</h6>
                        <p>Dans les 10 jours.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="./assets/images/icons/service3.png" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">Politique de retour sous 24 heures</h6>
                        <p>Aucune question posée.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="./assets/images/icons/service4.png" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">Support de qualité professionnelle</h6>
                        <p>Assistance 24/7.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de la section Services -->
@endsection