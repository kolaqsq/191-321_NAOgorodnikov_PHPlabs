<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐2. Циклические алгоритмы. Условия в
        алгоритмах. Табулирование функций. Вариант 8.</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="title">
        <h2>Огородников Николай Александрович, 191-321.</h2>
        <h1>Лабораторная работа № А‐2. Циклические алгоритмы.<br>Условия в
            алгоритмах. Табулирование функций. Вариант 8.</h1>
    </div>
</header>
<main>
    <?php
    function find_y($argument)
    {
        if ($argument <= 10) {
            $value = 7 * $argument + 18;
        } else {
            if ($argument < 20) {
                if (8 - $argument * 0.5 == 0) {
                    $value = 'error';
                } else {
                    $value = ($argument - 17) / (8 - $argument * 0.5);
                }
            } else {
                $value = ($argument + 4) * ($argument - 7);
            }
        }
        return $value;
    }

    function layout($argument, $value, $layout_type)
    {
        global $i;
        switch ($layout_type) {
            case 'A':
                if ($i - 1 != 0)
                    echo '<br>';
                echo 'f(' . $argument . ')= ';
                if (is_string($value))
                    echo $value;
                else echo round($value, 3);
                break;
            case 'B':
            case 'C':
                echo '<li>f(' . $argument . ')= ';
                if (is_string($value))
                    echo $value;
                else echo round($value, 3);
                echo '</li>';
                break;
            case 'D':
                echo '<tr>
						<td>' . $i . '</td>
						<td>x = ' . $argument . '</td>';
                if (is_string($value))
                    echo '<td>y = ' . $value . '</td>';
                else
                    echo '<td>y = ' . round($value, 3) . '</td>';
                echo '</td></tr>';
                break;
            case 'E':
                echo '<div>f(' . $argument . ')= ';
                if (is_string($value))
                    echo $value;
                else
                    echo round($value, 3);
                echo '</div>';
        }
    }

    $x = -5;            //Начальное значение аргумента
    $quantity = 1000;     //Количество вычисляемых значений
    $step = 3;          //Шаг изменения аргумента
    $f_max = 100000;    //Максимальное значение функции, при котором алгоритм завершает работу
    $f_min = -100000;   //Минимальное значение функции, при котором алгоритм завершает работу
    $min = 'absent';    //Минимальное значение
    $max = 'absent';    //Максимальное значение
    $sum = 'absent';    //Сумма всех значений
    $comp = 0;          //Количество вычесленных значений
    $i = 0;             //Переменная счётчиков
    $type = 'A';        //Тип формируемой верстки

    switch ($type) {
        case 'B':
            echo '<ul>';
            break;
        case 'C':
            echo '<ol>';
            break;
        case 'D':
            echo '<table>';
            break;
        case 'E':
            echo '<div class="layout">';
            break;

        default:
            break;
    }

    while (is_string($sum)) {
        $y = find_y($x);
        if (!is_string($y)) {
            if (($y <= $f_min) || ($y >= $f_max)) {
                break;
            } else {
                $min = $y;
                $max = $y;
                $sum = $y;
                $comp++;
            }
        }
        $i++;
        $x += $step;
        layout($x, $y, $type);
    }

    for ($i++; $i < $quantity; $i++, $x += $step) {
        $y = find_y($x);
        if (!is_string($y)) {
            if (($y <= $f_min) || ($y >= $f_max)) {
                break;
            } else {
                if ($y < $min) {
                    $min = $y;
                }
                if ($y > $max) {
                    $max = $y;
                }
                $sum += $y;
                $comp++;
            }
        }
        layout($x, $y, $type);
    }

    switch ($type) {
        case 'B':
            echo '</ul>';
            break;
        case 'C':
            echo '</ol>';
            break;
        case 'D':
            echo '</table>';
            break;
        case 'E':
            echo '</div>';
            break;

        default:
            break;
    }

    echo '<div class="conclusion">Наибольшее значение: ' . $max;
    echo '<br>Наименьшее значение: ' . $min;
    if (is_string($sum)) {
        echo '<br>Среднее арифмитическое значение: absent';
    } else {
        echo '<br>Среднее арифмитическое значение: ' . round($sum / $comp, 3);
    }
    echo '<br>Сумма: ' . $sum . '</div>';
    ?>
</main>
<footer>
    <?php
    echo '<span>Режим вёрстки: ' . $type . '</span>'
    ?>
</footer>
</body>
</html>