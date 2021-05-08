$(document).ready(function(){
    $("#regForm").submit(function(event){
        event.preventDefault();
        
        var firstname = $("#firstnameInp").val();
        var lastname = $("#lastnameInp").val();
        var email = $("#emailInp").val();
        var pass = $("#passInp").val();
        
        $("#errorText").load("../phpScripts/registrationScript.php", {
            firstname: firstname,
            lastname: lastname,
            email: email,
            pass: pass
        });
        
    });
    
    $("#loginForm").submit(function(event){
        event.preventDefault();
        
        var email = $("#emailInpL").val();
        var pass = $("#passInpL").val();
        
        $("#errorTextL").load("../phpScripts/loginScript.php", {
            email: email,
            pass: pass
        });
    });

});