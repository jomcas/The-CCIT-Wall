<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

$id = $_GET['ID'];
$userID = $_SESSION['ID'];

$sql = "SELECT * FROM posts WHERE postID = '$id'";
$posts = $con->query($sql) or die($con->error);
$row = $posts->fetch_assoc();

// Can access the page if the posts.userID = users.userID
if($row['userID'] == $userID) {
    echo "<div class='float-right'> Welcome <b> ".$_SESSION['UserLogin']." </b> Role: <b> ".$_SESSION['Access']."</b></div> <br>";
 } else {
    //  echo header("Location: myPosts.php");
}

if(isset($_POST['submit'])) {
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $sql = "UPDATE `posts` SET `subject` = '$subject', `body` = '$body' WHERE `userID` = $userID AND `postID` = $id";

    $con->query($sql) or die($con->error);

    echo header("Location: myPosts.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <h1 class="text-center"> CCIT Forum Admin </h1>
        <h3 class="text-center">Edit Post Content </h1>
            <div class="card">
                <div class="card-body">
                    <form action="addPost.php" method="post" onSubmit="return alert('Your post was edited!')">
                        <div class="form-group">
                            <label for="name">Topic </label>
                            <input type="text" class="form-control" name="postSubject" value=" <?php echo $row['subject'] ?>" required> </input>
                        </div>
                        <div class="form-group">
                            <label for="address">Body</label>
                            <textarea class="form-control" id="addressTA" rows="3" name="postBody" required"
                                style="resize:none;"><?php echo $row['body'] ?></textarea>
                        </div>
                        <a id="loginBtn" class="btn btn-link" href="/ccitforum/myPosts.php"> Back to Your Posts. </a>
                        <input type="submit" class="btn btn-success float-right" value="Save Changes" name="myPost"/>
                    </form>
                </div>
            </div>

</body>
</html>