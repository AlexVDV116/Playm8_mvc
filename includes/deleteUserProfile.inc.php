<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this script depends on
use DAO\userProfileDAO;

session_start();

if (isset($_POST["submit"])) {

    // Grabbing the new data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $userProfileID = $_SESSION["auth_user"]["userProfileID"];
    $userConfirmNumbers = $_POST["userConfirmNumbers"];

    if ((int)$userConfirmNumbers !== $_SESSION["randomNumbers"]) {
        header("location: ../view/editUserProfile.php?confirm=fail");
        exit();
    }


    // Instantiate the accountDAO class
    include "../DAO/userProfileDAO.php";
    $userProfileDAO = new userProfileDAO();
    $userProfileDAO->deleteUserProfile($userProfileID);

    // Set the session variable containing the userProfileID to NULL
    $_SESSION["auth_user"]["userProfileID"] = NULL;
    unset($_SESSION["randomNumbers"]);

    // Redirect user to index page with success message
    header("location: ../index.php?deleteUserProfile=success");
}
