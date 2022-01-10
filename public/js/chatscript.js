let block = document.getElementById('messblock');
let mesblock = document.getElementById('messblock');
let uid = document.getElementById('userid').value;

async function getmessages() {
    let response = await fetch('/chatapi');//запрос в БД
    let content = await response.json();//получаем ответ в JSON-формате
        let key;
    //вывод сообщений в окно с сообщениями
    for (key in content){
        //определяем, сообщение было отправлено, или полученно, и задаем соответсвующий от этого класс
        if ( content[key]['user_id'] == uid ) {
            mesblock.innerHTML += '<div class="usermess received">' + content[key].message + '</div>';
        } else {
            mesblock.innerHTML += '<div class="usermess sent">' + content[key].message + '</div>';
        }
    }
    block.scrollTop = block.scrollHeight;//проматываем этот блок в конец
}
getmessages();



