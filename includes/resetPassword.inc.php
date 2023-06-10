<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\resetPasswordController;

// Include script that handles user input when resetting the password
// Instantiaties a resetPasswordController with the user input as parameters

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

    // Redirect user back to the front page when sucsessfull
    header("location: ../view/login.php?reset=success");
    exit();
} else {
    header("location: ../index.php");
    exit();
}
