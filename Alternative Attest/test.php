<?php
$dataFile = "data.json";
$jsonData = file_get_contents($dataFile);
$questionsData = json_decode($jsonData, true);
$questions = $questionsData["questions"];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест про яблоки</title>
</head>
<body>
    <h2>Пройдите тест про яблоки!</h2>
    <form action="submit.php" method="post">
        <label>Введите ваше имя: <input type="text" name="username" required></label><br><br>
        
        <?php foreach ($questions as $index => $q): ?>
            <p><?= ($index + 1) . ". " . $q["question"] ?></p>
            <?php if ($q["type"] === "radio"): ?>
                <?php foreach ($q["answers"] as $answer): ?>
                    <label>
                        <input type="radio" name="answer[<?= $index ?>]" value="<?= $answer ?>"> <?= $answer ?>
                    </label><br>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($q["answers"] as $answer): ?>
                    <label>
                        <input type="checkbox" name="answer[<?= $index ?>][]" value="<?= $answer ?>"> <?= $answer ?>
                    </label><br>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        
        <br><button type="submit">Завершить тест</button>
    </form>
</body>
</html>
