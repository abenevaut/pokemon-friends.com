@extends('anonymous.default')

@section('title', $metadata['title'])
@section('description', $metadata['description'])

@section('content')

    <section class="py-5 py-md-6">
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 text-center mx-auto mb-4">
                    <i class="fas fa-qrcode icon"></i>
                    <h2 class="font-weight-bold font-size-lg">Recent Games at Gameforest</h2>
                    <p class="lead">Two assure edward whence the was. Who worthy yet ten boy denote wonder. Weeks views her sight old tears sorry.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-sm">
                        <a class="card-img card-img-lg" href="game-post.html">
                            <img class="card-img-top" src="{{ asset_cdn('images/pokemon-1581774_1920.jpg') }}" alt="God of War">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="ya ya-check-circle text-success" data-toggle="tooltip" data-placement="bottom" data-title="Available"></i>
                                <a href="game-post.html">God of War</a>
                            </h5>
                            <p class="card-tex font-size-md mb-0">His vengeance against the Gods of Olympus years behind him, Kratos now lives as a man in the realm of Norse Gods and mon...</p>
                        </div>
                        <div class="card-footer">
                            <span><i class="ya ya-calendar"></i> April 23, 2018</span>
                            <div class="ml-auto">
                                <a href="#"><i class="ya ya-comment"></i> 675</a>
                                <a class="ml-1" href="#"><i class="ya ya-heart-o"></i> 49</a>
                            </div>
                        </div>
                    </div>
                    <!-- end .card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-sm">
                        <a class="card-img card-img-lg" href="game-post.html">
                            <span class="badge badge-danger">new</span>
                            <img class="card-img-top" src="{{ asset_cdn('images/pokemon-2965902_1920.jpg') }}" alt="Marvel's Spider-Man">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="ya ya-check-circle text-success" data-toggle="tooltip" data-placement="bottom" data-title="Available"></i>
                                <a href="game-post.html">Marvel's Spider-Man</a>
                            </h5>
                            <p class="card-tex font-size-md mb-0">This isn’t the Spider-Man you’ve met or ever seen before. After eight years behind the mask, Peter Parker is more experi...</p>
                        </div>
                        <div class="card-footer">
                            <span><i class="ya ya-calendar"></i> September 12, 2018</span>
                            <div class="ml-auto">
                                <a href="#"><i class="ya ya-comment"></i> 103</a>
                                <a class="ml-1" href="#"><i class="ya ya-heart-o"></i> 581</a>
                            </div>
                        </div>
                    </div>
                    <!-- end .card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-sm">
                        <a class="card-img card-img-lg" href="game-post.html">
                            <img class="card-img-top" src="{{ asset_cdn('images/hands-1167612_1920.jpg') }}" alt="Forza Horizon 4">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="ya ya-check-circle text-success" data-toggle="tooltip" data-placement="bottom" data-title="Available"></i>
                                <a href="game-post.html">Forza Horizon 4</a>
                            </h5>
                            <p class="card-tex font-size-md mb-0">In Forza Horizon 4, you’re in charge of the Horizon Seasons. Customize everything, hire and fire your friends, and explo...</p>
                        </div>
                        <div class="card-footer">
                            <span><i class="ya ya-calendar"></i> October 05, 2018</span>
                            <div class="ml-auto">
                                <a href="#"><i class="ya ya-comment"></i> 89</a>
                                <a class="ml-1" href="#"><i class="ya ya-heart-o"></i> 44</a>
                            </div>
                        </div>
                    </div>
                    <!-- end .card -->
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-secondary btn-lg mt-3" href="games.html" role="button">Browse Games</a>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 px-0 mx-auto">
                    <div class="d-flex align-items-center position-relative overflow-hidden py-5 py-md-7 px-3 px-xl-0" data-parallax="scroll" data-image-src="{{ asset_cdn('images/pokemon-go-1569794_1920.jpg') }}" style="min-height: 500px">
                        <div class="overlay" ya-style="background-color: #292b2f"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 order-2 order-md-1 text-center text-sm-left">
                                    <h2 class="display-5 font-weight-bold text-white">Castlevania Review</h2>
                                    <p class="text-light">Konami's famed vampire hunting series made its debut on the PlayStation with Castlevania: Lament of Innocence. It tells the story of the Belmont family's first encounter...</p>
                                    <div class="d-flex d-sm-block flex-column mt-3 pt-3">
                                        <a class="btn btn-primary btn-shadow btn-rounded btn-lg mb-2 mb-sm-0" href="review-post.html" role="button">Read Review</a>
                                        <a class="btn btn-outline-light btn-rounded btn-lg ml-sm-2" href="#" role="button">Write Review <i class="ya ya-pen"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4 order-1 order-md-2 d-flex align-items-md-center justify-content-center justify-content-md-end text-center mb-4 mb-md-0">
                                    <div>
                                        <p class="font-weight-semibold text-white d-none d-md-inline-block">Gameforest</p>
                                        <a class="easypiechart" href="review-post.html" data-percent="89" data-scale-color="#e3e3e3" data-bar-color="#5eb404"><span class="easypiechart-text">89%</span></a>
                                    </div>
                                    <div class="ml-3 d-none d-md-inline-block">
                                        <p class="font-weight-semibold text-white">MetaCritic</p>
                                        <a class="review-score" href="review-post.html">9.1</a>
                                    </div>
                                    <div class="ml-3 d-none d-md-inline-block">
                                        <p class="font-weight-semibold text-white">Users</p>
                                        <a class="review-score" href="review-post.html">9.4</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-md-6">
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 text-center mx-auto mb-4">
                    <i class="fas fa-qrcode icon"></i>
                    <h2 class="font-weight-bold font-size-lg">Recent News at Gameforest</h2>
                    <p class="lead">May indulgence difficulty ham can put especially. Bringing remember for supplied her why was confined. Middleton principle did she procuring.</p>
                </div>
            </div>
            @include('partials.row_trainers', ['trainers' => $users])
            <div class="text-center mt-2 mb-3">
                <a class="btn btn-secondary btn-lg" href="blog.html" role="button">Read More</a>
            </div>
        </div>
    </section>

    <section class="bg-image py-0 py-lg-3 py-xl-6" ya-style="background-color: #2e2f2f">
        <img class="background" src="http://i3.ytimg.com/vi/2GNw1j7fepI/maxresdefault.jpg" alt="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div ya-embed="https://www.youtube.com/watch?v=2GNw1j7fepI" ya-title="Pokémon GO - Making Friends" ya-length="1:35">
                        <img src="http://i3.ytimg.com/vi/2GNw1j7fepI/maxresdefault.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary py-0">
        <div class="container">
            <div class="promo">
                <h2 class="promo-title h4">Build your professional gaming website with Gameforest</h2>
                <a class="btn btn-outline-light mt-4 mt-lg-0 ml-md-4"
                   target="_blank"
                   rel="noopener noreferrer nofollow"
                   href="https://niantic.helpshift.com/a/pokemon-go/?p=web&l={{ Session::get('locale') }}&s=friends-gifting-and-trading&f=friend-list-friendship-levels"
                   role="button"
                >
                    {{ trans('global.official_documentation') }}
                </a>
            </div>
        </div>
    </section>
    </div>
    <!-- end .site-content -->



<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark text-center">{{ trans('users.baseline') }}</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="d-none d-md-block col-lg-8">
                <div class="card card-widget widget-user">
                    <div class="ribbon-wrapper ribbon-lg"><div class="ribbon bg-danger">{{ trans('global.beta') }}</div></div>
                    <div class="widget-user-header text-white" style="background:url({{ asset_cdn('images/pokemon-banner.jpg') }}) no-repeat center center;">
                        <h3 class="widget-user-username text-left">{{ trans('users.welcome') }}</h3>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset_cdn('images/avatar.jpg') }}" alt="Avatar">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <span class="description-text">{{ trans('users.anonymous.dashboard.share_gift') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <span class="description-text">{{ trans('users.anonymous.dashboard.fight_friend') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <span class="description-text">{{ trans('users.anonymous.dashboard.boost_xp') }}</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {!! trans('users.anonymous.dashboard.features', ['home_url' => route('anonymous.dashboard'), 'app_name' => config('app.name')]) !!}
                    </div>
                </div>
                <div class="card card-widget widget-user">
                    <div class="ribbon-wrapper ribbon-lg"><div class="ribbon bg-info">{{ trans('global.to_come_up') }}</div></div>
                    <div class="card-body">
                        {!! trans('users.anonymous.dashboard.to_come_up', ['home_url' => route('anonymous.dashboard'), 'app_name' => config('app.name')]) !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @include('partials.card_register')
                @include('partials.card_official_doc')
                @include('partials.card_our_news')
            </div>
        </div>

    </div>
</div>
@endsection
