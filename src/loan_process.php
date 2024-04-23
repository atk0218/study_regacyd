<?php
// DB接続設定
$dsn = 'pgsql:host=db;port=5432;dbname=root;user=root;password=root';
try {
    $pdo = new PDO($dsn);

    // POSTデータの取得
    $user_name = $_POST['user_name'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];

    if ($quantity < 1) {
        echo "個数が不正です";
        exit; // Stop further processing
    }
    

    // 在庫の更新前に現在の在庫を確認
    $stmt = $pdo->prepare("SELECT quantity FROM items WHERE name = ?");
    $stmt->execute([$item_name]);
    $current_quantity = $stmt->fetchColumn();

    if ($current_quantity >= $quantity) {
        // 在庫数を減らす
        $new_quantity = $current_quantity - $quantity;
        $stmt = $pdo->prepare("UPDATE items SET quantity = ? WHERE name = ?");
        $stmt->execute([$new_quantity, $item_name]);

        // 在庫が0になったらステータスを更新
        if ($new_quantity == 0) {
            $stmt = $pdo->prepare("UPDATE items SET status = '貸出不可' WHERE name = ?");
            $stmt->execute([$item_name]);
        }

        // データベースに貸出情報を登録
        $stmt = $pdo->prepare("INSERT INTO loans (user_name, item_name, quantity, loan_date) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$user_name, $item_name, $quantity]);

        // 成功メッセージ
        echo "備品が正常に貸し出されました。在庫は更新されました。";
    } else {
        echo "在庫不足のため貸し出しできません。";
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
