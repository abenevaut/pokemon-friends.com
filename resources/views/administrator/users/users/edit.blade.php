@extends('administrator.default')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-users mr-2"></i>{{ trans('users.title') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('administrator.users.index') }}">
                            <i class="fa fa-users mr-2"></i>{{ trans('users.title') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ $user['data']['civility_name'] }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {!! Form::open(['route' => ['administrator.users.update', $user['data']['identifier']], 'method' => 'PUT']) !!}
                    <div class="card-body">

                        <div class="form-group required">
                            <label class="col-sm-3 control-label">{{ trans('users.locale') }}</label>
                            <div class="col-sm-9">
                                <select name="locale" class="full-width" data-init-plugin="select2" data-disable-search="true">
                                    @foreach ($locales as $key)
                                        <option value="{{ $key }}" @if ($key === $user['data']['locale']['language']) selected="selected" @endif>{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-3 control-label">{{ trans('users.timezone') }}</label>
                            <div class="col-sm-9">
                                <select name="timezone" class="full-width" data-init-plugin="select2" data-disable-search="false">
                                    @foreach ($timezones as $key)
                                        <option value="{{ $key }}" @if ($key === $user['data']['locale']['timezone']) selected="selected" @endif>{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-3 control-label">{{ trans('users.role') }}</label>
                            <div class="col-sm-9">
                                <select name="role" class="full-width" data-init-plugin="select2"data-disable-search="true">
                                    @foreach ($roles as $key => $trans)
                                        <option value="{{ $key }}" @if ($key === $user['data']['role']['key']) selected="selected" @endif>{{ $trans }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-3 control-label">{{ trans('users.civility') }}</label>
                            <div class="col-sm-9">
                                <div class="radio radio-primary">
                                    @foreach ($civilities as $key => $trans)
                                        <input type="radio" value="{{ $key }}" name="civility" id="{{ $key }}" @if ($key === $user['data']['civility']['key']) checked="checked" @endif>
                                        <label for="{{ $key }}">{{ $trans }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="last_name" class="col-sm-3 control-label">{{ trans('users.last_name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_name" placeholder="{{ trans('users.last_name') }}" name="last_name" required="required" aria-required="true" value="{{ $user['data']['last_name'] }}">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="first_name" class="col-sm-3 control-label">{{ trans('users.first_name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="first_name" placeholder="{{ trans('users.first_name') }}" name="first_name" required="required" aria-required="true" value="{{ $user['data']['first_name'] }}">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="email" class="col-sm-3 control-label">{{ trans('global.email') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" placeholder="{{ trans('global.email') }}" name="email" required="required" aria-required="true" value="{{ $user['data']['email'] }}">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">{{ trans('global.record') }}</button>
                        <a href="{{ route('administrator.users.index') }}" class="btn btn-default">{{ trans('global.back') }}</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
