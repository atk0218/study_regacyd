<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
</head>
<body>
    <h1>管理者ログイン</h1>
    <form action="admin_login_process.php" method="post">
        <label for="admin_id">ID:</label>
        <input type="text" id="admin_id" name="admin_id"><br>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password"><br>
        <button type="submit">ログイン</button>
    </form>
<?php
echo "<footer>";
echo "<nav>";
echo "<a href='index.php'>トップページに戻る</a>";
echo "</nav>";
echo "</footer>";
?>
</body>
</html>
