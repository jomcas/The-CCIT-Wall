<?php

if(!isset($_SESSION)) {
    session_start();
}
include_once "connections/connection.php";
$con = connection();


if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user -> fetch_assoc();
    $total = $user->num_rows;

    if ($total > 0) {
        $_SESSION['UserLogin'] = $row['email'];
        $_SESSION['Access'] = $row['access'];
        $_SESSION['ID'] = $row['userID'];
        echo header("Location: index.php");    
    } else {
        echo "Please try again!";
    }
}

if(isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user -> fetch_assoc();
    $total = $user->num_rows;

    if($total > 0) {
        echo "Duplicate Email! Try Again";
    } else {
        $insertSql = "INSERT INTO `users` (`name`,`email`,`password`,`access`) VALUES ('$name','$email','$password','user')";
        $con->query($insertSql) or die($con->error);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col-6 home-left">
                <h1 class="brand-title text-center "> Welcome To <br> The CCIT Forum.</h1>
                <div class="brand-list">
                    <ul>
                        <li>Share your thoughts!</li>
                        <li>Communicate with other CCIT students!</li>
                        <li>Be as one!</li>
                    </ul>
                </div>

                <div class="brand-subtitle">
                    <h4>"This is the subtitle put it here."</h3>
                </div>

                <br><br><br>
            </div>

            <div class="col-6 home-right">


                <div class="row">
                    <div class="login">
                        <h5 class="text-muted text-center">National University - Manila</h5>
                        <p class="text-muted">College of Computing and Information Technologies</p>
                        <h1 class="text-center">Sign In.</h1>
                        <div class="card">
                            <div class="card-body">
                                <!-- Makes POST request to /login route -->
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <input type="submit" name="login" class="btn btn-primary float-right"
                                        value="Sign In"></input>
                                </form>
                                <p> Not yet a member? <button id="registerBtn" class="btn btn-link"> Sign Up Now!
                                    </button></p>
                            </div>
                        </div>
                    </div>

                    <div class="register">
                        <h5 class="text-muted text-center">National University - Manila</h5>
                        <p class="text-muted">College of Computing and Information Technologies</p>
                        <h1 class="text-center">Sign Up.</h1>
                        <div class="card">
                            <div class="card-body">
                                <!-- Makes POST request to /login route -->
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="name" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <input type="submit" name="register" class="btn btn-primary float-right"
                                        value="Sign Up"></input>
                                </form>
                                <p> Already a member? <button id="loginBtn" class="btn btn-link"> Sign In Here.                                    </button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer bg-light fixed-bottom">
        <div class="container">
            <span class="text-muted text-center footer-text"> The College of Computing and Information Technolgies
                Forum</span>
        </div>
    </footer>



    <!-- JQuery library -->
    <script src="js/jquery/jquery.min.js"></script>
    <script>
        $(".register").hide();

        $("#registerBtn").click(function () {
            $(".login").hide();
            $(".register").show();
            console.log("anyare");
        })

        $("#loginBtn").click(function () {
            $(".register").hide();
            $(".login").show();
            console.log("anyare");
        })
    </script>
</body>

</html>