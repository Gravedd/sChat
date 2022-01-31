@extends('layouts.app')
@section('content')
    <main>
        <h1>Безопасный онлайн мессенджер</h1>
        <span>Все сообщения шифруются вашим ключом. Никто не сможет прочитать ващи сообщения без ключа</span><br>
        @if ( Auth::id() == null )
            <span><a href="register">Зарегистрирутесь</a> или <a href="login">войдите</a>, чтобы воспользоватся сервисом.</span>
        @else
            <strong>Вы вошли</strong>
        @endif
    </main>
@endsection
