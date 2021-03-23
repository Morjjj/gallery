<?php
require __DIR__ . '/auth.php';
if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
    if (checkAuth($_COOKIE['login'], $_COOKIE['password'])) {
        header('Location: /index.php');
    }
}
    if (!empty($_POST)) {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        if (checkAuth($login, $password)) {
            setcookie('login', $login, 0, '/');
            setcookie('password', $password, 0, '/');
            header('Location: /index.php');
        } else {
            $error = 'Ошибка авторизации';
        }
    }
?>
<html>
<head>
    <title>Cтраница входа</title>
</head>
<body>
<?php if (isset($error)): ?>
<span style="color: red"><?= $error ?></span>
<?php endif; ?>
<form action="/loginUser.php" method="post">
    <label for="login">Имя пользователя: </label><input type="text" name="login">
    <br>
    <label for="login">Пароль: </label><input type="password" name="password">
    <br>
    <input type="submit" value="Войти">
</form>
</body>
</html>
