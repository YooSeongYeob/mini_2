<?php

namespace application\controller;

use application\util\UrlUtil;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Controller {
    protected $model;
    private static $modelList = [];
    private static $arrNeedAuth = ["product/list"]; // 인증이 필요한 페이지 이름을 적어줘야 한다
    

    // 생성자
    public function __construct($identityName, $action) {
        //session start
        if(!isset($_SESSION)){
            session_start(); 
        }

        // 유저 로그인 및 권한 체크 
        $this->chkAuthorization(); // 메소드 만들음

        // var_dump("t1 "); // TODO
        // model 호출
        $this->model = $this->getModel($identityName);

        // 해당 controller의 메소드 호출
        $view = $this->$action();  // 로그인 겟과 로그인 포스트가 실행되는 지점
        // var_dump("t2 ".$action); // TODO
        if(empty($view)) {
            echo "해당 컨트롤러에 메소드가 없습니다. :" .$action;
            exit();
        }
        // var_dump("t3 ".$view); // TODO
        // view 호출
        require_once $this->getView($view);

        // this가 부모를 정의하지만 유저 컨트롤에서 loginget이 호출
    }

    // model 호출하고 결과를 리턴
    protected function getModel($identityName) {
        // model 생성 체크 
        if(!in_array($identityName, self::$modelList )) {
            $modelName = UrlUtil::replaceSlashToBackslash(_PATH_MODEL.$identityName._BASE_FILENAME_MODEL); // 클래스명이 와야 하기 때문에 php 확장자가 안 붙는다.
            self::$modelList[$identityName] = new $modelName(); // model class 호출
        }
        return self::$modelList[$identityName];
    }
    // 파라미터를 확인해서 해당하는 view를 리턴하거나, redirect
    // 리다이렉트가 필요하면 리다이렉트 아니면 뷰 스트링을 세팅
    protected function getView($view) {
        // view를 체크
        //리다이렉트를 할 뷰는 항상 앞에 상수로 준 로케이션이 있어야 한다
        // view 파일을 인쿠르드 해서 쓸거기 때문에 리다이렉트가 안 붙어 있는데
        // 규칙대로 움직여야 하는데 그게 바로 프레임워크다
        // 해당 문자열에 로케이션이 있는지 없는지 확인
        if(strpos($view, _BASE_REDIRECT) ===0) {
            header($view);
            exit();
        } 
            
        // 첫번 째 검사할 데이터 뷰가 들어가고 두 번째는 어떤 데이터를 넣을래?
        // 뷰 리다이렉트 하고 exit으로 종료하고 없으면 path로 문자열 출력
        return _PATH_VIEW.$view;
    }

    // 동적 속성 다이나믹 프로퍼티를 세팅하는 메소드
    protected function addDynamicProperty($key, $val) {
        $this->$key = $val; // 달러 변수가 넘어온 키기 때문에 에러미시지가 세팅되어있다고 하면 지금객체의 에러메시지를 찾아가는 것
    }  // $를 빼면 단순히 프로퍼티를 찾아가게 됨 변수가 아니라

    // 유저 권한 체크 메소드
    protected function chkAuthorization() {
        $urlPath = UrlUtil::getUrl();
        foreach (self::$arrNeedAuth as $authPath) {
            if(!isset($_SESSION[_STR_LOGIN_ID]) && strpos($urlPath, $authPath) === 0 ){
                header(_BASE_REDIRECT."/user/login");
                exit();
            }
        }
    }
 }

// 로그아웃 기능이 있을 때는 세션을 종료시켜버림 

// 포로텍티브로 했기 때문에 셀프로 해야 함
// 로그인을 안 하고 프로덕트 주소로 바로 넘어가서 로그인을 생략하는 것을 방지시켜야 함 

// 최상위 부모 클래스를 이었기 때문에 호출만 하면 끝 (마지막)


// 세팅돼있으면 트루 안 돼 있으면 펄스
// 아이덴티티네임이 모델리스트에 있는지 체크 파이빗을 선언 디스로는 사용 불가 셀프 스태틱 사용
// 모델을 여러개 불러올 수 있는데 데이터베이스에 붙어서 작업을 해서 메모리 사용량이 큼 그래서 modelList 라는 배열을 만들어준 것임
// 이미 있는 모델이면 모델리스트에서 그대로 쓰는 방식으로 만든다고 하심 서버의 부하를 줄이기 위함임
// 객체지향을 써서 메모리를 감축시킬 수 있음 (장점)
// 컨트롤러.php를 상속 받고 사용하려고 이렇게 함
// 서버에 요청을 할 때 메소드를 작성 안 해주면
// 디폴트가 get임
//url 쳐서 들어갈 땐 get
// post는 폼태그로 감싸서 메소드를 준다 강제적으로 설정해줘야지 post가 됨

// 겟 메소드로 왔을 때는 단순히 화면 출력용
// 포스트는 유저의 입력값이 많아서 데이터베이스에서 처리를 할 때 많이 사용
// 폼 태그로 감싸서 보내기도 함

// 구분해서 사용하는 건 개발자마다 다름
// url은 로그인으로 통일 조절은 어플리케이션에서 함