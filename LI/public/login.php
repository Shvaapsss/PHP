<?php
// Подключаем файл конфигурации для работы с базой данных
require_once 'includes/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем логин и пароль из формы
    $login = $_POST["login"];
    $password = $_POST["password"];
    
    // SQL-запрос для поиска пользователя в базе данных по логину
    $sql = "SELECT * FROM users WHERE login = '$login'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Если пользователь найден, проверяем пароль
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Если пароль совпадает, сохраняем информацию о пользователе в сессию
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['login'];
            header("Location: index.php"); // Перенаправляем на главную страницу
        } else {
            echo "Неверный пароль!";
        }
    } else {
        echo "Пользователь не найден!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<body>
    <h1>Вход в систему</h1>

    <form method="POST" action="login.php">
        <label for="login">Логин</label>
        <input type="text" name="login" required>
        <label for="password">Пароль</label>
        <input type="password" name="password" required>
        <button type="submit">Войти</button>
    </form>
</body>
</html>
