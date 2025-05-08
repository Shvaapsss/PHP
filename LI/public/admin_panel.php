<?php
// Подключаем файл конфигурации и файл для проверки авторизации
require_once '../includes/config.php';
require_once '../includes/auth.php'; // Проверка, что пользователь авторизован как администратор

// Получение списка пользователей для отображения в панели администратора
$sql = "SELECT id, login FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
</head>
<body>
    <h1>Панель администратора</h1>
    
    <h2>Список пользователей:</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Логин</th>
        </tr>
        <?php
        // Выводим каждого пользователя в таблицу
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["login"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Нет пользователей</td></tr>";
        }
        ?>
    </table>
</body>
</html>
