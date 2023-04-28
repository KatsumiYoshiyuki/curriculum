<?php

require_once("pdo.php");

class db_connect{
    public $pdo;
    public $data;

    //コンストラクタ
    function __construct()  {  
        $this->pdo = connect();
    }
}
?>