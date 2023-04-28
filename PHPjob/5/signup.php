<?php
    //db_connect.phpの読み込み
    require_once("db_connect.php");

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
            $pdo = new db_connect();

            //パスワードのハッシュ化
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            //Insert文の作成
            $ins_sql = "INSERT INTO users(name, password) VALUES (:name,:password)";

            echo $user;
            echo $password_hash;
            $stmt = $pdo->prepare($ins_sql);

            // パラメータのバインド
            $stmt->bindValue(':name', $user);
            $stmt->bindValue(':password', $password_hash);
            //SQL実行
            $stmt->execute();
            // SQLクエリの実行
            if ($stmt->execute()) {
                echo "登録が完了しました。";
            } else {
                echo "Error: " . $sql . "<br>" . $pdo->errorInfo();
                die();
            }
        }catch(PDOException $e){
            $errorMessage  = 'データベース接続に失敗しました。';
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
    <p><?php echo $errorMessage ?></p>
    <form method="POST" action="signup.php">

        <input type="text" name="name" id="name" class="user" placeholder = "ユーザー名" required>
        <br><br>
        <input type="password" name="password" id="password" class="password" placeholder = "パスワード" required><br>
        <input type="submit" value="新規登録" id="signUp" name="signUp" class="newReg" >
    </form>
</body>
</html>