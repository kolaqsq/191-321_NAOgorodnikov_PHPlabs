<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐3. Использование GET‐параметров в
        ссылках. Виртуальная клавиатура.</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="title">
        <h2>Огородников Николай Александрович, 191-321.</h2>
        <h1>Лабораторная работа № А‐3. Использование GET‐параметров в ссылках.
            <br>Виртуальная клавиатура.</h1>
    </div>
</header>
<main>
    <div class="numpad">
        <div class="result">
            <?php
            if (!isset($_GET['store'])) {                //Если не передано предыдущее значение
                $_GET['store'] = '';                     //Создаем пустое хранилище
            } elseif (isset($_GET['key'])) {             //Если кнопка была нажата
                $_GET['store'] .= $_GET['key'];          //Сохранить цифру в хранилище
            }


            if (!isset($_GET['quantity'])) {             //Если кнопки ранее не нажимались
                $_GET['quantity'] = 0;                   //Устанавливаем счётчик на 0
            } elseif (isset($_GET['quantity'])) {        //Если кнапка была нажата
                $_GET['quantity']++;                     //Дабавляем к счётчику 1
            }


            echo $_GET['store'];                         //Выводим содержание хранилища
            ?>
        </div>
        <div class="numbers">
            <div class="numbers-row">
                <a class="number"
                   href="?key=1&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">1</a>
                <a class="number"
                   href="?key=2&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">2</a>
                <a class="number"
                   href="?key=3&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">3</a>
                <a class="number"
                   href="?key=4&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">4</a>
                <a class="number"
                   href="?key=5&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">5</a>
            </div>
            <div class="numbers-row">
                <a class="number"
                   href="?key=6&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">6</a>
                <a class="number"
                   href="?key=7&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">7</a>
                <a class="number"
                   href="?key=8&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">8</a>
                <a class="number"
                   href="?key=9&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">9</a>
                <a class="number"
                   href="?key=0&quantity=<?php echo $_GET['quantity']; ?>&store=<?php echo $_GET['store']; ?>">0</a>
            </div>
            <div class="reset">
                <a href="index.php?quantity=<?php echo $_GET['quantity']; ?>">СБРОС</a>
            </div>
        </div>
    </div>
</main>
<footer>
    <?php
    echo '<span>Количество нажатий: ' . $_GET['quantity']++ . '</span>';
    ?>
</footer>
</body>
</html>