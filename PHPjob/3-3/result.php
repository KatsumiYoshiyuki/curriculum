<?php
    $name = $_POST['my_name'];
    $num = $_POST['num'];

    $today = date("Y-m-d H:i:s");
    $rand_num = rand(1,6);
    $lucky_num = $num * $rand_num;
    echo $today."<br>";
    echo "名前は".$name."です。"."<br>";
    echo "番号は".$lucky_num."です。"."<br>";

    switch($lucky_num){
        case $lucky_num <= 10:
            $luck = "凶";
            break;
        case $lucky_num <= 15:
            $luck = "小吉";
            break;
        case $lucky_num <= 20:
            $luck = "中吉";
            break;
        case $lucky_num <= 25:
            $luck = "吉";
            break;        
        case $lucky_num <= 36:
            $luck = "大吉";
            break;
        default:
            $luck = "残念";
            break;
    }

    echo "結果は".$luck."です。"."<br>";
?>
