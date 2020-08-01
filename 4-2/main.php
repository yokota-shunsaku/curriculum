<?php
session_start();

require_once('db_connect.php');

require_once('function.php');

if (empty($_SESSION["user_name"])) {
    header("Location: login.php");
    exit;
}
// PDOのインスタンスを取得
$pdo = db_connect();
try {
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    die();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メイン</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
    <h2>在庫一覧画面</h2>
    <div class="header clearfix">
        <div class="stock_submit">
            <a href="create_book.php"><button type="button">新規登録</button></a>
        </div>
        <div class="logout_button">
        <a href="logout.php"><button type="button">ログアウト</button></a><br />
        </div>
    </div>
    <div class="main">
    <table border="1">
        <tr>
            <th>タイトル</th>
            <th>発売日</th>
            <th>在庫数</th>
            <th></th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo (date('Y/m/d', strtotime($row['date']))); ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                    <div class=delete_button>
                        <a href="delete_post.php?id=<?php echo $row['id']; ?>">
                            <button type="button">削除</button>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
    </div>
</body>
</html>