<?php
session_start();

if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['user']) && isset($_POST['login']) &&
    isset($_POST['password']) && $f = fopen('users.csv', 'rt')) {
    while (!feof($f)) {
        $auth_user = explode(';', fgets($f));

        if (trim($auth_user[0]) == $_POST['login']) {
            if (isset($auth_user[1]) &&
                trim($auth_user[1]) == $_POST['password']) {
                $_SESSION['user'] = $auth_user;
                header('Location: index.php');
                exit();
            } else
                break;
        }
    }

    echo '</div>Неверный логин или пароль!</div>';
    fclose($f);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Login Page</title>
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo '<form name="auth" method="post" action="">
            <input type="text" name="login"';

    if (isset($_POST['login']))
        echo ' value="' . $_POST['login'] . '"';

    echo '><input type="password" name="password">
               <input type="submit" value="Войти">
               </form>';
} else {
    echo '<div>
            <p>Добро пожаловать, ' . $_SESSION['user'][0] . '!</p>
            <a href="index.php?logout=">Выход</a>
          </div>';
    include 'tree.php';
}
?>
</body>
</html>
