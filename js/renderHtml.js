$(document).ready(function(){
    //Setting up Visual stuff
    $(".ui_actions").append( "Username: " + $.cookie("username") +"  ");
    $(".ui_actions").append('<a class="'+'button glow button-primary'+'"' + 'onclick="'+ 'logout()' + '"' + 'href="' +'#' + '">LogOut</a>');
    document.getElementById("popAddPost").style.display = 'none';
    document.getElementById("viewPost").style.display = 'none';

});