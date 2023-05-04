<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in and form is submitted
if (isset($_SESSION["auth_user"]) && isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $accountID = $_SESSION["auth_user"]["accountID"];
    $userProfileID = substr_replace($accountID, 'UID', 0, 3);
    $firstName = htmlspecialchars($_POST["firstName"], ENT_QUOTES, "UTF-8");
    $lastName = htmlspecialchars($_POST["lastName"], ENT_QUOTES, "UTF-8");
    $city = htmlspecialchars($_POST["city"], ENT_QUOTES, "UTF-8");
    $country = htmlspecialchars($_POST["country"], ENT_QUOTES, "UTF-8");
    $phoneNumber = htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES, "UTF-8");
    $dateOfBirth = htmlspecialchars($_POST["dateOfBirth"], ENT_QUOTES, "UTF-8");
    $aboutMeTitle = htmlspecialchars($_POST["aboutMeTitle"], ENT_QUOTES, "UTF-8");
    $aboutMeText = htmlspecialchars($_POST["aboutMeText"], ENT_QUOTES, "UTF-8");

    // Update the session variables to contain the new userProfileID
    $_SESSION["auth_user"]['userProfileID'] = $userProfileID;

    // Instantiate the accountController class
    include "../controller/userProfileController.php";
    $userProfileController = new userProfileController($accountID, $userProfileID, $firstName, $lastName, $city, $country, $phoneNumber, $dateOfBirth, $aboutMeTitle, $aboutMeText);
    $userProfileController->run();

    // Redirect user back to his profile page when sucsessfull
    header("location: ../view/userProfilePage.php");
} else {
    // Redirect user to the index page
    header("location: ../index.php");
    exit();
}
