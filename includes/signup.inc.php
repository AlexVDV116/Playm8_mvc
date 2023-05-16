<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\accountController;

// Include script that gets the data from the signup form trough the $_POST method
// Uses this data to instantiate a accountController object
// The accountController will run several server side validations
// If no errors return user to the signup.php with a success message

session_start();

if (isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
    $passwordrepeat = htmlspecialchars($_POST["passwordrepeat"], ENT_QUOTES, "UTF-8");

    // Assign session variables to retain form values for username and password after error handling
    $_SESSION['signup_form']['username'] = $username;
    $_SESSION['signup_form']['email'] = $email;

    // Instantiate the accountController class
    $accountController = new accountController($username, $email, $password, $passwordrepeat);

    // Running server side validation, error handling and user sign up
    if ($accountController->run() === true) {
        $accountController->addAccount();
    }

    // Redirect user back to the front page when sucsessfull
    header("location: ../view/login.php?error=none");
    unset($_SESSION['signup_form']);
}
