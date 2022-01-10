@extends('layouts.app')
@section('content')
    <main>
        <h1>{{ $user[0]['name'] }}</h1>
        Статус: <span class="online">Онлайн</span><br><br>
        <input type="hidden" value="{{ $user[0]['id'] }}" id="uid">
        <div class="flexrow">
            <a href="/chat/{{ $user[0]['id'] }}" title="Перейти в диалог с этим пользователем" class="svgbuttona">
                <div class="button">
                    <svg width="45" height="45" style="fill: #ffffff;">
                        <image style="fill: #fc0000;" xlink:href="/public/icons/message.svg" src="icons/message.svg" width="45" height="45"/>
                    </svg>
                </div>
            </a>
            <a title="добавить пользователя в список" id="adduserbutton">
                <div class="button">
                    <svg width="45" height="45">
                        <image xlink:href="/public/icons/add.svg" src="icons/add.svg" width="45" height="45"/>
                    </svg>
                </div>
            </a>
        </div>



    </main>
    <script src="/public/js/profile.js"></script>
@endsection
