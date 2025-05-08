<?php
require_once '../includes/config.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash, $role);
        $stmt->fetch();
        if (password_verify($_POST['password'], $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            header("Location: dashboard.php");
            exit;
        }
    }
    echo "Неверные данные.";
}
?>
<form method="post">
    <input name="username" required>
    <input type="password" name="password" required>
    <button>Войти</button>
</form>
