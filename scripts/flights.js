$(document).ready(function(){
    //is user aleady is logined
    $("#errorText").load("../phpScripts/checkCookie.php", {unsetUrl: "index.html"});
    
    //filling select tags
    //$('#select').append($('<option>', {value:1, text:'One'}));
    /*$.ajax({
        url: "../phpScripts/flightsScript.php",
        type: 'POST',       // You are sending classic $_POST vars.
        data: null,
        dataType: 'JSON',  // You are receiving JSON as the response
        success: function(result) {
            console.log(result);
        }
    });*/
    
    $("#filterForm").submit(function(event){
        event.preventDefault();
        
        var from = $("#fromCity").val();
        var to = $("#toCity").val();
        
        if(from != undefined || to != undefined)
        {
            $("#availableFlights").load('../phpScripts/showFlights.php', {
                from: from,
                to: to
            });
        }
    });
});