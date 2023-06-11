<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\profilePictureController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include script that handles the user pictures upload
$userProfileID = $_SESSION["adminEditUserProfile"]["userProfileID"];

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
