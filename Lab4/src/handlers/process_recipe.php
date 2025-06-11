<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . '/../helpers.php';

    $title = sanitize($_POST['title'] ?? '');
    $category = sanitize($_POST['category'] ?? '');
    $ingredients = sanitize($_POST['ingredients'] ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $tags = isset($_POST['tags']) ? array_map('sanitize', $_POST['tags']) : [];
    $steps = isset($_POST['steps']) ? array_map('sanitize', $_POST['steps']) : [];

    if (!$title || !$category || !$ingredients || !$description) {
        die("Ошибка: Все поля обязательны!");
    }

    $recipe = compact("title", "category", "ingredients", "description", "tags", "steps");
    saveRecipe($recipe);

    header("Location: /public/index.php");
    exit();
}
die("Ошибка: Неверный метод запроса!");
