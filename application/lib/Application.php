<?php

// class는 대문자로 작성 카멜 기법으로 
// 원래 php는 스네이크 원툴인데 이런다 함

// 네임스페이스 설정은 역슬러쉬 해줘야 함
namespace application\lib; // 어플리케이션에 라이브러리를 가져와야겠다고 하면 얘를 가져온다고 함

use application\util\UrlUtil; // 패스가 이걸 사용하겠다라고 오토로드가 인식을 하게 됨

class Application {
    
    // 생성자 
    public function __construct() {            // 생성자 메소드는 __construct 얘도 원래 객체로 따로 만들어줘야 함
        //  $path = isset($_GET["url"]) ? $_GET["url"]: "";            // 쿼리스트링이 없을 때 로컬호스트 접속이 에러가 남 그래서 설정해줘야 함
        //  $arrPath = $path !== "" ? explode("/", $path) : "";    // 패스가 빈 문자열이 아니면 빈 문자열을 보내고 아니면 패스로 보낸다
        // 대부분의 객체지향은 카멜 기법, 라라벨도 카멜 기법
         $arrPath = UrlUtil::getUrlArrPath(); // 접속 URL을 배열로 획득
         $identityName = empty($arrPath[0]) ? "Coin" : ucfirst($arrPath[0]);                                           
         $action = (empty($arrPath[1]) ? "main" : $arrPath[1]).ucfirst(strtolower($_SERVER["REQUEST_METHOD"]));    // 메소드로 설정할거기 때문에 어퍼를 설정 안 함 대문자로 바꿔주지 않을거임 첫글자를
         
         // controller 명 작성
         $controllerPath = _PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER._EXTENSION_PHP;
         // 컨트롤러를 부르기 전에 먼저 파일이 있는지 확인해야 해서 불러온 것임

         // 해당 controller 파일 존재 여부 체크
         if(!file_exists($controllerPath)) {
            echo "해당 컨트롤러 파일이 없습니다. : ".$controllerPath;
            exit();
        }

        // 해당 컨트롤러를 생성
        // _PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER. 실질적인 패스명 확장자를 제외한 것
        $controllerName = UrlUtil::replaceSlashToBackslash(_PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER);
        new $controllerName($identityName, $action);
        // 생성자를 호출한 것임 유저 컨트롤에는 없음
        // 부모에 컨트롤러 생성자를 호출할 것임
        // 자식한테 없으면 부모한테 상속 받는다.


         // 파일이 있는지 없는지 체크하는 메소드가 있음
// ucfirst는 aaa bbb > Aaa bbb
// ucwords는 aaa bbb > Aaa Bbb

         // urlutil 위치까지 가야하는데 못 가는 중 그래서 위에 유즈를 사용
        }   // isset으로 겟에 url이 세팅되어 있는지 확인 있으면 사용 없으면 빈 문자열 사용
}
// new application\lib\Application(); // 나중에 사용하고 싶을 때 이렇게 쓰면 됨
// 어플레케이션에 있는 라이브러리의 어플리케이션을 사용하겠다
// 유저라는 건 각각의 컨트롤러 모델에서 가장 상위가 되는 거고 
// 로그인은 기능을 나타내는 말 접속 url을 받을 때 항상 user/login 형태로 받겠다라는 의미임
// 상세페이지면 쇼핑몰의 경우 product 안에 list 이런 형태
// 2개의 path를 슬러쉬로 다 받는다고 함
// 유틸리티를 패스로 쪼개는 것까지 완료