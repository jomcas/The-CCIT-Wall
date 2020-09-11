<?php

// Registration Validation
define("EMAIL", "/\S+@\S+\.\S+/"); // Basic Email Format
define("NAME", "/^[a-z ,.-]+$/i"); // No Special Characters. Accepts . , -
define("PASSWORD", "^(?=.*[0-9])(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+*!=]).*$"); // At least * chars, 1 lowercase, uppercase, number and special character


// Name Validation
function isNameValid($name) {
    return preg_match(NAME, $name);
}

function isEmailValid($email) {
    return preg_match(EMAIL, $email);
}

function isPasswordValid($password) {
    return preg_match(PASSWORD, $password);
}

function formValidate($data) {
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

// echo isNameValid("Cerceas Jr.");
// echo isEmailValid("jomari");
// echo isEmailValid("jomari@gmail.com");

?>