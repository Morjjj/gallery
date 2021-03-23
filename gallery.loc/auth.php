<?php

function checkAuth(string $login,string $password)
{
    $users = require __DIR__.'/usersDB.php';

    foreach ($users as $user) {
        if ($user['login'] === $login && $user['password'] === $password){
            return true;
        }
    }
    return false;
}

function getuserLogin(): ?string
{
    $loginFromCookie = $_COOKIE['login'] ?? '';
    $passwordFromCookie =$_COOKIE['password'] ?? '';

    if (checkAuth($loginFromCookie,$passwordFromCookie)){
        return  $loginFromCookie;
    }
    return null;
}