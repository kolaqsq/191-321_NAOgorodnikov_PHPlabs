<?php
function argIsNum($array_element)
{
    return true;
}

function echoArray($array)
{
    return null;
}

function echoStartArray($array) {
    echo '<span>Исходный массив</span>';
    echoArray($array);
    echo '<span>Массив проверен, сортировка возможна</span>';
}

function selectionSort($array)
{
    return null;
}


function bubbleSort($array)
{
    return null;
}

function shellSort($array)
{
    return null;
}

function gnomeSort($array)
{
    return null;
}

function quickSort($array)
{
    return null;
}

function builtInSort($array)
{
    return null;
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

    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐7. Основы использования массивов в
        программировании. Ввод данных и сортировка массивов.</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="title">
        <h2>Огородников Николай Александрович, 191-321</h2>
        <h1>Лабораторная работа № А‐7. Основы использования массивов в
            <br>программировании. Ввод данных и сортировка массивов.</h1>
    </div>
</header>
<main>
    <?php
    if (!isset($_POST['element0'])) {
        echo '<h1>Массив не задан, сортировка невозможна</h1>';
        exit();
    }

    $input_array = array();
    for ($i = 0; $i < $_POST['amount']; $i++)
        if (argIsNum($_POST['element' . $i])) {
            $input_array[] = $_POST['element' . $i];
        } else {
            echo '<h1>Элемент массива "' . $_POST['element' . $i] . '" – не число</h1>';
            exit();
        }

    $time = microtime(true);
    switch ($_POST['sort-type']) {
        case 'selection-sort':
            echo '<h1>Сортировка выбором</h1>';
            $n = selectionSort($input_array);
            break;
        case 'bubble-sort':
            echo '<h1>Пузырьковая сортировка</h1>';
            $n = bubbleSort($input_array);
            break;
        case 'shell-sort':
            echo '<h1>Алгоритм Шелла</h1>';
            $n = shellSort($input_array);
            break;
        case 'gnome-sort':
            echo '<h1>Алгоритм садового гнома</h1>';
            $n = gnomeSort($input_array);
            break;
        case 'quick-sort':
            echo '<h1>Быстрая сортировка</h1>';
            $n = quickSort($input_array);
            break;
        case 'built-in-sort':
            echo '<h1>Встроенная функция PHP для сортировки списков по значению</h1>';
            $n = builtInSort($input_array);
            break;
    }

    echo 'Сортировка завершена, проведено ' . $n . ' итераций. ';
    echo 'Затрачено ' . ($time - microtime(true)) . ' микросекунд!';
    ?>
</main>
<footer></footer>
</body>
</html>