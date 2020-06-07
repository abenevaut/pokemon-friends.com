@extends('administrator.default')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-tachometer-alt mr-2"></i>{{ trans('users.dashboard') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><i class="fas fa-tachometer-alt mr-2"></i>{{ trans('users.dashboard') }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12"><example-component></example-component></div>
            <div class="col-12"><authorised-clients-component></authorised-clients-component></div>
            <div class="col-12"><clients-component></clients-component></div>
            <div class="col-12"><personal-access-tokens-component></personal-access-tokens-component></div>
        </div>
    </div>
</section>
@endsection
