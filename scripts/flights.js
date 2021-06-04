$(document).ready(function(){
    //is user aleady is logined
    $("#errorText").load("../phpScripts/checkCookie.php", {unsetUrl: "index.html"});
    updateTables();
    
    //filters
    $("#filterForm").submit(function(event){
        event.preventDefault();
        
        updateTables();
    });
    
    function updateTables()
    {   
        var from = $("#fromCity").val();
        var to = $("#toCity").val();
        var time = $("#time").val();
        
        if(from != undefined || to != undefined)
        {
            //updating info
            $("#availableFlights").load('../phpScripts/showFlights.php', {
                from: from,
                to: to,
                time: time,
                available: 1
            }, function(){
                $("#inAirFlights").load('../phpScripts/showFlights.php', {
                    from: from,
                    to: to,
                    time: time,
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
    
    //get info for filters
    $.ajax({
        url: "../phpScripts/flightsAPI.php",
        type: "POST",
        data: {
            action: "get_cities"
        },
        success: function(data){
            var receivedData = JSON.parse(data);
            //console.log(receivedData);
            
            //objects we`ll be working with
            var fromCitySelect = $("#fromCity");
            var toCitySelect = $("#toCity");
            
            //appending selects with cities we got from server
            receivedData.forEach(function(city){
                fromCitySelect.append("<option value='"+city.cityName+"'>"+city.cityName+"</option>");
                toCitySelect.append("<option value='"+city.cityName+"'>"+city.cityName+"</option>");
            });
        },
        error: function(data){
            console.log(data);
        }
    });
    
});