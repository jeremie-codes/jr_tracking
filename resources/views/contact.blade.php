@extends('layouts.app')

@section('title', 'Contacts')

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
                            <li class="axil-breadcrumb-item active" aria-current="page">Contact</li>
                        </ul>
                        <h1 class="title">Contactez-nous</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la section Fil d'Ariane -->

    <!-- Début de la section Contact -->
    <div class="axil-contact-page-area axil-section-gap">
        <div class="container">
            <div class="axil-contact-page">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h3 class="title mb--10">Nous serions ravis d'avoir de vos nouvelles.</h3>
                            <p>Si vous avez des produits exceptionnels à vendre ou si vous souhaitez collaborer avec
                                nous, n'hésitez pas à nous envoyer un message.</p>
                            <form id="contact-form" method="POST" action="mail.php" class="axil-contact-form">
                                <div class="row row--10">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-name">Nom <span>*</span></label>
                                            <input type="text" name="contact-name" id="contact-name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-phone">Téléphone <span>*</span></label>
                                            <input type="text" name="contact-phone" id="contact-phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-email">E-mail <span>*</span></label>
                                            <input type="email" name="contact-email" id="contact-email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-message">Votre message</label>
                                            <textarea name="contact-message" id="contact-message" cols="1"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                            <button name="submit" type="submit" id="submit"
                                                class="axil-btn btn-bg-primary">Envoyer le message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-location mb--40">
                            <h4 class="title mb--20">Contact</h4>
                            <span class="phone">Téléphone : +243 987 543 586 / +243 910 178 673 </span>
                            <span class="phone">Téléphone : +243 831 786 160 / +243 856 939 499 </span>
                            <span class="email">E-mail : info@e-galeria.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la section Contact -->
</main>

@endsection
