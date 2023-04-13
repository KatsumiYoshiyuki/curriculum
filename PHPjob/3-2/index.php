<?php
    //商品の税込価格を計算
    //①税率を定数TAXに格納
    define('TAX',1.1);

    //②商品の情報を連想配列に格納
    $products = array("鉛筆" => 100, "消しゴム" => 150, "物差し" => 500);
    foreach($products as $key => $value){

        //③税込み価格計算処理
        $taxval = calcValue($value);
        echo $key."の税込み価格は".$taxval."円です"."<br>";
    }
    

    function calcValue($value){
        //税込価格計算
        $taxval= $value * TAX;
        return $taxval;
    }
?>