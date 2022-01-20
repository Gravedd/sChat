let token = document.getElementById('csrf-token');
let inputname = document.getElementById('name');

inputname.addEventListener('blur', checkNameinDB);

async function checkNameinDB() {
    let name = inputname.value;
    if ( name.length <= 5) {
        inputname.classList.add('is-invalid');
        alert('Ваше никнейм меньше 6 символов');
    } else {

        let toserver = {
            name: name
        }
        let response = await fetch('/checkname', {
            method: 'POST',
            credentials: "same-origin",
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": token.value,
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(toserver)
        });
        let content = await response.json();

        if (content.exist){
            inputname.classList.remove('ok');
            inputname.classList.add('is-invalid');
            alert('Пользователь с таким никнеймом уже существует')
            inputname.focus();
        } else {
            inputname.classList.remove('is-invalid');
            inputname.classList.add('ok');
        }


    }
}
