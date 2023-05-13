<?php
    //db_connect.phpの読み込み
    require_once("insData.php");

    //エラーメッセージ初期化
    $errorMessage = "";
    //登録ボタンを押下した場合
    if (isset($_POST["signUp"])){
        //ユーザ名取得
        $user = $_POST['name'];

        //パスワードを取得
        $password = $_POST['password'];

        //必須チェック
        if(empty($user) or empty($password)){
            if (empty($user) and !empty($password)){
                $contents = "ユーザ名";
            }elseif (!empty($user) and empty($password)){
                $contents = "パスワード";
            }else{
                $contents = "ユーザー名とパスワード";
            }
            $errorMessage  = $contents."が入力されていません。";
            exit;
        }

        try{
            // PDOStatementオブジェクトの作成
            $dt = new insData();
            //パスワードのハッシュ化
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            // トランザクションを開始する
            $dt->pdo->beginTransaction();

            //ユーザ情報の登録
            $Err_Flg = $dt->insUserData($dt,$user,$pass_hash);

            // SQLクエリの実行
            if ($Err_Flg == False) {

                echo "登録が完了しました。"."<br>";
                $dt->pdo->Commit();
                echo "3秒後に自働的にログイン画面に切り替わります。";

                //login.phpにリダイレクト
                header('Refresh: 3; login.php');
            } else {
                $errorInfo = $dt->pdo->errorInfo();
                if ($errorInfo[0] !== '00000') {
                    echo "Error: {$errorInfo[2]} ({$errorInfo[0]} - {$errorInfo[1]})";
                }
                $dt->pdo->RollBack();
                $dt->pdo->die();
            }
            exit;
        }catch(PDOException $e){
            $errorMessage  = "ERROR: ".$e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>ユーザー登録</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>ユーザー登録画面</h1>
    <form method="POST" action="">
        <p><?php echo $errorMessage ?></p>
        <input type="text" name="name" id="name" class="user" placeholder = "ユーザー名" required>
        <br><br>
        <input type="password" name="password" id="password" class="password" placeholder = "パスワード" required><br>
        <input type="submit" value="新規登録" id="signUp" name="signUp" class="newReg" >
    </form>
</body>
</html>