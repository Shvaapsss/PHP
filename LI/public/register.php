<?php
// Подключаем файл конфигурации для работы с базой данных
require_once 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем логин и пароль из формы
    $login = $_POST["login"];
    $password = $_POST["password"];
    
    // Хэшируем пароль перед сохранением в базе данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // SQL-запрос для добавления нового пользователя в таблицу users
    $sql = "INSERT INTO users (login, password) VALUES ('$login', '$hashed_password')";
    
    // Выполняем запрос и проверяем успешность
    if ($conn->query($sql) === TRUE) {
        echo "Регистрация прошла успешно! <a href='login.php'>Войти</a>";
    } else {
        echo "Ошибка регистрации: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация нового пользователя</h1>

    <form method="POST" action="register.php">
        <label for="login">Логин</label>
        <input type="text" name="login" required>
        <label for="password">Пароль</label>
        <input type="password" name="password" required>
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>
