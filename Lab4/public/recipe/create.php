<?php
$categories = ["Завтрак", "Обед", "Ужин", "Десерт"];
$tags = ["Быстро", "Полезно", "Вегетарианское", "Детское"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Добавить рецепт</title>
    <script>
        function addStep() {
            let container = document.getElementById("steps");
            let input = document.createElement("input");
            input.type = "text";
            input.name = "steps[]";
            container.appendChild(input);
        }
    </script>
</head>
<body>
<h1>Добавить рецепт</h1>
<form action="/src/handlers/process_recipe.php" method="post">
    <label>Название: <input type="text" name="title" required></label><br>
    <label>Категория:
        <select name="category">
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category ?>"><?= $category ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Ингредиенты: <textarea name="ingredients" required></textarea></label><br>
    <label>Описание: <textarea name="description" required></textarea></label><br>
    <label>Теги:
        <select name="tags[]" multiple>
            <?php foreach ($tags as $tag): ?>
                <option value="<?= $tag ?>"><?= $tag ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Шаги:</label>
    <div id="steps">
        <input type="text" name="steps[]">
    </div>
    <button type="button" onclick="addStep()">Добавить шаг</button><br>
    <button type="submit">Сохранить</button>
</form>
</body>
</html>
