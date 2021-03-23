<?php
require __DIR__ . '/auth.php';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
setcookie('login',$login,time()-3600, '/');
setcookie('password',$password,time()-3600, '/');
header("Location: /index.php");
//другой способ
/*if (!empty($_COOKIE)) {
    setcookie('login', $login, -10, '/');
    setcookie('password', $password, -10, '/');
    header('Location: /indexMain.php');
}*/
