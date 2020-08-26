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
    echo "Welcome ".$_SESSION['UserLogin'];    
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

        <h1 class="text-center"> CCIT Forum Admin </h1>
        <h3 class="text-center"> Users Account </h1>
            <a class="btn btn-danger float-left" href="/ccitforum/logout.php"> Logout </a>
            <a class="btn btn-success float-right" href="/ccitforum/add.php"> Add new </a> <br> <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">View</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                </thead>

                <tbody>
                    <?php do {?>
                    <tr>
                        <td> <?php echo $row['userID'];?></td>
                        <td> <?php echo $row['name'];?> </td>
                        <td> <?php echo $row['email'];?> </td>
                        <td> <?php echo $row['password'];?> </td>
                        <td>
                            <a class="view btn btn-info btn-sm" name="view" href="/ccitforum/view">View</a>
                        </td>
                        <td>
                            <a class="view btn btn-warning btn-sm" name="update" href="/ccitforum/update">Update</a>
                        </td>
                        <td>
                            <a class="view btn btn-danger btn-sm" name="delete" href="/ccitforum/delete">Delete</a>
                        </td>
                    </tr>
                    <?php } while ($row = $users->fetch_assoc()) ?>
                </tbody>
            </table>
            <div>
</body>
<html>