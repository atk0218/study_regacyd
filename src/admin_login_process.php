<?php
$dsn = 'pgsql:host=db;port=5432;dbname=root;user=root;password=root';
$admin_id = $_POST['admin_id'];
$password = $_POST['password'];

try {
    $pdo = new PDO($dsn);
    // 管理者IDに基づいてパスワードを取得
    $stmt = $pdo->prepare("SELECT password FROM administrators WHERE admin_id = ?");
    $stmt->execute([$admin_id]);
    $stored_password = $stmt->fetchColumn(); // データベースからパスワードを取得

    session_start(); // セッションの開始
    if ($stored_password === $password) {
        $_SESSION['admin_logged_in'] = true; // 管理者としてログインしたことをセッションに保存
        echo "ログイン成功！";
        // セッション開始やリダイレクトなどの処理
    } else {
        echo "IDまたはパスワードが間違っています。";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
echo "<footer>";
echo "<nav>";
echo "<a href='index.php'>トップページに戻る</a>";
echo "</nav>";
echo "</footer>";
?>
