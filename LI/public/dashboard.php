<?php
require_once '../includes/auth.php';
?>
<h1>Личный кабинет</h1>
<p>Вы вошли как пользователь.</p>
<a href="create_resource.php">Создать ресурс</a> |
<a href="search.php">Поиск</a> |
<a href="logout.php">Выход</a>
<?php if ($_SESSION['role'] === 'admin') echo '<p><a href="admin_panel.php">Админка</a></p>'; ?>
