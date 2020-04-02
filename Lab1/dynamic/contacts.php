<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    $title = 'Огородников Николай Александрович, 191-321. Лабораторная работа № А-1. Простейшая программа на PHP.
        Конвертация статического контента в динамический.';
    echo '<title>' . $title . '</title>';
    ?>
    <title></title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<header>
    <div class="logo">
        <img class="logo" src="images/logo.svg" alt="Наш логотип">
    </div>
    <div class="nav">

        <a <?php
        $name = 'Главная';
        $link = 'index.php';
        $is_current = false;
        if ($is_current)
            echo 'id="current" ';
        echo 'href="' . $link . '"';
        ?>><?php
            echo $name;
            ?></a>

        <a <?php
        $name = 'Фотогалерея';
        $link = 'photogallery.php';
        $is_current = false;
        if ($is_current)
            echo 'id="current" ';
        echo 'href="' . $link . '"';
        ?>><?php
            echo $name;
            ?></a>

        <a <?php
        $name = 'Контакты';
        $link = 'contacts.php';
        $is_current = true;
        if ($is_current)
            echo 'id="current" ';
        echo 'href="' . $link . '"';
        ?>><?php
            echo $name;
            ?></a>

    </div>
</header>
<main>
    <h1>Контакты</h1>
    <span>Улица Пушкина, дом Колотушкина</span>
    <h2>Схема проезда</h2>
    <div class="img-container">
        <div class="block">
            <img class="block" src="images/map-1.png" alt="Карта 1">
        </div>
        <div class="block">
            <img class="block" src="images/map-2.png" alt="Карта 2">
        </div>
    </div>
    <h2>Вид с улицы</h2>
    <div class="img-container">
        <?php $time = date('s') % 2 ?>
        <div class="block">
            <img class="block" src="images/building-<?php echo $time ?>.jpg" alt="Здание 0 или 1">
        </div>
        <div class="block">
            <img class="block" src="images/building-<?php echo $time + 1 ?>.jpg" alt="Здание 1 или 2">
        </div>
    </div>
</main>
<footer>
    <div class="copyright">
        <h3>Компания "Pen0blOK"</h3>
        <h3 id="copy">Copyright © 2020 All Rights Reserved.</h3>
    </div>
    <?php echo '<h3 id="copy">Сформированно ' . date("d.m.Y") . ' в ' . date("H:i:s") . '</h3>' ?>
</footer>
</body>
</html>