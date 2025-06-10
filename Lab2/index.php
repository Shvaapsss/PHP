<?php
// Часть 1: Условные конструкции
$dayOfWeek = date('N'); // 1 - Понедельник, 7 - Воскресенье
$johnStylesSchedule = in_array($dayOfWeek, [1, 3, 5]) ? '8:00-12:00' : 'Нерабочий день';
$janeDoeSchedule = in_array($dayOfWeek, [2, 4, 6]) ? '12:00-16:00' : 'Нерабочий день';

echo "<h2>Расписание</h2>";
echo "<table border='1'>";
echo "<tr><th>№</th><th>Фамилия Имя</th><th>График работы</th></tr>";
echo "<tr><td>1</td><td>John Styles</td><td>$johnStylesSchedule</td></tr>";
echo "<tr><td>2</td><td>Jane Doe</td><td>$janeDoeSchedule</td></tr>";
echo "</table>";

// Часть 2: Циклы
echo "<h2>Циклы</h2>";

// Цикл for
echo "<h3>Цикл for</h3>";
$a = 0;
$b = 0;
for ($i = 0; $i <= 5; $i++) {
    $a += 10;
    $b += 5;
    echo "Итерация $i: a = $a, b = $b <br>";
}
echo "Конец цикла for: a = $a, b = $b <br>";

// Цикл while
echo "<h3>Цикл while</h3>";
$a = 0;
$b = 0;
$i = 0;
while ($i <= 5) {
    $a += 10;
    $b += 5;
    echo "Итерация $i: a = $a, b = $b <br>";
    $i++;
}
echo "Конец цикла while: a = $a, b = $b <br>";

// Цикл do-while
echo "<h3>Цикл do-while</h3>";
$a = 0;
$b = 0;
$i = 0;
do {
    $a += 10;
    $b += 5;
    echo "Итерация $i: a = $a, b = $b <br>";
    $i++;
} while ($i <= 5);
echo "Конец цикла do-while: a = $a, b = $b <br>";
?>
