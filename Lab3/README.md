# Лабораторная работа №3: Массивы и Функции

## Цель работы
Освоить работу с массивами в PHP, применяя различные операции: создание, добавление, удаление, сортировка и поиск. Закрепить навыки работы с функциями, включая передачу аргументов, возвращаемые значения и анонимные функции.

## Условие задания

### Задание 1: Работа с массивами
Разработать систему управления банковскими транзакциями с возможностью:

- добавления новых транзакций;
- удаления транзакций;
- сортировки транзакций по дате или сумме;
- поиска транзакций по описанию.

### Задание 1.1: Подготовка среды
Убедитесь, что у вас установлен PHP 8+.
Создайте новый PHP-файл `index.php`.
В начале файла включите строгую типизацию:

```php
<?php

declare(strict_types=1);
```
### Задание 1.2: Создание массива транзакций
Создайте массив `$transactions`, содержащий информацию о банковских транзакциях. Каждая транзакция представлена в виде ассоциативного массива с полями:

- `id` – уникальный идентификатор транзакции;
- `date` – дата совершения транзакции (YYYY-MM-DD);
- `amount` – сумма транзакции;
- `description` – описание назначения платежа;
- `merchant` – название организации, получившей платеж.

Пример массива:

```php
$transactions = [
    [
        "id" => 1,
        "date" => "2019-01-01",
        "amount" => 100.00,
        "description" => "Payment for groceries",
        "merchant" => "SuperMart",
    ],
    [
        "id" => 2,
        "date" => "2020-02-15",
        "amount" => 75.50,
        "description" => "Dinner with friends",
        "merchant" => "Local Restaurant",
    ],
];
```
### Задание 1.3: Вывод списка транзакций
Используйте `foreach`, чтобы вывести список транзакций в HTML-таблице.

Пример таблицы:

```php
<table border='1'>
<thead>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Merchant</th>
    </tr>
</thead>

<tbody>
<?php
foreach ($transactions as $transaction) {
    echo "<tr>";
    echo "<td>" . $transaction['id'] . "</td>";
    echo "<td>" . $transaction['date'] . "</td>";
    echo "<td>" . $transaction['amount'] . "</td>";
    echo "<td>" . $transaction['description'] . "</td>";
    echo "<td>" . $transaction['merchant'] . "</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
```
### Задание 1.4: Реализация функций

1. **Функция `calculateTotalAmount`**

Создайте функцию `calculateTotalAmount(array $transactions): float`, которая вычисляет общую сумму всех транзакций.

```php
/**
 * Calculate the total amount of all transactions
 *
 * @param array $transactions
 * @return float
 */
function calculateTotalAmount(array $transactions): float {
    $total = 0.0;
    foreach ($transactions as $transaction) {
        $total += $transaction['amount'];
    }
    return $total;
}
```
Выведите сумму всех транзакций в конце таблицы:

```php
$totalAmount = calculateTotalAmount($transactions);
echo "<p>Total Amount: " . $totalAmount . "</p>";
```

2. **Функция `findTransactionByDescription`**

Создайте функцию `findTransactionByDescription(string $descriptionPart)`, которая ищет транзакцию по части описания.
```php
/**
 * Find a transaction by part of its description
 *
 * @param string $descriptionPart
 * @return array|null
 */
function findTransactionByDescription(string $descriptionPart) {
    foreach ($transactions as $transaction) {
        if (strpos($transaction['description'], $descriptionPart) !== false) {
            return $transaction;
        }
    }
    return null;
}
```

3. **Функция `findTransactionById`**

Создайте функцию `findTransactionById(int $id)`, которая ищет транзакцию по идентификатору.
```php
/**
 * Find a transaction by its ID
 *
 * @param int $id
 * @return array|null
 */
function findTransactionById(int $id) {
    foreach ($transactions as $transaction) {
        if ($transaction['id'] === $id) {
            return $transaction;
        }
    }
    return null;
}
```

4. **Функция `daysSinceTransaction`**
   
Создайте функцию `daysSinceTransaction(string $date): int`, которая возвращает количество дней между датой транзакции и текущим днем.
```php
/**
 * Calculate the number of days since a given transaction date
 *
 * @param string $date
 * @return int
 */
function daysSinceTransaction(string $date): int {
    $transactionDate = new DateTime($date);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($transactionDate);
    return $interval->days;
}
```
Добавьте в таблицу столбец с количеством дней с момента транзакции:
```php
<tbody>
<?php
foreach ($transactions as $transaction) {
    echo "<tr>";
    echo "<td>" . $transaction['id'] . "</td>";
    echo "<td>" . $transaction['date'] . "</td>";
    echo "<td>" . $transaction['amount'] . "</td>";
    echo "<td>" . $transaction['description'] . "</td>";
    echo "<td>" . $transaction['merchant'] . "</td>";
    echo "<td>" . daysSinceTransaction($transaction['date']) . " days</td>";
    echo "</tr>";
}
?>
</tbody>
```

5. **Функция `addTransaction`**
   
Создайте функцию `addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void` для добавления новой транзакции.
```php 
/**
 * Add a new transaction to the transactions array
 *
 * @param int $id
 * @param string $date
 * @param float $amount
 * @param string $description
 * @param string $merchant
 */
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void {
    global $transactions;
    $transactions[] = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];
}
```
### Задание 1.5: Сортировка транзакций

1. **Сортировка транзакций по дате**

Отсортируйте транзакции по дате с использованием `usort()`.

```php
/**
 * Sort transactions by date
 *
 * @param array $transactions
 * @return array
 */
function sortTransactionsByDate(array $transactions): array {
    usort($transactions, function ($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    });
    return $transactions;
}
```
2. **Сортировка транзакций по сумме (по убыванию)**
Отсортируйте транзакции по сумме в порядке убывания.
```php
/**
 * Sort transactions by amount in descending order
 *
 * @param array $transactions
 * @return array
 */
function sortTransactionsByAmountDesc(array $transactions): array {
    usort($transactions, function ($a, $b) {
        return $b['amount'] - $a['amount'];
    });
    return $transactions;
}
```
### Задание 2: Работа с файловой системой

1. **Вывод изображений из директории "image"**

Создайте директорию "image", в которой сохраните не менее 20-30 изображений с расширением `.jpg`. Затем создайте файл `index.php`, в котором определите веб-страницу с хедером, меню, контентом и футером.

```php
<?php
// Задаем путь к папке с изображениями
$dir = 'image/';
// Сканируем содержимое директории
$files = scandir($dir);

// Если нет ошибок при сканировании
if ($files === false) {
    return;
}

echo "<h1>Image Gallery</h1>";
echo "<div class='gallery'>";
for ($i = 0; $i < count($files); $i++) {
    // Пропускаем текущий каталог и родительский
    if (($files[$i] != ".") && ($files[$i] != "..") && pathinfo($files[$i], PATHINFO_EXTENSION) == 'jpg') {
        // Получаем путь к изображению
        $path = $dir . $files[$i];
        echo "<img src='$path' alt='Image' style='width: 100px; margin: 10px;'>";
    }
}
echo "</div>";
?>
```
2.**HTML-разметка страницы**
Пример структуры веб-страницы с хедером, меню, контентом и футером.
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Apple Image Gallery</title>
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
        }
        .gallery img {
            width: 100px;
            height: auto;
            margin: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Green Apple Image Gallery</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
    
    <section id="gallery">
        <h2>Green Apples Image Gallery</h2>
      
    </section>
    
    <footer>
        <p>&copy; Green Apple Image Gallery.</p>
    </footer>
</body>
</html>
```
### Контрольные вопросы
1. **Что такое массивы в PHP?**

Массивы в PHP — это структуры данных, которые позволяют хранить несколько значений в одной переменной. Массивы могут быть индексированными, где значения хранятся по порядку с числовыми индексами, и ассоциативными, где значения хранятся по ключам, которые могут быть строками.

2. **Каким образом можно создать массив в PHP?**

Массив можно создать с помощью функции `array()` или через синтаксис с квадратными скобками `[]`.

Пример создания индексированного массива:

```php
$array = array(1, 2, 3);
```
Или с использованием синтаксиса с квадратными скобками:

```php
$array = [1, 2, 3];
```
Пример создания ассоциативного массива:

```php
$array = [
    "name" => "John",
    "age" => 30,
];
```
3. **Для чего используется цикл `foreach`?**

Цикл `foreach` используется для перебора элементов массива в PHP. Он позволяет получить доступ к каждому элементу массива поочередно и выполнить операцию с этим элементом.

Пример использования:

```php
$fruits = ["apple", "banana", "cherry"];
foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}
```
