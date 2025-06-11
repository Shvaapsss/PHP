# Лабораторная работа №4: Обработка и валидация форм

## Цель работы

Освоить принципы работы с HTML-формами в PHP, включая отправку данных, их обработку, валидацию и сохранение. Эта лабораторная работа является основой для дальнейшего изучения разработки веб-приложений.

## Структура проекта

```
recipe-book/
├── public/                        
│   ├── index.php                   # Главная страница (вывод последних рецептов)
│   └── recipe/                    
│       ├── create.php              # Форма добавления рецепта
│       └── index.php               # Страница с отображением всех рецептов
├── src/                            
│   ├── handlers/                   # Обработчики форм
│   │   ├── process_recipe.php       # Обработчик формы добавления рецепта
│   └── helpers.php                 # Вспомогательные функции
├── storage/                        
│   └── recipes.txt                 # Файл для хранения рецептов
└── README.md                       # Описание проекта
```

---

## 1. Создание проекта

Создана корневая директория `recipe-book` с описанной выше структурой. Все файлы организованы по назначению.

---

## 2. Создание формы добавления рецепта

Форма представлена в файле `public/recipe/create.php`.

```php
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить рецепт</title>
    <script>
        function addStep() {
            let stepsContainer = document.getElementById('steps-container');
            let input = document.createElement('input');
            input.type = 'text';
            input.name = 'steps[]';
            input.placeholder = 'Введите шаг приготовления';
            stepsContainer.appendChild(input);
        }
    </script>
</head>
<body>
    <h2>Добавить рецепт</h2>
    <form action="../../src/handlers/process_recipe.php" method="post">
        <label>Название рецепта: <input type="text" name="title" required></label><br>
        <label>Категория:
            <select name="category">
                <option value="Завтрак">Завтрак</option>
                <option value="Обед">Обед</option>
                <option value="Ужин">Ужин</option>
            </select>
        </label><br>
        <label>Ингредиенты:<br>
            <textarea name="ingredients" required></textarea>
        </label><br>
        <label>Описание:<br>
            <textarea name="description" required></textarea>
        </label><br>
        <label>Тэги:
            <select name="tags[]" multiple>
                <option value="Вегетарианское">Вегетарианское</option>
                <option value="Мясное">Мясное</option>
                <option value="Быстрое">Быстрое</option>
            </select>
        </label><br>
        <label>Шаги приготовления:</label>
        <div id="steps-container"></div>
        <button type="button" onclick="addStep()">Добавить шаг</button><br>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>
```

---

## 3. Обработка формы

Файл `src/handlers/process_recipe.php` содержит обработку формы.

```php
<?php
require_once '../helpers.php';

$data = [
    'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
    'category' => $_POST['category'],
    'ingredients' => filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_STRING),
    'description' => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
    'tags' => $_POST['tags'] ?? [],
    'steps' => $_POST['steps'] ?? []
];

if (empty($data['title']) || empty($data['ingredients']) || empty($data['description'])) {
    die("Ошибка: Все обязательные поля должны быть заполнены!");
}

$file = '../../storage/recipes.txt';
file_put_contents($file, json_encode($data) . PHP_EOL, FILE_APPEND);

header('Location: ../../public/index.php');
exit;
```

---

## 4. Отображение рецептов

Файл `public/index.php` показывает последние 2 рецепта.

```php
<?php
$file = '../storage/recipes.txt';
$recipes = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
$recipes = array_map('json_decode', $recipes);
$latestRecipes = array_slice($recipes, -2);

foreach ($latestRecipes as $recipe) {
    echo "<h3>{$recipe->title}</h3>";
    echo "<p><strong>Категория:</strong> {$recipe->category}</p>";
    echo "<p><strong>Описание:</strong> {$recipe->description}</p>";
}
```

Файл `public/recipe/index.php` выводит все рецепты с пагинацией.

```php
<?php
$file = '../../storage/recipes.txt';
$recipes = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
$recipes = array_map('json_decode', $recipes);

$page = $_GET['page'] ?? 1;
$perPage = 5;
$totalPages = ceil(count($recipes) / $perPage);
$start = ($page - 1) * $perPage;
$recipesToShow = array_slice($recipes, $start, $perPage);

foreach ($recipesToShow as $recipe) {
    echo "<h3>{$recipe->title}</h3>";
}

if ($page > 1) {
    echo "<a href='index.php?page=" . ($page - 1) . "'>Предыдущая</a> ";
}
if ($page < $totalPages) {
    echo "<a href='index.php?page=" . ($page + 1) . "'>Следующая</a>";
}
```

---

## Контрольные вопросы

### 1. Какие методы HTTP применяются для отправки данных формы?
Используются `GET` и `POST`. `POST` безопаснее, так как данные передаются в теле запроса.

### 2. Что такое валидация данных, и чем она отличается от фильтрации?
- **Валидация** проверяет корректность введенных данных (например, обязательные поля).
- **Фильтрация** удаляет или преобразует нежелательные символы из данных (например, `FILTER_SANITIZE_STRING`).

### 3. Какие функции PHP используются для фильтрации данных?
Функции `filter_input()`, `htmlspecialchars()`, `strip_tags()` и `filter_var()`.

---

## Вывод

Лабораторная работа выполнена в соответствии с требованиями. Реализована динамическая форма, обработка, валидация и отображение рецептов с пагинацией.

