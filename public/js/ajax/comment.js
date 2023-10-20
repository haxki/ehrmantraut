post_id = parseInt(location.href.split("/")[4]);
author = $('#login').text();

function commentView(json) {
    $('#comments').append(
        $('<div>').attr('class', 'comment').append(
            $('<h3>').text(json.author),
            $('<p>').text(json.content),
            $('<p>').attr('class', 'blogpost-date').text(json.date)
        )        
    );
}

function decodeXml(xml) {
    xmldom = (new DOMParser()).parseFromString(xml, "text/xml");
    return { 
        'author': decodeURI(xmldom.getElementsByTagName('author')[0].childNodes[0].textContent),
        'content': decodeURI(xmldom.getElementsByTagName('content')[0].childNodes[0].textContent),
        'date': xmldom.getElementsByTagName('date')[0].childNodes[0].textContent
    };
}

function toggleCommentInput() {
    if ($('.post-form-button').length != 0) {
        closeCommentButton();
        openCommentInput();
    } else {
        closeCommentInput();
        openCommentButton();
    }
}

function openCommentInput() {
    $('#comments').after(
        $('<div>').attr('class', 'comment-input').append(
            $('<label>').attr('for', 'comment_input').text('Сообщение'),
            $('<br>'),
            $('<textarea>').attr('id', 'comment_input').attr('placeholder', 'Введите сообщение...'),
            $('<div>').attr('class', 'blogpost-buttons').append(
                $('<input>').attr('type', 'button').attr('id', 'comment_action').attr('value', 'Комментировать')
                    .on('click', commentSubmit),
                $('<input>').attr('type', 'button').attr('id', 'comment_cancel').attr('value', 'Отмена')
                    .on('click', toggleCommentInput)
            )
        )
    );
}

function commentSubmit() {
    if ($('#script').length > 0) {
        $('#script').remove();
    }
    var content = $('#comment_input').val();

    $('body').append(
        $('<script>').attr('id', 'script').attr('type', 'text/javascript')
            .attr('src', '/js/ajax/comment.php?post_id=' + post_id + '&author=' + encodeURI(author) + '&content=' + encodeURI(content))
    );
}


function closeCommentInput() {
    $('.comment-input').remove();
}

function openCommentButton() {
    $('.content').append(
        $('<div>').attr('class', 'post-form-button').attr('style', 'margin-top:10px').append(
            $('<input>').attr('type', 'button').attr('value', 'Написать комментарий')
                .on('click', toggleCommentInput)
            )
    );
}

function closeCommentButton() {
    $('.post-form-button').remove();
}

$('.post-form-button > input').on('click', toggleCommentInput);