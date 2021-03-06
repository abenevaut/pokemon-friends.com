@extends('customer.default')

@section('js')
<script type="text/javascript">
  (function (W, D, $) {
    $(D).ready(function() {
      $('#birth_date').flatpickr({
        enableTime: false,
        dateFormat: '{{ trans('global.date_format') }}',
        defaultDate: '{{ old('birth_date', $profile['data']['birth_date']) ?? Carbon\Carbon::create(date('Y'), 1, 1, 0, 0, 0, $profile['data']['locale']['timezone'])->subYears(18)->format(trans('global.date_format')) }}',
        minDate: '{{ Carbon\Carbon::create(date('Y'), 1, 1, 0, 0, 0, $profile['data']['locale']['timezone'])->subYears(80)->format(trans('global.date_format')) }}',
        maxDate: '{{ Carbon\Carbon::create(date('Y'), 1, 1, 0, 0, 0, $profile['data']['locale']['timezone'])->subYears(8)->format(trans('global.date_format')) }}',
        locale: {
          firstDayOfWeek: 1
        },
      });
    });
  })(window, document, jQuery);
</script>
@endsection

@section('content')
<section class="overflow-hidden py-0" data-parallax="scroll" data-image-src="{{ asset_cdn('images/david-grandmougin-Am1io6KusFM-unsplash.jpg') }}">
    <div class="overlay" ya-style="background-color: #36373a;opacity: .9"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-white py-7 mb-0 mt-3">Profile Settings</h1>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex align-items-center">
                <div class="nav-scroll">
                    <div class="nav nav-list nav-light">
                        <a class="nav-item nav-link active pl-0" href="javascript:void(0);">General</a>
                    </div>
                </div>
                <a class="btn btn-outline-light btn-icon ml-auto mb-3 d-none d-md-inline" href="{{ route('customer.users.dashboard') }}">Back to profile</a>
            </div>
        </div>
    </div>
</section>

<section class="py-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                {!! Form::open(['route' => ['customer.users.update', $profile['data']['user']['identifier']], 'class' => 'form-horizontal', 'role' => 'form', 'autoprimary' => 'off', 'novalidate' => 'novalidate', 'method' => 'PUT']) !!}
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nickname" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.nickname') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors && $errors->has('nickname') ? 'is-invalid' : '' }}" id="nickname" placeholder="{{ trans('users.nickname') }}" name="nickname" value="{{ old('nickname', $profile['data']['nickname']) }}">
                                @if ($errors && $errors->has('nickname'))
                                    <div class="text-danger text-sm">{{ $errors->first('nickname') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="friend_code" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.profiles.friend_code') }}</label>
                            <div class="col-sm-9">
                                <input
                                        type="text"
                                        class="form-control {{ $errors && $errors->has('friend_code') ? 'is-invalid' : '' }}"
                                        id="friend_code"
                                        placeholder="{{ trans('users.profiles.friend_code') }}"
                                        name="friend_code"
                                        value="{{ old('friend_code', $profile['data']['friend_code']) }}" />
                                @if ($errors && $errors->has('friend_code'))
                                    <div class="text-danger text-sm">{{ $errors->first('friend_code') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="team_color" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.profiles.team_color') }}</label>
                            <div class="col-sm-9">
                                <select name="team_color" id="team_color" class="select2 w-100 form-control">
                                    @foreach ($teams as $key)
                                        <option value="{{ $key }}" @if ($key === old('team_color', $profile['data']['team_color'])) selected="selected" @endif>
                                            {{ trans("users.profiles.teams_colors.{$key}") }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="locale" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.locale') }}</label>
                            <div class="col-sm-9">
                                <select name="locale" id="locale" class="select2 w-100 form-control">
                                    @foreach ($locales as $key)
                                        <option value="{{ $key }}" @if ($key === old('locale', $profile['data']['locale']['language'])) selected="selected" @endif>
                                            {{ trans("users.locale.{$key}") }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="timezone" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.timezone') }}</label>
                            <div class="col-sm-9">
                                <select name="timezone" id="timezone" class="select2 w-100 form-control">
                                    @foreach ($timezones as $key)
                                        <option value="{{ $key }}" @if ($key === old('timezone', $profile['data']['locale']['timezone'])) selected="selected" @endif>{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                @impersonating
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="twitch_channel" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.twitch_channel') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors && $errors->has('twitch_channel') ? 'is-invalid' : '' }}" id="twitch_channel" placeholder="{{ trans('users.twitch_channel') }}" name="twitch_channel" value="{{ old('twitch_channel', $profile['data']['twitch_channel']) }}">
                                @if ($errors && $errors->has('twitch_channel'))
                                    <div class="text-danger text-sm">{{ $errors->first('twitch_channel') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endImpersonating

                <div class="card card-info">
                    <div class="card-header">{{ trans('users.profile.info.only_admin_can_view_following_data') }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="civility" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.civility') }}</label>
                            <div class="col-sm-9">
                                <select name="civility" id="civility" class="select2 w-100 form-control">
                                    @foreach ($civilities as $key => $trans)
                                        <option
                                                value="{{ $key }}"
                                                @if (Auth::check() && $key === old('civility', $profile['data']['user']['civility'])) selected="selected" @endif
                                        >
                                            {{ $trans }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.first_name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors && $errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" placeholder="{{ trans('users.first_name') }}" name="first_name" value="{{ old('first_name', $profile['data']['user']['first_name']) }}">
                                @if ($errors && $errors->has('first_name'))
                                    <div class="text-danger text-sm">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.last_name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors && $errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" placeholder="{{ trans('users.last_name') }}" name="last_name" value="{{ old('last_name', $profile['data']['user']['last_name']) }}">
                                @if ($errors && $errors->has('last_name'))
                                    <div class="text-danger text-sm">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                        {{--                            <div class="form-group row">--}}
                        {{--                                <label for="family_situation" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.profiles.family_situation') }}</label>--}}
                        {{--                                <div class="col-sm-9">--}}
                        {{--                                    <select name="family_situation" class="select2 w-100 form-control">--}}
                        {{--                                        @foreach ($families_situations as $key => $trans)--}}
                        {{--                                            <option value="{{ $key }}" @if ($key === $profile['data']['family_situation']['key']) selected="selected" @endif>{{ $trans }}</option>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </select>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="form-group row">--}}
                        {{--                                <label for="maiden_name" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.profiles.maiden_name') }}</label>--}}
                        {{--                                <div class="col-sm-9">--}}
                        {{--                                    <input type="text" class="form-control" id="maiden_name" placeholder="{{ trans('users.profiles.maiden_name') }}" name="maiden_name" value="{{ $profile['data']['maiden_name'] }}">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        <div class="form-group row">
                            <label for="birth_date" class="col-sm-3 col-form-label text-sm-right">{{ trans('users.profiles.birth_date') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors && $errors->has('birth_date') ? 'is-invalid' : '' }}" id="birth_date" placeholder="{{ trans('users.profiles.birth_date') }}" name="birth_date" value="{{ old('birth_date', $profile['data']['birth_date']) }}" readonly="readonly"/>
                                @if ($errors && $errors->has('birth_date'))
                                    <div class="text-danger text-sm">{{ $errors->first('birth_date') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">{{ trans('global.record') }}</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        {{ trans('users.profiles.providers_tokens') }}
                    </div>
                    <div class="card-body">
                        <a class="btn btn-block btn-default btn-google-plus" href="{{ route('login_provider', ['provider' => \pkmnfriends\Infrastructure\Domain\Users\ProvidersTokens\ProvidersInterface::GOOGLE]) }}">
                            <span class="pull-left"><i class="fab fa-google"></i></span>
                            <span class="bold">{{ trans('auth.link_google') }}</span>
                        </a>
                        <a class="btn btn-block btn-primary btn-twitter" href="{{ route('login_provider', ['provider' => \pkmnfriends\Infrastructure\Domain\Users\ProvidersTokens\ProvidersInterface::TWITTER]) }}">
                            <span class="pull-left"><i class="fab fa-twitter"></i></span>
                            <span class="bold">{{ trans('auth.link_twitter') }}</span>
                        </a>
                    </div>
                </div>

                {!! Form::open(['route' => ['customer.users.email', $profile['data']['user']['identifier']], 'class' => 'form-horizontal', 'role' => 'form', 'autoprimary' => 'off', 'novalidate' => 'novalidate', 'method' => 'POST']) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('users.change_email') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="text"
                                        name="email"
                                        class="form-control {{ $errors && $errors->has('email') ? 'is-invalid' : '' }}"
                                        placeholder="{{ trans('users.email') }}"
                                />
                            </div>
                            @if ($errors && $errors->has('email'))
                                <div class="text-danger text-sm">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">{{ trans('global.record') }}</button>
                    </div>
                </div>
                {{ Form::close() }}

                {!! Form::open(['route' => ['customer.users.password', $profile['data']['user']['identifier']], 'class' => 'form-horizontal', 'role' => 'form', 'autoprimary' => 'off', 'novalidate' => 'novalidate', 'method' => 'PUT']) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('users.change_password') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="password"
                                        name="password_current"
                                        class="form-control {{ $errors && $errors->has('password_current') ? 'is-invalid' : '' }}"
                                        placeholder="{{ trans('users.password_current') }}"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors && $errors->has('password_current'))
                                <div class="text-danger text-sm">{{ $errors->first('password_current') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
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
                            </div>
                            @if ($errors && $errors->has('password'))
                                <div class="text-danger text-sm">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
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
                            </div>
                            @if ($errors && $errors->has('password_confirmation'))
                                <div class="text-danger text-sm">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">{{ trans('global.record') }}</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection
