<?php
session_start();
// セッション変数のクリア
$_SESSION = array();
// セッションクリア
session_destroy();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログアウト</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
    <div class="wrapper">
    <h1>ログアウト画面</h1>
    <div>ログアウトしました。</div>
    <a href="login.php">ログイン画面に戻る</a>
    </div>
    </body>
</html>