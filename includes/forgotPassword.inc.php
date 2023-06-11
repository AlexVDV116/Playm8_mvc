<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\forgotPasswordController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PHP script that grabs the data from the form
// Instantiates the Controller that runs the server side validations
// If there are no errors in the controller script redirect user 

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
    exit();
} else {
    header("location: ../index.php");
    exit();
}
