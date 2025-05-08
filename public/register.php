<?php
require_once '../includes/config.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    header("Location: login.php");
}
?>
<form method="post">
    <input name="username" required>
    <input type="password" name="password" required>
    <button>Зарегистрироваться</button>
</form>
