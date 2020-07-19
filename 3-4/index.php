<?php
require_once("pdo.php");
// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// セッション開始
session_start();

$pdo = db_connect();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="wrapper">
        <div class="header clearfix">
            <div class="logo">
            <img src="logo.png"  title="ロゴ" width="200px" height="120px">
            </div>
                <?php
                // ユーザー
                try {
                    $sql = "SELECT * FROM users";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<div class=right clearfix>";
                        echo "<div class=user>";
                            echo "<p class=text>";
                            echo "ようこそ ".$user["last_name"].$user["first_name"]." さん";
                            echo "</p>";
                        echo "</div>";
                        echo "<br />";
                        echo "<div class=login>";
                            echo "<p class=text>";
                            echo "最終ログイン日：".$user["last_login"];
                            echo "</p>";
                        echo "</div>";
                    echo "</div>";
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                    die();
                }
                ?>
        </div>
        <div class="main">
            <table border="1">
                    <tr>
                        <th>記事ID</th>
                        <th>タイトル</th>
                        <th>カテゴリ</th>
                        <th>本文</th>
                        <th>投稿日</th>
                    </tr>
            <?php
            // 記事
            try {
                $sql = "SELECT * FROM posts ORDER BY id DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>';
                echo $row['id'];
                echo '</td>';
                echo '<td>';
                echo $row['title'];
                echo '</td>';
                echo '<td>';
                
                if($row['category_no'] == 1) {
                echo "食事";
                } elseif($row['category_no'] == 2) {
                echo "旅行";
                } else {
                echo "その他";
                }

                echo '</td>';
                echo '<td>';
                echo $row['comment'];
                echo '</td>';
                echo '<td>';
                echo $row['created'];
                echo '</td>';
                echo '</tr>';
            }

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
                die();
            }
            ?>
            </table>
        </div>

        <div class="c_name">
            Y&I group.inc
        </div>
    </div>
</body>
</html>