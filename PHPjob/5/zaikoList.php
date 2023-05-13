<?php
    //trnData.phpの読み込み
    require_once("trnData.php");

    //PDO接続インスタンス生成
    $dt = new trnData();
    $zaiko_data = null;
    //SQL文生成
    $sel_sql = "Select * From books Order By date";
    $zaiko_data = $dt->pdo->query($sel_sql); 

    //新規作成ボタン押下
    if(isset($_POST['newReg'])){
        header('Location: bookReg.php');
        exit();
    }

    //ログアウトボタン押下
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: login.php');
        exit();
    }

    //削除ボタン押下
    if(isset($_POST['delete'])){
        try{
            $id = $_POST['delete'];
            //データ削除処理
            $Err_Message = $dt->delBookData($dt,$id);  
            echo $Err_Message;
            if ($Err_Message == "") {
                //コミット処理
                $dt->pdo->Commit();
                echo "ccc";
                header("Location: zaikoList");
                
                exit();
                //再読込処理
                // $sel_sql = "Select * From books Order By date";
                // $zaiko_data = $dt->pdo->query($sel_sql);    
            } else {
                $errorInfo = $dt->pdo->errorInfo();
                if ($errorInfo[0] !== '00000') {
                    echo "Error: {$errorInfo[2]} ({$errorInfo[0]} - {$errorInfo[1]})";
                }
                //ロールバック処理
                $dt->pdo->RollBack();
                $dt->pdo->die();
            }
        }catch(PDOException $e){
            $errorMessage  = "ERROR: ".$e->getMessage();
        }
    }  
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
            button1.classList.add('custom-cursor');
            button2.classList.add('custom-cursor');
            }
        </script>

        <title>ログインページ</title>
    </head>
    <body>         
        <h1>在庫一覧画面</h1><br>
        <form method="post" action=""> 
            <input type="submit" id = "newReg" name = "newReg" class= "newReg" value="新規登録" onmouseover="changeCursor()">
            <input type="submit" id = "logout" name = "logout" class= "logout" value="ログアウト" onmouseover="changeCursor()">

            <table border = "1" class = "bordered-table">
                <th>タイトル</th>
                <th>発売日</th>
                  <th>在庫数</th>
                <th></th>
                <?php foreach($zaiko_data as $row){ ?>
                    <input type="hidden" name = "delete" value = "<?php echo $row['id']; ?>">
                    <tr>
                        <td name="title"><?php echo $row["title"] ?></td>
                        <td name="seldate"><?php echo $row["date"] ?></td>
                        <td name = "zaiko"><?php echo $row["stock"] ?></td>
                        <td><input type="submit" id = "delete" class= "delete" value="削除" onmouseover="changeCursor()"></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </body>
</html>