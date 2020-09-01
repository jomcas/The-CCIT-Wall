<?php

function db_setup() {
    include_once "connection.php";
    $con = connection();

    createDatabase($con);
    createTables($con);
}

function createDatabase($con) {
    $sql = "CREATE DATABASE ccitDB";
    $con->query($sql) or die($con->error);
}

function createTables($con) {
    $usersTable = 
        "CREATE TABLE `users` (" +
            "`userID` int AUTO_INCREMENT PRIMARY KEY," +
            "`name` varchar(50) NOT NULL," +
            "`email` varchar(50) NOT NULL," +
            "`password` varchar(50) NOT NULL," +
            "`access` varchar(10) NOT NULL) ";
    $con->query($usersTable) or die ($con->error);
}

?>
