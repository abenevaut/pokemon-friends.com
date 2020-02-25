@extends('anonymous.default')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">{{ trans('pokemon.welcome') }}</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        @if(Auth::check())
        <trainers-profiles-list-component></trainers-profiles-list-component>
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        Inscrivez-vous pour partager votre code ami et ajouter de nouvelles connaissances!
                        <ul>
                            <li>Partagez des cados</li>
                            <li>Obtenez des oeufs régionaux</li>
                            <li>Boostez votre XP</li>
                        </ul>


                        // en
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=en&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                        // fr
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=fr&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
