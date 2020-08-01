<?php
session_start();

require_once('db_connect.php');

require_once('function.php');

if (empty($_SESSION["user_name"])) {
    header("Location: login.php");
    exit;
}
// URLの?以降で渡されるIDをキャッチ
$id = $_GET['id'];
// もし、$idが空であったらmain.phpにリダイレクト
// 不正なアクセス対策
if (empty($id)) {
    header("Location: main.php");
    exit;
}
// PDOのインスタンスを取得
$pdo = db_connect();
try {
    // SQL文の準備
    $sql = "DELETE FROM books WHERE id = $id";
    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);
    // idのバインド
    $stmt->bindParam(':id', $id);
    // 実行
    $stmt->execute();
    // main.phpにリダイレクト
    header("Location: main.php");
    exit;
} catch (PDOException $e) {

    echo 'Error: ' . $e->getMessage();

    die();
}