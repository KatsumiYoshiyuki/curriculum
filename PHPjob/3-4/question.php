<html lang="ja">
<?php
//POST送信で名前を受信
$name = $_POST['my_name'];
//問題文の選択肢の配列を変数に格納
$port_no = [80,22,20,21];
$language = ["php","Python","JAVA","HTML"];
$command = ["join","select","insert","update"];
//正解の選択肢の変数
$ans_port = 80;
$ans_lang = "HTML";
$ans_com = "select";
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <form action = "answer.php" method = "post">
            <p>お疲れ様です<?php echo $name ?>さん</p>
            <input type = "hidden" name = "my_name" value = <?php echo $name ?> /> 
            <h2>①ネットワークのポート番号は何番？</h2>
            <?php foreach($port_no as $value){ ?>
                <input type = "radio" name = "port_no" value = <?php echo $value ?> required /><?php echo $value ?>
            <?php } ?>
            <input type = "hidden" name = "ans_port" value = <?php echo $ans_port ?> /> 
            <br><br>
            <h2>②Webページを作成するための言語は？</h2>
            <?php foreach($language as $value){ ?>
                <input type = "radio" name = "language" value =  <?php echo $value ?> required /><?php echo $value ?> 
                <?php } ?>
                <input type = "hidden" name = "ans_lang" value = <?php echo $ans_lang ?> /> 
            <br><br>
            <h2>③MySQLで情報を取得するためのコマンドは？</h2>
            <?php foreach($command as $value){ ?>
                <input type = "radio" name = "command" value = <?php echo $value ?> required /><?php echo $value ?> 
            <?php } ?>
            <input type = "hidden" name = "ans_com" value = <?php echo $ans_com ?> /> 
            <br>
            <input type = "submit" value = "回答する" />
        </form>
    </body>
</html>