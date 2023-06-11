<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use DAO\accountDAO;
use DAO\roleDAO;
use DAO\permissionDAO;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Grab the filename from the form
$fileName = $_POST["fileName"];

// Check which CSV export was requested, instantiate the DAO accordingly to retrieve the correct tableData
if ($fileName === "accounts.csv") {
    $accountDAO = new accountDAO;
    $tableData = $accountDAO->getAllAccounts();
} elseif ($fileName === "roles.csv") {
    $roleDAO = new roleDAO;
    $tableData = $roleDAO->getAllRoles();
} elseif ($fileName === "permissions.csv") {
    $permissionDAO = new permissionDAO;
    $tableData = $permissionDAO->getAllPermissions();
} elseif ($fileName === "betaTesters.csv") {
    $accountDAO = new accountDAO;
    $tableData = $accountDAO->getAllBetaUsers();
} elseif ($fileName === "search.csv") {
    $accountDAO = new accountDAO;
    $search = $_POST["search"];
    $tableData = $accountDAO->startSearch($search);
}

// Grab the table headers from the associative array and move them to the front of the array
array_unshift($tableData, array_keys($tableData[0]));

// Set the response header to specify that the file should be downloaded as an attachment
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=" . $fileName);

// Set the content type to CSV
header("Content-Type: application/csv; ");

// Open a file handle that writes to the output buffer instead of creating a actual file 
$file = fopen('php://output', "w") or
    header("location: ../view/admin.php?view=home&error=cannotopenfile&file=" . $fileName);

// For each line in our multidimensional array containing our account data
// Format this line as CSV data and write to file
foreach ($tableData as $line) {
    fputcsv($file, $line);
}

// Close the file
fclose($file);

// Download the file
readfile('php://output');

exit();
