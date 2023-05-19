<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/application/view/assets/css/regist.css">
    <link rel="icon" href="/application/view/assets/Favicon/coinpavicon.png">
    <title>User Information Update</title>
</head>
<body>
  <h1>Edit</h1>
  <h2><a href="http://localhost/coin/main">YOObit</a></h2>
  <br><br>
  
  <?php if(isset($this->errMsg)) { ?>
    <div>
      <span><?php echo $this->errMsg ?></span>
    </div>
  <?php } ?>

  <form action="/user/update" method="POST">
    <div class="textForm">
      <label for="id">ID</label>
      <input type="text" name="id" id="id" class="id" placeholder="여기에 입력하세요" required>
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
      <button href="/user/update" type="submit" class="btn">회원 정보 수정</button>
    </div>
  </form>

  <script src="/application/view/js/common.js"></script>
</body>
</html>