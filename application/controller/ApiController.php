<?php

namespace application\controller;

class ApiController extends Controller {
   public function userGet() {
      $arrGet = $_GET;  
      $arrData = ["flg" => "0"];

         // model 호출
      $this->model = $this->getModel("User");

      $result = $this->model->getUser($arrGet, false);

      // 유저 유무 체크   
      if(count($result) !== 0) {
         $arrData["flg"] = "1";
         $arrData["msg"] = "입력하신 ID가 사용 중입니다.";
      }

       // 배열을 JSON으로 변경 < 구글 검색어: php 배열 제이슨 변환>
       $json = json_encode($arrData);
       header('Content-type: application/json');
       echo $json;
       exit();
   }
}

// 프로그램이 한 번 구축할 때는 어려운데 구축하고 나면
// 그 다음부터 추가하는 건 간단함

