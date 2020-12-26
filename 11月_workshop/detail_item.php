<?php
require_once('action_db.php');

$a = new Home();
$a->check_user();
$item_detail_data = $a->find_item_id();

var_dump($_POST['id']);
var_dump($_POST['users_id']);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="css/style.css">-->
  <link rel="stylesheet" href="css/style2.css">
</head>

<body>
<header>
        <nav class="navbar navbar-expand bg-white">
            <div class="navbar-brand ml-2"><h1>WorkShop</h1></div>
            <div class="row ml-2 my-auto">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item p-3 font-weight-bold">ITEMS</li>
                    <li class="nav-item p-3 font-weight-bold">FEATURE</li>
                    <li class="nav-item p-3 font-weight-bold">COORDINATE</li>
                    <li class="nav-item p-3 font-weight-bold">SHOP</li>
                    <li class="nav-item p-3 font-weight-bold">CONTENT</li>
                    <li class="nav-item p-2 ml-3"><i class="far fa-heart" style="font-size:30px;"></i></li>
                    <li class="nav-item p-2"><i class="fas fa-user" style="font-size:30px;"></i></li>
                    <li class="nav-item p-2"><i class="fas fa-shopping-cart" style="font-size:30px;"></i></li>
                </ul>
                <form class="form-inline my-2 my-lg-0 px-2">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search">
                    <img src="img/icon/search.png" alt="" type="submit">
                </form>
                <!--<button type="button" class="btn btn-outline-secondary my-auto ml-5">logout</button>-->
            </div>
        </nav>
    </header>
    <main>
        <div class="breadcrumbs"></div>
        <div class="main">
            <div class="detail">
                <div class="detail-image">
                <?php echo "<img src=\"" . $item_detail_data['img_url'] . "\">\n"?>
                </div>
            </div>
            <div class="other">
                <div class="other-top">
                    <ul>
                        <li><?php if($item_detail_data['category'] == "1") {
                            echo '机';
                        }else if($item_detail_data['category'] == "2") {
                            echo '椅子';
                        }else if($item_detail_data['category'] == "3") {
                            echo '棚';
                        }else {
                            echo 'その他';
                        }
                        ?>
                        </li>
                        <li><?php echo $item_detail_data['name'];?></li><br>
                        <li>商品ID:<?php echo $item_detail_data['id'];?></li>
                    </ul>
                </div>
                <div class="other-under">
                    <div class="price">
                        <div class="text">
                            <p class="price-title">本体価格</p>
                            <p class="price-text">￥<?php echo $item_detail_data['price']; ?></p>
                        </div>
                        <div class="btn">
                            <div class="buy-btn"><a href="">購入する</a></div>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo $item_detail_data['id'];?>">
                                <input type="hidden" name="users_id" value="<?php echo $_SESSION['user_id'];?>">
                                <input type="submit" value="お気に入りに追加">
                            </form>
                            <a href="ec_main.php">商品一覧に戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-main">
            <div class="footer-text">
                <p>©Y&I Group.inc</p>
            </div>
        </div>
    </footer>
</body>
</html>