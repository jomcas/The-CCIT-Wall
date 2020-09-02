<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

if(isset($_SESSION['Access']) && $_SESSION['Access'] == "admin") {
   echo "Welcome ". $_SESSION['UserLogin'];
} 

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM users WHERE userID = '$id'";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($_POST['access'] == "") {
        $access = "user";
    } else {
        $access = $_POST['access'];
    }
    $sql = "UPDATE `users` SET `name` = '$name', `email` = '$email', `password` = '$password', `access` = '$access' WHERE `userID` = $id";

    $con->query($sql) or die($con->error);

    echo header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">

        <div class="register">
            <h1 class="text-center"> CCIT Forum Admin </h1>
            <h3 class="text-center">Edit User </h1>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post"
                            onSubmit="return confirm('Do you really want to update this user')">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="name" class="form-control" name="name" value="<?php echo $row['name']?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="<?php echo $row['email']?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"
                                    value="<?php echo $row['password']?>">
                            </div>
                            <!-- Access -->
                            <?php if($_SESSION['Access'] == "admin") { ?>
                            <div class="form-group">
                                <label for="password">Access</label>
                                <select name="access" class="form-control">
                                    <?php if($row['access'] == "user") {  ?>
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                    <?php } else { ?>
                                    <option value="user">User</option>
                                    <option value="admin" selected>Admin</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>
                            <input type="submit" name="submit" class="btn btn-success float-right"
                                value="Save Changes"></input>
                        </form>
                        <a id="loginBtn" class="btn btn-link" href="/ccitforum/accounts.php"> Back to User's List. </a>
                    </div>
                </div>
        </div>

    </div>
</body>

</html>