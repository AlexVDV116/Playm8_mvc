<?php

// ...

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $selector = htmlspecialchars($_POST["selector"], ENT_QUOTES, "UTF-8");
    $validator = htmlspecialchars($_POST["validator"], ENT_QUOTES, "UTF-8");
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
    $passwordrepeat = htmlspecialchars($_POST["passwordrepeat"], ENT_QUOTES, "UTF-8");

    // Instantiate the forgotPasswordController class
    include "../framework/databaseHandler.php";
    include "../controller/resetPasswordController.php";
    $reset = new resetPasswordController($selector, $validator, $password, $passwordrepeat);

    // Running server side validation, error handling and reset the password
    $reset->run();
} else {
    header("location: ../index.php");
}
