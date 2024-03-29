<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\userProfileController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and form is submitted
if (isset($_SESSION["auth_user"]) && isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $accountID = $_SESSION["adminEditUserProfile"]["accountID"];
    $userProfileID = $_SESSION["adminEditUserProfile"]["userProfileID"];
    $firstName = htmlspecialchars($_POST["firstName"], ENT_QUOTES, "UTF-8");
    $lastName = htmlspecialchars($_POST["lastName"], ENT_QUOTES, "UTF-8");
    $city = htmlspecialchars($_POST["city"], ENT_QUOTES, "UTF-8");
    $country = htmlspecialchars($_POST["country"], ENT_QUOTES, "UTF-8");
    $phoneNumber = htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES, "UTF-8");
    $dateOfBirth = htmlspecialchars($_POST["dateOfBirth"], ENT_QUOTES, "UTF-8");

    // Use nl2br method to retain HTML line breaks
    $aboutMeTitle = nl2br(htmlspecialchars($_POST["aboutMeTitle"], ENT_QUOTES, "UTF-8"));
    $aboutMeText = nl2br(htmlspecialchars($_POST["aboutMeText"], ENT_QUOTES, "UTF-8"));

    // Instantiate the accountController class
    $userProfileController = new userProfileController($accountID, $userProfileID, $firstName, $lastName, $city, $country, $phoneNumber, $dateOfBirth, $aboutMeTitle, $aboutMeText);
    $userProfileController->adminEditUserProfile();

    // Redirect user back to his profile page when sucsessfull
    header("location: ../view/admin.php?view=adminEditUserProfile&userProfileID=" . $userProfileID . "&accountID=" . $accountID . "&error=none");
    exit();
} else {
    // Redirect user to the index page
    header("location: ../index.php");
    exit();
}
