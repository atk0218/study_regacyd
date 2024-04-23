<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Redirect if not logged in
    exit;
}
$dsn = 'pgsql:host=db;port=5432;dbname=root;user=root;password=root';
$id = $_POST['id'];

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$id]);
    echo "備品が削除されました。";
    echo "<footer>";
    echo "<nav>";
    echo "<a href='index.php'>トップページに戻る</a>";
    echo "</nav>";
    echo "</footer>";
} catch (PDOException $e) {
    echo "削除に失敗しました: " . $e->getMessage();
}
?>
