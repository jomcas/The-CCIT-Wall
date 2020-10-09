<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

if(isset($_POST['addPost'])) {


    $userID = $_SESSION['ID'];
    $subject = "";
    $body = "";
    $dateAdded = date('Y-m-d H:i:s');;
    $sql = "INSERT INTO `posts` (`userID`,`subject`,`body`,`dateAdded`) VALUES ('$userID','$subject','$body', '$dateAdded')";

    $con->query($sql) or die($con->error);
    $last_id = $con->insert_id;	
    insertLog("INFO", 1, " User ID ".$_SESSION['ID']." add a new post with an ID of ".$last_id);
    
    //Subject
    if(isSubjectValid($_POST['postSubject']) == 1) {
        $firstName = formValidate($_POST['postSubject']);
    } else {
        throw new customException("Error: Invalid Subject Name!");
        insertLog("ERROR", 1, "User ID: ".$_SESSION['ID']." Post Subject Input Validation Error");
    }


    // Body
    if(isBodytValid($_POST['postBody']) == 1) {
        $firstName = formValidate($_POST['postBody']);
    } else {
        throw new customException("Error: Invalid Body Content!");
        insertLog("ERROR", 1, "User ID: ".$_SESSION['ID']." Post Body Input Validation Error");
    }


    echo header("Location: home.php");
}

if(isset($_POST['myPost'])) {
    $userID = $_SESSION['ID'];
    $subject = $_POST['postSubject'];
    $body = $_POST['postBody'];
    $dateAdded = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `posts` (`userID`,`subject`,`body`,`dateAdded`) VALUES ('$userID','$subject','$body', '$dateAdded')";

    $con->query($sql) or die($con->error);

    $last_id = $con->insert_id;	
    insertLog("INFO", 1, " User ID ".$_SESSION['ID']." add a new user with an ID of ".$last_id);
    
    
    //Subject
    if(isSubjectValid($_POST['postSubject']) == 1) {
        $firstName = formValidate($_POST['postSubject']);
    } else {
        throw new customException("Error: Invalid Subject Name!");
        insertLog("ERROR", 1, "User ID: ".$_SESSION['ID']." Post Subject Input Validation Error");
    }


    // Body
    if(isBodytValid($_POST['postBody']) == 1) {
        $firstName = formValidate($_POST['postBody']);
    } else {
        throw new customException("Error: Invalid Body Content!");
        insertLog("ERROR", 1, "User ID: ".$_SESSION['ID']." Post Body Input Validation Error");
    }

    echo header("Location: myPosts.php");
}
?>