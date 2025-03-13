<?php
$dataFile = "data.json";
$jsonData = file_get_contents($dataFile);
$questionsData = json_decode($jsonData, true);
$questions = $questionsData["questions"];

$answers = $_POST['answer'];
$username = trim($_POST['username']);
$score = 0;
$totalQuestions = count($questions);

foreach ($questions as $index => $q) {
    $correctAnswers = $q['correct'];
    $userAnswer = $answers[$index] ?? [];

    if ($q['type'] === 'radio') {
        if ($userAnswer == $correctAnswers[0]) {
            $score++;
        }
    } else {
        sort($userAnswer);
        sort($correctAnswers);
        if ($userAnswer === $correctAnswers) {
            $score++;
        }
    }
}

$percentage = round(($score / $totalQuestions) * 100);

$resultsFile = 'results.json';
$results = json_decode(file_get_contents($resultsFile), true);
$results[] = [
    'username' => $username,
    'score' => $percentage
];

file_put_contents($resultsFile, json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты</title>
</head>
<body>
    <h2>Ваш результат:</h2>
    <p>Правильных ответов: <?= $score ?> из <?= $totalQuestions ?></p>
    <p>Набранные баллы: <?= $percentage ?>%</p>
    <a href="dashboard.php"><button>Просмотреть лидеров</button></a>
    <a href="test.php"><button>Пройти тест заново</button></a>
</body>
</html>
