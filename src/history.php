<?php
session_start();  // セッションの開始
$dsn = 'pgsql:host=db;port=5432;dbname=root;user=root;password=root';
try {
    $pdo = new PDO($dsn);
    echo "<h1>貸出履歴</h1>";
    echo "<table border='1'>";
    echo "<tr><th>User Name</th><th>Item Name</th><th>Quantity</th><th>Type</th><th>Date</th></tr>";

    // loans テーブルからのデータ
    $query_loans = $pdo->query("SELECT id, user_name, item_name, quantity, '貸出' as type, loan_date as date FROM loans ORDER BY loan_date DESC;");
    while ($row = $query_loans->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
        echo "<td>" . date('Y-m-d H:i:s', strtotime($row['date'])) . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<h1>返却履歴</h1>";
    echo "<table border='1'>";
    echo "<tr><th>User Name</th><th>Item Name</th><th>Quantity</th><th>Type</th><th>Date</th></tr>";
    // returns テーブルからのデータ
    $query_returns = $pdo->query("SELECT id, user_name, item_name, quantity, '返却' as type, return_date as date FROM returns ORDER BY return_date DESC;");
    while ($row = $query_returns->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
        echo "<td>" . date('Y-m-d H:i:s', strtotime($row['date'])) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
echo "<footer>";
echo "<nav>";
echo "<a href='index.php'>トップページに戻る</a>";
echo "</nav>";
echo "</footer>";
?>
