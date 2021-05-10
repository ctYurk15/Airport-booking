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
    <link rel="stylesheet" href="css/trystyle.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Рейси</title>
</head>
<body>
    <header>
        <div>
            <nav>
                <div>
                <ul class="nav-links">
                    <li>
                        <img src="images/Mylogo(3).png"  width="100px" height="25px" alt="FlyCompany">
                    </li>
                    <li>
                        <a href="#"> Домашня сторінка </a>
                    </li>
                    <li>
                       <a href="#"> Бронювання </a>
                    </li>
                    <li>
                        <a href="#"> Приватні літаки </a>
                       </li>
                    <li>
                        <a href="account.php"> Аккаунт </a>
                    </li>                          
                </ul>
                </div>
            </nav>
        </div>
    </header>
    <hr>
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
                    <option value="today" data-uniqid="selectbox2-0">Будь-коли</option>
                    <option value="tomorrow" data-uniqid="selectbox2-1">Завтра</option>
                    <option value="11.05.21" data-uniqid="selectbox2-2">11.05.21</option>
                    <option value="12.05.21" data-uniqid="selectbox2-3">12.05.21</option>
                </select>
            </div>
            
        </div>
            
        <input type='submit' class='button' value='Показати'>
    </form>

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
    
</body>
<script src="scripts/jquery.js"></script>
<script src="scripts/flights.js"></script>

</html>