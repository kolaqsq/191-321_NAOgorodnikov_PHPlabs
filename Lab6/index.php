<?php
if (isset($_POST['A']))
    switch ($_POST['TASK']) {
        case 'square':
            $p = ($_POST['A'] + $_POST['B'] + $_POST['C']) * 0.5;
            $result = round(($p * ($p - $_POST['A']) * ($p - $_POST['B']) * ($p - $_POST['C'])) ** 0.5, 2);
            break;
        case 'perimeter':
            $result = round($_POST['A'] + $_POST['B'] + $_POST['C'], 2);
            break;
        case 'volume':
            $result = round($_POST['A'] * $_POST['B'] * $_POST['C'], 2);
            break;
        case 'average':
            $result = round(($_POST['A'] + $_POST['B'] + $_POST['C']) / 3, 2);
            break;
        case 'geometric_mean':
            $result = round(($_POST['A'] * $_POST['B'] * $_POST['C']) ** (1 / 3), 2);
            break;
        case 'discriminant':
            $result = round($_POST['B'] ** 2 - 4 * $_POST['A'] * $_POST['C'], 2);
            break;
    }
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐6. Использование форм для передачи
        данных
        в программу РНР. Тест математических знаний.</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="title">
        <h2>Огородников Николай Александрович, 191-321</h2>
        <h1>Лабораторная работа № А‐6. Использование форм для передачи
            <br>данных в программу РНР. Тест математических знаний.</h1>
    </div>
</header>
<main>
    <?php
    if (isset($result)) {
        $output = 'ФИО: ' . $_POST['FULL_NAME'] . '<br>';
        $output .= 'Группа: ' . $_POST['GROUP'] . '<br>';
        if (isset($_POST['ABOUT']))
            $output .= '<br>' . $_POST['ABOUT'] . '<br>';
        $output .= 'Решаемая задача: ';
        switch ($_POST['TASK']) {
            case 'square':
                $output .= 'ПЛОЩАДЬ ТРЕУГОЛЬНИКА<br>';
                break;
            case 'perimeter':
                $output .= 'ПЕРИМЕТР ТРЕУГОЛЬНИКА<br>';
                break;
            case 'volume':
                $output .= 'ОБЪЁМ ПАРАЛЛЕЛЕПИПЕДА<br>';
                break;
            case 'average':
                $output .= 'СРЕДНЕЕ АРИФМЕТИЧЕСКОЕ<br>';
                break;
            case 'geometric_mean':
                $output .= 'СРЕДНЕЕ ГЕОМЕТРИЧЕСКОЕ<br>';
                break;
            case 'discriminant':
                $output .= 'ДИСКРИМИНАНТ<br>';
                break;
        }
        if ($result === $_POST['RESULT'])
            $output .= '<b>ТЕСТ ПРОЙДЕН</b><br>';
        else
            $output .= '<b>ОШИБКА: ТЕСТ НЕ ПРОЙДЕН</b><br>';
        echo '<div>' . $output . '</div>';

        if (array_key_exists('SEND_MAIL', $_POST)) {
            mail($_POST['MAIL'],
                'Результат тестирования',
                str_replace('<br>', "\r\n", $output),
                "From: auto@mami.ru\n" . "Content-Type: text/plain; charset=utf-8\n");
            echo 'Результаты тестирования были автоматически отправлены на e-mail ' . $_POST['MAIL'];
        }
    } else {
        echo '<form name="main-form" method="post" action="index.php">
        <label for="FIO">ФИО</label>
        <input type="text" name="FIO" id="FIO" required><br>
        
        <label for="GROUP">Группа</label>
        <input type="text" name="GROUP" id="GROUP" required><br>
        
        <label for="ABOUT">Немного о себе</label><br>
        <textarea name="ABOUT" id="ABOUT" cols="30" rows="10"></textarea><br>
        
        <label for="TASK">Решаемая задача</label><br>
            <label for="square">ПЛОЩАДЬ ТРЕУГОЛЬНИКА</label>
            <input type="radio" name="TASK" id="square" value="square" checked><br>
            
            <label for="perimeter">ПЕРИМЕТР ТРЕУГОЛЬНИКА</label>
            <input type="radio" name="TASK" id="perimeter" value="perimeter"><br>
            
            <label for="volume">ОБЪЁМ ПАРАЛЛЕЛЕПИПЕДА</label>
            <input type="radio" name="TASK" id="volume" value="volume"><br>
            
            <label for="average">СРЕДНЕЕ АРИФМЕТИЧЕСКОЕ</label>
            <input type="radio" name="TASK" id="average" value="average"><br>
            
            <label for="geometric_mean">СРЕДНЕЕ ГЕОМЕТРИЧЕСКОЕ</label>
            <input type="radio" name="TASK" id="geometric_mean" value="geometric_mean"><br>
            
            <label for="discriminant">ДИСКРИМИНАНТ</label>
            <input type="radio" name="TASK" id="discriminant" value="discriminant"><br>
            
        <label for="A">Значение A</label>
        <input type="text" name="A" id="A" value="' . (mt_rand(500, 10000) / 100) . '" required><br>
           
        <label for="B">Значение B</label>
        <input type="text" name="B" id="B" value="' . (mt_rand(500, 10000) / 100) . '" required><br>
           
        <label for="C">Значение C</label>
        <input type="text" name="C" id="C" value="' . (mt_rand(500, 10000) / 100) . '" required><br>
          
        <label for="RESULT">Ваш ответ</label>
        <input type="text" name="RESULT" id="RESULT"><br>
        
        <label for="SEND_MAIL">Отправить результат тестирования по e-mail</label>   
        <input type="checkbox" name="SEND_MAIL" id="SEND_MAIL" onclick="
            obj = document.getElementById(\'mail-input\');
            if (this.checked)
                obj.style.display = \'flex\';
            else
                obj.style.display = \'none\';"><br>
        
        <div id="mail-input">
            <label for="MAIL">Ваш e-mail</label>
            <input type="text" name="MAIL" id="MAIL" required><br>
        </div>  
        
        <label for="TYPE">Форма отображения результата</label>
            <label for="web">Версия для просмотра в браузере</label>
            <input type="radio" name="TYPE" id="web" value="web" checked><br>
            
            <label for="print">Версия для печати</label>
            <input type="radio" name="TYPE" id="print" value="print"><br>
            
        <input type="submit" value="Проверить">
    </form>';
    }
    ?>
</main>
<footer></footer>
</body>
</html>