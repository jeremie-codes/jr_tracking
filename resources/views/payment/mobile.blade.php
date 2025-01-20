@extends('layouts.app')

@section('title')
    E-galeria || Mobile redirection
@endsection

@section('content')
<section class="error-page onepage-screen-area">
    <div class="container">
        <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="content" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                        @if ($resultat === 'echec')
                            <span class="title-highlighter highlighter-secondary"> <i class="fal fa-exclamation-circle"></i> Oops! Le paiement n'a pas abouti</span>
                            <h1 class="title">Erreur lors du paiement</h1>
                        @else
                            <h1 class="title">Paiement éffectué</h1>
                        @endif
                        <a href="{{url('/')}}" class="axil-btn btn-bg-secondary right-icon">Back To Home <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>

            <div class="col-lg-6">
                <div class="thumbnail" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
