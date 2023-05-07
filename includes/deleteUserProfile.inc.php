<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
