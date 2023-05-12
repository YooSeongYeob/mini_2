<?php

// config에는 여러가지 설정들을 추가할 수 있음

define("_ROOT", $_SERVER["DOCUMENT_ROOT"]);

// DB 관련
define("_DB_HOST","localhost");
define("_DB_USER","root");
define("_DB_PASSWORD","root506");
define("_DB_NAME","minitwo");
define("_DB_CHARSET","utf8mb4");


// 익스텐션 : 확장자
// base : 기본 부모 파일

// 기타 
define("_EXTENSION_PHP",".php");
define("_PATH_CONTROLLER","application/controller/");
define("_PATH_MODEL","application/model/");
define("_PATH_VIEW","application/view/");

define("_BASE_FILENAME_CONTROLLER", "Controller");
define("_BASE_FILENAME_MODEL", "Model");

define("_BASE_REDIRECT", "Location: ");
define("_STR_LOGIN_ID", "u_id");


// 뒤에꺼 패스, 앞에는 네임

