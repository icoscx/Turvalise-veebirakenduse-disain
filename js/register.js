
$('form.register-form').on('submit',function() {
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
    var refined = JSON.stringify(data);
    console.log(refined);
    $.ajax({
        url: url,
        type: type,
        data: refined,
        success: function(response){
            console.log(response);
            if(response==0){
                console.log("error registering, username exists");
                $( ".content" ).append( '<div class='+"loginerror"+'>Username already exists</div>' );

            }else{
                location.href='index.html';
            }
        }
    });

    return false;
});