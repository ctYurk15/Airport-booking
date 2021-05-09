$(document).ready(function(){
    $("#loginForm").submit(function(event){
        event.preventDefault();
        
        var email = $("#emailInp").val();
        var pass = $("#passInp").val();
        
        $("#errorText").load("../phpScripts/loginScript.php", {
            email: email,
            pass: pass
        });
    });
});