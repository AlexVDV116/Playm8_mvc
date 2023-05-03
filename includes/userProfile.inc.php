<?php

// Check if user has created a userProfile
// If true, retrieve data from database and create userProfile page
// If false redirect user to userProfile creation page

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// If the user access this script trough the editUserProfile.php
if (isset($_SESSION["auth_user"]) && isset($_POST["submit"])) {

    // Grabbing the data 
    $accountID = $_SESSION["auth_user"]["accountID"];
    $userProfileID = substr_replace($accountID, 'UID', 0, 3);
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $phoneNumber = $_POST["phoneNumber"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $aboutMeTitle = $_POST["aboutMeTitle"];
    $aboutMeText = $_POST["aboutMeText"];

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
