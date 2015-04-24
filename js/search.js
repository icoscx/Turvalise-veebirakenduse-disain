/**
 * Created by Administrator on 5.05.14.
 */
/*
$(document).ready(function(){
    var param = location.search.split('s=')[1] ? location.search.split('s=')[1] : '';
    var rdyparam = 'list=' + param;
    console.log(rdyparam);
    $.ajax({
        url: 'cgi-bin/getComplaints.cgi',
        type: 'get',
        data: rdyparam,
        success: function(response){
            console.log(response);
            var obj = jQuery.parseJSON(response);
            //console.log(obj[0].complaint_id);
            var nr = 1;
            $.each(obj, function(){
                $( "#append_here" ).append( '<tr><td><a href="#" class="button button-tiny" onclick="openView('+ this.complaint_id +')">'+ this.complaint_id +'</a></td><td>'+ this.date +'</td><td>'+ this.type +'</td></tr>' );
            });
        }
    });

});
*/
$('form.searchform').on('submit',function() {
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
    console.log(data.searchfor);
    var rdyparam = 'search=' + data.searchfor;
    console.log(rdyparam);
    $.ajax({
        url: 'cgi-bin/getComplaints.cgi',
        type: 'get',
        data: rdyparam,
        success: function(response){
            console.log(response);
            var obj = jQuery.parseJSON(response);
            //console.log(obj[0].complaint_id);
            var nr = 1;
            $.each(obj, function(){
                $( "#append_here" ).append( '<tr><td><a href="#" class="button button-tiny" onclick="openView('+ this.complaint_id +')">'+ this.complaint_id +'</a></td><td>'+ this.date +'</td><td>'+ this.type +'</td></tr>' );
            });
        }
    });

    /*
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
    */

    return false;
});

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
                $('#view').bPopup({
                    contentContainer:'.content',
                    position: [500, 50]
                });
            });
        }
    });
}


function deletecookie(){
    //alert('delete');
    $.removeCookie("username");
    location.href='index.html';
}

function pop(){
    //alert(1);
    document.getElementById("pop").style.display = 'none';
    $('#pop').bPopup({
        contentContainer:'.content',
        position: [500, 50]
    });

}

$('form.appnitro').on('submit',function() {
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
                console.log("Input or backend error");
                //$( ".content" ).append( "<div>Username already exists</div>" );
                alert('Something went wrong!');
            }else{
                location.href='main.html';
            }
        }
    });

    return false;
});