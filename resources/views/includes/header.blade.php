<header>
    <div class="logo">
        <a href="/">sChat</a>
    </div>
    <div class="nav">
        <a href="/home"><div class="button">Диалоги</div></a>
        <a href="/search"><div class="button">Поиск</div></a>
        @if ( Auth::id() == null )
            <a href="/login"><div class="button">Вход</div></a>
        @else
            <a href="/logout"><div class="button">Выход</div></a>
        @endif
    </div>
</header>
