<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/application/view/assets/css/regist.css">
    <link rel="icon" href="/application/view/assets/Favicon/coinpavicon.png">
    <title>regist</title>
</head>
<body>
 <!-- 1. if로 작성 -->

  <h1>join</h1>
  <h2><a href="http://localhost/coin/main">YOObit</a></h2>
    <br>
    <br>
    <?php if(isset($this->errMsg)) { ?>
        <div>
            <span><?php echo $this->errMsg ?></span>
        </div>
    <?php } ?>

 <form action="/user/regist" method="POST">
 <div class="textForm">
    <label for="id">ID</label>
    <input type="text" name="id" id="id" class="id" placeholder="여기에 입력하세요" required>
    <button type="button" onclick="chkDuplicationId();" class="jjj">중복체크</button>
    <span id="errMsgId">
        <?php 
        if(isset($this->arrError["id"])) { 
            echo $this->arrError["id"];
        }
        ?>
    </span>
    </div>  
    <br>
    <div class="textForm">
    <label for="pw">PW</label>
    <input type="text" name="pw" id="pw" class="pw" placeholder="여기에 입력하세요" required>
    <span>
        <?php 
        if(isset($this->arrError["pw"])) { 
        echo $this->arrError["pw"];
        }
        ?>
    </span>  
    </div>
    <br>
    <div class="textForm">    
    <label for="pwChk">PW Check</label>
    <input type="text" name="pwChk" id="pwChk" class="pw" placeholder="여기에 입력하세요" required>
    <span>
        <?php 
        if(isset($this->arrError["pwChk"])) { 
        echo $this->arrError["pwChk"];
        }
        ?>
    </span>  
    </div>
    <br>
    <div class="textForm">
    <label for="name">NAME</label>
    <input type="text" name="name" id="name" class="name" placeholder="여기에 입력하세요" required>
    <span>
        <?php 
        if(isset($this->arrError["name"])) { 
        echo $this->arrError["name"];
        }
        ?>
    </span>  
    </div>
    <br>
    <div class="textForm">
    <button type="submit" class="btn">회원가입</button>
    <!-- <input type="submit" class="btn" value="J O I N"/> -->
    <!-- <button type="submit">회원가입</button> -->
    </div>
    </form>



    <!-- <h2>회원가입</h2>
      <div class="textForm">
        <input name="loginId" type="text" class="id" placeholder="아이디">
        </input>
      </div>
      <div class="textForm">
        <input name="loginPw" type="password" class="pw" placeholder="비밀번호">
      </div>
       <div class="textForm">
        <input name="loginPwConfirm" type="password" class="pw" placeholder="비밀번호 확인">
      </div>
      <div class="textForm">
        <input name="name" type="password" class="name" placeholder="이름">
      </div>
       <div class="textForm">
        <input name="email" type="text" class="email" placeholder="이메일">
      </div>
      <div class="textForm">
        <input name="nickname" type="text" class="nickname" placeholder="닉네임">
      </div>
      <div class="textForm">
        <input name="cellphoneNo" type="number" class="cellphoneNo" placeholder="전화번호">
      </div>
      <input type="submit" class="btn" value="J O I N"/>
    </form> -->


    <script src="/application/view/js/common.js"></script>
</body>
</html>