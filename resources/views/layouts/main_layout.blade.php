<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/trystyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>Рейси</title>
</head>
<body>
    <header>
        <div class = "headir">
            <nav class="navbar navbar-default navigation-clean-button">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand" href="#">Domino</a>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li role="presentation"><a class="vlad" href="{{route('flights')}}">Купити квитки</a></li>
                            <li role="presentation"><a class="vlad" href="{{route('hotels')}}">Орендувати готель</a></li>
                            <li role="presentation"><a class="vlad" href="{{route('private')}}">Приватні рейси</a></li>
                            <li role="presentation"><a class="vlad" href="{{route('account')}}">Аккаунт</a></li>
                        </ul>
                        <!--<p class="navbar-text navbar-right actions"><a class="navbar-link login" href="#">Log In</a> 
                        <a class="btn btn-default action-button" role="button" href="#">Sign Up</a></p>-->
                    </div>
                </div>
            </nav>
        </div>
    </header>
    
    @yield('content')
    
    <footer id="footer">
        <div class="copy-bottom-txt text-center py-3">
          <p>© 2021 Domino. All Rights Reserved.</p>
        </div>
        <div class="social-icons mt-lg-3 mt-2 text-center">
          <ul>
            <li><a href="https://www.facebook.com"><span class="fa fa-facebook"></span></a></li>
            <li><a href="https://twitter.com/?lang=uk"><span class="fa fa-twitter"></span></a></li>
            <li><a href="https://uk.wikipedia.org/wiki/Wi-Fi"><span class="fa fa-rss"></span></a></li>
          </ul>
        </div>
  </footer>
</body>

<script src="{{asset('scripts/jquery.js')}}"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/df966d76e1.js"></script>

</html>