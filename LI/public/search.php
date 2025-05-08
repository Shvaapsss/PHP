<?php
require_once '../includes/auth.php';
require_once '../includes/config.php';
?>
<form method="get">
    <input name="q" placeholder="Поиск...">
    <button>Поиск</button>
</form>
<?php
if (!empty($_GET['q'])) {
    $q = "%" . $_GET['q'] . "%";
    $stmt = $conn->prepare("SELECT * FROM resources WHERE title LIKE ?");
    $stmt->bind_param("s", $q);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    }
}
?>
