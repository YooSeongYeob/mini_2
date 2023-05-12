<?php

require_once("application/lib/config.php"); // config 파일을 불러옵니다

// echo $_GET["url"];  // url 설정해줘야 함 지금은 아무것도 설정 안 됨
require_once("application/lib/autoload.php"); // new만 있을 때는 실행이 안 돼서 얘를 추가해줬음
new application\lib\Application(); // require로 불러오고 나서 new 뭐시기저시기로 실행
// Application 호출 네임스페이스까지 적어줌
// 어플리케이션은 인덱스 안에 있는 파일이 아니다. 
// 얘를 쓰려면 리콰이어나 인크루드를 해야 쓸 수 있다.
// 그래서 이 상태로는 안 됨

// 인크루드랑 리콰이어를 자동으로 해주는 거라고 함 오토로드라는 것을 알아볼거임
// 객체지향은 파일이 수백개기 때문임


// 1. 필요한 설정 파일 불러오고
// 2. 오토로드 불러오고
// 뉴 어플리케이션 불러오고 끝


/* 

mariaDB 데이터베이스는 이렇게 만듬
CREATE DATABASE minitwo;

USE minitwo;

CREATE TABLE user_info(
	u_no INT PRIMARY KEY AUTO_INCREMENT
	,u_id VARCHAR(12) NOT NULL
	,u_pw VARCHAR(512) NOT NULL
);

INSERT INTO user_info(u_id, u_pw) VALUES('php506', '506');

*/