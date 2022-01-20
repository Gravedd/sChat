@extends('layouts.app')

@section('content')
    <main>
        <form id="loginform" method="POST" action="{{ route('login') }}">
            @csrf
            <label>Ваш email</label>
            <input id="email" type="email" class="@error('email')is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" ваш email">
            <label>Ваш пароль</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder=" ********">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <input class="form-check-input" type="checkbox" name="remember" id="remember" checked="checked" style="display:none">
            <label>Не зарегистрированны?</label> <a href="register">Нажмите чтобы зарегистрироватся</a>
            <input type="submit" class="btn btn-primary" value="Войти">
        </form>
    </main>
@endsection

