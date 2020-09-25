<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";
include "validation/validation.php";
$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM users WHERE userID = '$id'";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

// Can access the page if it is an admin or it is the user's personal account!
if((isset($_SESSION['Access']) && $_SESSION['Access'] == "admin" || $_SESSION['ID'] == $id)) {
    echo "<div class='float-right'> Welcome <b> ".$_SESSION['UserLogin']." </b> | Role: <b> ".$_SESSION['Access']."</b></div> <br>";
 } else {
     echo header("Location: home.php");
}

if(isset($_POST['submit'])) {
   // Validation
    //First Name
    if(isFirstNameValid($_POST['firstName']) == 1) {
        $firstName = formValidate($_POST['firstName']);
    } else {
        die("Error: Invalid First Name!");
    }

     //Last Name
    if(isLastNameValid($_POST['lastName']) == 1) {
        $lastName = formValidate($_POST['lastName']);
    } else {
        die("Error: Invalid Last Name!");
    }

    // Email
    if(isEmailValid($_POST['email']) == 1) {
        $email = formValidate($_POST['email']);
    } else {
        die("Error: Invalid Email!");
    }

    // Password
    if(isPasswordValid($_POST['password']) == 1) {
        $password = $_POST['password'];
    } else {
        die("Error: Invalid Password!");
    }
    if($_POST['access'] == "") {
        $access = "user";
    } else {
        $access = $_POST['access'];
    }
    $sql = "UPDATE `users` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `password` = '$password', `access` = '$access' WHERE `userID` = $id";

    $con->query($sql) or die($con->error);

    //logout if the info was change on the own account.
    if($_SESSION['ID'] == $id) {
        echo header("Location: logout.php");
    } else {
        echo header("Location: accounts.php");
    }
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
                        <form action="" method="post"
                            onSubmit="return confirm('Do you really want to update this user? You might be logged out if it is successful!')">
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
                                <input type="email" class="form-control" name="email"
                                    value="<?php echo $row['email']?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="pass" type="password" class="form-control" name="password"
                                    value="<?php echo $row['password']?>">
                             <input type="checkbox" onclick="unhidePassword()" > Show Password </input>
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

    <!-- JQuery library -->
    <script src="js/jquery/jquery.min.js"></script>

    <!-- JQuery Script -->
    <script>
        function unhidePassword() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>