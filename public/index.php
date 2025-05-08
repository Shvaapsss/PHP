<?php
require_once '../includes/config.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Главная</title></head>
<body>
<h1>Добро пожаловать</h1>
<p><a href="login.php">Вход</a> | <a href="register.php">Регистрация</a></p>

<h2>Публичный контент</h2>
<?php
$result = mysqli_query($conn, "SELECT title, description FROM resources LIMIT 3");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
}
?>
</body>
</html>
