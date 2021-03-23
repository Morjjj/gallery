<?php

require  __DIR__ . '/auth.php';
$login = getuserLogin();

if($login !== null && !empty($_FILES['attachment'])) {

    if (!empty($_FILES['attachment'])) {
        $file = $_FILES['attachment'];
        // собираем путь до нового файла - папка uploads в текущей директории
        // в качестве имени оставляем исходное файла имя во время загрузки в браузере
        $srcFileName = $file['name'];
        $newFilePath = __DIR__ . '/uploads/' . $srcFileName;
        $sizeX = 1280;
        $sizeY = 720;
        $imageSize = getimagesize($file['tmp_name']);
        $allowedExtensions = ['jpg', 'png', 'gif'];
        $extension = pathinfo($srcFileName, PATHINFO_EXTENSION);

        if (empty ($srcFileName)) {
            $error = 'Пожалуйста, выберите файл.';
        } elseif ($imageSize[1] > $sizeY) {
            $error = 'Высота изображения не должна превышать 720px.';
        } elseif ($imageSize[0] > $sizeX) {
            $error = 'Ширина изображения не должна превышать 1280px.';
            // Установите значение upload_max_filesize в файле php.ini, равное 2M
        } elseif ($file['error'] == UPLOAD_ERR_INI_SIZE) {
            $error = 'Загружаемый файл не может превышать 2 МБ';

            // Позвольте загружать только файлы размером меньше 8Мб.
        } elseif ($file['size'] > 8388608) {
            $error = 'Загружаемый файл не может превышать 8МБ.';
        } elseif (!in_array($extension, $allowedExtensions)) {
            $error = 'Загрузка файлов с таким расширением запрещена!';
        } elseif ($file['error'] !== UPLOAD_ERR_OK) {
            $error = 'Ошибка при загрузке файла.';
        } elseif (file_exists($newFilePath)) {
            $error = 'Файл с таким именем уже существует.';
        } elseif (!move_uploaded_file($file['tmp_name'], $newFilePath)) {
            $error = 'Ошибка при загрузке файла.';
        } else {
            $result = 'http://myproject.loc/index.php/uploads/' . $srcFileName;
        }
    }
}
?>
<html>
<head>
    <title>Загрузка файла</title>
</head>
<body>
<?php if ($login === null): ?>
    <a href="/login.php">Авторизуйтесь</a>
<?php else: ?>
    Добро пожаловать, <?= $login ?> |
    <a href="/logout.php">Выйти</a>
    <br>
    <?php if (!empty($error)): ?>
        <?= $error ?>
    <?php elseif (!empty($result)): ?>
        <?= $result ?>
    <?php endif; ?>
    <br>
    <form action="/upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="attachment">
        <input type="submit">
    </form>
<?php endif; ?>
</body>
</html>