<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Practice2</title>
</head>
<body>
    <form action = "result.php" method = "post">
        好きな名前を入れてください<br>
        <br>
        <input type="text" name="my_name" required /><br>
        <br>
        1～6の中で好きな数字を入れてください<br>
        <br>
        <input class = size type="number" min = 1 max = 6 name="num" required /><br>
        <input type="Submit" value = "送信" />     
    </form>
</body>
</html>