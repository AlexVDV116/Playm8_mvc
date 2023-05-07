<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    header("location: ../view/editUserProfile.php?createUserProfile=fail");
}
