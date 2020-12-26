<?php

use PhpParser\Node\Stmt\TryCatch;

require_once('db_connect.php');


class Home {
    public $pdo;

    //コンストラクタ
    function __construct() {
        $this->pdo = connect();
    }

    //商品情報取得処理
    public function getItemData() {
        $getitem_sql = "SELECT * FROM items";
        $item_data = $this->pdo->prepare($getitem_sql);
        $item_data->execute();
        return $item_data;
    }

    //新規登録処理
    public function insertMember() {
        if(isset($_POST['signUp'])) {
            if(empty($_POST['user']) && empty($_POST['pass'])) {
                echo '<FONT COLOR="RED">入力を確認してください</FONT COLOR>';
            }
            else if(empty($_POST['pass'])) {
                echo '<FONT COLOR="RED">パスワードが未入力です</FONT COLOR>';
            }else if (empty($_POST['user'])) {
                echo '<FONT COLOR="RED">ユーザー名が未入力です</FONT COLOR>';
            }else if(!empty($_POST['user']) && !empty($_POST['pass'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                try {
                    $insert_sql = "INSERT INTO USERS(name,password) VALUES (:name,:password)";
                    $hash = password_hash($pass,PASSWORD_DEFAULT);
                    $insert_data = $this->pdo->prepare($insert_sql);
                    $insert_data->bindParam(':name',$user);
                    $insert_data->bindParam(':password',$hash);
                    $insert_data->execute();
                    echo '登録完了しました。';
                }catch(PDOException $e) {
                    echo "Error:".$e->getMessage();
                    die();
                }
            }
        }
    }

    //ログイン処理
    public function loginUser() {
        session_start();
        if(!empty($_POST)) {
            if(empty($_POST['user']) && empty($_POST['pass'])) {
                echo '<FONT COLOR="RED">入力を確認してください</FONT COLOR>';
            }
            else if(empty($_POST['pass'])) {
                echo '<FONT COLOR="RED">パスワードが未入力です</FONT COLOR>';
            }else if (empty($_POST['user'])) {
                echo '<FONT COLOR="RED">ユーザー名が未入力です</FONT COLOR>';
            }else if(!empty($_POST['user']) && !empty($_POST['pass'])) {
                $user = htmlspecialchars($_POST['user'],ENT_QUOTES);
                $pass = htmlspecialchars($_POST['pass'],ENT_QUOTES);
                try {
                    $login_sql = "SELECT * FROM USERS WHERE name = :name";
                    $login_data = $this->pdo->prepare($login_sql);
                    $login_data->bindParam(':name',$user);
                    $login_data->execute();
                    }catch(PDOException $e) {
                        echo 'Error:'.$e->getMessage();
                        die();
                    }
                    if($row = $login_data->fetch(PDO::FETCH_ASSOC)) {
                        if(password_verify($pass,$row['password'])) {
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['user_name'] = $row['name'];
                            header('Location:ec_main.php');
                            exit;
                        }else {
                            echo 'パスワードに誤りがあります。';
                        }
                    }else {
                        echo 'ユーザー名かパスワードに誤りがあります。';
                    }
            }
        }
    }

    //ログインチェック
    public function check_user() {
        session_start();
        if(empty($_SESSION['user_name'])) {
            header('Location:login.php');
            exit;
        }
    }

    //商品詳細情報取得処理
    public function find_item_id() {
        $id = $_GET['id'];
        if(empty($id)) {
            header("Location:main.php");
            exit;
        }else if(!empty($id)) {
            try {
                $find_item_sql = "SELECT * FROM items WHERE id = :id";
                $find_item = $this->pdo->prepare($find_item_sql);
                $find_item->bindParam(':id',$id);
                $find_item->execute();
            }catch(PDOException $e) {
                echo 'Error:'.$e->getMessage();
                die();
            }
            if($item_detail_data = $find_item->fetch(PDO::FETCH_ASSOC)) {
                return $item_detail_data;
            }else {
                if(empty($id)) {
                    header("Location:main.php");
                    exit;
                }
            }
        }
    }

    // お気に入り登録処理
    public function favorite_item_id() {
        if(!empty($_POST)){
            $id = $_POST['id'];
            $user_id = $_POST['users_id'];
            $item = intval($id);
            $user = intval($user_id);
            if($id == null) {
                header("Location:detail_item.php");
                exit;
            }else if(!empty($id)) {
                try{
                    $add_favorite_sql = "INSERT INTO favorite(users_id,items_id,favorite_flag) VALUES(:users_id, :items_id, 1)";
                    $add_favorite = $this->pdo->prepare($add_favorite_sql);
                    $add_favorite->bindparam(':users_id', $user);
                    $add_favorite->bindparam(':items_id', $item);
                    $add_favorite->execute();
                    echo "お気に入りに登録しました。";
                }catch(PDOException $e){
                    echo 'Error:'.$e->getMessage();
                    die();
                }
        
            }
        }
    }

}

?>