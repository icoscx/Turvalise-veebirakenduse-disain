$('form.login-form').on('submit',function() {
        var that = $(this),
            url = that.attr('action'),
            type = that.attr('method'),
            data = {};

    that.find('[name]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        data[name] = value;
    });
    console.log('Parsed json:');
    //console.log(data.username);
    var refined = JSON.stringify(data);
    console.log(refined);
    $.ajax({
        url: url,
        type: type,
        data: refined,
        success: function(response){
            console.log(response);
            if(response==200){
                console.log("SettingUpCookies:");
                $.cookie("username", data.username);
                console.debug($.cookie("username"));
                location.href='main.html';
            }else{
                console.log("error logging in");
                $( ".content" ).append( '<div class=' + "loginerror" + '>Vale kasutaja/parool</div>');
            }
        }
    });

    return false;
});