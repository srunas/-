@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтвердите ваш адрес электронной почты') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ссылка для подтверждения была отправлена на ваш адрес электронной почты.') }}
                        </div>
                    @endif

                    {{ __('Прежде чем продолжить, пожалуйста, проверьте вашу электронную почту на наличие ссылки для подтверждения.') }}
                    {{ __('Если вы не получили письмо') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите здесь, чтобы запросить еще одно') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
