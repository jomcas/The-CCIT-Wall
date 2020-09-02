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

        <h1 class="text-center"> CCIT Forum Admin </h1>
        <h3 class="text-center"> Users Account </h3>

        <a class="btn btn-danger float-left" href="/ccitforum/logout.php"> Logout </a>
        <?php if($_SESSION['Access'] == "admin") { ?>
        <a class="btn btn-success float-right" href="/ccitforum/add.php"> Add new </a> <br> <br>
        <?php } ?>
        
        <!-- Search Bar -->
        <form action="result.php" method="get">
            <div class="input-group mb-3">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search for user's name or email" autocomplete="off">
            <div class="input-group-append float-right">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
            </div>
        </form>

        <!-- Users Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <?php if($_SESSION['Access'] == "admin") { ?>
                    <th scope="col">Password</th>
                    <th scope="col">Access</th>
                    <th scope="col">View</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    <?php } ?>
            </thead>

            <tbody>
                <?php do {?>
                <tr>
                    <td> <b> <?php echo $row['userID'];?> </b> </td>
                    <td> <?php echo $row['name'];?> </td>
                    <td> <?php echo $row['email'];?> </td>
                    <?php if($_SESSION['Access'] == "admin") { ?>
                    <td> <?php echo $row['password'];?> </td>
                    <td> <?php echo $row['access'];?> </td>
                    <td>
                        <a class="view btn btn-info btn-sm" name="view"
                            href="/ccitforum/details.php?ID=<?php echo $row['userID']?>">View</a>
                    </td>
                    <td>
                        <a class="view btn btn-warning btn-sm" name="update"
                            href="/ccitforum/update.php?ID=<?php echo $row['userID']?>">Update</a>
                    </td>
                    <td>
                        <form action="delete.php" onSubmit="return confirm('Do you really want to delete this user?')"
                            method="post">
                            <button type="submit" class="view btn btn-danger btn-sm" name="delete">Delete</button>
                            <input type="hidden" class="<style>hidden" name="ID" value="<?php echo $row['userID']?>">
                        </form>
                    </td>
                    <?php } ?>
                </tr>
                <?php } while ($row = $users->fetch_assoc()) ?>
            </tbody>
        </table>
        <div>
</body>
<html>