<!-- ユーザー登録 -->
<?php
require_once("db_connect.php");
// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// セッション開始
session_start();


// ログインボタンが押された場合
if (!empty($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST)) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["username"];
        $password = $_POST["password"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql:host=localhost;charset=utf8;dbname='.DB_DATABASE);

        //$pdo = db_connect();
        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO users(name, password) VALUES (?, ?)");

            $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる
            $main_link = '<p><a href="main.php">メインページへ</a></p>';
            $signUpMessage = '登録が完了しました。';  // ログイン時に使用するIDとパスワード
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
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
    </head>
    <body>
        <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
        <div><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></div>
        <div><?php echo $main_link; ?></div>
        <h1>新規登録</h1>
        <form action="signUp.php" method="POST">
            <label for="username">user:</label><br>
            <input type="text" id="username" name="username">
            <br>
            <label for="password">password:</label><br>
            <input type="password" id="password" name="password">
            <br>
            <input type="submit" id="signUp" name="signUp" value="submit">
        </form>
    </body>
</html>
