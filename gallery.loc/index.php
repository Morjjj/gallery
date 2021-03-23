<?php
require  __DIR__ . '/auth.php';
$login = getuserLogin();
?>
<html>
<head>
    <title>Фотоальбом</title>
</head>
<body>
<?php
$files = scandir(__DIR__ . '/uploads');
$links = [];
foreach ($files as $fileName) {
    if ($fileName === '.' || $fileName === '..') {
        continue;
    }
    $links[] = 'http://gallery.loc/uploads/' . $fileName;
}

foreach ($links as $link):?>
    <img src="<?= $link ?>" height="90px">
<?php endforeach; ?>

<?php if($login !== null): ?>
    <br>
    Добро пожаловать, <?= $login ?>
    <br>
    <a href="/logout.php">Выйти</a>
    <a href="upload.php">Загрузить фото</a>
<?php else: ?>
    <br>
    <a href="/loginUser.php">Авторизуйтесь</a>
<?php endif; ?>
</body>
</html>
<!--<html>
<head>
    <title>Главная страница</title>
</head>
<body>
<?php /*if($login !== null): */?>
Добро пожаловать, <?/*= $login */?>
<br>
<a href="/logout.php">Выйти</a>
<?php /*else: */?>
<a href="/loginUser.php">Авторизуйтесь</a>
<?php /*endif; */?>

</body>
</html>-->
