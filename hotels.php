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
    <title>Орендувати готельний номер</title>
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
                            <li role="presentation"><a class="vlad" href="Flights.php">Купити квитки</a></li>
                            <li role="presentation"><a class="vlad" href="#">Орендувати готель</a></li>
                            <li role="presentation"><a class="vlad" href="#">Приватні рейси</a></li>
                            <li role="presentation"><a class="vlad" href="account.php">Аккаунт</a></li>
                        </ul>
                        <!--<p class="navbar-text navbar-right actions"><a class="navbar-link login" href="#">Log In</a> 
                        <a class="btn btn-default action-button" role="button" href="#">Sign Up</a></p>-->
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <h1>Готелі</h1>
    
    <div class="row">
        <form action="/" method="post" id='filtersForm'>
            <div class="fromToDate">
                <label for="from_to">ГОТЕЛЬ *</label><br>
                <select id='hotel'>
                    <?php

                        $result = $dbgeneral->getAllHotels();

                        for($i = 0; $i < count($result); $i++)
                        {
                            $cityName = $result[$i]['cityName'];
                            $hotelName = $result[$i]['hotelName'];
                            echo "<option value='{$hotelName}'>{$hotelName} - {$cityName}</option>";
                        }

                    ?>
                </select>
            </div>

            <div class="fromToDate">
                <label for="airport">КЛАС КІМНАТИ *</label><br>
                <select id='class'>
                    <?php

                        $result = $dbgeneral->getRoomTypes();

                        for($i = 0; $i < count($result); $i++)
                        {
                            $roomtypeName = $result[$i]['roomtypeName'];
                            echo "<option value='{$roomtypeName}'>{$roomtypeName}</option>";
                        }

                    ?>
                </select>
            </div>
            <div class="show_button">
                <input type='submit' class='button' value='Показати'>
            </div>
        </form>
    </div>

    <div class="depart">
        <table class="dpt">
            <thead>
                <tr class="optr">
                    <th class="opth">МІСТО</th>
                    <th class="opth">ГОТЕЛЬ</th>
                    <th class="opth">КЛАС</th>
                    <th class="opth">КІМНАТ</th>
                    <th class="opth">МІСТКІСТЬ</th>
                    <th class="opth"></th>
                </tr>
            </thead>
            <tbody id='rooms'>
                
            </tbody>
        </table>
    </div>
    
    <h3 id='errorText'></h3>
    
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
<script src="scripts/hotels.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/df966d76e1.js"></script>

</html>