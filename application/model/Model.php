<?php
namespace application\model;

use PDO;
use Exception;


class Model {
        protected $conn; // 콘을 선언만 해둠

        public function __construct() {
        $dns = "mysql:host="._DB_HOST.";dbname="._DB_NAME.";charset="._DB_CHARSET;
        $option =
        [
            PDO::ATTR_EMULATE_PREPARES      => false
            ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
            ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
        ];

        try{
            $this->conn = new PDO($dns, _DB_USER, _DB_PASSWORD, $option);
    } catch (Exception $e) {
        echo "DB Connect Error : ".$e->getMessage();
        exit();
    }
  }

 // DB Connect 파기
 public function close() {
    $this->conn = null;
  }

   // Transaction Start (beginTransaciton)
 public function beginTransaction() {
    $this->conn->beginTransaction();
  }

  // commit
 public function commit() {
    $this->conn->commit();
  } 
  
  // rollback
  public function rollback() {
    $this->conn->rollback();
  } 
}