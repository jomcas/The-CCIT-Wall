<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['Access']) && $_SESSION['Access'] == "admin") {
    echo header("Location: index.php");
}

include_once "connections/connection.php";
$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM users WHERE userID = '$id'";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=" , initial-scale=1.0">
    <title>View Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <div class="container">

        <h1 class="text-center"> CCIT Forum Admin </h1>
        <h3 class="text-center"> View Details </h3>
        <br> <br>
        <!-- <a class="btn btn-dark" href="/ccitforum/index.php"> Back to List </a> <br> -->

        <div class="card">
            <div class="card-body" <div class="view">
                <h2> <b>Name</b> : <?php echo $row['name'];?> </h2>
                <h2> <b>Email</b> : <?php echo $row['email'];?> </h2>
                <h2> <b>Access</b>: <?php echo $row['access'];?> </h2>
            </div>
            <a id="loginBtn" class="btn btn-link" href="/ccitforum/"> Back to User's List. </a>
        </div>
    </div>
</body>

</html>