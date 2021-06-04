$(document).ready(function(){
    //login
    $("#loginForm").submit(function(event){
        event.preventDefault();
        
        var email = $("#emailInp").val();
        var pass = $("#passInp").val();
        
        $("#errorText").load("../phpScripts/loginScript.php", {
            email: email,
            pass: pass
        });
    });
    
    //if user aleady is logined
    $("#errorText").load("../phpScripts/checkCookie.php", {setUrl: "Flights.html"});
});