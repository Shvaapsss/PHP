<?php
// Подключаем конфигурацию и файл для проверки авторизации
require_once '../includes/config.php';
require_once '../includes/auth.php'; // Проверка авторизации

// Выводим приветственное сообщение для авторизованного пользователя
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать, <?php echo $user_name; ?>!</title>
</head>
<body>
    <h1>Добро пожаловать, <?php echo $user_name; ?>!</h1>
    <p>Это ваш дашборд. Здесь можно увидеть важную информацию о вашем аккаунте.</p>
    <p><a href="logout.php">Выйти</a></p>
</body>
</html>
