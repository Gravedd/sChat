<html lang="ru">
<head>
    <title>sChat - secure chat</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/adaptive.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    @yield('content')
@include('includes.footer')
</body>
</html>
