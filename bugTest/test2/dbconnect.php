<?php
// セッション開始
session_start();
// データベース名
$db['dbname'] = "yigroupBlog";
// DBサーバのURL
$db['host'] = 'mysql:host=localhost;charset=utf8;dbname=' . $db['dbname'];
// ユーザー名
$db['user'] = "root";
// ユーザー名のパスワード
$db['pass'] = "root";



function db_connect() {
    try {
        // PDOインスタンスの作成
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=',"root"  ,"root");
        // echo '成功';
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        die();
    }
}

