<!DOCTYPE html>
<html lang="{{ Session::get('locale') }}">
<head>
    @include('partials.metadata')
</head>
<body class="hold-transition sidebar-mini @if (Auth::user()->profile->is_sidebar_pined) sidebar-collapse @else layout-fixed @endif">
<div id="template" class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <collapse-sidebar-component></collapse-sidebar-component>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link"><i class="fa fa-sign-out-alt mr-2"></i>{{ trans('auth.logout') }}</a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('administrator.users.dashboard') }}" class="brand-link">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('images/logo.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('administrator.users.profiles.edit', ['id' => Auth::user()->uniqid]) }}" class="d-block">{{ Auth::user()->full_name }}</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('administrator.users.dashboard') }}" class="nav-link @if (Route::currentRouteNamed('administrator.users.dashboard')) active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview @if (
                        Route::currentRouteNamed('administrator.users.index')
                        || Route::currentRouteNamed('administrator.users.create')
                        || Route::currentRouteNamed('administrator.users.edit')
                        || Route::currentRouteNamed('administrator.users.show')
                        || Route::currentRouteNamed('administrator.users.leads.index')
                        ) menu-open @endif">
                        <a href="javascript:void(0);" class="nav-link @if (
                            Route::currentRouteNamed('administrator.users.index')
                            || Route::currentRouteNamed('administrator.users.create')
                            || Route::currentRouteNamed('administrator.users.edit')
                            || Route::currentRouteNamed('administrator.users.show')
                            || Route::currentRouteNamed('administrator.users.leads.index')
                            ) active @endif">
                            <i class="nav-icon fa fa-users"></i>
                            <p>{{ trans('users.title') }}<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('administrator.users.leads.index') }}" class="nav-link @if (Route::currentRouteNamed('administrator.users.leads.index')) active @endif">
                                    <i class="far fa-user-circle nav-icon"></i>
                                    <p>{{ trans('users.leads.title') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrator.users.index') }}" class="nav-link @if (
                                    Route::currentRouteNamed('administrator.users.index')
                                    || Route::currentRouteNamed('administrator.users.create')
                                    || Route::currentRouteNamed('administrator.users.edit')
                                    || Route::currentRouteNamed('administrator.users.show')
                                    ) active @endif">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>{{ trans('users.title') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('administrator.files.index') }}" class="nav-link @if (Route::currentRouteNamed('administrator.files.index')) active @endif">
                            <i class="nav-icon fa fa-folder-open"></i>
                            <p>{{ trans('files.title') }}</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        @if (Session::has('message-success'))
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-2 pb-2">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {!! trans(Session::get('message-success')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if (Session::has('message-error'))
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-2 pb-2">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {!! trans(Session::get('message-error')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if (Session::has('message-warning'))
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-2 pb-2">
                    <div class="col-12">
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {!! trans(Session::get('message-warning')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            {!! trans('global.version', ['version' => env('APP_VERSION')]) !!}
        </div>
        <span class="mr-0">{!! trans('global.copyright', ['date' => date('Y'), 'route' => route('anonymous.dashboard'), 'name' => config('app.name')]) !!}</span>
    </footer>
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
@include('partials.scripts')
</body>
</html>
