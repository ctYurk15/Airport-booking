$(document).ready(function(){
    $("#errorText").load("../phpScripts/checkCookie.php", {unsetUrl: "index.html"});
    
    $("#filtersForm").submit(function(event){
        event.preventDefault();
        
        var hotel = $("#hotel").val();
        var room_class = $("#class").val();
        
        $("#rooms").load("../phpScripts/showHotelRooms.php", {
            hotel: hotel,
            class: room_class
        }, bindButtons);
        
    });
    
    $("#rooms").load("../phpScripts/showHotelRooms.php", bindButtons);
    
    function bindButtons()
    {
        //reserving room
        $(".reserveRoom").on("click", function(){
            var idRoom = $(this).attr('data-idRoom');
            $("#errorText").load("../phpScripts/reserveRoomScript.php", {idRoom: idRoom});
        });
    }
})