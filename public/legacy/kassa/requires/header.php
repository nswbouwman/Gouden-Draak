<!-- THIS IS A PARTIAL. No <HTML> tags needed -->
<link rel='stylesheet' type='text/css' href='css/header.css'>
<link rel='stylesheet' type='text/css' href='css/login.css'>
<link rel='stylesheet' type='text/css' href='css/general.css'>
<link rel='stylesheet' type='text/css' href='css/cashDesk.css'>
<link rel='stylesheet' type='text/css' href='css/menu.css'>
<link rel='stylesheet' type='text/css' href='css/sales.css'>

<script src="js/cashDesk.js" defer></script>
<script src="js/header.js" defer></script>
<script src="js/sales.js" defer></script>
<script src="js/main.js" defer></script>

<div id='menuBar'>
    <img id="logo" src="../pictures/goodpay.png" alt="goodpay logo">

    <div id='buttonBar'>
        <?php
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        ?>

            <button id='cashDeskBtn' class='menuButton'>
                Kassa
            </button>

            <button id='menuBtn' class='menuButton'>
                Gerechten
            </button>
            <button id='salesBtn' class='menuButton'>
                Verkoop Overzicht
            </button>
            
            <a class='menuLink' href='logout.php'>
                <div class='menuButton'>
                        Log Uit
                </div>
            </a>
            
        <?php
          }
        ?>
    </div>
</div>