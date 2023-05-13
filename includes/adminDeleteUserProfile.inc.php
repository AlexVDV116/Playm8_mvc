<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this script depends on
use DAO\userProfileDAO;
use DAO\accountDAO;

session_start();

if (isset($_POST["submit"])) {

    // Grabbing the new data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $userProfileID =  $_SESSION["adminEditUserProfile"]["userProfileID"];
    $adminEmail = $_SESSION["auth_user"]["email"];
    $adminPassword = $_POST["adminPassword"];

    // Grab the account from the DB
    $accountDAO = new AccountDAO;
    $adminAccount = $accountDAO->get($adminEmail);

    // use PHP built in method to check if the given admin password matches the hashed password stored in the DB (returns bool)
    $checkPwd = password_verify($adminPassword, $adminAccount->getPassword());

    // If the password match
    if ($checkPwd == false) {
        // echo "Onjuist wachtwoord.";
        header("location: ../view/admin.php?view=adminEditUserProfile&userProfileID=" . $userProfileID . "&error=wrongpassword");
        exit();
    } elseif ($checkPwd == true) {

        // Instantiate the accountDAO class
        $userProfileDAO = new userProfileDAO();
        $userProfileDAO->deleteUserProfile($userProfileID);

        // Redirect user to index page with success message
        header("location: ../view/admin.php?view=listAccounts&deleteUserProfile=success");
    }
}
