<?php
function argIsNum($array_element)
{
    if ($array_element == '') return false;
    for ($i = 0; $i < strlen($array_element); $i++)
        if ($array_element[$i] !== '0' && $array_element[$i] !== '1' && $array_element[$i] !== '2' &&
            $array_element[$i] !== '3' && $array_element[$i] !== '4' && $array_element[$i] !== '5' &&
            $array_element[$i] !== '6' && $array_element[$i] !== '7' && $array_element[$i] !== '8' &&
            $array_element[$i] !== '9') return false;
    return true;
}

function echoArray($array)
{
    echo '<div class="array">';
    for ($i = 0; $i < count($array); $i++) echo '<div class="array-element">
        <span class="element-number">' . $i . '</span>
        <span class="element-data">' . $array[$i] . '</span>
    </div>';
    echo '</div>';
}

function echoStartArray($array)
{
    echo '<h2>Исходный массив</h2>';
    echoArray($array);
    echo '<span>Массив проверен, сортировка возможна</span>
        <h2>Процесс сортировки</h2>';
}

function selectionSort($array)
{
    echoStartArray($array);
    $iterations = 0;
    for ($i = 0; $i < count($array) - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < count($array); $j++) {
            if ($array[$j] < $array[$min])
                $min = $j;
        }

        if ($min > $i) list($array[$i], $array[$min]) = array($array[$min], $array[$i]);

        $iterations++;
        echo '<span>Итерация: ' . $iterations . '</span>';
        echoArray($array);
    }

    return $iterations;
}

function bubbleSort($array)
{
    echoStartArray($array);
    $iterations = 0;
    for ($j = 0; $j < count($array) - 1; $j++) {
        for ($i = 0; $i < count($array) - 1 - $j; $i++) {
            if ($array[$i] > $array[$i + 1]) list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);

            $iterations++;
            echo '<span>Итерация: ' . $iterations . '</span>';
            echoArray($array);
        }
    }

    return $iterations;
}

function shellSort($array)
{
    echoStartArray($array);
    $iterations = 0;
    for ($k = ceil(count($array) / 2); $k >= 1; $k = ceil($k / 2)) {
        for ($i = $k; $i < count($array); $i++) {
            $val = $array[$i];
            $j = $i - $k;
            while ($j >= 0 && $array[$j] > $val) {
                $array[$j + $k] = $array[$j];
                $j -= $k;
                $iterations++;
                echo '<span>Итерация: ' . $iterations . '</span>';
                echoArray($array);
            }

            $array[$j + $k] = $val;
            $iterations++;
            echo '<span>Итерация: ' . $iterations . '</span>';
            echoArray($array);
        }

        if ($k == 1) break;
    }

    return $iterations;
}

function gnomeSort($array)
{
    echoStartArray($array);
    $i = 1;
    $j = 2;
    $iterations = 0;
    while ($i < count($array)) {
        if (!$i || $array[$i - 1] <= $array[$i]) {
            $i = $j;
            $j++;
            $iterations++;
            echo '<span>Итерация: ' . $iterations . '</span>';
            echoArray($array);
        } else {
            list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
            $i--;
            $iterations++;
            echo '<span>Итерация: ' . $iterations . '</span>';
            echoArray($array);
        }
    }

    return $iterations;
}

function quickSort($array, $left_border, $right_border, $iterations)
{
    if ($iterations == 0) echoStartArray($array);
    $left = $left_border;
    $right = $right_border;
    $point = $array[floor(($left_border + $right_border) / 2)];
    do {
        while ($array[$left] < $point)
            $left++;
        while ($array[$right] > $point)
            $right--;

        if ($left <= $right) {
            list($array[$left], $array[$right]) = array($array[$right], $array[$left]);
            $right--;
            $left++;

            $iterations++;
            echo '<span>Итерация: ' . $iterations . '</span>';
            echoArray($array);
        }
    } while ($right >= $left);

    if ($right > $left_border)
        $iterations = quickSort($array, $left_border, $right, $iterations);
    if ($left < $right_border)
        $iterations = quickSort($array, $left, $right_border, $iterations);

    return $iterations;
}

function builtInSort($array)
{
    echoStartArray($array);
    $iterations = sort($array);
    echo '<span>Итерация: ' . $iterations . '</span>';
    echoArray($array);

    return $iterations;
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
            $n = quickSort($input_array, 0, count($input_array) - 1, 0);
            break;
        case 'built-in-sort':
            echo '<h1>Встроенная функция PHP для сортировки списков по значению</h1>';
            $n = builtInSort($input_array);
            break;
    }

    echo '<span>Сортировка завершена, итераций проведено: ' . $n . '</span>';
    echo '<span>Сортировка заняла ' . number_format(microtime(true) - $time, 10) . ' секунд</span>';
    ?>
</main>
<footer></footer>
</body>
</html>