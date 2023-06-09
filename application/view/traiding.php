<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/application/view/assets/css/traiding.css">
    <link rel="icon" href="/application/view/assets/Favicon/coinpavicon.png">
    <title>User Information Update</title>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
        <style>
            table {border-collapse: collapse}
            td, th {padding:5px; width:120px}
        </style>
        <h2><a href="http://localhost/coin/main">YOObit</a></h2>
        <h1>Traiding</h1>
        <script src="https://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script>
            // 전역 변수 세팅
            var usd = 0;
            var alert_array = new Array();
            
            // 천단위 콤마 함수
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            // 숫자 외 문자열 제거 함수
            function numberDeleteChar(x) {
                return x.toString().replace(/[^0-9]+/g, '');
            }
            
            // 달러 환율 함수 (ajax 동기식) <현재 URL이 막혀 밑의 함수로 대체합니다.>
            function usdkrw_(){
                $.ajax({
                    type: 'GET',
                    async: false, //동기식 처리
                    url:'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%3D%22USDKRW%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys',
                    success: function(data) {
                    usd = parseFloat(data['query']['results']['rate']['Rate']); // 전역변수에 저장하여 활용
                    $('#USDKRW').html('환율 : $1 = \\' + usd);
                    }
                });
            }

            // 달러 환율 함수 (ajax 동기식) <2017.09.18 수정>
            function usdkrw(){
                $.ajax({
                    type: 'GET',
                    async: false, //동기식 처리
                    url:'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=c4l1&s=USDKRW=X',
                    success: function(data) {
                    usd = parseFloat(data.split(",")[1]); // 전역변수에 저장하여 활용
                    $('#USDKRW').html('환율 : $1 = \\' + usd);
                    }
                });
            }
            
            // 폴로닉스 함수 (환율 함수와 함께 적용되어야함)
            function poloniex(){
                $.get('https://poloniex.com/public?command=returnTicker', function(data) {
                    var poloniex_btc = parseFloat(data['USDT_BTC']['last']);
                    var poloniex_eth = parseFloat(data['USDT_ETH']['last']);
                    var poloniex_xrp = parseFloat(data['USDT_XRP']['last']);
                    $('#poloniex_BTC').html('\\ ' + numberWithCommas(Math.round(usd * poloniex_btc))); // 거래소 시세 정보 표에 값 세팅
                    $('#poloniex_ETH').html('\\ ' + numberWithCommas(Math.round(usd * poloniex_eth)));
                    $('#poloniex_XRP').html('\\ ' + numberWithCommas(Math.round(usd * poloniex_xrp)));
                });
            }
            
            // 코인원 함수
            function coinone(){
                $.get('https://api.coinone.co.kr/ticker?currency=all', function(data) {
                    var coinone_btc = parseFloat(data['btc']['last']);
                    var coinone_eth = parseFloat(data['eth']['last']);
                    var coinone_xrp = parseFloat(data['xrp']['last']);
                    $('#coinone_BTC').html('\\ ' + numberWithCommas(coinone_btc)); // 거래소 시세 정보 표에 값 세팅
                    $('#coinone_ETH').html('\\ ' + numberWithCommas(coinone_eth));
                    $('#coinone_XRP').html('\\ ' + numberWithCommas(coinone_xrp));
                });
            }
            
            // 빗썸 함수 (크로스도메인 문제로 익스에서만 됨)
            function bithumb(){
                $.get('https://api.bithumb.com/public/ticker/ALL', function(data) {
                    var bithumb_btc = parseFloat(data['data']['BTC']['closing_price']);
                    var bithumb_eth = parseFloat(data['data']['ETH']['closing_price']);
                    var bithumb_xrp = parseFloat(data['data']['XRP']['closing_price']);
                    $('#bithumb_BTC').html('\\ ' + numberWithCommas(bithumb_btc)); // 거래소 시세 정보 표에 값 세팅
                    $('#bithumb_ETH').html('\\ ' + numberWithCommas(bithumb_eth));
                    $('#bithumb_XRP').html('\\ ' + numberWithCommas(bithumb_xrp));
                });
            }
            
            // 코빗 함수 (크로스도메인 문제로 익스에서만 됨)
            function korbit(){
                $.get('https://api.korbit.co.kr/v1/ticker?currency_pair=btc_krw', function(data) {
                    data = JSON.parse(data); //json데이터로 전달 안되어 변환
                    var korbit_btc = parseFloat(data['last']);
                    $('#korbit_BTC').html('\\ ' + numberWithCommas(korbit_btc));
                });
                $.get('https://api.korbit.co.kr/v1/ticker?currency_pair=eth_krw', function(data) {
                    data = JSON.parse(data); //json데이터로 전달 안되어 변환
                    var korbit_eth = parseFloat(data['last']);
                    $('#korbit_ETH').html('\\ ' + numberWithCommas(korbit_eth));
                });
                $.get('https://api.korbit.co.kr/v1/ticker?currency_pair=xrp_krw', function(data) {
                    data = JSON.parse(data); //json데이터로 전달 안되어 변환
                    var korbit_xrp = parseFloat(data['last']);
                    $('#korbit_XRP').html('\\ ' + numberWithCommas(korbit_xrp));
                });
            }
            
            // 알람 세팅 함수
            function alert_setting() {
                var selectTrade = $("#targetTrade option:selected").val(); // 선택된 거래소
                var selectAmount = numberDeleteChar($("#targetAmount").val()); // 선택된 시세
                var targetIf = $("#targetIf option:selected").val(); // 이상/이하
                var tmp_array = new Array(selectTrade, selectAmount, targetIf); // 세팅 값 3개를 묶음
                alert_array.push(tmp_array); // 세팅 값 저장
                if(targetIf == '0')
                    var targetIfPrint = "<font color='blue'>이하</font>";
                else if(targetIf == '1')
                    var targetIfPrint = "<font color='red'>이상</font>";
                $("#alert_list").append("<li><b>"+selectTrade+"</b> 거래소의 시세가 <b>"+numberWithCommas(selectAmount)+"</b> 원 "+targetIfPrint+" 일 때 알람</li>")
            }
            
            // 알람 실행 함수
            function alert_start() {
                // 알람 배열 크기만큼 순회
                for(var i=0; i < alert_array.length; i++) {
                    if(typeof alert_array[i]=='undefined') continue; // 지워진 알람이면 건너뛰기
                    var selectTrade = alert_array[i][0];
                    var selectAmount = alert_array[i][1];
                    var targetIf = alert_array[i][2];
                    var currentAmount = numberDeleteChar($('#'+selectTrade).html()); // 선택된 거래소의 현재 시세
                    var d = new Date();
                    
                    if(targetIf == '0' && parseFloat(currentAmount) <= parseFloat(selectAmount)) { // 선택된 거래소의 현재 시세가 설정 값보다 이하일때
                        alert(selectTrade + " 거래소의 시세가 " + selectAmount + "원 이하(" + currentAmount + ")입니다.\n" + d.toString());
                        delete(alert_array[i]); // 알람 세팅 값 삭제
                    } else if(targetIf == '1' && parseFloat(currentAmount) >= parseFloat(selectAmount)) { // 선택된 거래소의 현재 시세가 설정 값보다 이상일때
                        alert(selectTrade + " 거래소의 시세가 " + selectAmount + "원 이상(" + currentAmount + ")입니다.\n" + d.toString());
                        delete(alert_array[i]); // 알람 세팅 값 삭제
                    }
                }
                
                // 알람목록 갱신
                $("#alert_list").empty();
                for(var i=0; i < alert_array.length; i++) {
                    if(typeof alert_array[i]=='undefined') continue; // 지워진 알람이면 건너뛰기
                    var selectTrade = alert_array[i][0];
                    var selectAmount = alert_array[i][1];
                    var targetIf = alert_array[i][2];
                    if(targetIf == '0') var targetIfPrint = "<font color='blue'>이하</font>";
                    else if(targetIf == '1') var targetIfPrint = "<font color='red'>이상</font>";
                    $("#alert_list").append("<li><b>"+selectTrade+"</b> 거래소의 시세가 <b>"+numberWithCommas(selectAmount)+"</b> 원 "+targetIfPrint+" 일 때 알람</li>")
                }
                
            }
            

            // 현재 시간 갱신
            function CurrentTime() {
                var d = new Date();
                $("#lastUpdate").html(d.toString());
            }
            
            // 갱신 함수
            function proc() {
                try {
                    usdkrw(); // 환율
                    poloniex(); // 폴로닉스
                    coinone(); // 코인원
                    bithumb(); // 빗썸
                    korbit(); // 코빗
                    alert_start(); // 알람 확인
                    CurrentTime(); // 갱신 시간
                } catch(e){
                    
                } finally {
                    setTimeout("proc()", 10000); //10초후 재시작
                }
            }
        </script>
    </head>
    <body onLoad="proc()">
        <!-- 환율 정보 -->
        <span id="USDKRW"></span>
        
        <!-- 거래소 시세 정보 -->
        <table>
            <tr>
                
                <th>Coin</th>
                
            </tr>
            <tr>
                <td>비트코인</td>
                
                <td id="bithumb_BTC"></td>
               
            </tr>
            <tr>
                <td>이더리움</td>
           
                <td id="bithumb_ETH"></td>
               
            </tr>
            <tr>
                <td>리플</td>
               
                <td id="bithumb_XRP"></td>

            </tr>
            <tr>
                <td>최근 갱신 시간</td>
                <td colspan="4" id="lastUpdate"></td>
            </tr>
        </table>
        
        <!-- 작대기 구분 -->
        <hr>
        
        <!-- 알람 설정 -->
        <select id="targetTrade">
            <option value="bithumb_BTC">비트코인</option>
            <option value="bithumb_ETH">이더리움</option>
            <option value="bithumb_XRP">리플</option>
        </select> 
        <input id="targetAmount" type="text" value="3000000"> 원
        <select id="targetIf">
            <option value="1">이상</option>
            <option value="0">이하</option>
        </select> 일때 알람
        <input id="targetSetting" type="button" value="설정" onClick="alert_setting()">
        
        <!-- 알람 목록 -->
        <ul id="alert_list"></ul>
        <br>
        <div class="soo1">
            <select class="CoinName" name="CoinName">
            <option hidden="" disabled="disabled" selected="selected" value="">=====선택하세요=====</option>
	        <option value="비트코인">비트코인</option>
	        <option value="이더리움">이더리움</option>
	        <option value="리플">리플</option>
            </select>
            <div class="KRW1">
            <input>KRW</input>
            <button><a href="#">매수</a></button>
            <button><a href="#">매도</a></button>
            </div>
        </div>    
    </body>
</html>