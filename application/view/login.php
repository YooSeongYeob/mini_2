<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <h3 style="color: red;"><?PHP echo isset($this->errMsg) ? $this->errMsg : ""; ?></h3>
    <form action="/user/login" method="post"> 
    <label for="id">ID</label>
    <input type="text" name="id" id="id">
    <label for="pw">PW</label>
    <input type="password" name="pw" id="pw">
    <button type="submit">Login</button>
    </form>
</body>
</html>

<!-- root는 htdocs임 슬러쉬 붙여줘야 함
 root 안 붙여주면 url 이상해짐 -->