<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

$sql = "SELECT * FROM users ORDER BY userID";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

if(!isset($_SESSION['UserLogin'])) {
    echo header("Location: login.php");
}

if(isset($_SESSION['UserLogin'])) {
    echo "<div class='text-center'> Welcome ".$_SESSION['UserLogin']." Role: ".$_SESSION['Access']."</div>";
} else {
    echo "Welcome guest!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> CCIT Forum </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">

        <h1 class="text-center"> The CCIT Wall </h1>
        <h3 class="text-center"> Homepage </h3>

        <!-- Button Group User -->
        <h1> The CCIT Wall </h1>
        <small> Create and edit posts. Read posts from other users.</small>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a class="btn btn-info float-left" href="/ccitforum/home.php"> News Feed </a>
            <button type="button" class="btn btn-primary"><a class="text-white text-decoration-none"
                    href="/applicants-pending">My Posts</a></button>
            <a class="btn btn-success float-left" href="/ccitforum/accounts.php"> Accounts </a>
            <a class="btn btn-danger float-left" href="/ccitforum/logout.php"> Logout </a>
        </div>
        <hr>
   
        <?php if($_SESSION['Access'] == "admin") { ?>
        <a class="btn btn-success float-right" href="/ccitforum/add.php"> Add new </a> <br> <br>
        <?php } ?>

        <!-- Search Bar -->
        <form action="result.php" method="get">
            <div class="input-group mb-3">
                <input type="text" name="search" id="search" class="form-control"
                    placeholder="Search for user's name or email" autocomplete="off">
                <div class="input-group-append float-right">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </form>

       
        <div>
</body>
<html>