<?php
require_once __DIR__ . '/../src/helpers.php';
$recipes = loadRecipes();
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 5;
$totalPages = ceil(count($recipes) / $perPage);
$start = ($page - 1) * $perPage;
$recipes = array_slice($recipes, $start, $perPage);
?>
<!DOCTYPE html>
<html>
<head><title>Список рецептов</title></head>
<body>
<h1>Рецепты</h1>
<a href="recipe/create.php">Добавить рецепт</a>
<ul>
<?php foreach ($recipes as $recipe): ?>
    <li><a href="recipe/index.php?title=<?php echo urlencode($recipe['title']); ?>">
        <?php echo htmlspecialchars($recipe['title']); ?></a>
    </li>
<?php endforeach; ?>
</ul>
<div>
    <?php if ($page > 1): ?><a href="?page=<?php echo $page - 1; ?>">Назад</a><?php endif; ?>
    <?php if ($page < $totalPages): ?><a href="?page=<?php echo $page + 1; ?>">Вперед</a><?php endif; ?>
</div>
</body>
</html>
