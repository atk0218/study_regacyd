<?php
session_start(); // セッション開始
// DB接続設定
$dsn = 'pgsql:host=db;port=5432;dbname=root;user=root;password=root';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>備品管理システム</title>
    <!-- Bootstrap CSSの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1 class="mb-4">備品一覧</h1>
    <?php
    try {
        $pdo = new PDO($dsn);
        if ($pdo) {
            if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
                echo "<div class='mb-3'>";
                echo "<form action='admin_logout.php' method='get' class='d-inline'>";
                echo "<button type='submit' class='btn btn-warning me-2'>管理者ログアウト</button>";
                echo "</form>";
                echo "<form action='history.php' method='get' class='d-inline'>";
                echo "<button type='submit' class='btn btn-primary me-2'>貸し出し履歴表示</button>";
                echo "</form>";
                echo "<form action='add_item.php' method='get' class='d-inline'>";
                echo "<button type='submit' class='btn btn-success'>備品を登録</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<form action='admin_login.php' method='get'>";
                echo "<button type='submit' class='btn btn-primary'>管理者ログイン</button>";
                echo "</form>";
            }
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr><th>名前</th><th>数量</th><th>状態</th><th>操作</th><th>管理</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            $query = $pdo->query("SELECT * FROM items ORDER BY id;");
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "<td>";
                if ($row['status'] !== '貸出不可') {
                    $loanLink = "<a href='loan.php?item_name=" . urlencode($row['name']) . "' class='btn btn-outline-primary btn-sm'>貸出</a>";
                } else {
                    $loanLink = "<span class='text-muted'>貸出不可</span>";
                }
                echo $loanLink . " | <a href='return.php?item_name=" . urlencode($row['name']) . "' class='btn btn-outline-secondary btn-sm'>返却</a>";
                echo "</td>";
                if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
                    echo "<td>";
                    echo "<form action='delete_item.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"この備品を削除してもよろしいですか？\");'>削除</button>";
                    echo "</form>";
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>接続失敗: " . $e->getMessage() . "</div>";
    }
    ?>
</div>
<!-- Bootstrap JavaScriptの読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
