<h1>備品返却</h1>
<form action="return_process.php" method="post">
    <label for="user_name">自分の名前:</label>
    <input type="text" id="user_name" name="user_name"><br>
    <label for="item_name">備品の名前:</label>
    <input type="text" id="item_name" name="item_name" value="<?php echo htmlspecialchars($_GET['item_name']); ?>" readonly><br>
    <label for="quantity">個数:</label>
    <input type="number" id="quantity" name="quantity" required min="1"><br>
    <input type="submit" value="返却">
</form>
<?php
echo "<footer>";
echo "<nav>";
echo "<a href='index.php'>トップページに戻る</a>";
echo "</nav>";
echo "</footer>";
?>