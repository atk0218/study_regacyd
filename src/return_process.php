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
    $stmt = $pdo->prepare("SELECT quantity, status FROM items WHERE name = ?");
    $stmt->execute([$item_name]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    $current_quantity = $item['quantity'];
    $current_status = $item['status'];

    // 在庫数を増やす
    $new_quantity = $current_quantity + $quantity;
    $stmt = $pdo->prepare("UPDATE items SET quantity = ? WHERE name = ?");
    $stmt->execute([$new_quantity, $item_name]);

    // 在庫が1以上でステータスが「貸出不可」の場合、ステータスを「貸出可能」に更新
    if ($new_quantity >= 1 && $current_status == '貸出不可') {
        $stmt = $pdo->prepare("UPDATE items SET status = '貸出可能' WHERE name = ?");
        $stmt->execute([$item_name]);
    }

    // データベースに返却情報を登録
    $stmt = $pdo->prepare("INSERT INTO returns (user_name, item_name, quantity, return_date) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user_name, $item_name, $quantity]);

    // 成功メッセージ
    echo "備品が正常に返却されました。在庫は更新されました。";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
echo "<footer>";
echo "<nav>";
echo "<a href='index.php'>トップページに戻る</a>";
echo "</nav>";
echo "</footer>";
?>
