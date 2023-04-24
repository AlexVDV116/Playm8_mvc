<?php

// An include file that runs a PHP script
// Gets the data from the email activation link trough the $GET method
// Uses this data to instantiate a accountDAO object
// Run the getUnverifiedAccount method to check if account exists in activation time bracket
// If activation has expired account will be removed, redirect user to signup page 
// Else activate account and return user to login page

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ((isset($_GET['email'])) && (isset($_GET['activationCode']))) {

    // Grabbing the data
    $email = $_GET['email'];
    $activationCode = $_GET['activationCode'];

    // Instantiate the betaFormController class
    include "../dao/accountDAO.php";

    // Instantiate a new accountDAO and use the getUnverifiedAccount method that either deletes the account if expired
    // or returns an associative array with the accountID, username and activationCode
    $accountDAO = new accountDAO();
    $user = $accountDAO->getUnverifiedAccount($email, $activationCode);

    // if user exists activate the user and redirect user to login page with a success message
    if ($user && $accountDAO->activateAccount($user['accountID'])) {
        header("location: ../view/login.php?activation=success");
    } else {
        header("location: ../view/signup.php?activation=fail");
    }
}
