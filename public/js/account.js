$(document).ready(function(){
    
    //unlogginig from your account
    $("#unloginLink").on("click", function(event){

        event.preventDefault();
        var url = $(this).attr("data-route");
        var url2 = $(this).attr("data-route2");
        
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data)
                {
                    location.replace(url2);
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });

    //sending passport request
    $("#passIdForm").submit(function(event){
        event.preventDefault();

        //collecting data of user
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var sex = $("#sex").val();
        var passId = $("#passId").val();
        var birthDate = $("#birthDate").val();
        var interPassId = $("#interPassId").val();
        var url = $("#submitButton").attr("data-route");
        var name = firstname + " " + lastname;

        //console.log(firstname + " " + lastname + " " + sex + " " + passId + " " + birthDate + " " + interPassId);
        //console.log(url);
        $.ajax({
            url: url,
            type: "POST",
            data: {
                Name: name,
                Sex: sex,
                PassID: passId, 
                BirthDate: birthDate, 
                InterPass: interPassId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                //if insert was correct
                if(data)
                {
                    location.reload();
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });
});