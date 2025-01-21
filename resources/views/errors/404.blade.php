@extends('layouts.app')

@section('content')
<section class="error-page onepage-screen-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="content" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                    <span class="title-highlighter highlighter-secondary">
                        <i class="fal fa-exclamation-circle"></i> Oups ! Il manque quelque chose.
                    </span>
                    <h1 class="title">Page non trouvée</h1>
                    <p>Il semble que nous n'ayons pas trouvé ce que vous cherchiez. La page que vous recherchez n'existe
                        pas, n'est pas disponible ou ne se charge pas correctement.</p>
                    <a href="{{ route('home') }}" class="axil-btn btn-bg-secondary right-icon">
                        Retour à l'accueil <i class="fal fa-long-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="thumbnail" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">
                    <img src="assets/images/others/404.png" alt="404">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection