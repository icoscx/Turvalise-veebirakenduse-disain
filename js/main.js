$(document).ready(function(){
    if(!$.cookie("username")){
        //logout(); //testimiseks off
    }
    var setParameter = 'listItems';
    $.ajax({
        url: 'cgi-bin/getPosts.cgi',
        type: 'get',
        data: setParameter,
        cache: false,
        success: function(response){
            console.log(response);

           // var obj = jQuery.parseJSON(response);
           // $.each(obj, function(){
              //  $( "#append_here" ).append( '<tr><td><a href="#" class="button button-tiny" onclick="openView('+ this.complaint_id +')">'+ this.complaint_id +'</a></td><td>'+ this.date +'</td><td>'+ this.type +'</td></tr>' );
            //});
        }
    });

});

function logout(){
    var cookies = $.cookie();
    for(var cookie in cookies) {
       $.removeCookie(cookie);
    }
    $.ajax({
        url: 'cgi-bin/getPosts.cgi',
        type: 'get',
        data: 'logout',
        cache: false,
        success: function(response){
            response = $.trim(response);
            console.log(response);
            if(($.trim(response)) == 0){
                location.href='index.html';
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
    });
    //location.href='index.html'; //testimiseks off
    return false;
}

function popAddPost(){
    document.getElementById("popAddPost").style.display = 'none';
    $('#popAddPost').bPopup({
        contentContainer:'.content',
        position: [500, 50]
    });
    return false;
}

function openView(nr){

    $.ajax({
        url: 'cgi-bin/getComplaints.cgi',
        type: 'get',
        data: 'listitem='+nr+'',
        success: function(response){
            console.log(response);
            var obj = jQuery.parseJSON(response);
            $.each(obj, function(){
                $('#set_fname').val(this.complainer_fname);
                $('#set_lname').val(this.complainer_lname);
                $('#set_date').val(this.time);
                $('#set_type').val(this.type);
                $('#set_description').val(this.description);
                $('#set_address').val(this.complainer_address);
                $('#viewComplaint').bPopup({
                    contentContainer:'.content',
                    position: [500, 50]
                });
            });
        }
    });
}

$('#sendForm').on('submit',function(e) {
    e.preventDefault();

    //setup input filters
    var sdescription = /^[\ *a-zA-Z0-9+\ ]{3,32}$/;
    var description = /^[\s*a-zA-Z0-9,\s\-\?\!\.+\s]{3,1024}$/;
    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};

    that.find('[name]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
            if($.trim(value).length > 0){//WhiteSpace trim [beg, end] and empty Input check
                data[name] = value.replace( /[\s\n\r\t]+/g, ' ' );//remove unneccesary WSP
            }else{
                console.log('Input empty');
                return false;
            }
    });

    if(!data['sdescription'].match(sdescription)){
        alert('Invalid short desc [a-z, A-Z, 0-9 and spaces] 3-32');
        return false;
    }else if(!data['description'].match(description)){
        alert('Invalid description: [a-z, A-Z, 0-9 ,spaces, !?,.] 3-1024');
        return false;
    }

    var refined = JSON.stringify(data);
    //console.log(refined);
    $.ajax({
        url: url,
        type: type,
        data: refined,
        cache: false,
        contentType: "application/json; charset=utf-8",
        success: function(response){
            response = $.trim(response);
            //console.log(response);
            if(response != 1){
                alert('Error Posting info, try re-logging.');
            }else{
                location.href='main.html';
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
    });
    return false;
});