<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this script depends on
use Model\userProfile;
use DAO\userProfileDAO;

session_start();

if ($_SESSION["auth_user"]["userProfileID"] !== "test") {

    $accountID = $_SESSION["auth_user"]["accountID"];
    $userProfileID = "UID" . substr($accountID, 3);
    $_SESSION["auth_user"]["userProfileID"] = $userProfileID;

    $data = array(
        "accountID" => $accountID,
        "userProfileID" => $userProfileID,
        "firstName" => "",
        "lastName" => "",
        "city" => "",
        "country" => "",
        "phoneNumber" => "",
        "dateOfBirth" => "1970/01/01",
        "age" => "0",
        "aboutMeTitle" => "",
        "aboutMeText" => "",
        "userProfilePicture" => "default"
    );

    // Create a new userProfile object 
    include "../model/userProfile.php";
    $userProfile = new userProfile($data);

    include "../DAO/userProfileDAO.php";
    $userProfileDAO = new userProfileDAO;
    $userProfileDAO->setUserProfileInfo($userProfile);

    header("location: ../view/editUserProfile.php?createUserProfile=success");
} else {
    header("location: ../index.php?createUserProfile=fail");
}
