<?php

// PHP script that grabs the data from the form
// Instantiates the Controller that runs the server side validations
// If there are no errors in the controller script redirect user 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");

    // Instantiate the forgotPasswordController class
    include "../framework/databaseHandler.php";
    include "../controller/forgotPasswordController.php";
    $forgot = new forgotPasswordController($email);

    // Running server side validation, error handling and reset the password
    $forgot->run();

    // Redirect user back to the front page when sucsessfull
    header("location: ../view/forgotPassword.php?forgot=success");
} else {
    header("location: ../index.php");
}
