$(document).ready(function(){

    $("#regForm").on("submit", function(event){

        event.preventDefault();
        
        //collecting data, that user loggined
        var firstname = $("#firstnameInp").val();
        var lastname = $("#lastnameInp").val();
        var email = $("#emailInp").val();
        var pass = $("#passInp").val();
        var url = $("#submitButton").attr("data-route");

        $.ajax({
            url: url,
            type: "POST",
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                pass: pass
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                console.log(data);

                var errorText = $("#errorText");

                //clearing previous errors
                errorText.text("");
                $("#firstnameInp").removeClass("wrongInput");
                $("#lastnameInp").removeClass("wrongInput");
                $("#emailInp").removeClass("wrongInput");
                $("#passInp").removeClass("wrongInput");

                //showing errors
                if(!data.correct_name)
                {
                    $("#firstnameInp").addClass("wrongInput");
                    $("#lastnameInp").addClass("wrongInput");
                    errorText.append("Ваше ім'я уже зайнято <br>")
                }
                if(!data.correct_email)
                {
                    $("#emailInp").addClass("wrongInput");
                    errorText.append("Ваша пошта уже зайнята <br>")
                }
                if(!data.correct_pass)
                {
                    $("#passInp").addClass("wrongInput");
                    errorText.append("Ваш пароль бути довшим за 7 символів <br>")
                }

                //new user is registred
                if(data.correct_name && data.correct_email && data.correct_pass)
                {
                    location.replace($("#submitButton").attr("data-route2"));
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });

});