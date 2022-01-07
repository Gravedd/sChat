<html lang="ru">
<head>
    <title>sChat - secure chat</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        :root {
            --bg-color: #d7d7d7;
            --text-color: #000000;
            --main-color: #eeeeee;
            --baselink-color: #ff8b00;
            --cont-color: #ff8b00;
            --inverse-color: #ffffff;
            --shadow-color: #b1b1b1;
        }
    </style>
</head>
<body>
@include('includes.header')

<main>
    @yield('content')
</main>

<footer>
    <a href=""><div class="button">ВК</div></a>
    <a href=""><div class="button">ВК</div></a>
    <a href=""><div class="button end">This website is opensource</div></a>
</footer>



</body>
</html>
