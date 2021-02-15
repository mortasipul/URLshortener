<?php
//Adding a service for localhost
define("SERVICE","http://localhost/");

//database connection
$db = new mysqli("localhost","root","root","urls");

//get the value from the input having the name "link"
$url = $_POST['link'];

if($url) {
    $stmt = $db->prepare('SELECT token FROM links WHERE link= ?');
    $stmt->bind_param("s", $url); //give $url to the query
    $stmt->execute(); //run query
    $stmt->store_result();

    //checking if the URL already exists and if so, return the token
    if($stmt->num_rows == 1) {
        $stmt->bind_result($token);
        $stmt->fetch();
        echo SERVICE.$token;

        //If it doesn't exist, generate a token
    } else {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
        $token = substr(str_shuffle($chars),0,5);
        $stmt = $db->prepare("INSERT INTO links VALUES (NULL, ?, ?, NOW(), 0");
        $stmt->bind_param('ss', $url, $token);  // s is the type of the variable introduced in the query, this time string

        if($stmt->execute()) {
            echo SERVICE.$token; //generates new url
        } else {
            printf('errno: %d, error: %s', $stmt->errno, $stmt->error);
            die; 
        }
    }
} else {
    echo "FALSE";
}

