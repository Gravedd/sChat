@extends('layouts.app')
@section('content')
    <main>
    <h1>Диалоги</h1>
    <div class="searchresults">
        @foreach($dlist as $user)
            <div class="searchitem">
                <a href="/user/{{ $user->id }}" title="перейти в профиль" class="name">{{ $user->name }}</a>
                <a href="/chat/{{ $user->id }}" title="перейти в профиль" class="offline">Перейти в диалог</a>
            </div>
        @endforeach
    </div>
    </main>
@endsection
