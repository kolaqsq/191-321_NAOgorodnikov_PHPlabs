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

function quickSort($array, $left_border, $right_border, $iterations)
{
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
            echo 'Итерация: ' . $iterations;
            echoArray($array);
        }
    } while ($right >= $left);

    if ($right > $left_border)
        $iterations = quickSort($array, $left_border, $right, $iterations);
    if ($left < $right_border)
        $iterations = quickSort($array, $left, $right_border, $iterations);

    return $iterations;
}

//$n = 0;
$n = quickSort([4, 3, 8], 0, 2, 0);
echo $n;
?>