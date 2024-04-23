<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$dsn = 'pgsql:host=db;port=5432;dbname=root;user=root;password=root';
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$status = $_POST['status'];

if ($quantity < 1) {
    echo "個数が不正です";
    exit; // Stop further processing
}

try {
    $pdo = new PDO($dsn);
    $stmt = $pdo->prepare("INSERT INTO items (name, quantity, status) VALUES (?, ?, ?)");
    $stmt->execute([$name, $quantity, $status]);
    echo "備品が登録されました。";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<footer>
    <a href="index.php">トップページに戻る</a>
</footer>
