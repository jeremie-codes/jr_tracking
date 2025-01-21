@extends('layouts.app')

@section('content')
<section class="error-page onepage-screen-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="content" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                    <span class="title-highlighter highlighter-secondary">
                        <i class="fal fa-exclamation-circle"></i> Oups ! Accès refusé.
                    </span>
                    <h1 class="title">Erreur 403 - Accès interdit</h1>
                    <p>Il semble que vous n'ayez pas la permission d'accéder à cette page. Veuillez vérifier vos droits
                        ou contacter l'administrateur si vous pensez qu'il s'agit d'une erreur.</p>
                    <a href="{{ route('home') }}" class="axil-btn btn-bg-secondary right-icon">
                        Retour à l'accueil <i class="fal fa-long-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="thumbnail" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">
                    <img src="assets/images/others/403.png" alt="403">
                    <!-- Changez l'image pour une illustration 403 -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection