@extends('layouts.app')
@section('content')
    <main>
        <h1>Поиск пользователей</h1>
        <form class="searchform">
            <div class="inputwrapper">
                <form>
                    <input name="username" type="text" placeholder=" никнейм пользователя" value="@if (isset($_GET['username'])){{ $_GET['username'] }}@endif">
                    <input type="submit" value="Поиск">
                </form>
            </div>
        </form>
        <div class="searchresults">
            <h3>Результат поиска</h3>
            @foreach($users as $user)
                <div class="searchitem">
                    <a href="user/{{ $user['id'] }}" title="перейти в профиль" class="name">{{ $user['name'] }}</a>
                    <span class="offline">Заходил 5 минут назад</span>
                </div>
            @endforeach
            @empty($users[0])
                <b>Пользователь с таким именем не найден</b>
            @endempty
        </div>

    </main>
@endsection
