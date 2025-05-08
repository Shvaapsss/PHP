<?php
// Настройки для подключения к базе данных
$servername = "localhost";
$username = "root"; // Убедитесь, что это ваши данные
$password = "";     // Ваш пароль для подключения
$dbname = "web_app"; // Имя вашей базы данных

// Создание соединения с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка на успешность подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
