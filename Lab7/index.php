<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script>
        let i = 0;

        function addOneElement(container, counter) {
            i += 1;
            document.getElementById(counter).setAttribute('value', i + 1);
            document.getElementById(container).innerHTML += '<label for="element' + i + '">Элемент №' + i + ':</label>\n' +
                '<input type="text" name="element' + i + '" id="element' + i + '">';
        }
    </script>

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
    <form action="sort.php" target="_blank" method="post" class="main-form">
        <div id="input-array-elements">
            <input type="text" name="amount" id="amount" value="1">
            <label for="element0">Элемент №0:</label>
            <input type="text" name="element0" id="element0">
        </div>
        <label for="sort-type">Алгоритм сортировки:</label>
        <select name="sort-type" id="sort-type">
            <option value="selection-sort">Сортировка выбором</option>
            <option value="bubble-sort">Пузырьковая сортировка</option>
            <option value="shell-sort">Алгоритм Шелла</option>
            <option value="gnome-sort">Алгоритм садового гнома</option>
            <option value="quick-sort">Быстрая сортировка</option>
            <option value="built-in-sort">Встроенная функция PHP для сортировки списков по значению</option>
        </select>
        <input type="button" value="Добавить ещё один элемент" onclick="addOneElement('input-array-elements', 'amount')">
        <input type="submit" value="Сортировать массив">
    </form>
</main>
<footer></footer>
</body>
</html>