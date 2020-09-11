<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM users WHERE userID = '$id'";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

// Can access the page if it is an admin or it is the user's personal account!
if ((isset($_SESSION['Access']) && $_SESSION['Access'] == "admin" || $_SESSION['ID'] == $id)) {
    echo "<div class='float-right'> Welcome <b> " . $_SESSION['UserLogin'] . " </b> | Role: <b> " . $_SESSION['Access'] . "</b></div> <br>";
} else {
    echo header("Location: home.php");
}

if(isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($_POST['access'] == "") {
        $access = "user";
    } else {
        $access = $_POST['access'];
    }
    $sql = "UPDATE `users` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `password` = '$password', `access` = '$access' WHERE `userID` = $id";

    $con->query($sql) or die($con->error);

    echo header("Location: accounts.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

    <div class="container">
        <div class="register">
            <h1 class="text-center"> CCIT Forum Admin </h1>
            <h3 class="text-center">Edit User </h1>
                <a id="loginBtn" class="btn btn-dark float-right" href="/ccitforum/accounts.php"> Back to User's List. </a>
                <br><br>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" onSubmit="return confirm('Do you really want to update this user')" accept-charset="utf-8">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="name" class="form-control" name="firstName" value="<?php echo $row['firstName']?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="name" class="form-control" name="lastName" value="<?php echo $row['lastName']?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $row['password'] ?>">
                            </div>
                            <!-- Access -->
                            <?php if ($_SESSION['Access'] == "admin") { ?>
                                <div class="form-group">
                                    <label for="password">Access</label>
                                    <select name="access" class="form-control">
                                        <?php if ($row['access'] == "user") {  ?>
                                            <option value="user" selected>User</option>
                                            <option value="admin">Admin</option>
                                        <?php } else { ?>
                                            <option value="user">User</option>
                                            <option value="admin" selected>Admin</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                            <input type="submit" name="submit" class="btn btn-success float-right" value="Save Changes"></input>
                        </form>
                    </div>
                </div>
        </div>

    </div>
</body>

</html>