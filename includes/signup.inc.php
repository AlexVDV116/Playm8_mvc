<?php

// An include file that runs a PHP script
// Gets the data from the signup form trough the $_POST method
// Uses this data to instantiate a accountController object
// The accountController will run several server side validations
// If no errors return user to the signup.php with a success message

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordrepeat = $_POST["passwordrepeat"];
    $enabled = true;

    // Assign session variables to retain form values for username and password after error handling
    $_SESSION['signup_form']['username'] = $username;
    $_SESSION['signup_form']['email'] = $email;

    // Instantiate the accountController class
    include "../framework/databaseHandler.php";
    include "../dao/accountDAO.php";
    include "../controller/accountController.php";
    $signup = new accountController($username, $email, $password, $passwordrepeat, $enabled);

    // Running server side validation, error handling and user sign up
    $signup->run();

    // Redirect user back to the front page when sucsessfull
    header("location: ../view/login.php?error=none");
    unset($_SESSION['signup_form']);
}
