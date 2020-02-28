@extends('anonymous.default')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Inscrivez-vous pour partager votre code ami et ajouter de nouvelles connaissances!</h1>
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
            <div class="col-lg-8">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url(/images/pkmn-go-banner.jpg) no-repeat center center;">
                        <h3 class="widget-user-username text-right">{{ trans('pokemon.welcome') }}</h3>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="/images/avatar.png" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
{{--                                    <h5 class="description-header">3,200</h5>--}}
                                    <span class="description-text">Partagez des cados</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
{{--                                    <h5 class="description-header">13,000</h5>--}}
                                    <span class="description-text">Obtenez des oeufs régionaux</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
{{--                                    <h5 class="description-header">35</h5>--}}
                                    <span class="description-text">Boostez votre XP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    {!! Form::open(['route' => ['register'], 'method' => 'POST']) !!}
                    @honeypot
                    <div class="card-body">
                        <div class="input-group mb-2">
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
                            @if ($errors && $errors->has('friend_code'))
                                <div class="error mb-2">{{ $errors->first('friend_code') }}</div>
                            @endif
                        </div>
                        <div class="input-group mb-2">
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
                            @if ($errors && $errors->has('email'))
                                <div class="error mb-2">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="input-group mb-2">
                            <input
                                    type="password"
                                    name="password"
                                    class="form-control {{ $errors && $errors->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="{{ trans('users.password') }}"
                            />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @if ($errors && $errors->has('password'))
                                <div class="error mb-2">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="input-group mb-2">
                            <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control {{ $errors && $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                    placeholder="{{ trans('users.password_confirmation') }}"
                            />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @if ($errors && $errors->has('password_confirmation'))
                                <div class="error mb-2">{{ $errors->first('password_confirmation') }}</div>
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
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">

                        // en
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=en&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                        // fr
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=fr&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">

                        // en
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=en&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                        // fr
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=fr&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">

                        // en
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=en&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                        // fr
                        https://niantic.helpshift.com/a/pokemon-go/?p=web&l=fr&s=friends-gifting-and-trading&f=friend-list-friendship-levels

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        Boosted friends codes

                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
