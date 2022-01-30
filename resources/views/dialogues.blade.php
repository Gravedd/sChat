@extends('layouts.app')
@section('content')
    <main>
    <h1>Диалоги</h1>
    <div class="searchresults">
        @foreach($dlist as $user)
            <div class="searchitem" id="user{{ $user->id }}">
                <a href="/user/{{ $user->id }}" title="перейти в профиль" class="name">{{ $user->name }}</a>
                <a href="/chat/{{ $user->id }}" title="перейти в профиль" class="offline">Перейти в диалог</a>
                <div><small>
                        Количество сообщений:
                        @php
                            $count = \App\Models\messages::getCountAllMessages(\Illuminate\Support\Facades\Auth::id(), $user->id);
                            echo $count;
                        @endphp
                    </small>
                </div>
                <div class="button"><strong class="contcolor" id="deleteuserbutton" title="{{ $user->id }}">X</strong> <small>Удалить из списка диалогов</small></div>
            </div>
        @endforeach
    </div>
    </main>
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <script src="/public/js/dialogues.js"></script>
@endsection
