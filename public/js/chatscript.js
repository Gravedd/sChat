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
    let toserver = {//что отправляем на сервер
        sendid: sendid//кому отправляем
    };
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
    });//запрос в БД
    let content = await response.json();//получаем ответ в JSON-формате
        let key;
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
    let toserver = {//что отправляем на сервер
        lastid: lastmessid,//айди посл.сообщения
        sendid: sendid//кому отправляем
    };
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


    //если ошибка, то вывести ошибку в консоль и заново запустить функцию
    if (response.status != 200) {
        console.log(response.statusText);
        await checkNew();
    }
    let content = await response.json();//получаем ответ в JSON-формате

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



//отправка сообщения на сервер
let tempid = 0;
sendButton.addEventListener('click', sendMessage);
messinput.addEventListener('keyup', function (event){
    let keyboardCode = event.key;
    if (keyboardCode === "Enter"){
        sendMessage();
    }
});

function getInputtext() {
    return messinput.value;
}
async function sendMessage() {
    if ( getInputtext() != '' && getInputtext() != ' ' ) {
        tempid += 1;
        let mess = {
            message: messageencoding(getInputtext()),
            sendid: sendid
        };

        mesblock.innerHTML += '<div class="usermess sent anim" id="' + tempid + '">' + getInputtext() + '</div>';
        block.scrollTop = block.scrollHeight;//проматываем этот блок в конец
        messinput.value = '';//очищаем инпут

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

        //если ответ = true, то сообщение успешно отпр-но, иначе ошибка
        if (content['response'] == true) {
            console.log('Сообщение успешно отправлено')
            document.getElementById(tempid).classList.remove("anim");
        } else {
            alert('ошибка при отправке: ' + (content['response']));
            document.getElementById(tempid).classList.add("error");
        }
    }


}

//Кодирование/раскодирование сообщения
function messageencoding(text) {
    let inp;
    let key;
    let output = "";
    let keyval = document.getElementById('securekey').value;
    for (i = 0; i < text.length; i++){
        // берём цифровое значение очередного символа в сообщении и ключе
        inp = text.charCodeAt(i);
        key = keyval.charCodeAt(i);
        // и применяем к ним исключающее или — XOR
        output += String.fromCharCode(inp ^ key);
    }
    return output;
}

//Сохраняет ключ в LocalStorage
function localstorageaddkey(key){
    let data = {
        receiver_id: sendid,
        key: document.getElementById('securekey').value
    }
    let recid = "recid" + sendid;
    localStorage.setItem(recid, JSON.stringify(data));
    return alert('Ключ сохранен в вашем браузере'), location.reload();
}
function localstorageaddkeyStart(key){
    let data = {
        receiver_id: sendid,
        key: key
    }
    let recid = "recid" + sendid;
    localStorage.setItem(recid, JSON.stringify(data));
    return alert('Ключ сохранен в вашем браузере');
}


keyinput.addEventListener('dblclick', localstorageaddkey);

function getKeyfromLstorage(recid){
    recid = "recid" + recid;
    if ( localStorage.getItem(recid) ) {
        let savedata = JSON.parse(localStorage.getItem(recid));
        return savedata.key;
    } else {
        alert('В браузере не был сохранен ключ');
    }
}
function checkKeyInLstorage(recid){
    recid = "recid" + recid;
    if ( localStorage.getItem(recid) ) {
        return true;
    } else {
        return false;
    }
}
function deletekey(){
    recid = "recid" + sendid;
    if ( localStorage.getItem(recid) ) {
        localStorage.removeItem(recid);
        location.reload();
    }

}


//ВЫЗОВЫ ФУНКЦИЙ
if ( checkKeyInLstorage(sendid)){
    keyinput.value = getKeyfromLstorage(sendid);
    getmessages();//получить все сообщения при загрузки страницы
} else {
    key = prompt("Ключ с этим пользователем не найден в вашем браузере. Введите новый ключ");
    localstorageaddkeyStart(key);
    keyinput.value = getKeyfromLstorage(sendid);
    getmessages();//получить все сообщения при загрузки страницы
}
setTimeout(checkNew, 2 * 1000, 4);




