login = $('#login'); 
login.on('blur', function() {
    if (login.next().attr('class') == 'err-msg') {
        login.next().remove();
    }
    iframe = document.createElement('iframe');
    document.body.append(iframe);
    
    $(iframe).attr('style','width:0;height:0').on('load', function() {
        if (login.val() != '') {
            iframe.contentWindow.location = '/try_register?login=' + login.val();
            console.log(iframe.contentWindow.document.body.innerHTML);
            let data = JSON.parse(iframe.contentWindow.document.body.innerHTML);
            if (data.occupied != false) {
                login.after(
                    $('<p>').attr('class', 'err-msg').text('Этот логин уже занят.')
                );
            }
        }
        $(iframe).remove();
    });
    
});