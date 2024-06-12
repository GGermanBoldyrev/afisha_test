<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/icon.png">
    <link rel="stylesheet" href="/css/style.css">
    <title>Афиша тестовое</title>
</head>
<body>
<div class="container">
    <header>
        <div class="header-block">
            <a href="/">Главная</a>
            <a href="/users">Пользователи</a>
            <a href="/roles">Роли</a>
        </div>
    </header>
    <main>
        <?= $content ?> <!--Содержимое $template-->
    </main>
    <footer>
        <div class="footer-block">
            <a href="https://t.me/ggerman_boldyrev" target="_blank">Telegram - ggerman_boldyrev</a>
            <span class="dash">|</span>
            <a href="https://github.com/GGermanBoldyrev" target="_blank">Github - GGermanBoldyrev</a>
        </div>
    </footer>
</div>
</body>
</html>