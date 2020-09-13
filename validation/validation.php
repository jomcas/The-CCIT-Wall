<?php

// Registration Validation
define("EMAIL", "/\S+@\S+\.\S+/"); // Basic Email Format
define("NAME", "/^[a-z ,.-]+$/i"); // No Special Characters. Accepts . , -
define("PASSWORD", "/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{7,19}$/"); // At least * chars, 1 lowercase, uppercase, number and special character


// Validation
function isFirstNameValid($name) {
    return preg_match(NAME, $name);
}

function isLastNameValid($name) {
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

echo isFirstNameValid("Cerceas Jr.");
// echo isEmailValid("jomari");
// echo isEmailValid("jomari@gmail.com");

?>