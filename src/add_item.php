<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>備品登録</title>
</head>
<body>
    <h1>備品登録</h1>
    <form action="add_item_process.php" method="post">
        <p>
            <label for="name">備品名:</label>
            <input type="text" id="name" name="name" required>
        </p>
        <p>
            <label for="quantity">数量:</label>
            <input type="number" id="quantity" name="quantity" required min="1">
        </p>
        <p>
            <label for="status">状態:</label>
            <select id="status" name="status">
                <option value="貸出可能">貸出可能</option>
                <option value="貸出不可">貸出不可</option>
            </select>
        </p>
        <button type="submit">登録</button>
    </form>
    <footer>
        <a href="index.php">トップページに戻る</a>
    </footer>
</body>
</html>
