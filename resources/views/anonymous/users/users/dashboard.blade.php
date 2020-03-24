@extends('anonymous.default')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark text-center">{{ trans('global.baseline') }}</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        @if(!Auth::check())
        <div class="row">
            <div class="d-none d-md-block col-lg-8">
                <div class="card card-widget widget-user">
                    <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-danger">
                            {{ trans('global.beta') }}
                        </div>
                    </div>
                    <div class="widget-user-header text-white" style="background:url(/images/pokemon-banner.jpg) no-repeat center center;">
                        <h3 class="widget-user-username text-left">{{ trans('pokemon.welcome') }}</h3>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('images/avatar.jpg') }}" alt="User Avatar">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <span class="description-text">{{ trans('global.share_gift') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <span class="description-text">{{ trans('global.fight_friend') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <span class="description-text">{{ trans('global.boost_xp') }}</span>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <p>
                            <a href="{{ route('anonymous.dashboard') }}">{{ config('app.name') }}</a> est un annuaire de codes amis Pokemon GO
                        </p>
                        <ul>
                            <li>Parcourez des dizaines de codes amis et ajoutez les facilement, en une photo, sur votre jeu Pokemon Go grâce au QRcode</li>
                            <li>Inscrivez-vous pour partager votre code ami et être vous aussi ajoutez par des dresseurs de la communauté.</li>
                        </ul>

                        <p><a href="{{ route('anonymous.dashboard') }}">{{ config('app.name') }}</a>, est un site communautaire qui n'est pas une filliale de Niantic.</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    {!! Form::open(['route' => ['register'], 'method' => 'POST']) !!}
                    @honeypot
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="text"
                                        name="friend_code"
                                        class="form-control {{ $errors && $errors->has('friend_code') ? 'is-invalid' : '' }}"
                                        placeholder="{{ trans('users.profiles.friend_code') }}"
                                        value="{{ old('friend_code') }}"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-users"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors && $errors->has('friend_code'))
                                <div class="text-danger text-sm">{{ $errors->first('friend_code') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="email"
                                        name="email"
                                        class="form-control {{ $errors && $errors->has('email') ? 'is-invalid' : '' }}"
                                        placeholder="{{ trans('users.email') }}"
                                        value="{{ old('email') }}"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors && $errors->has('email'))
                                <div class="text-danger text-sm">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="sm-p-t-10 clearfix"></div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ trans('auth.register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="card">
                    <div class="card-body">
                        <iframe width="100%" src="https://www.youtube.com/embed/2GNw1j7fepI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <a
                                class="btn btn-primary btn-block"
                                target="_blank"
                                rel="noopener noreferrer nofollow"
                                href="https://niantic.helpshift.com/a/pokemon-go/?p=web&l={{ Session::get('locale') }}&s=friends-gifting-and-trading&f=friend-list-friendship-levels"
                        >
                            La documentation officiel
                        </a>
                    </div>
                </div>
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">{{ trans('global.our_news') }}</span>
                        <span class="info-box-number text-center text-muted mb-0"><a href="{{ config('services.twitter.url') }}" target="_blank" rel="noopener" title="twitter.com"><i class="fab fa-twitter mr-2"></i>Twitter</a></span>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <trainers-profiles-list-component></trainers-profiles-list-component>
    </div>
</div>
@endsection
