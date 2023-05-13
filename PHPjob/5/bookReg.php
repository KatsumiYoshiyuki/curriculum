<?php

    //'trnData.php'読み込み
    require_once("trnData.php");

    $error_message = "";
    //登録ボタンを押下した場合
    if (isset($_POST["signUp"])){
        //セッション開始
        session_start();

        //タイトルを取得
        $title = $_POST['title'];
        //発売日を取得
        $seldate = $_POST['seldate'];
        //在庫数を取得
        $zaiko = $_POST['zaiko'];

        //セッションに保存する
        $_SESSION['title'] = $title;
        $_SESSION['seldate'] = $seldate;
        $_SESSION['zaiko'] = $zaiko;

        //必須チェック
        if(empty($title) or empty($seldate) or empty($zaiko)){
            if (empty($title)){
                $contents = "タイトル";
            }elseif (empty($seldate)){
                $contents = "発売日";
            }else{
                $contents = "在庫数";
            }
            $error_message = $contents."が入力されていません。";
        }else{
            //オブジェクト生成
            $dt = new trnData();
        
            try{    
                //トランザクション開始
                $dt->pdo->beginTransaction();

                //ブック情報登録処理
                $Err_Message= $dt->insBookData($dt,$title,$seldate,$zaiko);
                
                //ブック情報登録判定
                if ($Err_Message == "") {
                    echo "登録が完了しました。"."<br>";
                    $dt->pdo->Commit();
                    echo "3秒後に自働的に在庫一覧画面に切り替わります。";
    
                    //zaikoList.phpにリダイレクト
                    header('Refresh: 3; zaikoList.php');
                    exit();
                } else {
                    echo $Err_Message;
                    $dt->pdo->RollBack();
                    $dt->pdo->die();
                }
            }catch(PDOException $e){
                $error_message  = "ERROR: ".$e->getMessage();
            }
        }
    }     
?>
<!DOCTYPE html>
<html>
<head>
    <title>本登録</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>本登録画面</h1>
    <form method="POST" action="">
        <p><?php echo $error_message ?></p>  
        <dev>
            <input type="text" name="title" id="title" class="title" placeholder = "タイトル" value="<?= $title ?? '' ?>">
        </dev>
        <br><br>
        <dev>
            <input type="text" name="seldate" id="seldate" class="seldate" placeholder = "発売日" value="<?= $seldate ?? '' ?>"><br>
        </dev>
        <br>
        在庫数
        <br>
        <dev>
            <input type="number" name="zaiko" id="zaiko" class="zaiko" placeholder = "選択してください" value="<?= $zaiko ?? '' ?>"><br>
        </dev>
        <input type="submit" value="登録" id="signUp" name="signUp" class="signUp" >
    </form>
</body>
</html>