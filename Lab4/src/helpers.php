<?php
function getRecipesFile() {
    return __DIR__ . '/../storage/recipes.txt';
}

function loadRecipes() {
    $file = getRecipesFile();
    if (!file_exists($file)) return [];
    return array_map('json_decode', file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}

function saveRecipe($recipe) {
    file_put_contents(getRecipesFile(), json_encode($recipe, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);
}

function sanitize($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}
