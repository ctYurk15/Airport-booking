<?php
    include 'phpScripts/dbconnect.php';
    include 'phpScripts/generalScripts.php';
    include 'phpScripts/DBgeneral.php';

    $dbgeneral = new DBgeneral($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/trystyle.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/main.css">
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
                            <li role="presentation"><a class="vlad" href="#">Купити квитки</a></li>
                            <li role="presentation"><a class="vlad" href="hotels.php">Орендувати готель</a></li>
                            <li role="presentation"><a class="vlad" href="private.html">Приватні рейси</a></li>
                            <li role="presentation"><a class="vlad" href="account.html">Аккаунт</a></li>
                        </ul>
                        <!--<p class="navbar-text navbar-right actions"><a class="navbar-link login" href="#">Log In</a> 
                        <a class="btn btn-default action-button" role="button" href="#">Sign Up</a></p>-->
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <h1>Табло вильоту і прильоту</h1>
    <form action="/" method="post" id='filterForm'>
        <div class="row">
            <div class="fromToDate">
                <label for="airport">ЗВІДКИ *</label><br>
                <select id='fromCity'>
                    <?php

                        $result = $dbgeneral->getAllCities();

                        for($i = 0; $i < count($result); $i++)
                        {
                            $cityName = $result[$i]['cityName'];
                            echo "<option value='{$cityName}'>{$cityName}</option>";
                        }

                    ?>
                    <option value='null' selected>Будь-де</option>
                </select>
            </div>

            <div class="fromToDate">
                <label for="from_to">КУДИ *</label><br>
                <select id='toCity'>
                    <?php

                        $result = $dbgeneral->getAllCities();

                        for($i = 0; $i < count($result); $i++)
                        {
                            $cityName = $result[$i]['cityName'];
                            echo "<option value='{$cityName}'>{$cityName}</option>";
                        }

                    ?>
                    <option value='null' selected>Будь-куди</option>
                </select>
            </div>

            <div class="fromToDate">
                <label for="airport">ДАТА ВИЛЬОТУ *</label><br>
                <select id='time'>
                    <option value="today">Цього дня</option>
                    <option value="tomorrow">Завтра</option>
                    <option value="week">Цього тижня</option>
                    <option value="month">Цього місяця</option>
                    <option value="null" selected>Будь-коли</option>
                </select>
            </div>
            
        </div>
        <input type='submit' class='button' value='Показати'>
    </form><br>

    <div class="depart">
        <div class="text-center">
            <i>ВИЛІТ</i>
        </div>
        <table class="dpt">
            <thead>
                <tr class="optr">
                    <th class="opth buyTicket">МАРШРУТ</th>
                    <th class="opth">РЕЙС №</th>
                    <th class="opth">ЧАС ЗА РОЗКЛАДОМ</th>
                    <th class="opth">ОЧІКУЄТЬСЯ</th>
                    <th class="opth">ФАКТИЧНИЙ ЧАС</th>
                    <th class="opth">КУПИТИ КВИТОК</th>
                </tr>
            </thead>
            <tbody id='availableFlights'>
                
            </tbody>
        </table>
        <h3 id='errorText'></h3>
    </div>

    <div class="arrival">
        <div class="text-center">
            <i>ПРИЛІТ</i>
        </div>
        <table class="arrt">
            <thead>
                <tr class="optr">
                    <th class="opth">МАРШРУТ</th>
                    <th class="opth">РЕЙС №</th>
                    <th class="opth">ЧАС ЗА РОЗКЛАДОМ</th>
                    <th class="opth">ОЧІКУЄТЬСЯ</th>
                    <th class="opth">ФАКТИЧНИЙ ЧАС</th>
                </tr>
            </thead>
            <tbody id='inAirFlights'>
                
            </tbody>
        </table>
    </div>
    
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

<script src="scripts/jquery.js"></script>
<script src="scripts/flights.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/df966d76e1.js"></script>

</html>