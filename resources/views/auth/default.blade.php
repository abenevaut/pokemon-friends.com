<!DOCTYPE html>
<html lang="{{ Session::get('locale') }}">
<head>
    @include('partials.metadata')
</head>
<body class="hold-transition login-page"

      style="background-color:#41474c;"

>
@include('partials.googletag-body')
<div id="template" class="login-box">
    <div class="login-logo">
        <a href="{{ route('anonymous.dashboard') }}"

           class="text-light"

        >{{ config('app.name') }}</a>
    </div>
    <div class="card">
        @yield('content')
    </div>
</div>
@include('partials.scripts')
</body>
</html>
