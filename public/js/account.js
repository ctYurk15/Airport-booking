$(document).ready(function(){
    
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
});