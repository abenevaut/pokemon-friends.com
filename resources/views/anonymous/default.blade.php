<!DOCTYPE html>
<html lang="{{ Session::get('locale') }}">
<head>
    @include('partials.metadata')
</head>
<body class="fixed-navbar">
@include('partials.googletag-body')
<div id="template" class="site">
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ya ya-bar"></i>
                </button>
                <a class="navbar-brand" href="{{ route('anonymous.dashboard') }}">{{ config('app.name') }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('anonymous.dashboard') }}" class="nav-link @if (Route::currentRouteNamed('anonymous.dashboard')) active @endif">
                                @if(Auth::check())
                                    <i class="fas fa-tachometer-alt mr-2"></i>{{ trans('users.dashboard') }}
                                @else
                                    <i class="fas fa-home mr-2"></i>{{ trans('users.home') }}
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('anonymous.contact.index') }}" class="nav-link @if (Route::currentRouteNamed('anonymous.contact.index')) active @endif"><i class="fas fa-envelope mr-2"></i>{{ trans('users.leads.contact') }}</a>
                        </li>
                    </ul>
                </div>
                <!-- end .navbar-collapse -->

{{--                <form class="navbar-search" action="search.html" method="post">--}}
{{--                    <div class="container">--}}
{{--                        <input class="form-control mr-sm-2" type="search" placeholder="Search for games, posts..." aria-label="Search">--}}
{{--                        <i class="ya ya-times search-close"></i>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <!-- end .navbar-search -->

                <ul class="navbar-nav navbar-right flex-row d-flex align-items-center">
                    @if(Auth::check())
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"><i class="fa fa-sign-out-alt mr-2"></i>{{ trans('auth.logout') }}</a>
                        </li>
                    @else
{{--                        @if (Route::currentRouteNamed(Route::currentRouteName()))--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-language"></i></a>--}}
{{--                                <div class="dropdown-menu dropdown-menu-sm-right dropdown-menu-right">--}}
{{--                                    @foreach(\template\Infrastructure\Interfaces\Domain\Locale\LocalesInterface::LOCALES as $locale)--}}
{{--                                        @if (Session::get('locale') !== $locale)--}}
{{--                                            <a href="{{ route(Route::currentRouteName(), ['locale' => $locale]) }}" class="dropdown-item">--}}
{{--                                                <i class="far fa-flag mr-2"></i>{{ trans("users.locale.${locale}") }}--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endif--}}
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link"><i class="fa fa-sign-in-alt mr-2"></i>{{ trans('auth.login') }}</a>
                        </li>
                    @endif
                    @impersonating
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('impersonate.leave') }}"><i class="fa fa-user-times mr-2"></i>{{ trans('users.stop_impersonation') }}</a>
                    </li>
                    @endImpersonating
{{--                    <li class="nav-item"><a class="nav-link toggle-search" href="#"><i class="ya ya-search"></i></a></li>--}}
                </ul>
                <!-- end .navbar-nav -->
            </div>
        </nav>
    </header>
    <!-- end .site-header -->

    <div class="site-content" role="main">

    @yield('content')

    <footer class="site-footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0 pb-1 pb-md-0">
                    <div class="footer-title">About Gameforest</div>
                    <p>Gameforest is a Bootstrap Gaming theme what is built on the world's most popular front-end framework. Clean and well coded professional front-end files are included in your downloaded package.</p>
{{--                    <a class="btn btn-outline-light mt-2" href="https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730" target="_blank" role="button">Purchase theme</a>--}}
                </div>
                <div class="col-md-4 mb-4 mb-md-0 pb-1 pb-md-0">
                    <div class="footer-title">Most represented regions</div>
                    <div class="footer-tags">
                        <a href="#">Playstation 4</a>
                        <a href="#">Xbox One</a>
                        <a href="#">God of War</a>
                        <a href="#">Bioshock</a>
                        <a href="#">Uncharted 4</a>
                        <a href="#">Uplay</a>
                        <a href="#">Steam</a>
                        <a href="#">Wordpress</a>
                        <a href="#">Rachet</a>
                        <a href="#">Github</a>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::open(['route' => ['register'], 'method' => 'POST']) !!}
                    @honeypot
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
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container d-flex flex-column flex-md-row">
                <div class="order-2 order-md-1">
                    <div class="footer-links d-none d-md-inline-block">
                        <a href="{{ route('anonymous.terms') }}" target="_blank" rel="noopener">{{ trans('users.terms') }}</a>
                        <a href="{{ config('services.github.changelog') }}" target="_blank" rel="noopener">Changelog</a>
                    </div>
                    <p class="footer-copyright">{!! trans('global.copyright', ['date' => date('Y'), 'route' => route('anonymous.dashboard'), 'name' => config('app.name')]) !!}</p>
                </div>
                <div class="footer-social order-1 order-md-2 ml-md-auto text-center text-md-right">
                    <span class="d-none d-sm-block mb-2">{{ trans('global.social_networks_baseline') }}</span>
{{--                    <a href="https://facebook.com/yakuthemes" target="_blank" rel="noopener" data-toggle="tooltip" title="facebook"><i class="ya ya-facebook"></i></a>--}}
                    <a href="{{ config('services.twitter.url') }}" target="_blank" rel="noopener" data-toggle="tooltip" title="twitter.com"><i class="ya ya-twitter"></i></a>
{{--                    <a href="#" target="_blank" rel="noopener" data-toggle="tooltip" title="instagram"><i class="ya ya-instagram"></i></a>--}}
                    <a href="{{ config('services.discord.url') }}" target="_blank" rel="noopener" data-toggle="tooltip" title="discord.com"><i class="ya ya-discord"></i></a>
{{--                    <a href="#" target="_blank" rel="noopener" data-toggle="tooltip" title="youtube"><i class="ya ya-youtube"></i></a>--}}
                    <a href="{{ config('services.github.url') }}" target="_blank" rel="noopener" data-toggle="tooltip" title="github.com"><i class="ya ya-github"></i></a>
{{--                    <a href="#" target="_blank" rel="noopener" data-toggle="tooltip" title="twitch"><i class="ya ya-twitch"></i></a>--}}
                </div>
            </div>
        </div>
    </footer>
    <!-- end .site-footer -->
</div>
<!-- end .site -->
@if(!Auth::check())
    @include('cookieConsent::index')
@endif
@include('partials.scripts')
</body>
</html>
