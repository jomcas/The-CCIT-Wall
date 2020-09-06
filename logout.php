<?php

// Unsetting the SESSION Variables
session_start();
unset($_SESSION['UserLogin']);
unset($_SESSION['Access']);
unset($_SESSION['ID']);
echo header("Location: login.php");

?>