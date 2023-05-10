<?php

// Define the namespace of this class
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this script depends on
use DAO\accountDAO;

// An include file that runs a PHP script
// Gets the data from the email activation link trough the $GET method
// Uses this data to instantiate a accountDAO object
// Run the getUnverifiedAccount method to check if account exists in activation time bracket
// If activation has expired account will be removed, redirect user to signup page 
// Else activate account and return user to login page

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

    // If a $user is returned by the getUnverifiedAccount method
    // activate the account using the activateAccount method and redirect user with success message
    if ($user && $accountDAO->activateAccount($user['accountID'])) {
        header("location: ../view/login.php?activation=success");
    } else {
        header("location: ../view/signup.php?activation=fail");
    }
}
