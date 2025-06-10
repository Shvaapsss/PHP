<?php
declare(strict_types=1);

// Исходные транзакции
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

/**
 * Calculate the total amount of all transactions
 */
function calculateTotalAmount(array $transactions): float {
    $total = 0.0;
    foreach ($transactions as $transaction) {
        $total += $transaction['amount'];
    }
    return $total;
}

/**
 * Find a transaction by part of its description
 */
function findTransactionByDescription(array $transactions, string $descriptionPart): ?array {
    foreach ($transactions as $transaction) {
        if (strpos($transaction['description'], $descriptionPart) !== false) {
            return $transaction;
        }
    }
    return null;
}

/**
 * Find a transaction by its ID
 */
function findTransactionById(array $transactions, int $id): ?array {
    foreach ($transactions as $transaction) {
        if ($transaction['id'] === $id) {
            return $transaction;
        }
    }
    return null;
}

/**
 * Calculate the number of days since a given transaction date
 */
function daysSinceTransaction(string $date): int {
    $transactionDate = new DateTime($date);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($transactionDate);
    return $interval->days;
}

/**
 * Add a new transaction to the transactions array
 */
function addTransaction(array &$transactions, int $id, string $date, float $amount, string $description, string $merchant): void {
    $transactions[] = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];
}

/**
 * Sort transactions by date
 */
function sortTransactionsByDate(array &$transactions): void {
    usort($transactions, function ($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    });
}

/**
 * Sort transactions by amount in descending order
 */
function sortTransactionsByAmountDesc(array &$transactions): void {
    usort($transactions, function ($a, $b) {
        return $b['amount'] <=> $a['amount'];
    });
}

// Добавляем новую транзакцию
addTransaction($transactions, 3, "2021-03-20", 50.25, "Book purchase", "BookStore");

// Сортировка транзакций
sortTransactionsByDate($transactions);
// sortTransactionsByAmountDesc($transactions);

// Поиск транзакции
$foundTransaction = findTransactionByDescription($transactions, "groceries");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bank Transactions</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Bank Transactions</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Merchant</th>
                <th>Days Since</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= $transaction['id'] ?></td>
                    <td><?= $transaction['date'] ?></td>
                    <td><?= number_format($transaction['amount'], 2) ?></td>
                    <td><?= $transaction['description'] ?></td>
                    <td><?= $transaction['merchant'] ?></td>
                    <td><?= daysSinceTransaction($transaction['date']) ?> days</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Total Amount: <?= number_format(calculateTotalAmount($transactions), 2) ?></p>

    <?php if ($foundTransaction): ?>
        <h2>Found Transaction:</h2>
        <pre><?= print_r($foundTransaction, true) ?></pre>
    <?php endif; ?>
</body>
</html>
