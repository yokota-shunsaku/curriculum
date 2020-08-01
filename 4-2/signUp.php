<?php
require_once("db_connect.php");

session_start();

if (!empty($_POST)) {

    if (empty($_POST["username"])) {
        echo "ユーザー名が未入力です。";
    }

    if (empty($_POST["password"])) {
        echo "パスワードが未入力です。";
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $dsn = sprintf('mysql:host=localhost;charset=utf8;dbname='.DB_DATABASE);

        try {
            $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO users(name, password) VALUES (?, ?)");

            $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));
            $userid = $pdo->lastinsertid();
            $login_link = '<p><a href="login.php">ログインページへ</a></p>';
            $signUpMessage = '登録が完了しました。';
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
             echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>
    <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
        <div><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></div>
        <div class="wrapper">
        <div><?php echo $login_link; ?></div>
        <h2 style="margin-bottom: 0px;">ユーザー登録画面</h2>
        <form action="signUp.php" method="POST">
            <div class="div_input">
                <label for="username"></label><br>
                <input type="text" id="username" name="username" placeholder="ユーザー名">
                <br>
                <label for="password"></label><br>
                <input type="password" id="password" name="password" placeholder="パスワード">
            </div>
            <br>
            <div class="submit_button">
                <input type="submit" id="signUp" name="signUp" value="新規登録">
            </div>
        </div>
        </form>
    </body>
</html>