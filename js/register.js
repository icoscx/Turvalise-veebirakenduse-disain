//Pure
$('form.register-form').on('submit',function(e) {
    e.preventDefault();

    //setup input filters
    var name_regex = /^[a-zA-Z0-9]{3,20}$/;
    var email_regex = /^[\w\-\.\+]{3,32}\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};

    that.find('[name]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
            if($.trim(value).length > 0){//WhiteSpace trim and empty Input check
                data[name] = value;
            }else{
                console.log('Input empty');
                return false;
            }
    });

    if(!data['username'].match(name_regex) || !data['password'].match(name_regex)){
        alert('Invalid username/password [a-z, A-Z, 0-9] 3-20');
        return false;
    }else if(!data['email'].match(email_regex)){
        alert('Invalid e-mail');
        return false;
    }

    var refined = JSON.stringify(data);
    //console.log(refined);
    console.log('Sending to server..');
    $.ajax({
        url: url,
        type: type,
        data: refined,
        cache: false,
        contentType: "application/json; charset=utf-8",
        success: function(response){
            response = $.trim(response);
            console.log(response);
            if(response != 1){
                alert('username already exists');
            }else{
                location.href='index.html';
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
    });
    return false;
});