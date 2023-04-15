<?php 
$name = $_POST['my_name'];
$sel_port = $_POST['port_no'];
$sel_lang = $_POST['language'];
$sel_com = $_POST['command'];
$ans_port = $_POST['ans_port'];
$ans_lang = $_POST['ans_lang'];
$ans_com = $_POST['ans_com'];

//回答判定処理
function res_answer($sel_value,$ans_value){
    if($sel_value == $ans_value){
        $result = "正解!";
    }else{
        $result = "残念．．．";
    }
        return $result;
}
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p><?php echo $name ?>さんの結果は・・・？</p>
    <p>①の答え</p>
    <p><?php echo res_answer($sel_port,$ans_port); ?></p>

    <p>②の答え</p>
    <p><?php echo res_answer($sel_lang,$ans_lang) ?></p>

    <p>③の答え</p>
    <p><?php echo res_answer($sel_com,$ans_com) ?></p>
</body>