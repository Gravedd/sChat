@extends('layouts.app')

@section('content')
    <main>
        <form id="loginform" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <label>Ваше Никнейм</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus minlength="6" maxlength="32" placeholder=" должен быть уникальным и не менее 6 символов">
            <label>Ваш email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder=" ваш email">
            <label>Пароль</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder=" минимум 8 символов" minlength="8">
            <label>Подтверждение пароля</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" должен совпадать с полем выше">
            <label>Уже зарегистрированы?</label> <a href="login">Нажмите чтобы войти</a>
            <input type="submit" id="submitbtn" class="btn btn-primary" value="Зарегистрироватся">
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

        </form>
    </main>
@endsection
