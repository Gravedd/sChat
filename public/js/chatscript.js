//ОБЪЯВЛЕНИЕ ПЕРЕМЕННЫХ
let block = document.getElementById('messblock');
let mesblock = document.getElementById('messblock');
let uid = document.getElementById('userid').value;
let sendid = document.getElementById('sendid').value;
let messinput = document.getElementById('messinput');
let sendButton = document.getElementById('sendButton');
let token = document.getElementById('csrf-token');
let keyinput = document.getElementById('securekey');

let lastmessid;
/*ФУКНЦИИ*/

//загрузка всех сообщений
async function getmessages() {
    //что отправляем на сервер
    let toserver = {
        sendid: sendid//кому отправляем
    };
    //Запрос на сервер
    let response = await fetch('/chatapi', {
        method: 'POST',
        credentials: "same-origin",//с куки
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token.value,
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(toserver)//отправка нашего массива
    });
    //получаем ответ в JSON-формате
    let content = await response.json();
        let key;
    //Если ответ пришел не пустой
    if ( content.length > 1 ) {
        //вывод сообщений в окно с сообщениями
        for (key in content) {
            //определяем, сообщение было отправлено, или полученно, и задаем соответсвующий от этого класс
            if (content[key]['user_id'] == uid) {
                mesblock.innerHTML += '<div class="usermess sent">' + messageencoding(content[key].message) + '</div>';
            } else {
                mesblock.innerHTML += '<div class="usermess received">' + messageencoding(content[key].message) + '</div>';
            }
        }
        block.scrollTop = block.scrollHeight;//проматываем этот блок в конец
        lastmessid = getIdlastMessage(content);//получаем айди посл.сообщения
    } else {
        lastmessid = 0;
    }

}


//получение айди последнего сообщения
function getIdlastMessage(arr) {
    return arr[arr.length - 1]['id'];
}


//запрос к серверу на новые сообщения
async function checkNew() {
    //что отправляем на сервер
    let toserver = {
        lastid: lastmessid,//айди посл.сообщения
        sendid: sendid//кому отправляем
    };
    //Запрос на сервер
    let response = await fetch('/chatapi/checknew', {
        method: 'POST',
        credentials: "same-origin",//с куки
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token.value,
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(toserver)//отправка нашего массива
    }, 3000);//запрос к серверу
    //если ошибка, то заново запустить функцию
    if (response.status != 200) {
        await checkNew();
    }

    //получаем ответ в JSON-формате
    let content = await response.json();
    //если пришел ответ от сервера
    if (content.length > 0) {
        let key;
        //то делаем вывод сообщений в окно
        for (key in content) {
            //определяем, сообщение было отправлено, или полученно, и задаем соответсвующий от этого класс
            if (content[key]['user_id'] == uid) {
                mesblock.innerHTML += '<div class="usermess sent">' + messageencoding(content[key].message) + '</div>';
                if (document.getElementById(tempid) != null) {
                    if (document.getElementById(tempid).innerHTML == messageencoding(content[key].message)) {
                        document.getElementById(tempid).remove();
                    }
                }
            } else {
                mesblock.innerHTML += '<div class="usermess received">' + messageencoding(content[key].message) + '</div>';
            }
        }
        block.scrollTop = block.scrollHeight;//проматываем этот блок в конец
        lastmessid = getIdlastMessage(content);//получаем айди посл.сообщения
        await checkNew();//заново запускаем функцию
    } else {//если ответ пришел пустой
        await checkNew();//то заново запустить функцию
    }

}



//ОТПРАВКА СООБЩЕНИЯ НА СЕРВЕР
let tempid = 0;
//Добавляем эвенты, запускающие функции, при нажатии на Enter и кнопки отправки
sendButton.addEventListener('click', sendMessage);
messinput.addEventListener('keyup', function (event){
    let keyboardCode = event.key;//получить нажатую клавишу
    if (keyboardCode === "Enter"){
        sendMessage();
    }
});
//Получить текст с инпута
function getInputtext() {
    return messinput.value;
}

//Функция отправки сообщения
async function sendMessage() {
    //Если сообщение не равно пустате или пробелу
    if ( getInputtext() != '' && getInputtext() != ' ' ) {
        tempid += 1;
        //Что отправляем на сервер
        let mess = {
            message: messageencoding(getInputtext()),
            sendid: sendid
        };

        //Вывод временного сообщения, с анимацией отправки
        mesblock.innerHTML += '<div class="usermess sent anim" id="' + tempid + '">' + getInputtext() + '</div>';
        block.scrollTop = block.scrollHeight;//проматываем этот блок в конец
        messinput.value = '';//очищаем инпут

        //Отправка данных на сервер
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
        });
        //получаем ответ в JSON-формате
        let content = await response.json();
        //если ответ = true, то сообщение успешно отпр-но, иначе ошибка
        if (content['response'] == true) {
            document.getElementById(tempid).classList.remove("anim");
        } else {
            alert('ошибка при отправке: ' + (content['response']));
            document.getElementById(tempid).classList.add("error");
        }
    }


}

//КОДИРОВАНИЕ/РАССКОДИРОВАНИЕ СООБЩЕНИЯ
function messageencoding(text) {//функция принимает в себя текст
    let inp;
    let key;
    let output = "";
    let keyval = document.getElementById('securekey').value;//получаем значение ключа
    for (i = 0; i < text.length; i++){
        // берём цифровое значение очередного символа в сообщении и ключе
        inp = text.charCodeAt(i);
        key = keyval.charCodeAt(i);
        // и применяем к ним исключающее или — XOR
        output += String.fromCharCode(inp ^ key);
    }
    return output;//возращаем закодированное/раскодированное сообщение
}

//LOCAL STORAGE

//Двойное нажатие на инпут ключа вызывает функцию сохранения ключа
keyinput.addEventListener('dblclick', localstorageaddkey);

//Сохранить ключ
function localstorageaddkey(key){
    let data = {
        receiver_id: sendid,
        key: document.getElementById('securekey').value
    }
    let recid = "recid" + sendid;
    localStorage.setItem(recid, JSON.stringify(data));
    return alert('Ключ сохранен в вашем браузере'), location.reload();
}
//Сохранить ключ(введенный из prompt)
function localstorageaddkeyStart(key){
    let data = {
        receiver_id: sendid,
        key: key
    }
    let recid = "recid" + sendid;
    localStorage.setItem(recid, JSON.stringify(data));
    return alert('Ключ сохранен в вашем браузере');
}

//Получить ключ
function getKeyfromLstorage(recid){
    recid = "recid" + recid;
    if ( localStorage.getItem(recid) ) {
        let savedata = JSON.parse(localStorage.getItem(recid));
        return savedata.key;
    } else {
        alert('В браузере не был сохранен ключ');
    }
}
//Проверить наличие ключа
function checkKeyInLstorage(recid){
    recid = "recid" + recid;
    if ( localStorage.getItem(recid) ) {
        return true;
    } else {
        return false;
    }
}
//Удалить ключ
function deletekey(){
    recid = "recid" + sendid;
    if ( localStorage.getItem(recid) ) {
        localStorage.removeItem(recid);
        location.reload();
    }

}

//ВЫЗОВЫ ФУНКЦИЙ
//Если ключ есть, то вписать его в поле ключа, и загрузить сообщения
if ( checkKeyInLstorage(sendid)){
    keyinput.value = getKeyfromLstorage(sendid);
    getmessages();//получить все сообщения при загрузки страницы
} else //Иначе, выполнить ввод ключа
{
    key = prompt("Ключ с этим пользователем не найден в вашем браузере. Введите новый ключ");
    localstorageaddkeyStart(key);
    keyinput.value = getKeyfromLstorage(sendid);
    getmessages();//получить все сообщения при загрузки страницы
}
//Запуск функции проверки новых сообщений
setTimeout(checkNew, 2 * 1000, 4);




