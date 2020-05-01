<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if (isset($_POST['A']))
    switch ($_POST['TASK']) {
        case 'square':
            $p = round(($_POST['A'] + $_POST['B'] + $_POST['C']) * 0.5, 2);
            $result = round(($p * ($p - $_POST['A']) * ($p - $_POST['B']) * ($p - $_POST['C'])) ** (1 / 2), 2);
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

    <?php
    if (isset($_POST['TYPE']) && $_POST['TYPE'] == 'print')
        echo '<link rel="stylesheet" href="css/print.css">';
    else
        echo '<link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/fonts.css">';
    ?>

    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐6. Использование форм для передачи
        данных в программу РНР. Тест математических знаний.</title>
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
    <h1 class="print-only">Результаты тестирования</h1>
    <?php
    if (isset($result)) {
        $output = 'ФИО: ' . $_POST['FULL_NAME'] . '<br>';
        $output .= 'Группа: ' . $_POST['GROUP'] . '<br>';
        if (isset($_POST['ABOUT']))
            $output .= 'Сведения о студенте:<br>' . $_POST['ABOUT'] . '<br><br>';
        $output .= 'Решаемая задача: ';
        switch ($_POST['TASK']) {
            case 'square':
                $output .= '<b>ПЛОЩАДЬ ТРЕУГОЛЬНИКА</b><br>';
                break;
            case 'perimeter':
                $output .= '<b>ПЕРИМЕТР ТРЕУГОЛЬНИКА</b><br>';
                break;
            case 'volume':
                $output .= '<b>ОБЪЁМ ПАРАЛЛЕЛЕПИПЕДА</b><br>';
                break;
            case 'average':
                $output .= '<b>СРЕДНЕЕ АРИФМЕТИЧЕСКОЕ</b><br>';
                break;
            case 'geometric_mean':
                $output .= '<b>СРЕДНЕЕ ГЕОМЕТРИЧЕСКОЕ</b><br>';
                break;
            case 'discriminant':
                $output .= '<b>ДИСКРИМИНАНТ</b><br>';
                break;
        }
        $output .= 'Значения:<br>
                    A = <b>' . $_POST['A'] . '</b><br>
                    B = <b>' . $_POST['B'] . '</b><br>
                    C = <b>' . $_POST['C'] . '</b><br>';
        if ($_POST['RESULT'] != '')
            $output .= 'Ответ студента: <b>' . $_POST['RESULT'] . '</b><br>';
        else
            $output .= '<b>ОШИБКА: СТУДЕНТ НЕ ВВЕЛ ОТВЕТ</b><br>';
        $output .= 'Правильный ответ: <b>' . $result . '</b><br><br>';
        if ($result == $_POST['RESULT'])
            $output .= '<b>ТЕСТ ПРОЙДЕН</b><br>';
        else
            $output .= '<b>ОШИБКА: ТЕСТ НЕ ПРОЙДЕН</b><br>';
        if (array_key_exists('SEND_MAIL', $_POST)) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.yandex.ru';
                $mail->SMTPAuth = true;
                $mail->Username = 'kolaqsqsq';
                $mail->Password = 'kolyanilluminat420%';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                $mail->CharSet = "UTF-8";

                $mail->setFrom('kolaqsqsq@yandex.ru', 'Тест математических знаний');
                $mail->addAddress($_POST['MAIL']);

                $mail->isHTML(true);
                $mail->Subject = 'Результаты тестирования';
                $mail->Body = $output;
                $mail->AltBody = str_replace('<br>', "\r\n", $output);

                $mail->send();
                $output .= "<br>Результаты тестирования были автоматически отправлены на e-mail <b>{$_POST['MAIL']}</b>";
            } catch (Exception $e) {
                $output .= "<br>Результаты тестиования не были отправлены. <b>Ошибка: {$mail->ErrorInfo}</b>";
            }
        }
        echo '<div class="output">' . $output . '</div>';
        if ($_POST['TYPE'] == 'web')
            echo '<a class="retry" href="?full_name=' . $_POST['FULL_NAME'] . '&group=' . $_POST['GROUP'] . '&about=' . $_POST['ABOUT'] . '">Повторить тест</a>';
    } else {
        echo '<form name="main-form" method="post" action="index.php">
        <label for="FULL_NAME">ФИО</label>
        <input type="text" name="FULL_NAME" id="FULL_NAME" value="' . ((isset($_GET['full_name'])) ? $_GET['full_name'] : '') . '" required><br>
        
        <label for="GROUP">Группа</label>
        <input type="text" name="GROUP" id="GROUP" value="' . ((isset($_GET['group'])) ? $_GET['group'] : '') . '" required><br>
        
        <label for="ABOUT">Немного о себе</label><br>
        <textarea name="ABOUT" id="ABOUT" cols="30" rows="2">' . ((isset($_GET['about'])) ? $_GET['about'] : '') . '</textarea><br>
        
        <label for="TASK" class="type-header">Решаемая задача</label><br>
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
            inp = document.getElementById(\'MAIL\')
            if (this.checked) {
                obj.style.display = \'flex\';
                inp.required = \'required\';
            }
            else {
                obj.style.display = \'none\';
                inp.removeAttribute(\'required\');
            }"><br>
                
        <div id="mail-input">
            <label for="MAIL">Ваш e-mail</label>
            <input type="text" name="MAIL" id="MAIL"><br>
        </div>  
        
        <label for="TYPE" class="type-header">Форма отображения результата</label>
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