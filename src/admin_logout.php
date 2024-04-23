<?php
session_start(); // セッションを開始

// セッション変数を全て削除
$_SESSION = array();

// クッキーに保存されているセッションIDを削除
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 最終的に、セッションを破壊してログアウトを完了
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログアウト完了</title>
    <!-- 5秒後にトップページにリダイレクト -->
    <meta http-equiv="refresh" content="3;url=index.php">
</head>
<body>
    <h1>ログアウトが完了しました。</h1>
    <p>3秒後にトップページに自動的にリダイレクトされます。リダイレクトされない場合は、<a href="index.php">こちら</a>をクリックしてください。</p>
</body>
</html>
