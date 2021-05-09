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
});