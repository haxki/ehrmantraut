var initial_blogpost;

function redactStart() {
    initial_blogpost = document.getElementById('blogpost').innerHTML;
    
    let title = document.getElementById('title').parentElement;
    let content = document.getElementById('content');
    
    $('#title').parent().remove();
    $('#content').remove();
    $('.blogpost-buttons').remove();
    
    $('#blogpost').append(
        $('<label>').attr('for', 'title').text('Заголовок:'), $('<br>'),
        $('<input>').attr('type', 'text').attr('id', 'title').attr('name', 'title').attr('value', title.children[0].textContent), $('<br>'),
        
        $('<label>').attr('for', 'content').text('Содержание:'), $('<br>'),
        $('<textarea>').attr('id', 'content').attr('name', 'content').text(content.innerHTML.replace("<br>", "\r\n")), $('<br>'),
        
        $('<label>').attr('for', 'image').text('Новое изображение (опционально):'), $('<br>'),
        $('<input>').attr('id', 'image').attr('name', 'image').attr('type', 'file'), $('<br>'),
        
        $('<input>').attr('type', 'checkbox').attr('id', 'delete_image').attr('name', 'delete_image'),
        $('<label>').attr('for', 'delete_image').text('Удалить изображение'),
        
        $('<div>').attr('class', 'blogpost-buttons').append(
            $('<input>').attr('type', 'button').attr('value', 'Сохранить').on('click', redactFinish),
            $('<input>').attr('type', 'button').attr('value', 'Отмена').on('click', redactCancel)
        )
    );
}
        
function redactFinish() {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.open('POST', document.location.href, true);
    xmlHttp.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    xmlHttp.responseType = "document";

    xmlHttp.onreadystatechange = () => {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            let response = xmlHttp.responseXML;
            document.getElementById('blogpost').replaceWith(response.getElementById('blogpost'));
        }
    };
    let formData = new FormData();
    formData.append('title', document.getElementById('title').value);
    formData.append('content', document.getElementById('content').value);
    if (document.getElementById('image').files[0]){
        formData.append('image', document.getElementById('image').files[0]);
    }
    if (document.getElementById('delete_image').checked) {
        formData.append('delete_image', true);
    }

    xmlHttp.send(formData);
}

function redactCancel() {
    document.getElementById('blogpost').innerHTML = initial_blogpost;
}