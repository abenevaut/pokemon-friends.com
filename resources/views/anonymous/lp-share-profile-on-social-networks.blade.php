@extends('default')

@section('title', $metadata['title'])
@section('description', $metadata['description'])

@section('content')
<section class="py-5 py-md-6">
    <div class="container">
        <div class="row">
            <div class="col-11 col-md-8 text-center mx-auto mb-4">
                <h1 class="font-weight-bold font-size-lg">{{ trans('users.welcome') }}</h1>
                <p class="lead">{{ trans('users.baseline') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-sm">
                    <span class="card-img card-img-lg">
                        <img class="card-img-top" src="{{ asset_cdn('images/pokemon-1581774_1920.jpg') }}" alt="Pokemon Go mobile">
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-center">You only need a Pokemon Go account</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-sm">
                    <span class="card-img card-img-lg">
                        <img class="card-img-top" src="{{ asset_cdn('images/hands-1167612_1920.jpg') }}" alt="Capture a qrcode">
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-center">Meet friends worldwide and connect with</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-sm">
                    <span class="card-img card-img-lg">
                        <img class="card-img-top" src="{{ asset_cdn('images/pokemon-2965902_1920.jpg') }}" alt="Pokemon Go mobile with friend">
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-center">Share gift, get opponents, won eggs & XP</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white border-top border-bottom py-0 py-md-4">
    <div class="container-fluid">
        <div class="row justify-content-around align-items-center">
            <div class="col-lg-6 px-xs-0">
                <div class="img-cover" style="min-height: 600px;">
                    <img src="{{ asset_cdn('images/qrcode-sharing.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-5 pl-md-5 pb-4 pb-md-0 mr-auto mt-4 mt-md-0 mb-2 mb-md-0">
                <div class="px-1 px-md-0">
                    <h2 class="display-5 font-weight-normal text-dark mb-5 mt-4">Share your profile on social networks</h2>
                    <p class="mb-4">Share your pkmn-friends profile easily on all your social networks, the sharing is focused to allow others trainers to add you as fast as possible, just a pic and play together!</p>
                    <div class="text-center">
                        <a class="btn btn-secondary btn-lg" href="{{ route('register') }}" role="button">Register now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
