$(document).ready(function(){
    //registration
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
    
    //if user aleady is logined
    $("#errorText").load("../phpScripts/checkCookie.php?", {setUrl: "Flights.html"});
});