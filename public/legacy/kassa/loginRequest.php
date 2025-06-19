<?php
    session_start();

    require_once('config/dbconfig.php');

    $_SESSION['loggin_in'] = false;

    if(isset($_POST['employeeNr']) && isset($_POST['password'])){
        if($_POST['employeeNr'] === "" || $_POST['password'] === ""){
            $_SESSION['login_error'] = "Medewerker nummer of wachtwoord niet ingevuld.";
        } else {
            $conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                // check password/username

                $sql = "SELECT * FROM gebruiker WHERE id='".$_POST['employeeNr']."' AND wachtwoord='".$_POST['password']."'";
                $result = $conn->query($sql);

                if ($result!= null && $result->num_rows > 0) {
                    // password/username found
                    $_SESSION['logged_in'] = true;
                } else {
                    $_SESSION['login_error'] = "Onbekende combinatie medewerker nummer en wachtwoord";
                } 

                $conn->close();
            }
        }
    }

    header("Location: index.php");
    exit;
?>