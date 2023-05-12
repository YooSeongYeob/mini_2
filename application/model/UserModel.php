<?php
// 로그인이 유저에 있기 때문에 만들어준 파일

namespace application\model;

class UserModel extends Model {
    
    // 파라미터로 값을 받아올 거임 스트링, 배열 둘 중에 하나로 아이디랑 패스워드 받아와야 함
    // 배열로 받기로 함 $arrUserInfo
    public function getUser($arrUserInfo) {       
        $sql = " select * from user_info where u_id = :id and u_pw = :pw ";
        $prepare = [
            ":id" => $arrUserInfo["id"]
            ,":pw" => $arrUserInfo["pw"]
        ];
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($prepare);
            $result = $stmt->fetchAll();
        } catch (Exception $e) {
            echo " UserModel->getUser Error : ".$e->getMessage();
            exit();
        } finally {
            $this->closeConn();
        }
        return $result;
    }
} 