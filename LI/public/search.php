<?php
// Подключаем конфигурацию для работы с базой данных
require_once '../includes/config.php';

// Если форма отправлена, получаем данные для поиска
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['search_query'];
    
    // SQL-запрос для поиска по названию в базе данных
    $sql = "SELECT * FROM resources WHERE title LIKE '%$search_query%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск</title>
</head>
<body>
    <h1>Поиск ресурсов</h1>
    
    <form method="POST" action="search.php">
        <label for="search_query">Введите запрос для поиска:</label>
        <input type="text" name="search_query" required>
        <button type="submit">Поиск</button>
    </form>
    
    <?php
    // Если есть результаты поиска, выводим их
    if (isset($result) && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div><h2>" . $row["title"] . "</h2><p>" . $row["description"] . "</p></div>";
        }
    } else {
        echo "Нет результатов для вашего запроса.";
    }
    ?>
</body>
</html>
