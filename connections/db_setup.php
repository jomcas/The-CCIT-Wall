<?php

function db_setup() {
    include_once "connection.php";
    $con = connection();

    //createDatabase($con);
    return $con;
}

$con = db_setup();

createTables($con);

function createDatabase($con) {
    $sql = "CREATE DATABASE ccitDB2";
    $con->query($sql) or die($con->error);
    $con->close();
}

function createTables($con) {
    $usersTable = 
        "CREATE TABLE `users` (" +
            "`userID` int AUTO_INCREMENT PRIMARY KEY," +
            "`name` varchar(50) NOT NULL," +
            "`email` varchar(50) NOT NULL," +
            "`password` varchar(50) NOT NULL," +
            "`access` varchar(10) NOT NULL) ";
    echo $usersTable;
    //$con->query($usersTable) or die ($con->error);

    $postsTable =
        "CREATE TABLE `posts` (" +
            "`postID int AUTO_INCREMENT PRIMARY KEY," +
            "`FOREIGN KEY (userID) REFERENCES users(id)`," +
            "`subject` varchar(75) NOT NULL," +
            "`body` varchar(255) NOT NULL," +
            "`dateAdded` datetime NOT NULL)" +
            "`ALTER TABLE `posts`
             ADD CONSTRAINT `postUserFK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
            COMMIT;`";

    $con->close();
}

?>
