<html>
<head>
    <title>Domino - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/reglog.css')}}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @yield('content');
</body>

<script src="{{asset('js/jquery.js')}}"></script>
<script>
    $(document).ready(function(){

        //checking if user is loggined or not
        $.ajax({
            url: "{{route('loginStatus')}}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data)
                {
                    location.replace("{{route('flights')}}");
                }
            },
            error: function(data){
                console.log(data);
            }
        });

    });
</script>
@yield('custom_js')
</html>