$(document).ready(function(){
    
    //checking if we`re logined
    $.ajax({
        type: "POST",
        url: "../phpScripts/accountAPI.php",
        data: { action: "is_loggined"},
        success: function(responce)
        {
            var receivedData = JSON.parse(responce);
            
            if(!receivedData.is_loggined)
            {
                location.replace('../index.html');
            }
        }
        
    });
    //checking if we`re have passport set
    $.ajax({
        type: "POST",
        url: "../phpScripts/accountAPI.php",
        data: { action: "passport_status"},
        success: function(responce)
        {
            var receivedData = JSON.parse(responce);
            var statusText = $("#statusText");
            
            if(receivedData.confirmed == true) //if passport is already set
            {
                statusText.html("Ваш аккаунт успішно верифіковано.<br> Ваш паспорт - "+receivedData.passId);
                $("#purchaseDiv").removeClass("hidden");
            }
            else if(receivedData.confirmed == false)
            {
                statusText.html("Ваші дані були введені невірно. Введіть їх будь ласка заново");
            }
            else if(receivedData.confirmed == null)
            {
                 statusText.html("Ваш запит все ще обробляється. Будь ласка, зачекайте");
            }
        }
        
    });
    
    //sending password request
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
            url: '../phpScripts/accountAPI.php',
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
            url: '../phpScripts/accountAPI.php',
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