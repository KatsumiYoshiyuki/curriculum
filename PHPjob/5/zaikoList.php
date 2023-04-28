<?php
    //db_connect.phpの読み込み
    require_once("db_connect.php");

    //PDO接続インスタンス生成
    $pdo = new db_connect();

    //SQL文生成
    $sel_sql = "Select * From books Order By date";
    $zaiko_data = $pdo->query($sel_sql);      
?>

<!doctype html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css" />
        <script>
            function changeCursor() {
            var button1 = document.getElementById('newReg');
            var button2 = document.getElementById('logout');
            var button3 = document.getElementById('delete');
            button1.classList.add('custom-cursor');
            button2.classList.add('custom-cursor');
            button3.classList.add('custom-cursor');
            }
        </script>

        <title>ログインページ</title>
    </head>
    <body>
            
        <h1>在庫一覧画面</h1><br>
        <form method="post" action="signup.php">
            <div class = "container">   
                <div>
                    <input type="submit" id = "newReg" class= "newReg" value="新規登録" onmouseover="changeCursor()">
                </div>
                <div>
                    <input type="submit" id = "logout" class= "logout" value="ログアウト" onmouseover="changeCursor()">
                </div>
            </div>
        </form>
        
        <?php foreach($zaiko_data as $row){ ?>
            <table>
                <th>タイトル</th>
                <th>発売日</th>
                <th>在庫数</th>
                <th></th>
                <tr><?php $row["title"] ?></tr>
                <tr><?php $row["date"] ?></tr>
                <tr><?php $row["stock"] ?></tr>
                <tr><input type="submit" id = "delete" class= "Delete" value="削除" onmouseover="changeCursor()"></tr>                           
            </table>
        <?php } ?>
    </body>
</html>