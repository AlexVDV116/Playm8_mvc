<?php

// Define the namespace of this class
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Controller\roleController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["submit"])) {

    // Grabbing the new data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $roleID = $_POST["roleID"];
    $adminEmail = $_SESSION["auth_user"]["email"];
    $adminPassword = $_POST["form_adminPassword"];

    // Instantiate the roleController class
    $roleController = new roleController();
    $roleController->adminDeleterole($roleID, $adminEmail, $adminPassword);
}
