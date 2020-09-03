<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['Access']) && $_SESSION['Access'] == "admin") {
    echo header("Location: home.php");
}

include_once "connections/connection.php";

$con = connection();

if(isset($_POST['delete'])) {
    $id = $_POST['ID'];
    $sql = "DELETE FROM users WHERE userID = '$id'";
    $con->query($sql) or die ($con->error);
    echo header("Location: accounts.php");
}

?>
