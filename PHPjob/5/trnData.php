<?php
require_once("pdo.php");

class trnData{

    public $pdo;
    public $data;

    //コンストラクタ
    function __construct()  {  
        $this->pdo = connect();
    }

    /**
     * ユーザ情報の登録
     *
     * @param
     * @return boolearn $Err_Flg エラーフラグ
     */
    public function insUserData($pdo,$user,$pass){
        try{
            $ins_sql = "INSERT INTO users(name, password) VALUES (:name,:password)";
            $stmt = $this->pdo->prepare($ins_sql);
            $stmt->bindParam(':name', $user);
            $stmt->bindParam(':password', $pass);
            $stmt->execute();
            $Err_Flg = FALSE;
        }catch(PDOException $e){
            $Err_Flg = TRUE;
        }
        return $Err_Flg;
    }

    /**
     * ブック情報の登録
     *
     * @param
     * @return string $Err_Message エラーメッセージ
     */
    public function insBookData($pdo,$title,$date,$stock){
        try{
            //Insert文の作成
            $insusers_sql = 'INSERT INTO Books(title, date, stock) Values (:title,:date,:stock)';

            // PDOStatementオブジェクトの作成
            $stmt = $this->pdo->prepare($insusers_sql);
            $date1 = new DateTime($date);
            $dateString = $date1->format('Y/m/d');
            // パラメータのバインド
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':date', $dateString, PDO::PARAM_STR);
            $stmt->bindValue(':stock', $stock, PDO::PARAM_INT); 
            $stmt->execute();
            $Err_Message = "";
        }catch(PDOException $e){
            $Err_Message = "ERROR: ".$e->getMessage();
        }
        return $Err_Message;
    }

   /**
     * ブック情報の削除
     *
     * @param
     * @return string $Err_Message エラーメッセージ
     */
    public function delBookData($pdo,$id){
        try{
            //delete文の作成
            $del_sql = 'DELETE FROM Books Where id = :id';
            // PDOStatementオブジェクトの作成
            $stmt = $this->pdo->prepare($del_sql);
            // パラメータのバインド
            $stmt->bindValue(':id', $id, PDO::PARAM_INT); 
            $stmt->execute();
            $Err_Message = "";
        }catch(PDOException $e){
            $Err_Message = "ERROR: ".$e->getMessage();
        }
        return $Err_Message;
    }
}