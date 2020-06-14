@extends('anonymous.default')

@section('title', $metadata['title'])
@section('description', $metadata['description'])

@section('content')
<section>
    <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 text-center mx-auto mb-4">
                    <i class="fas fa-envelope icon"></i>
                    <h2 class="font-weight-bold font-size-lg">{!! trans('users.leads.contact') !!}</h2>
                    <p class="lead">{!! trans('users.leads.baseline') !!}</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    {!! Form::open(['route' => ['anonymous.contact.store'], 'method' => 'POST', 'data-user_identifier' => (Auth::check() ? Auth::user()->uniqid : 0)]) !!}
                    @honeypot
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="civility" id="civility" class="form-control" {{ Auth::check() ? 'readonly' : '' }}>
                                        @foreach ($civilities as $key)
                                            <option
                                                    value="{{ $key }}"
                                                    @if (Auth::check() && $key === Auth::user()->civility) selected="selected" @endif
                                            >
                                                {{ trans("users.civility.{$key}") }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input
                                            type="text"
                                            name="first_name"
                                            class="form-control @if ($errors && $errors->has('first_name')) is-invalid @endif"
                                            placeholder="{{ trans('users.first_name') }}"
                                            value="{{ old('first_name', Auth::check() ? Auth::user()->first_name : '') }}"
                                            {{ Auth::check() ? 'readonly' : '' }}
                                    />
                                    @if ($errors && $errors->has('first_name'))
                                        <span class="text-danger text-sm">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input
                                            type="text"
                                            name="last_name"
                                            class="form-control @if ($errors && $errors->has('last_name')) is-invalid @endif"
                                            placeholder="{{ trans('users.last_name') }}"
                                            value="{{ old('last_name', Auth::check() ? Auth::user()->last_name : '') }}"
                                            {{ Auth::check() ? 'readonly' : '' }}
                                    />
                                    @if ($errors && $errors->has('last_name'))
                                        <span class="text-danger text-sm">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="text"
                                        name="email"
                                        class="form-control @if ($errors && $errors->has('email')) is-invalid @endif"
                                        placeholder="{{ trans('users.email') }}"
                                        value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                        {{ Auth::check() ? 'readonly' : '' }}
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors && $errors->has('email'))
                                <span class="text-danger text-sm">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input
                                    type="text"
                                    name="subject"
                                    class="form-control @if ($errors && $errors->has('message')) is-invalid @endif"
                                    placeholder="{{ trans('users.leads.subject') }}"
                                    value="{{ old('subject') }}"
                            />
                            @if ($errors && $errors->has('subject'))
                                <span class="text-danger text-sm">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <span class="text-sm">{!! trans('users.leads.language_info') !!}</span>
                            <textarea
                                    name="message"
                                    class="form-control @if ($errors && $errors->has('message')) is-invalid @endif"
                                    style="min-height:100px;"
                                    placeholder="{{ trans('users.leads.message') }}"
                            >
                            {{ old('message', '') }}
                        </textarea>
                            @if ($errors && $errors->has('message'))
                                <span class="text-danger text-sm">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-9">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="certify" name="certify" {{ old('certify') ? 'checked' : '' }}/>
                                    <label for="certify">
                                        <span class="@if ($errors && $errors->has('certify')) text-danger @endif">{{ trans('users.leads.certify') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary float-right">{{ trans('users.leads.send') }}</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
