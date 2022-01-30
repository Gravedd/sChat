let token = document.getElementById('csrf-token');
let deletebuttons = document.querySelectorAll('#deleteuserbutton');
console.log(deletebuttons)
if ( deletebuttons != null) {
    for (deletebutton of deletebuttons) {
        deletebutton.addEventListener('click', deleteuser);
    }
}

async function deleteuser() {
    //что отправляем на сервер
    let toserver = {
        userid: deletebutton.title
    };
    console.log(toserver);
    //Запрос на сервер
    let response = await fetch('/dialogues/delete', {
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
    if ( content == 1) {
        deleteinhtml(deletebutton.title);
        alert('пользователь удален из вашего списка');
    } else {
        console.log(content);
        alert('ошибка');
    }
}
function deleteinhtml(uid){
    let elemid = 'user' + uid;
    let userblock = document.getElementById(elemid);
    userblock.remove();
    return true;
}
