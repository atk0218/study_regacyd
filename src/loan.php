<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>備品貸出</title>
    <!-- Bootstrap CSSの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1>備品貸出</h1>
    <form action="loan_process.php" method="post" class="mb-3">
        <div class="row mb-3">
            <label for="user_name" class="col-sm-2 col-form-label">自分の名前:</label>
            <div class="col-sm-4">
                <input type="text" id="user_name" name="user_name" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <label for="item_name" class="col-sm-2 col-form-label">備品の名前:</label>
            <div class="col-sm-4">
                <input type="text" id="item_name" name="item_name" class="form-control" value="<?php echo htmlspecialchars($_GET['item_name']); ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="quantity" class="col-sm-2 col-form-label">個数:</label>
            <div class="col-sm-2">
                <input type="number" id="quantity" name="quantity" class="form-control" required min="1">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-2">
                <button type="submit" class="btn btn-primary">貸出</button>
            </div>
        </div>
    </form>
    <footer>
        <nav>
            <a href="index.php" class="btn btn-link">トップページに戻る</a>
        </nav>
    </footer>
</div>
<!-- Bootstrap JavaScriptの読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
