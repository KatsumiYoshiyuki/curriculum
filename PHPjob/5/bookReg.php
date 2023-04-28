<?php
    $error_message = "";
    //登録ボタンを押下した場合
    if (isset($_POST["signUp"])){
        //タイトルを取得
        $title = $_POST['title'];
        //発売日を取得
        $seldate = $_POST['seldate'];
        //在庫数を取得
        $zaiko = $_POST['zaiko'];

        //必須チェック
        if(empty($title) or empty($seldate) or empty($zaiko)){
            if (empty($title)){
                $contents = "タイトル";
            }elseif (!empty($seldate) and empty($password)){
                $contents = "発売日";
            }else{
                $contents = "在庫数";
            }
            $error_message = $contents."が入力されていません。";
            exit;
        }

        $db = db_connect();
        
        try{

            //Insert文の作成
            $insusers_sql = "INSERT 
            INTO users(title, date, book) 
            Values ( 
                :title
                ,:date
                ,:stock)";

            // PDOStatementオブジェクトの作成
            $stmt = $db->prepare($insusers_sql);

            // パラメータのバインド
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':date', $date, PDO::PARAM_DATE);
            $stmt->bindValue(':stock', $stock, PDO::PARAM_INT);          

            // SQLクエリの実行
            if ($stmt->execute()) {
                echo "登録が完了しました。";
            } else {
                echo "Error: " . $sql . "<br>" . $pdo->errorInfo();
                die();
            }
        }catch(PDOException $e){
            $error_message = 'データベース接続に失敗しました。';
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
    <p><?php $error_message ?></p>
    <form method="POST" action="signup.php">

        <input type="text" name="title" id="title" class="title" placeholder = "タイトル"  required>
        <br><br>
        <input type="date" name="seldate" id="seldate" class="seldate" placeholder = "発売日"  required><br>
        <br><br>
        在庫数
        <br>
        <input type="number" name="zaiko" id="zaiko" class="zaiko" placeholder = "選択してください"  required><br>
        <br>
        <input type="submit" value="登録" id="signUp" name="signUp" class="newReg" >
    </form>
</body>
</html>