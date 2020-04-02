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
        $is_current = true;
        if ($is_current)
            echo 'id="current" ';
        echo 'href="' . $link . '"';
        ?>><?php
            echo $name;
            ?></a>

        <a <?php
        $name = 'Контакты';
        $link = 'contacts.php';
        $is_current = false;
        if ($is_current)
            echo 'id="current" ';
        echo 'href="' . $link . '"';
        ?>><?php
            echo $name;
            ?></a>

    </div>
</header>
<main>
    <h1>Фотогалерея</h1>
    <h2>Пеноблоки</h2>
    <div class="img-container">
        <?php $time = date('s') % 2 ?>
        <div class="block">
            <img class="block" src="images/penoblock-<?php echo $time ?>.png" alt="Пеноблок 0 или 1">
        </div>
        <div class="block">
            <img class="block" src="images/penoblock-<?php echo $time + 1 ?>.png" alt="Пеноблок 1 или 2">
        </div>
    </div>
    <h2>Газоблоки</h2>
    <div class="img-container">
        <?php $time = date('s') % 2 ?>
        <div class="block">
            <img class="block" src="images/gazoblock-<?php echo $time ?>.png" alt="Газоблок 0 или 1">
        </div>
        <div class="block">
            <img class="block" src="images/gazoblock-<?php echo $time + 1 ?>.png" alt="Газоблок 1 или 2">
        </div>
    </div>
    <h2>Шлакоблоки</h2>
    <div class="img-container">
        <?php $time = date('s') % 2 ?>
        <div class="block">
            <img class="block" src="images/shlakoblock-<?php echo $time ?>.png" alt="Шлакоблок 0 или 1">
        </div>
        <div class="block">
            <img class="block" src="images/shlakoblock-<?php echo $time + 1 ?>.png" alt="Шлакоблок 1 или 2">
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