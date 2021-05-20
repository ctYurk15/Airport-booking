$(document).ready(function(){
    $("#passIdForm").submit(function(event){
        event.preventDefault();
        
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var sex = $("#sex").val();
        var passId = $("#passId").val();
        var dateOfBirth = $("#birthDate").val();
        var interPassId = $("#interPassId").val();

        $("#errorText").load("../phpScripts/passVerificationRequest.php", {
            firstname: firstname,
            lastname: lastname,
            sex: sex,
            passId: passId,
            dateOfBirth: dateOfBirth,
            interPassId: interPassId
        });
    });
    
    //purchase info
    $.ajax({ //tickets
            type: "POST",
            url: '../phpScripts/accountScripts.php',
            data: {action: "get_tickets"},
            success: function(response)
            {
                //getting all info needed
                var receivedData = JSON.parse(response);
                
                //table we would be working with
                var table = $("#ticketsTable");
                
                receivedData.tickets.forEach(function(item){
                    var reisID = "PS10"+item.Reis_id1;
                    var place = item.PlaceNumber;
                    
                    //filling table with rows
                    table.append("<tr> <td>"+reisID+"</td> <td>"+place+"</td> </tr>");
                });
                

            }
    });
    
    $.ajax({ //rooms
            type: "POST",
            url: '../phpScripts/accountScripts.php',
            data: {action: "hotel_rooms"},
            success: function(response)
            {
                //getting all info needed
                var receivedData = JSON.parse(response);
                
                //table we would be working with
                var table = $("#hotelRoomsTable");
                
                receivedData.rooms.forEach(function(item){
                    var roomtype = item.roomtypeName;
                    var hotel = item.hotelName;
                    
                    table.append("<tr> <td>"+hotel+"</td> <td>"+roomtype+"</td> </tr>");
                });
                
            }
    });
    
    
});