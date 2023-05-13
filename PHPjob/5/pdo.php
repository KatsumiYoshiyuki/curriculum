<?php
function connect(){
    // DBサーバのURL
    $db['host'] = "localhost";
    // データベース名
    $db['dbname'] = "zaikomng_DB";
    // ユーザー名
    $db['user'] = "root";
    // ユーザー名のパスワード
    $db['pass'] = "root";
    try {
        //接続情報設定
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        $dbo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbo;
    } catch (PDOException $e) {
        $errorMessage = 'データベース接続に失敗しました。';
    }
}
?>