<?php
//require 'lib/password.php';
// セッション開始
if (session_status() != PHP_SESSION_NONE){
    session_start();
}

require_once("getData.php");

//データベースエラーメッセージ
$errorMessage = "";

/*定数設定*/
//カテゴリ
define("meal","食事");
define("travel","旅行");
define("others","その他");

//フッター
define("footer","Y&I group.Inc");

//初期化
$result = "";
$user = "";

$dt = new getData();

//ユーザ名を取得
$result = $dt->getUserData();

$user = $result['last_name'].$result['first_name']; 

$result = "";

//記事・カテゴリデータを取得
$result = $dt->getPostData();

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
        <div class ="size">
            <div class = "container">
                <div class = "Box1">
                    <img class = "image" src = "img/logo.png" alt="ロゴ">
                </div>
                <div class = "container2">
                    <div class = "Box2">
                        <p>ようこそ <?php echo $user ?> さん</p>
                    </div>  
                    <div class = "Box3">
                        <p>最終ログイン日:<?php echo date("Y-m-d H:i:s") ?></p>
                    </div>
                </div>
                
            </div>
            <table>
                <tr>
                    <th>記事ID</th>
                    <th>タイトル</th>
                    <th>カテゴリ</th>
                    <th>本文</th>
                    <th>投稿日</th>
                </tr>
                <?php 
                    foreach($result as $row){ ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php switch($row['category_no']){ 
                                case 1: echo meal;
                                break;
                                case 2: echo travel;
                                break;
                                default: echo others;
                                break; 
                            } ?>
                            </td>
                            <td><?php echo $row['comment'] ?></td>
                            <td><?php echo $row['created'] ?></td>
                        <tr>
                <?php } ?>
            </table>
            <div class = "footer">
                <p><?php echo footer ?></p>
            </div>
        </div>
    </body>
</html>
