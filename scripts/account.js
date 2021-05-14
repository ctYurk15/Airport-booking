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
});