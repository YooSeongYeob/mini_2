<?php
// 로그인이 유저에 있기 때문에 만들어준 파일

namespace application\model;

class UserModel extends Model {
    
    // 파라미터로 값을 받아올 거임 스트링, 배열 둘 중에 하나로 아이디랑 패스워드 받아와야 함
    // 배열로 받기로 함 $arrUserInfo
    public function getUser($arrUserInfo, $pwFlg = true) {      // 2번째 파라미터가 있으면 쓰고 없으면 1번째꺼를 쓰겠다라는 의미
        $sql =" select * from user_info where u_id = :id ";
        
        // PW 추가할 경우 // 동적 쿼리의 가장 기초이고 여러 화면에서 다 사용하겠다는 의미
        if($pwFlg) {
            $sql .= " and u_pw = :pw ";
        }    
    
        
        $prepare = [
            ":id" => $arrUserInfo["id"]
        ];

        // PW 추가할 경우 // 동적 쿼리의 가장 기초 // 인서트 딜리트 다 해당
        if($pwFlg) {
            $prepare[":pw"] = $arrUserInfo["pw"];
        }    

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($prepare);
            $result = $stmt->fetchAll();
        } catch (Exception $e) {
           echo "UserModel->getUser Error : ".$e->getMessage();
           exit();
        }
        //  finally {
        //     $this->closeConn();
        // } // 커넥션 닫는 걸 여기서 못 닫게 꺼버림 user controller POST로 닫아줄거임
        return $result;
    }

        // Insert User
        public function insertUser($arrUserInfo) {
        $sql = " INSERT INTO user_info(u_id, u_pw, u_name) VALUES(:u_id, :u_pw, :u_name) ";

        $prepare = [
        ":u_id" => $arrUserInfo["id"]
        , ":u_pw" => $arrUserInfo["pw"]
        , ":u_name" => $arrUserInfo["name"]
            ];

        try {
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($prepare);
            return $result;
            } catch (Exception $e) {
            return false;
            }
    }
} 