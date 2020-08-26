<?php

function connection() {
    
    $host = "localhost";
    $username = "jomcas";
    $password = "jomcas";
    $database = "ccitForum";

    $con = new mysqli($host, $username, $password, $database);

    if($con->connect_error) {
        echo $con->connect_error;
    } else {
        return $con;
    }

    $conn->close();
}

