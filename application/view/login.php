<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/application/view/assets/css/coinLogin.css">
    <link rel="icon" href="/application/view/assets/Favicon/coinpavicon.png">
    <script src="/application/view/js/common.js"></script>
    <title>Login</title>
</head>
<body>
  
<h3 style="color: red;"><?PHP echo isset($this->errMsg) ? $this->errMsg : ""; ?></h3>
<form action="/user/login" method="post"> 

<!-- <form action="/user/login" method="post"> -->
		<!-- <label for="id">ID</label>
		<input type="text" name="id" id="id">
		<label for="pw">PW</label>
		<input type="text" name="pw" id="pw">
		<button type="submit">Login</button> -->
<h1><a href="http://localhost/coin/main">YOObit</a></h1>
<div class="container">
    <div class="screen">
      <div class="screen__content">
        
      <form class="login">
          <div class="login__field">
            <i for="id" class="login__icon fas fa-user"></i>
            <input type="text" name="id" id="id" class="login__input" placeholder="User name">
          </div>
          <div class="login__field">
            <i for="pw" class="login__icon fas fa-lock"></i>
            <input type="password" name="pw" id="pw" class="login__input" placeholder="Password">
          </div>
          <button class="button login__submit">
            <span class="button__text">LogIn</span>
            <i class="button__icon fas fa-chevron-right"></i>
          </button>       
        </form>

        <div class="social-login">
          <h3>log in via</h3>
          <div class="social-icons">
            <a href="#" class="social-login__icon fab fa-instagram"></a>
            <a href="#" class="social-login__icon fab fa-facebook"></a>
            <a href="#" class="social-login__icon fab fa-twitter"></a>
          </div>
        </div>
      </div>
      <div class="screen__background">
        <span class="screen__background__shape screen__background__shape4"></span>
        <span class="screen__background__shape screen__background__shape3"></span>    
        <span class="screen__background__shape screen__background__shape2"></span>
        <span class="screen__background__shape screen__background__shape1"></span>
      </div>    
    </div>
  </div>
</body>
</html>