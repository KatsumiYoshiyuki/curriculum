<html>
<?php
    define("STR_FIZZ","Fizz!");
    define("STR_BUZZ","Buzz!");
    define("STR_FIZZBUZZ","FizzBuzz!!");
    for($i=1;$i <= 100;$i++){
        Switch($i){
            Case $i%3 == 0 && $i%5 == 0:
                echo STR_FIZZBUZZ."<br>";
                break;
            Case $i%3 == 0:
                echo STR_FIZZ."<br>";
                break;

            Case $i%5 == 0:
                echo STR_BUZZ."<br>";
                break;
            default:
                echo $i."<br>";
        }
    }
?>
</html>