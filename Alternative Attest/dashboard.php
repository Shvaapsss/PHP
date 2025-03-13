<?php
$resultsFile = 'results.json';
$results = json_decode(file_get_contents($resultsFile), true);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица лидеров</title>
</head>
<body>
    <h2>Результаты теста</h2>
    <table border="1">
        <tr>
            <th>Имя</th>
            <th>Процент</th>
        </tr>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?= $result['username'] ?></td>
                <td><?= $result['score'] ?>%</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="test.php"><button>Пройти тест заново</button></a>
</body>
</html>
