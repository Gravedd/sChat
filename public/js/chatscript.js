//ОБЪЯВЛЕНИЕ ПЕРЕМЕННЫХ
let block = document.getElementById('messblock');
let mesblock = document.getElementById('messblock');
let uid = document.getElementById('userid').value;
let sendid = document.getElementById('sendid').value;
let messinput = document.getElementById('messinput');
let sendButton = document.getElementById('sendButton');
let token = document.getElementById('csrf-token');


/*ФУКНЦИИ*/
//загрузка всех сообщений
async function getmessages() {
    let response = await fetch('/chatapi');//запрос в БД
    let content = await response.json();//получаем ответ в JSON-формате
        let key;
    //вывод сообщений в окно с сообщениями
    for (key in content){
        //определяем, сообщение было отправлено, или полученно, и задаем соответсвующий от этого класс
        if ( content[key]['user_id'] == uid ) {
            mesblock.innerHTML += '<div class="usermess sent received">' + content[key].message + '</div>';
        } else {
            mesblock.innerHTML += '<div class="usermess received">' + content[key].message + '</div>';
        }
    }
    block.scrollTop = block.scrollHeight;//проматываем этот блок в конец
    getIdlastMessage(content)
}
//получение айди последнего сообщения
function getIdlastMessage(arr) {
    return arr[arr.length - 1]['id'];
}



//отправка сообщения на сервер
sendButton.addEventListener('click', sendMessage);
function getInputtext() {
    return messinput.value;
}
async function sendMessage() {
    let mess = {
        message: getInputtext(),
        sendid: sendid
    };

    let response = await fetch('/chatapi/sendmess', {
        method: 'POST',
        credentials: "same-origin",
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token.value,
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(mess)
    });//запрос к серверу
    let content = await response.json();//получаем ответ в JSON-формате
    if ( content['response'] == true) {
        console.log('Сообщение успешно отправлено')
    } else {
        alert('ошибка при отправке: ' + (content['response']) );
    }


}

//ВЫЗОВЫ ФУНКЦИЙ
getmessages();//получить все сообщения при загрузки страницы




