<?php

namespace application\controller;

class CoinController extends Controller {
   public function mainGet() {
   if(isset($_SESSION[_STR_LOGIN_ID])){
      $this->addDynamicProperty('loginFlg', "1");
   }

      return "main"._EXTENSION_PHP;
   }
}
?>


<!-- 프로그램이 한 번 구축할 때는 어려운데 구축하고 나면
그 다음부터 추가하는 건 간단함 -->