<?php
    $db_username = "root"; //Database Username
    $db_password = ""; //Database Password
    
    try {
        $conn = new PDO("mysql:hostname=localhost;dbname=bets", $db_username, $db_password); //change the hostname and dbname accordingly
        //echo "done";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>