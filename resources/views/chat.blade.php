@extends('layouts.app')
@section('content')
    <main>
        <div class="flexrow">
            <h1>Диалог с пользователем <a href="">{{ $userinf[0]['name'] }}</a></h1>
            <div class="wrapper">
                <strong title="Сделайте двойной клик, чтобы сохранить ключ в вашем браузере и применить его">?</strong>&nbsp;
                <strong onclick="deletekey()" title="Нажмите, чтобы удалить сохраненный ключ">X</strong>&nbsp;
                <input type="text" id="securekey" maxlength="64" placeholder="ваш ключ шифрования...">
            </div>
        </div>
        <div class="chatwrapper">
            <div class="messages" id="messblock">
                <br>
            </div>
            <div class="messinput">
                <input type="text" placeholder=" ваше сообщение..." id="messinput">
                <input id="userid" type="hidden" value="{{$id}}">
                <input id="sendid" type="hidden" value="{{$sendid}}">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="submit" value="&#8594;" id="sendButton">
            </div>
            <script src="/public/js/chatscript.js"></script>
        </div>
    </main>
@endsection
