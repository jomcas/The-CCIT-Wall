<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

$userSQL = "SELECT * FROM users ORDER BY userID";
$postSQL =  "SELECT users.userID, users.name, users.email, posts.postID, posts.subject, posts.body, posts.dateAdded ".
            "FROM users JOIN posts ".
            "ON users.userID = posts.userID ".
            "ORDER BY posts.dateAdded DESC"; 

$users = $con->query($userSQL) or die($con->error);
$posts = $con->query($postSQL) or die($con->error);
$row = $users->fetch_assoc();
$postRow = $posts->fetch_assoc();

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
        <h1> News Feed </h1>
        <small> View the latest post.</small>
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

        <!-- Search Bar
        <form action="result.php" method="get">
            <div class="input-group mb-3">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search for topics"
                    autocomplete="off">
                <div class="input-group-append float-right">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </form> -->

        <!-- Compose Post Section -->
        <h3> Compose Post </h3>
        <div class="card">
            <div class="card-body">
                <form action="addPost.php" method="post" onSubmit="return alert('Your post was posted!')">
                    <div class="form-group">
                        <label for="name">Topic </label>
                        <input type="text" class="form-control" name="postSubject" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Body</label>
                        <textarea class="form-control" id="addressTA" rows="3" name="postBody" required"
                            style="resize:none;"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Post" name="addPost"/>
                </form>

            </div>
        </div>
        <div>

         <br>

        <!-- All Posts -->
        <h3> Recent Posts </h3>
         <?php do { ?>
        <div class="card">
             <div class="card-header">
                <h4 class="card-title"> <?php echo $postRow['subject'] ?></h4>
                <small class="card-subtitle">
                    <?php echo "Posted by <b>".$postRow['name'].' </b>'.' '.$postRow['email'].' '.$postRow['dateAdded']  ?>
                </small>
            </div>
            <div class="card-body">
                <?php echo $postRow['body'] ?>
            </div>
        </div> <br>
        <?php } while($postRow = $posts->fetch_assoc()) ?>


</body>
<html>