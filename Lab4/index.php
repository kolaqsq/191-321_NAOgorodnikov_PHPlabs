<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐4. Пользовательские функции. Вывод
        таблиц.</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="title">
        <h2>Огородников Николай Александрович, 191-321</h2>
        <h1>Лабораторная работа № А‐4. Пользовательские функции. Вывод таблиц.</h1>
    </div>
</header>
<main>
    <?php
    function makeRow($row_structure)
    {
        if (!empty($row_structure)) {
            global $columns;
            $cells_data = explode('*', $row_structure);
            $result = '<tr>';

            for ($i = 0; $i < count($cells_data); $i++)
                $result .= '<td>' . $cells_data[$i] . '</td>';

            if (count($cells_data) < $columns)
                for ($i = 0; $i < ($columns - count($cells_data)); $i++)
                    $result .= '<td></td>';

            return $result . '</tr>';
        } else
            return null;
    }

    function displayTable($table_structure)
    {
        if (!empty($table_structure)) {
            $rows_data = explode('#', $table_structure);
            $table = '';

            for ($i = 0; $i < count($rows_data); $i++)
                $table .= makeRow($rows_data[$i]);

            if ($table)
                echo '<table>' . $table . '</table>';
            else
                echo '<h3>В таблице нет строк с ячейками</h3>';
        } else {
            echo '<h3>В таблице нет строк</h3>';
        }
    }

    $input = array('1*2*3*4*5#1*2*3*4*5#1*2*3*4*5#1*2*3*4*5#1*2*3*4*5',
        '1*2*3*4*5##1*2*3*4*5#1*2*3*4*5#1*2*3*4*5',
        '1#1*2#1*2*3#1*2*3*4#1*2*3*4*5',
        '####',
        '');
    $columns = 5;

    if ($columns > 0)
        for ($i = 0; $i < count($input); $i++) {
            echo '<div class="table"><h2>Таблица №' . ($i + 1) . '</h2>';
            echo displayTable($input[$i]) . '</div>';
        }
    else
        echo '<div class="table"><h2>Неправильное число колонок</h2></div>'
    ?>
</main>
<footer></footer>
</body>
</html>