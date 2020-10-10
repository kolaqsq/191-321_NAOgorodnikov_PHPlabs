<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐5. Динамическое формирование контента и
        меню. Таблица умножения.</title>
</head>
<body>
<header>
    <div class="static">
        <div class="logo">
            <img src="img/logo.png" alt="logo">
        </div>
        <div class="title">
            <h2>Огородников Николай Александрович, 191-321</h2>
            <h1>Лабораторная работа № А‐5.
                <br>Динамическое формирование контента и меню.Таблица умножения.</h1>
        </div>
    </div>
    <div class="menu">
        <?php
        echo '<a href="?html_type=TABLE';
        if (isset($_GET['content']))
            echo '&content=' . $_GET['content'];
        echo '"';
        if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'TABLE')
            echo ' class="selected"';
        echo '>Табличная форма</a>';

        echo '<a href="?html_type=DIV';
        if (isset($_GET['content']))
            echo '&content=' . $_GET['content'];
        echo '"';
        if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'DIV')
            echo ' class="selected"';
        echo '>Блоковая форма</a>'
        ?>
    </div>
</header>
<main>
    <div class="side-menu">
        <?php
        echo '<a href="';
        if (isset($_GET['html_type']))
            echo '?html_type=' . $_GET['html_type'];
        else echo '?html_type=TABLE';
        echo '"';
        if (!isset($_GET['content'])) echo ' class="selected"';
        echo '>Вся таблица умножения</a>';

        for ($i = 2; $i <= 9; $i++) {
            echo '<a href="?';
            if (isset($_GET['html_type']))
                echo 'html_type=' . $_GET['html_type'] . '&';
            else echo 'html_type=TABLE&';
            echo 'content=' . $i . '"';
            if (isset($_GET['content']) && $_GET['content'] == $i)
                echo ' class="selected"';
            echo '>Таблица умножения на ' . $i . '</a>';
        }
        ?>
    </div>
    <div class="table">
        <?php
        function displayTable()
        {
            echo '<table>';
            if (!isset($_GET['content']))
                for ($i = 2; $i <= 9; $i++) {
                    if (($i == 2) || ($i == 6))
                        echo '<tr>';
                    echo '<td>';
                    displayData($i);
                    echo '</td>';
                    if (($i == 5) || ($i == 9)) echo '</tr>';
                }
            else {
                echo '<tr class="single"><td>';
                displayData($_GET['content']);
                echo '</td></tr>';
            }
            echo '</table>';
        }

        function displayDiv()
        {
            if (!isset($_GET['content']))
                for ($i = 2; $i <= 9; $i++) {
                    echo '<div>';
                    displayData($i);
                    echo '</div>';
                }
            else {
                echo '<div class="single">';
                displayData($_GET['content']);
                echo '</div>';
            }
        }

        function numAsLink($digit)
        {
            if ($digit <= 9)
                if (array_key_exists('html_type', $_GET))
                    return '<a href="?html_type=' . $_GET['html_type'] . '&content=' . $digit . '">' . $digit . '</a>';
                else
                    return '<a href="?html_type=TABLE&content=' . $digit . '">' . $digit . '</a>';
            else return $digit;
        }

        function displayData($digit)
        {
            if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'DIV')
                for ($i = 2; $i <= 9; $i++)
                    echo numAsLink($digit) . 'x' . numAsLink($i) . '=' . numAsLink($digit * $i) . '<br>';
            else
                for ($i = 2; $i <= 9; $i++)
                    if ($i != 9) echo numAsLink($digit) . 'x' . numAsLink($i) . '=' . numAsLink($digit * $i) . '<br>';
                    else echo numAsLink($digit) . 'x' . numAsLink($i) . '=' . numAsLink($digit * $i);
        }


        if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE')
            displayTable();
        else
            displayDiv();
        ?>
    </div>
</main>
<footer>
    <span>Тип вёрстки:
        <?php
        if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE') echo 'табличная';
        else echo 'блочная';
        ?></span>
    <span>Таблица умножения
        <?php
        if (!isset($_GET['content'])) echo '(полная)';
        else echo 'на ' . $_GET['content'];
        ?></span>
    <span>Дата и время: <?php echo date('d M Y H:i:s'); ?></span>
</footer>
</body>
</html>