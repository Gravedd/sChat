@extends('layouts.app')
@section('content')
    <main>
        <div class="flexrow">
            <h1>Диалог с пользователем <a href="">{{ $userinf[0]['name'] }}</a></h1>
            <input type="text" maxlength="64" placeholder="ваш ключ шифрования...">
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
