<?php

// An include file that runs a PHP script
// Gets the data from the editAccount form trough the $_POST method
// Uses this data to instantiate a accountController object
// The accountController will run several server side validations
// If no errors return user to the index page with a success message

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the new data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $newUsername = htmlspecialchars($_POST["newUsername"], ENT_QUOTES, "UTF-8");
    $newEmail = htmlspecialchars($_POST["newEmail"], ENT_QUOTES, "UTF-8");
    $newPassword = htmlspecialchars($_POST["newPassword"], ENT_QUOTES, "UTF-8");
    $newPasswordrepeat = htmlspecialchars($_POST["newPasswordrepeat"], ENT_QUOTES, "UTF-8");
    $currentPassword = htmlspecialchars($_POST["currentPassword"], ENT_QUOTES, "UTF-8");

    // Grab the email adress from the session variable,
    // the editAccount method uses this to get the account from the DB so we can compare any changes made
    $email = $_SESSION["auth_user"]["email"];

    // Instantiate the accountController class
    include "../controller/accountController.php";
    $editAccount = new accountController($newUsername, $newEmail, $newPassword, $newPasswordrepeat);

    // Running server side validation, error handling and user sign up
    $editAccount->editAccount($email, $currentPassword);
}
