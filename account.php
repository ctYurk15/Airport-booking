<?php
    include 'phpScripts/dbconnect.php';
    include 'phpScripts/generalScripts.php';
    include 'phpScripts/User.php';

    $user = new User($conn, $_COOKIE['email']);

    if(!isset($_COOKIE['email'])) //if user already logined
    {
        gotoURL("../index.html"); 
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
                            <li role="presentation"><a class="vlad" href="Flights.php">Купити квитки</a></li>
                            <li role="presentation"><a class="vlad" href="#">Орендувати готель</a></li>
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
    <table border='1px'>
        <tr>
            <td>Reis</td>
            <td>Place</td>
        </tr>
    
    <?php
        $allTickets = $user->getTicketsPurchased();

        for($i = 0; $i < count($allTickets); $i++)
        {
            echo "  <tr>
                        <td>PS10{$allTickets[$i]['Reis_id1']}</td>
                        <td>{$allTickets[$i]['PlaceNumber']}</td>
                    </tr>"; 
        }
    ?>
    
    </table>
    
    <div class="infoDivContainer">
      <h1>Passport Info</h1>
      <form action="/" method="post">
        <div class="toCenter">
          <div class="inline">
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  First Name
                </label>
              </div>
              <input type="text" required autocomplete="off" />
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Second Name
                </label>
              </div>
              <input type="text" required autocomplete="off" />
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Sex
                </label>
              </div>
              <select>
                  <option>Male</option>
                  <option>Female</option>
                </select>
            </div>
          </div>
          <div class="inline">
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Passport ID
                </label>
              </div>
              <input type="text"required autocomplete="off"/>
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Date of birth
                </label>
              </div>
              <input type="text" required autocomplete="off" />
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  E-Mail
                </label>
              </div>
              <input type="text" required autocomplete="off" />
            </div>
          </div>
          <div class="field-wrap ">
            <div class="labelSize">
              <label>
                Inter. Passport
              </label>
            </div>
            <input type="text" required autocomplete="off" />
          </div>
        </div>
        <div>
          <button type="submit" class="button button-block">Відправити</button>
        </div>
      </form>
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