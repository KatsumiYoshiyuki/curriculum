<?php
    //'trnData.php'読み込み
    require_once("trnData.php");
    // セッション開始
    session_start();

    // $_POSTが空ではない場合
    // つまり、ログインボタンが押された場合のみ、下記の処理を実行する
    if (!empty($_POST)) {
        // ログイン名が入力されていない場合の処理
        if (empty($_POST["name"])) {
            echo "名前が未入力です。";
        }
        // パスワードが入力されていない場合の処理
        if (empty($_POST["pass"])) {
            echo "パスワードが未入力です。";
        }

        // 両方共入力されている場合
        if (!empty($_POST["name"]) && !empty($_POST["pass"])) {
            //ログイン名とパスワードのエスケープ処理
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
            $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
            // ログイン処理開始
            $pdo = new trnData();
            try {
                //データベースアクセスの処理文章。ログイン名があるか判定
                $sql = "SELECT * FROM users WHERE name = :name";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->execute();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
                die();
            }

            // 結果が1行取得できたら
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // ハッシュ化されたパスワードを判定する定形関数のpassword_verify
                // 入力された値と引っ張ってきた値が同じか判定しています。
                if (password_verify($pass, $row['password'])) {
                    // セッションに値を保存
                    $_SESSION["user_id"] = $row['id'];
                    $_SESSION["user_name"] = $row['name'];
                    // main.phpにリダイレクト
                    header("Location: main.php");
                    exit;
                } else {
                    // パスワードが違ってた時の処理
                    echo "パスワードに誤りがあります。";
                }
            } else {
                //ログイン名がなかった時の処理
                echo "ユーザー名かパスワードに誤りがあります。";
            }
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
            var button1 = document.getElementById('UserReg');
            var button2 = document.getElementById('login');            
            button1.classList.add('custom-cursor');
            button2.classList.add('custom-cursor');
            }
        </script>

        <title>ログインページ</title>
    </head>
    <body>
        <div class = "container">       
            <h1>ログイン画面</h1>
            <form method="post" action="signup.php">
                <div>
                    <input type="submit" id = "UserReg" class= "userReg" value="新規ユーザー登録" onmouseover="changeCursor()">
                </div>
            </form>
        </div>
        <form method="post" action="zaikoList.php">
            <input type="text" name="name" class="user" placeholder = "ユーザー名" required><br><br>
            <input type="text" name="pass" class="password" placeholder = "パスワード" required><br><br>
            <input type="submit" id = "login" class= "login" value="ログイン" onmouseover="changeCursor()" required>
        </form>
    </body>
</html>