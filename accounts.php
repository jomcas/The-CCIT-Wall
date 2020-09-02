<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

$id = $_SESSION['ID'];
$sql = "SELECT * FROM users ORDER BY userID";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

if(!isset($_SESSION['UserLogin'])) {
    echo header("Location: login.php");
}

if(isset($_SESSION['UserLogin'])) {
    echo "<div class='text-center'> Welcome ".$_SESSION['UserLogin']." Role: ".$_SESSION['Access']."</div>";
    echo "<div class='text-center'> ID:".$_SESSION['ID']."</div>";
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

        <h1> Accounts </h1>
        <small> View All Users.</small>
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
        
        <!-- Edit Account Link -->
        <a id="loginBtn" class="btn btn-link float-right" href="/ccitforum/update.php?ID=<?php echo $id?>"> Edit My Account. </a>
        
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