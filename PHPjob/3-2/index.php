<html>
    <?php
        //商品の税込価格を計算
        //①税率を定数TAXに格納
        define('TAX',1.1);

        //各価格を変数に格納
        $pencil = 100;
        $eraser = 150;
        $protractor = 500;

        //②商品の情報を連想配列に格納
        $products = array("鉛筆" => $pencil, "消しゴム" => $eraser, "物差し" => $protractor);
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
</html>