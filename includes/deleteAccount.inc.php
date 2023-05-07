<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the new data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $accountID = $_SESSION["auth_user"]["accountID"];
    $userConfirmNumbers = $_POST["userConfirmNumbers"];

    if ((int)$userConfirmNumbers !== $_SESSION["randomNumbers"]) {
        header("location: ../view/editAccount.php?confirm=fail");
        exit();
    }


    // Instantiate the accountDAO class
    include "../DAO/accountDAO.php";
    $accountDAO = new accountDAO();
    $accountDAO->delete($accountID);

    // Log user out
    // When logging out regenerate session id, unset session variables and destroy session to prevent session-fixation by malicious user
    session_start();
    session_regenerate_id();
    session_unset();
    session_destroy();


    // Redirect user to register page with success message
    header("location: ../view/signup.php?deleteAccount=success");
}
