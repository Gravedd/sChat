let adduserbutton = document.getElementById('adduserbutton');//кнопка события
let userid = document.getElementById('uid').value;//получаем id пользователя
let token = document.getElementById('csrf-token').value;

async function adduser() {
    let toserver = {//что отправляем на сервер
        userid: userid
    };
    console.log( JSON.stringify(toserver))
    let response = await fetch('http://schat.loc/adduser', {
        method: 'POST',
        credentials: "same-origin",//с куки
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token,
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(toserver)
    }); // завершается с заголовками ответа
    let result = await response.text(); // читать тело ответа в формате JSON
    console.log(result)
}
adduserbutton.addEventListener('click', adduser);
