<?php
function analyseText($text)
{
    $numbers = array('0' => true, '1' => true, '2' => true, '3' => true, '4' => true,
        '5' => true, '6' => true, '7' => true, '8' => true, '9' => true);
    $rus_alphabet = array('А' => true, 'Б' => true, 'В' => true, 'Г' => true, 'Д' => true, 'Е' => true, 'Ё' => true,
        'Ж' => true, 'З' => true, 'И' => true, 'Й' => true, 'К' => true, 'Л' => true, 'М' => true, 'Н' => true,
        'О' => true, 'П' => true, 'Р' => true, 'С' => true, 'Т' => true, 'У' => true, 'Ф' => true, 'Х' => true,
        'Ц' => true, 'Ч' => true, 'Щ' => true, 'Ш' => true, 'Ъ' => true, 'Ы' => true, 'Ь' => true, 'Э' => true,
        'Ю' => true, 'Я' => true);
    $punctuation_marks = array('.' => true, ',' => true, '!' => true, '?' => true, '-' => true, ';' => true,
        ':' => true, '"' => true, '\'' => true, '(' => true, ')' => true);

    $numbers_amount = 0;
    $punctuation_marks_amount = 0;
    $letters_amount = 0;
    $letters_uppercase_amount = 0;
    $letters_lowercase_amount = 0;
    $newlines_amount = 0;
    $word = '';
    $words = array();

    for ($i = 0; $i < strlen($text); $i++) {
        switch ($text[$i]) {
            case '\n':
            case '\r':
                $newlines_amount++;
                break;
            case array_key_exists($text[$i], $numbers):
                $numbers_amount++;
                break;
            case ($text[$i] == ' ' || $i == strlen($text) - 1):
                if ($i == (strlen($text) - 1) && $text[$i] != '.' && $text[$i] != ',' && $text[$i] != '!' && $text[$i] != '?' && $text[$i] != '-' && $text[$i] != ';' && $text[$i] != ':' && $text[$i] != ' ' && !(array_key_exists($text[$i], $numbers))) //Если сейчас цикл на последнем символе и этот символ буква, а не знак препинания или пробел или цифра
                {
                    $word .= $text[$i]; //Добавляем в это слово символ
                    $letters_amount++; //Повышаем счетчик букв
                    if (array_key_exists(iconv("cp1251", "utf-8", $text[$i]), $rus_alphabet) || ctype_upper($text[$i])) //Если буква заглавная
                        $letters_uppercase_amount++; //Повышаем количество заглавных букв
                    else
                        $letters_lowercase_amount++; //Повышаем количество строчных букв
                }

                //Если последний символ — знак препинания
                if ($text[$i] == '.' || $text[$i] == ',' || $text[$i] == '!' || $text[$i] == '?' || $text[$i] == '-' || $text[$i] == ';' || $text[$i] == ':') {
                    $punctuation_marks_amount++; //Повышаем количество знаков препинания
                }
                if ($word) //Если есть слово
                {
                    if (isset($words[$word])) //Если слово сущствует в массиве
                        $words[$word]++; //Увеличиваем количество повторов
                    else
                        $words[$word] = 1; //Задаём количество, равное единице

                    $word = ''; //Сбрасываем текущее слово
                }
                break;
            case array_key_exists($text[$i], $punctuation_marks):
                $punctuation_marks_amount++;
                break;
            default:
                $word .= $text[$i];
                $letters_amount++;
                if (array_key_exists(iconv("cp1251", "utf-8", $text[$i]), $rus_alphabet)
                    || ctype_upper($text[$i])) $letters_uppercase_amount++;
                else $letters_lowercase_amount++;
                break;
        }
    }

//        if ($text[$i] == "\r") {
//            $newlines_amount++;
//            continue;
//        }
//        if ($text[$i] == "\n") {
//            $newlines_amount++;
//            continue;
//        }
//
//        if (array_key_exists($text[$i], $numbers)) //Если встречается цифра
//        {
//            $numbers_amount++; //Повышаем счетчик цифр
//        }

//        if ($text[$i] == ' ' || $i == strlen($text) - 1) //Если встретился пробел, знак препинания конец текста
//        {
//            if ($i == (strlen($text) - 1) && $text[$i] != '.' && $text[$i] != ',' && $text[$i] != '!' && $text[$i] != '?' && $text[$i] != '-' && $text[$i] != ';' && $text[$i] != ':' && $text[$i] != ' ' && !(array_key_exists($text[$i], $numbers))) //Если сейчас цикл на последнем символе и этот символ буква, а не знак препинания или пробел или цифра
//            {
//                $word .= $text[$i]; //Добавляем в это слово символ
//                $letters_amount++; //Повышаем счетчик букв
//                if (array_key_exists(iconv("cp1251", "utf-8", $text[$i]), $rus_alphabet) || ctype_upper($text[$i])) //Если буква заглавная
//                    $letters_uppercase_amount++; //Повышаем количество заглавных букв
//                else
//                    $letters_lowercase_amount++; //Повышаем количество строчных букв
//            }
//
//            //Если последний символ — знак препинания
//            if ($text[$i] == '.' || $text[$i] == ',' || $text[$i] == '!' || $text[$i] == '?' || $text[$i] == '-' || $text[$i] == ';' || $text[$i] == ':') {
//                $punctuation_marks_amount++; //Повышаем количество знаков препинания
//            }
//            if ($word) //Если есть слово
//            {
//                if (isset($words[$word])) //Если слово сущствует в массиве
//                    $words[$word]++; //Увеличиваем количество повторов
//                else
//                    $words[$word] = 1; //Задаём количество, равное единице
//
//                $word = ''; //Сбрасываем текущее слово
//            }
//        } //Считаем количество знаков препинания
//        else if ($text[$i] == '.' || $text[$i] == ',' || $text[$i] == '!' || $text[$i] == '?' || $text[$i] == '-' || $text[$i] == ';' || $text[$i] == ':') {
//            $punctuation_marks_amount++; //Повышаем количество знаков препинания
//        } //Если слово продолжается
//        else {
//            $word .= $text[$i]; //Добавляем в это слово следующий символ
//            $letters_amount++; //Повышаем количество букв
//            if (array_key_exists(iconv("cp1251", "utf-8", $text[$i]), $rus_alphabet) || ctype_upper($text[$i])) //Если буква заглавная
//                $letters_uppercase_amount++; //Повышаем количество заглавных букв
//            else
//                $letters_lowercase_amount++; //Повышаем количество строчных букв
//        }
//    }

    $symbols = countSymbols($text); //Заполняем массив всеми символами
    $symbol_amount = strlen($text) - $newlines_amount;
    $words_amount = count($words);
    echo <<<HERE
                                    <table>
                                        <tr>
                                            <th colspan="2" class="title">Общая информация о тексте</td>
                                        </tr>
                                        <tr>
                                            <td>Кол-во символов</td>
                                            <td>$symbol_amount</td>
                                        </tr>
                                        <tr>
                                            <td>Кол-во букв</td>
                                            <td>$letters_amount</td>
                                        </tr>
                                        <tr>
                                            <td>Кол-во заглавных букв</td>
                                            <td>$letters_uppercase_amount</td>
                                        </tr>
                                        <tr>
                                            <td>Кол-во строчных букв</td>
                                            <td>$letters_lowercase_amount</td>
                                        </tr>
                                        <tr>
                                            <td>Кол-во знаков препинания</td>
                                            <td>$punctuation_marks_amount</td>
                                        </tr>
                                        <tr>
                                            <td>Кол-во цифр</td>
                                            <td>$numbers_amount</td>
                                        </tr>
                                        <tr>
                                            <td>Кол-во различных слов</td>
                                            <td>$words_amount</td>
                                        </tr>
                                        
                                        <tr>
                                            <th colspan="2" class="title">Количество всех символов без учёта регистра</th>
                                        </tr>
                                        <tr>
                                            <th>Символ</th>
                                            <th>Кол-во</th>
                                        </tr>
HERE;
    foreach ($symbols as $key => $value) //Выводим количество всех симвоов
    {
        $tSymbol = iconv("cp1251", "utf-8", $key);
        if ($tSymbol == ' ')
            $tSymbol = '<i>пробел</i>';
        $tSymbolCount = iconv("cp1251", "utf-8", $value);
        echo "<tr>
                                            <td>$tSymbol</td>
                                            <td>$tSymbolCount</td>
                                          </tr>";
    }

    echo <<<HERE
                                        <tr>
                                            <th colspan="2" class="title">Список всех слов, отсортированный по алфавиту и количество их вхождений</th>
                                        </tr>
                                        <tr>
                                            <th>Символ</th>
                                            <th>Кол-во</th>
                                        </tr>
HERE;
    ksort($words); //Сортируем слова по алфавиту

    if (count($words) == 0) //Если в тексте нет слов
    {
        echo '<tr><th colspan="2"><u>Слова в тексте отсутствуют</u></th></tr>';
    }
    foreach ($words as $key => $value) //Выводим количество всех слов
    {
        echo '<tr><td>' . iconv("cp1251", "utf-8", $key) .
            '</td><td>' . iconv("cp1251", "utf-8", $value) .
            '</td></tr>';
    }
    echo '</table>'; //Закрываем таблицу
}

function countSymbols($text)
{
    $symbols = array(); //Массив символов
    $lowerText = strtolower($text); //Переводим символы в нижний регистр

    for ($i = 0; $i < strlen($lowerText); $i++) //Для каждого символа текста
    {
        if ($text[$i] == "\r") //Если встретился символ возрата каретки
            continue; //Пропускаем 1 шаг цикла
        if ($text[$i] == "\n") //Если встретился символ переноса сроки
            continue; //Пропускаем 1 шаг цикла

        if (isset($symbols[$lowerText[$i]])) //Если символ уже есть в массиве
            $symbols[$lowerText[$i]]++; //Повышаем число символов
        else //Если символ встречается впервые
            $symbols[$lowerText[$i]] = 1; //Приравниваем число символов к одному
    }

    return $symbols;
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
    <title>Огородников Николай Александрович, 191-321. Лабораторная работа № А‐8. Основы работы со строковыми данными в
        РНР. Кодировка. Анализ текста.</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="title">
        <h2>Огородников Николай Александрович, 191-321</h2>
        <h1>Лабораторная работа № А‐8. Основы работы со
            <br>строковыми данными в РНР. Кодировка. Анализ текста.</h1>
    </div>
</header>
<main>
    <div class="analysis-data">
        <?php
        $input_data = $_POST['data'];

        if (!$input_data)
            echo '<h1>Нет текста для анализа</h1>';
        else {
            echo "<h1>Анализ текста</h1>
            <h2>Анализируемый текст</h2>
            <div class='input-text'>$input_data</div>";
            analyseText(iconv("utf-8", "cp1251", $input_data));
            echo '<a href="index.html">Другой анализ</a>';
        }
        ?>
    </div>
</main>
<footer></footer>
</body>
</html>