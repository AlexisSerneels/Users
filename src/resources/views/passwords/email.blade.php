@extends('core::admin.master')

@section('title', __('Reset Password'))
@section('bodyClass', 'gray-background')

@section('page-header')
@endsection
@section('sidebar')
@endsection
@section('mainClass')
@endsection
@section('errors')
@endsection

@section('content')

<div id="reset" class="container-reset small-container">

    @includeWhen(TypiCMS::hasLogo(), 'users::_logo')

    {!! BootForm::open()->action(url('password/email'))->addClass('small-container-form') !!}

        @include('users::_status', ['closable' => false])

        <h1 class="small-container-title">{{ __('Reset Password') }}</h1>

        {!! BootForm::email(__('Email'), 'email')->addClass('form-control input-lg')->autofocus(true)->required() !!}

        <div class="form-group form-action">
            {!! BootForm::submit(__('Send password reset link'), 'btn-primary')->addClass('btn-lg btn-block') !!}
        </div>

    {!! BootForm::close() !!}

</div>

@endsection