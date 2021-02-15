<?php

$db = new mysqli("localhost", "root", "root", "urls"); 

//Check if the token has been provided and if so, process it
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $db->prepare("SELECT link, clicked FROM links WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    //Check if the token was found in the database
    if($stmt->num_rows == 1) {
        $stmt->bind_result($url, $clicked);
        $stmt->fetch();
        $clicked++;
        //Update the click counter
        $stmtUpdate = $db->prepare("UPDATE links SET clicked = ? WHERE token = ?");
        $stmtUpdate->bind_param("ds", $clicked, $token);
        $stmtUpdate->execute();

        // redirect to a proper url

        header('Location:'. $url);
    } else {
        echo "This URL doesn't exists";
    }
}