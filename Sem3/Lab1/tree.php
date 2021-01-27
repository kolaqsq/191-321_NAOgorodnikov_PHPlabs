<?php
function outputDirInfo($name, $path)
{
    echo '<div class="dir-tree">Каталог ' . $name . '<br>';
    $dir = opendir($path);
    while (($file = readdir($dir)) !== false) {
        if ($file != "." && $file != "..") {
            if (is_dir($path . '\\' . $file)) {
//                echo "$file, $path\\$file";
                outputDirInfo($file, $path . '\\' . $file);
            }

            else
                if (is_file($path . '\\' . $file))
                    makeLink($file, $path);
        }
    }
    closedir($dir);
    echo '</div>';
}

function makeLink($name, $path)
{
    echo '<a class="dir-tree" href="viewer.php?filename=' . UrlEncode($path) .
        '/' . $name . '">Файл ' . $name . '</a>';
}

echo '<div>';
outputDirInfo('корневой', getcwd());
echo '</div>';

echo '<p>tree works</p>';
