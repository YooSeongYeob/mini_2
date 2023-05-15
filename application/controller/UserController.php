<?php

namespace application\controller;

class UserController extends Controller {
   public function loginGet() {
      return "login"._EXTENSION_PHP;
   }
  public function loginPost() {
   $result = $this->model->getUser($_POST);
   // 유저 유무 체크
   if(count($result) === 0) {
      $errMsg = "입력하신 회원 정보가 없습니다";
      $this->addDynamicProperty("errMsg", $errMsg);
      // 로그인 페이지로 이동
      return "login"._EXTENSION_PHP;
      // 동적 속성 다이나믹 프로퍼티 
      // 특정 값을 멤버 필드에 저장할 때 
      // 멤버 필드에 해당 변수가 저장되어 있는데
      // 미리 선언 되어있지 않고 그때그때 넣어줄 수 있다
   }
    // session에 user ID를 저장
   $_SESSION[_STR_LOGIN_ID] = $_POST["id"];

    // 리스트 레이지 리턴
    return _BASE_REDIRECT."/coin/main";
   }

   // 로그아웃 메소드 
   public function logoutGet() {
      session_unset(); // 모든 데이터 지워줌
      session_destroy(); // 아예 파기
      // 로그인 페이지 리턴
      return "login"._EXTENSION_PHP;
   }
}
?>
