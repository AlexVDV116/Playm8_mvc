<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\loginController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// An include file that runs a PHP script
// Gets the data from the loginform trough the $_POST method
// Uses this data to instantiate a loginController object
// The loginController will run several server side validations
// If no errors return user to the index.php with a success message

if (isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");

    // Instantiate the LoginCont class
    include "../framework/databaseHandler.php";
    include "../controller/loginController.php";
    $login = new LoginController($email, $password);

    // Running server side validation, error handling and login user
    $login->run();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php");
    exit();
}
