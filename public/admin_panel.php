<?php
require_once '../includes/auth.php';
if ($_SESSION['role'] !== 'admin') exit("Доступ запрещён");

require_once '../includes/config.php';
echo "<h1>Админка</h1>";

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM users WHERE id = $id");
}

$result = $conn->query("SELECT id, username, role FROM users");
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['username']} ({$row['role']}) <a href='?delete={$row['id']}'>Удалить</a></p>";
}
?>
