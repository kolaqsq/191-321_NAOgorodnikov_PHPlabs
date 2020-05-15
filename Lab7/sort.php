<?php
function argIsNum($array_element)
{
    return null;
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
        echo '<span>Массив не задан, сортировка невозможна</span>';
        exit();
    }

    for ($i = 0; $i < $_POST['amount']; $i++)
        if (argIsNum($_POST['element' . $i])) {
            echo '<span>Элемент массива "' . $_POST['element' . $i] . '" – не число</span>';
            exit();
        }

    switch ($_POST['sort-type']) {
        case 'selection-sort':
            echo '<h1>Сортировка выбором</h1>';
            break;
        case 'bubble-sort':
            echo '<h1>Пузырьковая сортировка</h1>';
            break;
        case 'shell-sort':
            echo '<h1>Алгоритм Шелла</h1>';
            break;
        case 'gnome-sort':
            echo '<h1>Алгоритм садового гнома</h1>';
            break;
        case 'quick-sort':
            echo '<h1>Быстрая сортировка</h1>';
            break;
        case 'built-in-sort':
            echo '<h1>Встроенная функция PHP для сортировки списков по значению</h1>';
            break;
    }

    $input_array = array();
    echo 'Исходный массив<br>----------------------------<br>';
    for ($i = 0; $i < $_POST['amount']; $i++) {
        echo '<div class="arr_element">' . $i . ': ' .
            $_POST['element' . $i] . '</div>'; // выводим текущий элемент и его номер
        $input_array[] = $_POST['element' . $i]; // добавляем элемент в массив для сортировки
    }
    echo '<br>----------------------------<br>Массив проверен, сортировка возможна';
    $time = microtime(true); // засекаем время начала сортировки

    switch ($_POST['sort-type']) {
        case 'selection-sort':
            $n = selectionSort($input_array);
            break;
        case 'bubble-sort':
            $n = bubbleSort($input_array);
            break;
        case 'shell-sort':
            $n = shellSort($input_array);
            break;
        case 'gnome-sort':
            $n = gnomeSort($input_array);
            break;
        case 'quick-sort':
            $n = quickSort($input_array);
            break;
        case 'built-in-sort':
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