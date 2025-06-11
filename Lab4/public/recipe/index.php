<?php
require_once __DIR__ . '/../../src/helpers.php';
$recipes = loadRecipes();
$title = $_GET['title'] ?? '';
$recipe = array_filter($recipes, fn($r) => $r['title'] === $title);
$recipe = reset($recipe);
if (!$recipe) die("Рецепт не найден");
?>
<!DOCTYPE html>
<html>
<head><title><?= htmlspecialchars($recipe['title']) ?></title></head>
<body>
<h1><?= htmlspecialchars($recipe['title']) ?></h1>
<p>Категория: <?= htmlspecialchars($recipe['category']) ?></p>
<p>Ингредиенты: <?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
<p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
<h2>Шаги приготовления:</h2>
<ol>
    <?php foreach ($recipe['steps'] as $step): ?>
        <li><?= htmlspecialchars($step) ?></li>
    <?php endforeach; ?>
</ol>
<a href="create.php">Добавить рецепт</a>
</body>
</html>
