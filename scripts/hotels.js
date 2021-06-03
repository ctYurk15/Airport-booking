$(document).ready(function(){
    
    $("#errorText").load("../phpScripts/checkCookie.php", {unsetUrl: "index.html"});
    
    //filtering rooms
    $("#filtersForm").submit(function(event){
        event.preventDefault();
        
        var hotel = $("#hotel").val();
        var room_class = $("#class").val();
        
        $("#rooms").load("../phpScripts/showHotelRooms.php", {
            hotel: hotel,
            class: room_class
        }, bindButtons);
        
    });
    
    //filtering by default
    $("#rooms").load("../phpScripts/showHotelRooms.php", bindButtons);
    
    function bindButtons()
    {
        //reserving room
        $(".reserveRoom").on("click", function(){
            var idRoom = $(this).attr('data-idRoom');
            $("#errorText").load("../phpScripts/reserveRoomScript.php", {idRoom: idRoom});
        });
    }
    
    //getting info about all hotels
    $.ajax({
        url: "../phpScripts/flightsAPI.php",
        type: "POST",
        data: {
            action: 'hotels_info'
        },
        success: function(data){
            var receivedData = JSON.parse(data);
            //console.log(receivedData);
            
            var hotelOption = $("#hotel");
            
            //filling select with appropriative options
            for(var i = 0; i < receivedData.length; i++)
            {
                hotelOption.append("<option value='"+receivedData[i].hotelName+"'>"+receivedData[i].hotelName+" - "+receivedData[i].cityName+"</option>");
            }
        },
        error: function(data){
            //console.log(data);
        }
    });
    
    //getting info about all roomtypes
    $.ajax({
        url: "../phpScripts/flightsAPI.php",
        type: "POST",
        data: {
            action: "roomtypes_info"
        },
        success: function(data){
            var receivedData = JSON.parse(data);
            console.log(receivedData);
            
            var classOption = $("#class");
            
            //filling select with appropriative options
            for(var i = 0; i < receivedData.length; i++)
            {
                var current_roomtype = receivedData[i].roomtypeName;
                classOption.append("<option value='"+current_roomtype+"'>"+current_roomtype+"</option>");
            }
        },
        error: function(data){
            console.log(data);
        }
    });
    
})