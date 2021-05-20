<?php
    include 'phpScripts/dbconnect.php';
    include 'phpScripts/generalScripts.php';
    include 'phpScripts/User.php';
    include 'phpScripts/DBgeneral.php';

    if(!isset($_COOKIE['email'])) //if user already logined
    {
        gotoURL("../index.html"); 
    }

    $user = new User($conn, $_COOKIE['email']);
    $dbgeneral = new DBgeneral($conn);

    $userID = $user->getColumn('id');

    $class = "";
    $Confirmed = $dbgeneral->getColumn('Confirmed', 'passport_request', 'User_Id', $userID);
    $status = "";

    if($dbgeneral->getColumn('id', 'passport_request', 'User_Id', $userID) != null) //if we don`t need passport request
    {
        $class = "hidden";
    }
    
    if($Confirmed == null) //if request is still processing
    {
        $status = "Ваш запит все ще обробляється. Будь ласка, зачекайте";
    }
    else if($Confirmed) //if account is verified
    {
        $passId = $dbgeneral->getColumn('PassId', '`user`', 'id', $userID);
        $status = "Ваш аккаунт успішно верифіковано.<br> Ваш паспорт - {$passId}";
    }
    else if(!$Confirmed) //if something went wrong
    {
        $status = "Ваші дані були введені невірно. Введіть їх будь ласка заново";
        $class = "";
    }
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
    <link rel="stylesheet" href="css/passportView.css">
    <title>Аккаунт</title>
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
                            <li role="presentation"><a class="vlad" href="hotels.php">Орендувати готель</a></li>
                            <li role="presentation"><a class="vlad" href="#">Приватні рейси</a></li>
                            <li role="presentation"><a class="vlad" href="#">Аккаунт</a></li>
                        </ul>
                        <!--<p class="navbar-text navbar-right actions"><a class="navbar-link login" href="#">Log In</a> 
                        <a class="btn btn-default action-button" role="button" href="#">Sign Up</a></p>-->
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <a href="phpScripts/unloginScript.php">Вийти з аккаунту</a>
    <h1>Квитки</h1>
    <table border='1px' id='ticketsTable'>
        <tr>
            <td>Номер рейсу</td>
            <td>Місце</td>
        </tr>
    </table>
    <h1>Готелі</h1>
    <table border='1px' id='hotelRoomsTable'>
        <tr>
            <td>Готель</td>
            <td>Клас кімнати</td>
        </tr>
    </table>
    
    <div class="infoDivContainer <?= $class ?>">
      <h1>Passport Info</h1>
      <form action="/" method="post" id='passIdForm'>
        <div class="toCenter">
          <div class="inline">
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  First Name
                </label>
              </div>
              <input type="text" required autocomplete="off" id='firstname'>
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Second Name
                </label>
              </div>
              <input type="text" required autocomplete="off" id='lastname'>
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Sex
                </label>
              </div>
              <select id='sex'>
                  <option>Male</option>
                  <option>Female</option>
                </select>
            </div>
          </div>
          <div class="inline">
            <div class="field-wrap">
              <div class="labelSize">
                <label>
                  Passport ID
                </label>
              </div>
              <input type="text"required autocomplete="off" id='passId'>
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Date of birth
                </label>
              </div>
              <input type="text" required autocomplete="off" id='birthDate'>
            </div>
            <div class="field-wrap ">
            <div class="labelSize">
              <label>
                Inter. Passport
              </label>
            </div>
            <input type="text" required autocomplete="off" id='interPassId'>
          </div>
          </div>
          
        </div>
        <div>
          <button type="submit" class="button button-block">Відправити</button>
         
        </div>
      </form>
       
    </div>
    <h2 id='statusText'><?= $status ?></h2>
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
<script src="scripts/account.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/df966d76e1.js"></script>

</html>