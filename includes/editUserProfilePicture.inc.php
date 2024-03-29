<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\profilePictureController;

// Include script that handles the user pictures upload

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userProfileID = $_SESSION["auth_user"]["userProfileID"];

if (isset($_POST["submit"])) {

    // Grab the data of the file
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileType = $_FILES["file"]["type"];
    $fileError = $_FILES["file"]["error"];

    $profilePictureController = new profilePictureController($userProfileID, $file);
    $profilePictureController->run();
}
