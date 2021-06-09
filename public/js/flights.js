$(document).ready(function(){
    
    //updating filter after reloading page
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);

    var fromCity = urlParams.get("fromCity");
    var toCity = urlParams.get("toCity");
    var time = urlParams.get("time");

    if(time != null)
    {
        $("#time").children("[value='"+time+"']").prop("selected", true);
    }
    
    if(fromCity != null)
    {
        $("#fromCity").children("[value='"+fromCity+"']").prop("selected", true);
    }

    if(toCity != null)
    {
        $("#toCity").children("[value='"+toCity+"']").prop("selected", true);
    }

    $("#filterForm").submit(function(event){

        event.preventDefault();
        
        var fromCity = $("#fromCity").val();
        var toCity = $("#toCity").val();
        var time = $("#time").val();
        var url = $("#submitButton").attr("data-route");

        $.ajax({
            url: url,
            type: "GET",
            data: {
                fromCity: fromCity,
                toCity: toCity,
                time: time
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                //refreshing flights display
                $("#flightsTable").html(data);

                //updating url
                let positionParameters = location.pathname.indexOf('?');
                let url = location.pathname.substring(positionParameters, location.pathname.length);
                let newUrl = url + '?';

                if(fromCity != 'any')
                {
                    newUrl += "&fromCity="+fromCity;
                }
                if(toCity != 'any')
                {
                    newUrl += "&toCity="+toCity;
                }
                if(time != 'any')
                {
                    newUrl += "&time="+time;
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