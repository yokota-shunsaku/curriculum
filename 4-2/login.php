<?php
require_once('db_connect.php');

session_start();

if (!empty($_POST)) {

    if (empty($_POST["name"])) {
        echo "ユーザー名が未入力です。";
    }

    if (empty($_POST["pass"])) {
        echo "パスワードが未入力です。";
    }

    if (!empty($_POST["name"]) && !empty($_POST["pass"])) {
        //ログイン名とパスワードのエスケープ処理
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
        // ログイン処理開始
        $pdo = db_connect();
        try {
            //データベースアクセスの処理文章。ログイン名があるか判定
            $sql = "SELECT * FROM users WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            die();
        }
        // 結果が1行取得できたら
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // ハッシュ化されたパスワードを判定する定形関数のpassword_verify
            // 入力された値と引っ張ってきた値が同じか判定しています。
            if (password_verify($pass, $row['password'])) {
                // セッションに値を保存
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_name"] = $row['name'];
                // main.phpにリダイレクト
                header("Location: main.php");
                exit;
            } else {
                echo "パスワードに誤りがあります。";
            }
        } else {
            echo "ユーザー名かパスワードに誤りがあります。";
        }
    }
}
?>
<!doctype html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ログインページ</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="header clearfix">
                <div class="title">
                    <h2>ログイン画面</h2>
                </div>
                <div class="jump_signup">
                    <a href="signUp.php"><button type="button">新規ユーザー登録</button></a>
                </div>
            </div>
                <form method="post" action="login.php">
                <div class="div_input">
                    <input type="text" name="name" placeholder="ユーザー名" width="400px"><br><br>
                    <input type="text" name="pass" placeholder="パスワード" width="400px"><br><br>
                </div>
                <div class="submit_button">
                    <input type="submit" value="ログイン">
                </div>
                </form>
        </div>
    </body>
</html>