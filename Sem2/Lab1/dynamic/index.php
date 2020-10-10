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
        $is_current = true;
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
    <h1>Компания "Pen0blOK"</h1>
    <span>Производим различные строительные блоки для всех нужд</span>
    <h2>Фотографии продукта</h2>
    <div class="img-container">
        <?php $time = date('s') % 2 ?>
        <div class="block">
            <img class="block" src="images/block-<?php echo $time ?>.png" alt="Пеноблок 0 или 1">
        </div>
        <div class="block">
            <img class="block" src="images/block-<?php echo $time + 1 ?>.png" alt="Пеноблок 1 или 2">
        </div>
        <div class="block">
            <img class="block" src="images/block-<?php echo $time + 2 ?>.png" alt="Пеноблок 2 или 3">
        </div>
        <div class="block">
            <img class="block" src="images/block-<?php echo $time + 3 ?>.png" alt="Пеноблок 3 или 4">
        </div>
    </div>
    <h2>Сравнительная таблица блоков</h2>
    <div class="table-container">
        <table>
            <?php
            echo '<tr>
                <th>Тип блока</th>
                <th>Описание</th>
                <th>Стоимость</th>
            </tr>'
            ?>
            <tr>
                <td><?php echo 'Пеноблок' ?></td>
                <td><?php echo 'Тёплый и лёгкий. Сделан из самых современных материалов' ?></td>
                <td><?php echo 'Дорого но стоит того' ?></td>
            </tr>
            <tr>
                <td>Газоблок</td>
                <td>Такой же тёплый, как пеноблок, но тяжелее. Изготовлен по устаревшему техпроцессу</td>
                <td>Доступно</td>
            </tr>
            <tr>
                <td>Шлакоблок</td>
                <td>Из названия всё ясно. Делается не пойми из чего не пойми как</td>
                <td>Очень дёшево</td>
            </tr>
        </table>
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