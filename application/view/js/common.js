function chkDuplicationId() {
    // console.log('tt'); // F12로 테스트하기
    const id = document.getElementById('id');

    const url = "/api/user?id=" + id.value;
    
    // API
    fetch(url) // 패치로 url을 주고 성공하면 받아와서 제이슨으로 파싱을 하고 다시 리턴을 해줌
    .then(data => { 
        if(data.status !== 200) {
            throw new Error(data.status + ' : API Response Error ');
        }
        return data.json();
    })
    .then(apiData => {
        const idspan = document.getElementById('errMsgId');
        if(apiData["flg"] === "1") {
            idspan.innerHTML = apiData["msg"]
        } else {
            idspan.innerHTML = "";
        }
    })
    // 에러는 alert로 처리
    .catch(error => alert(error.message));
     
    // 에러 예외처리 해준 것임 위에 꺼

    // fetch(url) // 패치로 url을 주고 성공하면 받아와서 제이슨으로 파싱을 하고 다시 리턴을 해줌
    // .then(data => { return data.json();})
    // .then(apiData => {
    //     const idspan = document.getElementById('errMsgId');
    //     if(apiData["flg"] ==="1") {
    //         idspan.innerHTML = apiData["msg"]
    //     } else {
    //         idspan.innerHTML = "";
    //     }
    // });
}


