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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$accountID = $_SESSION["auth_user"]["email"];

if (isset($_POST["exportSubmit"])) {

    // Grab the data of the file
    $fileName = $_POST["fileName"];
    $filePath = '../uploads/csv/' . $fileName;

    $CSVController = new CSVController($accountID);
    $CSVController->uploadCSV($filePath);
}
