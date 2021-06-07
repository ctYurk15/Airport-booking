$(document).ready(function(){

    $("#loginForm").on("submit", function(event){

        //avoiding page reload
        event.preventDefault();
        
        //getting user data
        var email = $("#emailInp").val();
        var pass = $("#passInp").val();
        var url = $("#submitButton").attr("data-route");

        $.ajax({
            url: url,
            type: "POST",
            data: {
                email: email,
                pass: pass
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                var errorText = $("#errorText");
                errorText.text("");

                //if email was not correct
                if(!data.correct_email)
                {
                    $("#emailInp").addClass("wrongInput");
                    errorText.append("Ваша пошта невірна");
                }

                //if pass was not correct
                if(data.correct_email && !data.correct_pass)
                {
                    $("#passInp").addClass("wrongInput");
                    errorText.append("Ваш пароль невірний");
                }
                
                //if authorization were correct
                if(data.correct_email && data.correct_pass)
                {
                    location.replace($("#submitButton").attr("data-route2"));
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

});