<?php
//Adding a service for localhost
define("SERVICE","http://localhost/");

//database connection
$db = new mysqli("localhost","root","root","urls");

//get the value from the input having the name "link"
$url = $_POST['link'];

//function who generated the random token
function createToken() {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!"#$%&.,*+/:;<=>?`}{[]()~_^\|'; 
    $abbreviation = substr(str_shuffle($chars),0,5); 
    return $abbreviation;
}

// The resolve if: takes the link, fragment it in 2 parts, check if the first part is the name of the server and the second one use it as a token to search in the database
$urlCheck = substr($url, 0, 16);
//Now I will check if the first 16 characters are the name of my server
if ($urlCheck == 'http://localhost') { 
    $length = strlen($url);
    $checked = substr($url, 17 , $length);
    //get the token from the URL
    $stmt = $db->prepare('SELECT link FROM links WHERE token = ?'); 
    $stmt->bind_param("s", $checked); 
    $stmt->execute(); 
    $stmt->store_result();
    if ($stmt->num_rows == 1) { 
        $stmt->bind_result($url); 
        $stmt->fetch(); 
        echo $url; 
    }

} else if($url) {
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
        $token = createToken();
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

