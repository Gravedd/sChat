@extends('layouts.app')
@section('content')
    <main>
    <h1>Диалоги</h1>
    <div class="searchresults">
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
