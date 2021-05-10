$(document).ready(function(){
    //is user aleady is logined
    $("#errorText").load("../phpScripts/checkCookie.php", {unsetUrl: "index.html"});
    updateTables();
    
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
    
    //filters
    $("#filterForm").submit(function(event){
        event.preventDefault();
        
        updateTables();
    });
    
    function updateTables()
    {   
        var from = $("#fromCity").val();
        var to = $("#toCity").val();
        
        if(from != undefined || to != undefined)
        {
            //updating info
            $("#availableFlights").load('../phpScripts/showFlights.php', {
                from: from,
                to: to,
                available: 1
            }, function(){
                $("#inAirFlights").load('../phpScripts/showFlights.php', {
                    from: from,
                    to: to,
                    available: 0
                }, function(){
                    //binding buttons
                    $(".buyTicket").on("click", function(){
                        $("#errorText").load('../phpScripts/buyTicket.php', {reisID: $(this).attr("data-reisID")})
                    });
                });
            });
        }
    }
    
    
    
    
});