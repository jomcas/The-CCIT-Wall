<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();
$id = $_SESSION['ID'];
$userPostSQL = "SELECT users.userID, users.name, users.email, posts.postID, posts.subject, posts.body, posts.dateAdded ".
            "FROM users JOIN posts ".
            "ON users.userID = posts.userID ".
            "WHERE users.userID = ".$id.
            " ORDER BY posts.dateAdded DESC";
$userPosts = $con->query($userPostSQL) or die($con->error);
$userPostRow = $userPosts->fetch_assoc();

if(!isset($_SESSION['UserLogin'])) {
    echo header("Location: login.php");
}   

if(isset($_SESSION['UserLogin'])) {
    echo "<div class='text-center'> Welcome ".$_SESSION['UserLogin']." Role: ".$_SESSION['Access']."</div>";
} else {
    echo "Welcome guest!";
}

?>

<!-- HTML CODES -->

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
            <h1> My Posts </h1>
            <small> View your posts.</small>
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <a class="btn btn-info float-left" href="/ccitforum/home.php"> News Feed </a>
                <a class="btn btn-primary float-left" href="/ccitforum/home.php?ID=<?php echo $id ?>"> My Posts </a>
                <a class="btn btn-success float-left" href="/ccitforum/accounts.php"> Accounts </a>
                <a class="btn btn-danger float-left" href="/ccitforum/logout.php"> Logout </a>
            </div>
            <hr>

            <?php if($_SESSION['Access'] == "admin") { ?>
            <a class="btn btn-success float-right" href="/ccitforum/add.php"> Add new </a> <br> <br>
            <?php } ?>

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

            <br>

            <!-- Recent Posts -->
            <h3> My Posts </h3>
            <?php do { ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <?php echo $userPostRow['subject'] ?></h4>
                    <small class="card-subtitle">
                        <?php echo "Posted by <b>".$userPostRow['name'].' </b>'.' '.$userPostRow['email'].' '.$userPostRow['dateAdded']  ?>
                    </small>
                </div>
                <div class="card-body">
                    <?php echo $userPostRow['body'] ?>
                </div>
            </div> <br>
            <?php } while($userPostRow = $userPosts->fetch_assoc()) ?>
    
    </body>
<html>