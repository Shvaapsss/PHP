<?php
require_once '../includes/auth.php';
require_once '../includes/config.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO resources (title, description, category, is_active, created_by)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $_POST['title'], $_POST['desc'], $_POST['cat'], $_POST['active'], $_SESSION['user_id']);
    $stmt->execute();
    echo "Создано!";
}
?>
<form method="post">
    <input name="title" required>
    <textarea name="desc" required></textarea>
    <select name="cat"><option>Общая</option><option>Приватная</option></select>
    <label><input type="radio" name="active" value="1" checked> Активен</label>
    <label><input type="radio" name="active" value="0"> Неактивен</label>
    <button>Сохранить</button>
</form>
