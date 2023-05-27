<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\CSVController;

// Include script that handles the user pictures upload

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$accountID = $_SESSION["auth_user"]["email"];

if (isset($_POST["submit"])) {

    // Grab the data of the file
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileType = $_FILES["file"]["type"];
    $fileError = $_FILES["file"]["error"];

    $CSVController = new CSVController($accountID);
    $CSVController->uploadCSV($file);
}