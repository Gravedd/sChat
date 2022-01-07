@extends('layouts.app')
@section('content')
    <main>
        <h1>Поиск пользователей</h1>
        <form class="searchform">
            <div class="inputwrapper">
                <input type="text" placeholder=" никнейм пользователя">
                <input type="submit" value="Поиск">
            </div>
        </form>
        <div class="searchresults">
            <h3>Результат поиска</h3>
            <div class="searchitem">
                <a href="" title="перейти в профиль" class="name">Имя фамалия</a>
                <a href="" title="перейти в профиль" class="nick">@nickname</a>
                <a href="" title="перейти в профиль" class="offline">Заходил 5 минут назад</a>
            </div>
            <div class="searchitem">
                <a href="" title="перейти в профиль" class="name">Имя фамалия</a>
                <a href="" title="перейти в профиль" class="nick">@nickname</a>
                <a href="" title="перейти в профиль" class="online">Онлайн</a>
            </div>
        </div>

    </main>
@endsection
