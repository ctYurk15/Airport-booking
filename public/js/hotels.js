$(document).ready(function(){
    
    //updating filter after reloading page
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);

    var hotel = urlParams.get("hotel");
    var room_class = urlParams.get("room_class");

    if(hotel != null)
    {
        $("#hotel").children("[value='"+hotel+"']").prop("selected", true);
    }
    if(room_class != null)
    {
        $("#class").children("[value='"+room_class+"']").prop("selected", true);
    }

    $("#filtersForm").submit(function(event){

        event.preventDefault();

        //getting user selected options in filter
        var hotel = $("#hotel").val();
        var room_class = $("#class").val();
        var url = $("#submitButton").attr("data-route");

        $.ajax({
            url: url,
            type: "GET",
            data: {
                hotel: hotel,
                room_class: room_class
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                $(".depart").html(data);

                //updating url
                let positionParameters = location.pathname.indexOf('?');
                let url = location.pathname.substring(positionParameters, location.pathname.length);
                let newUrl = url + '?';

                if(hotel != 'any')
                {
                    newUrl += "&hotel="+hotel;
                }
                if(room_class != 'any')
                {
                    newUrl += "&room_class="+room_class;
                }

                //forming url & pushing it
                history.pushState({}, '', newUrl);
            },
            error: function(data){
                console.log(data);
            }
        });
    });

});