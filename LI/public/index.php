<?php
// Старт сессии для хранения данных о пользователе
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>
<body>
    <h1>Добро пожаловать на главную страницу!</h1>

    <?php
    // Проверка, авторизован ли пользователь
    if (!isset($_SESSION['user_id'])) {
        // Если не авторизован — выводим ссылки на страницу регистрации и входа
        echo "Вы не авторизованы. Пожалуйста, <a href='login.php'>войдите</a> или <a href='register.php'>зарегистрируйтесь</a>.";
    } else {
        // Если пользователь авторизован — показываем ссылку для выхода
        echo "Добро пожаловать, <strong>{$_SESSION['user_name']}</strong>! <a href='logout.php'>Выйти</a>";
    }
    ?>
</body>
</html>
