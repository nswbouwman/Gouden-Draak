<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>GoodPay Kassa</title>
    </head>

    <body>
        <?php
            require('requires/header.php');

            if(isset($_SESSION['logged_in'])){
                require('main.php');
            } else {
                require('login.php');
            }
        ?>
    </body>
</html>