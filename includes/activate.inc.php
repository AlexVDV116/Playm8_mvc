<?php

// An include file that runs a PHP script
// Gets the data from the betaform trough the $_POST method
// Uses this data to instantiate a betaFormController object
// The betaFormController will run several server side validations
// If no errors return user to the index.php with a success message

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ((isset($_GET['email'])) && (isset($_GET['activation_code']))) {

    // Grabbing the data
    $email = $_GET['email'];
    $activationCode = $_GET['activation_code'];

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
