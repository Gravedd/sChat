@extends('layouts.app')
@section('content')
    <main>
        <div class="flexrow">
            <h1>Диалог с пользователем <a href="">Олег</a></h1>
            <input type="text" maxlength="64" placeholder="ваш ключ шифрования...">
        </div>
        <div class="chatwrapper">
            <div class="messages" id="messblock">
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess sent">сообщение1</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение</div>
                <div class="usermess received">сообщение1</div>
                <div class="usermess received">сообщение1</div>
                <div class="usermess sent">сообщение1</div>
                <div class="usermess anim">
                    Отправка сообщения...
                </div>
                <br>
            </div>
            <div class="messinput">
                <input type="text" placeholder=" ваше сообщение...">
                <input type="submit" value="&#8594;">
            </div>
            <script src="public/js/chatscript.js"></script>
        </div>
    </main>
@endsection
