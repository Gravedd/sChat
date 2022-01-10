let adduserbutton = document.getElementById('adduserbutton');//кнопка события
let userid = document.getElementById('uid').value;//получаем id пользователя

async function func() {
    alert();
    let response = await fetch('http://schat.loc', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(userid)
    }); // завершается с заголовками ответа
    let result = await response.text(); // читать тело ответа в формате JSON
}
adduserbutton.addEventListener('click', func);
