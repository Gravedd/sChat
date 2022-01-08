@extends('layouts.app')

@section('content')
    <main>
        <form id="loginform" method="POST" action="{{ route('register') }}">
            @csrf
            <label>Ваше никнейм</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <label>Ваш email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            <label>Пароль</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <label>Подтверждение пароля</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <label>Уже зарегистрированы?</label> <a href="login">Нажмите чтобы войти</a>
            <input type="submit" class="btn btn-primary" value="Зарегистрироватся">
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
