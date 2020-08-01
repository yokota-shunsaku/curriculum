<?php
session_start();

require_once('db_connect.php');

require_once('function.php');

if (empty($_SESSION["user_name"])) {
    header("Location: login.php");
    exit;
}

if (!empty($_POST)) {

    if (empty($_POST["title"])) {
        echo 'タイトルが未入力です。';
    } 
    if (empty($_POST["date"])) {
        echo '発売日が未入力です。';
    } 
    if ((($_POST["stock"])<0) || (empty($_POST["stock"]))) {
        echo '在庫数が未入力です。';
    } 

    if (!empty($_POST["title"]) && !empty($_POST["date"]) && ($_POST["stock"])>=0) {

        $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
        $date = htmlspecialchars($_POST['date'], ENT_QUOTES);
        $stock = htmlspecialchars($_POST['stock'], ENT_QUOTES);
        // PDOのインスタンスを取得
        $pdo = db_connect();
        try {
            // SQL文の準備
            $sql = "INSERT INTO books(title, date, stock) VALUES ('$title', '$date', '$stock')";
            // プリペアドステートメントの準備
            $stmt = $pdo->prepare($sql);
            // バインド
            $stmt->bindParam(':title', $title);

            $stmt->bindParam(':date', $date);

            $stmt->bindParam(':stock', $stock);
            // 実行
            $stmt->execute();
            // main.phpにリダイレクト
            header("Location: main.php");
                exit;
        } catch (PDOException $e) {

            echo 'Error: ' . $e->getMessage();

            die();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
    <h2>本 登録画面</h2>
    <form method="POST" action="">
        <input type="text" name="title" id="title" placeholder="タイトル" style="width:250px;height:30px;">
        <br>
        <br>
        <input type="text" name="date" id="date" placeholder="発売日" style="width:250px;height:30px;"><br>
        <p style="margin-top: 10px; margin-bottom:10px;">在庫数</p>
        
    
        <select type="text" name="stock" id="stock" style="width:160px;height:36px;">
        <option disabled selected value>選択してください</option>
        <?php 
        for ($i=0; $i<=99; $i++) {
        print('<option value="' . $i . '">' . $i);}
        ?>
        </select>
        <br>
        <div class="new_book">
            <input type="submit" value="登録" id="post" name="post">
        </div>
    </form>
    </div>
</body>
</html>