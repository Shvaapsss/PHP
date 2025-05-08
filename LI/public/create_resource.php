<?php
// Подключаем файл конфигурации для работы с базой данных
require_once 'includes/config.php';

// Проверяем, был ли отправлен POST-запрос
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $title = $_POST["title"];
    $description = $_POST["description"];
    
    // SQL-запрос для добавления нового ресурса в базу данных
    $sql = "INSERT INTO resources (title, description) VALUES ('$title', '$description')";
    
    // Выполняем запрос и проверяем успешность
    if ($conn->query($sql) === TRUE) {
        echo "Ресурс успешно создан!";
    } else {
        echo "Ошибка создания ресурса: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание ресурса</title>
</head>
<body>
    <h1>Создать новый ресурс</h1>

    <form method="POST" action="create_resource.php">
        <label for="title">Название ресурса</label>
        <input type="text" name="title" required>
        <label for="description">Описание ресурса</label>
        <textarea name="description" required></textarea>
        <button type="submit">Создать</button>
    </form>
</body>
</html>
