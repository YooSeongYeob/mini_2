<?php
namespace application\controller;

class UserController extends Controller {
   public function loginGet() {
      return "login"._EXTENSION_PHP;
   }

  public function loginPost() {
   $result = $this->model->getUser($_POST); // DB에서 유저정보 습득
   $this->model->close(); // DB 파기

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
      return _BASE_REDIRECT."/coin/main";
   }

   // 회원가입
   public function registGet(){
      return "regist"._EXTENSION_PHP;
   }

   public function registPost() {
      $arrPost = $_POST;   
      $arrChkErr = [];
      // 값의 유효성을 체크해야 함
      // ID 글자 수 체크
      if(mb_strlen($arrPost["id"]) === 0 || mb_strlen($arrPost["id"]) > 12 ) {
         $arrChkErr["id"] ="ID는 12글자 이하로 입력해주세요.";
      }
      // ID 영문숫자 체크 (한 번 해보세요)

      // PW 글자 수 체크
      if(mb_strlen($arrPost["pw"]) < 8 || mb_strlen($arrPost["pw"]) > 20) {
         $arrChkErr["pw"] = "PW는 8~20글자로 입력해주세요";
      }
      // PW 영문숫자특수문자 체크 (한 번 해보세요)


      // 비밀번호와 비밀번호 체크 확인
      if($arrPost["pw"] !== $arrPost["pwChk"]) {
         $arrChkErr["pwChk"] = "비밀번호와 비밀번호 확인이 일치하지 않습니다  ";
      }

      // NAME 글자 수 체크
      if(mb_strlen($arrPost["name"]) ===0 || mb_strlen($arrPost["name"]) > 30) {
         $arrChkErr["name"] = "이름을 30글자 이하로 입력해주세요";
      }
      
      // 유효성 체크 에러일 경우
      if(!empty($arrChkErr)) {
         // 에러메시지 세팅
         $this->addDynamicProperty('arrError', $arrChkErr);
         return "regist"._EXTENSION_PHP; 
      }

      $result = $this->model->getUser($arrPost, false);


      // 유저 유무 체크
      if(count($result) !== 0) {
         $errMsg = "입력하신 ID가 사용 중입니다.";
         $this->addDynamicProperty("errMsg",$errMsg);
         // 회원가입 페이지
         return "regist"._EXTENSION_PHP;
      }
      // ***** Transaction Start 
      $this->model->beginTransaction();

      // user insert
      if(!$this->model->insertUser($arrPost)) {
         // 예외처리 롤백
         $this->model->rollback();
         echo "User Regist ERROR";
         exit();
        }
        
      $this ->model->commit(); // 정상처리 커밋
      // ***** transaction End

      // 로그인 페이지로 이동
         return _BASE_REDIRECT."/user/login";
      }
   }
?>
