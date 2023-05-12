<?php

// utility 앞에 있는 건 해당 그룹명 그 뒤에 이름은 자기가 속해 있는 디렉토리 명과 똑같이 
// 가는 규칙을 지켜야 함

// 유틸이라는 클래스를 하나 만들게 된 거임


namespace application\util;
class UrlUtil {

    // $_GET["url"]을 분석해서 리턴
    public static function getUrl() {
        return isset($_GET["url"]) ? $_GET["url"]: "";
    }

    // URL을 "/"로 구분해서 배열을 만들고 리턴
    public static function getUrlArrPath() {
        // $arr_path = $path !== "" ? explode("/", $path) : "";  
        // $obj = new UrlUtil();
        // $obj->getUrl(); 원래는 이렇게 인스턴트화 해서 사용했는데
        // 스태틱을 붙였기 때문에 뉴 함수를 선언하면서 인스턴트화 안 해도 쓸 수 있음
        $url = UrlUtil::getUrl();
        return $url !== ""? explode("/", $url) : "";
    }

        // function 만들거임 "/"를 "\"로 치환해주는 메소드
    public static function replaceSlashToBackslash($str) {
        return str_replace("/","\\",$str);
    }

}


// 스태틱으로 선언했으니 콜론 2개로 사용 ::
// 객체 지향을 할 때는 최대한 쪼갠다
// 하나의 기능이 하나의 동작만 수행하도록 하기 위해

// 여러개의 기능이 한 군데에 들어가 있으면
// 어디에 뭐가 있는지 분석을 따로 해야 하기 때문에
// 하나의 메소드를 하나의 기능만 하도록 해야 함

// 재사용성도 증가하게 된다 

// 쪼개면 단점도 있음 너무 많은 메소드와 클래스가 있어서
// 이미 있는 기능이 있는데 미처 파악하지 못하고 또
// 생성할 수가 있게 됨 소스코드가 복잡해질 수 있음
// A 라는 애는 여기 B라는 애는 저기 C는 거기 
// 불러올 때 난잡해질 수 있음 소스코드가 적당히 쪼개야 하는데
// 그게 상당히 어렵다고 함 그래서 객체지향이 어렵다
// 하지만 쪼개면 쪼갤수록 좋음 그래서 저 위에 코드를
// 2개로 쪼갠거임