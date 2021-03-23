<?php
$login = !empty($_POST['login']) ? $_POST['login'] : 'логин не передан';
$password = !empty($_POST['password']) ? $_POST['password'] : 'пароль не передан';

if ($login === 'admin' && $password === 'Pa$$w0rd') {
    $isAuthorized = 'Авторизация прошла успешно';
} else if($login !== 'admin') {
    $isAuthorized = 'Логин неверный';
} else {
    $isAuthorized = 'Пароль неверный';
}
?>
<html>
<head>
    <title>Результат авторизации</title>
</head>
<body>
<p>
    <?= $isAuthorized ?>
</p>
</body>
</html>