<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on

use DAO\accountDAO;
use DAO\permissionDAO;
use DAO\roleDAO;

use Framework\Controller;
use Framework\databaseHandler;

use Model\Account;
use Model\Permission;
use Model\Role;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Controller class that handles user input when registering as a beta user
// Connects to the database trough an instance of the accountDAO class

class CSVController extends Controller
{
    private string $accountID;
    private string $fileName;
    private string $fileTmpName;
    private int $fileSize;
    private string $fileType;
    private string $fileError;


    public function __construct(string $accountID)
    {
        $this->accountID = $accountID;
    }

    public function run(): void
    {
        return;
    }

    public function importCSV(array $file): void
    {
        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileType = $file["type"];
        $fileError = $file["error"];

        // Grab the extension of the file
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = ["csv"];
        $time = time();

        // Grab the admin account
        $accountDAO = new accountDAO();
        $accountDAO = $accountDAO->get($this->accountID);

        // Check if file extension is allowed else redirect with error message
        if (in_array($fileActualExt, $allowedExt)) {
            // Check if an error occuroed while uploading
            if ($fileError == 0) {
                // Check if the file size is less then 5 megabytes
                if ($fileSize < 5120000) {
                    // Generate an unique file name and concat with file extentsion
                    // Add time in second since 1970 to generate a unique file name in order to force browser to recache/download image
                    $fileNameNew = "adminCSV_" . $this->accountID . "_" . $time . "." . $fileActualExt;
                    $fileDest = '../uploads/csv/' . $fileNameNew;

                    // Move the file from the tmp location to the uploads folder
                    // If you run this using XAMPP make sure the Apache process owner has read/write permission to your file destination folder
                    move_uploaded_file($fileTmpName, $fileDest);

                    // Redirect user with success message
                    header("location: ../view/admin.php?view=adminImportCSV&file=" . $fileNameNew);
                    exit();

                    // Filesize greater then allowed, redirect with error message
                } else {
                    header("location: ../view/admin.php?view=adminImportCSV&error=filesize");
                    exit();
                }
                // File error is not equal to 0, redirect with role dependent error message
            } else {
                header("location: ../view/admin.php?view=adminImportCSV&error=" . $fileError);
                exit();
            }
            // File extension not allowed, redirect with role dependent error message
        } else {
            header("location: ../view/admin.php?view=adminImportCSV&error=fileextnotallowed");
            exit();
        }
    }

    public function readCSV($fileName, $header = false): string
    {
        $filePath = "../uploads/csv/" . $fileName;
        $html = '<div class="table-responsive mt-5"><table class="table table-sm table-striped table-bordered table-hover">';

        if (!file_exists($filePath)) {
            return '<p class="form-error mt-2"><i class="fa-solid fa-circle-exclamation"></i> Bestand niet gevonden, probeer opnieuw.</p>';
        } elseif (($handle = fopen($filePath, "r")) !== false) {
            if ($header) {
                $csvcontents = fgetcsv($handle);
                $html .= '<tr>';
                foreach ($csvcontents as $headercolumn) {
                    $html .= "<th style='color:#d6004a'>" . htmlspecialchars($headercolumn) . "</th>";
                }
                $html .= '</tr>';
            }

            while (($csvcontents = fgetcsv($handle)) !== false) {
                $html .= '<tr>';
                foreach ($csvcontents as $column) {
                    $html .= "<td style='width:1px; white-space:nowrap;'>" . htmlspecialchars($column) . "</td>";
                }
                $html .= '</tr>';
            }

            $html .= '</table></div>';

            // Close the file, but keep it in its directory in case user wants to upload to DB
            // Files older then 2 hours get deleted adminImportCSV.php runs
            fclose($handle);
        } else {
            $error = "File not found.";
            return $error;
        }
        return $html;
    }

    public function uploadCSV($filePath): void
    {
        // Check if user is logged in if false redirect to index page else check if user has the correct admin role
        if (!in_array(3, $_SESSION["auth_role"])) {
            // Redirect user back to the importcsv page with error message
            header("location: ../view/admin.php?view=adminimportcsv&error=insuffPerm");
            exit();
        }

        // Get all database tables
        $dbHeaders = [];
        $dbh = new databaseHandler();
        $tables = $dbh->getAllTables();

        // For each table in the database get the collum names and add these collum names to the array as the value
        // IMPORTANT: Change database name in databaseHandler getAllCollumns class to match webhost/localhost database name
        foreach ($tables as $table) {
            $tableName = $table[0];
            $collumns = $dbh->getAllCollumns($tableName);
            $dbHeaders[$tableName] = [];
            foreach ($collumns as $collumn) {
                array_push($dbHeaders[$tableName], $collumn[0]);
            }
        }

        // Open uploaded CSV file with read-only mode
        $handle = fopen($filePath, 'r') or
            header("location: ../view/admin.php?view=adminimportcsv&error=cannotopenfile&file=" . $filePath);

        // Check if the headers on the first row of the CSV file match the exact collum names of the tables in our DB
        $csvHeaders = fgetcsv($handle);

        // If the headers match the collumn names of one of our tables
        // Instantiate the right DAO depending on the table being uploaded
        if ($csvHeaders === $dbHeaders['accounts']) {
            $accountDAO = new accountDAO;
            $updates = 0;
            $inserts = 0;

            // Parse data from CSV file line by line        
            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                // Skip any blank lines (fgetcsv returns empty lines as an non-empty array with a NULL element inside)
                if ($getData[0] == NULL) {
                    continue;
                }

                // Generate an associative array containing the data from the csv file
                $data = array(
                    "accountID" => $getData[0],
                    "username" => $getData[1],
                    "email" => $getData[2],
                    "password" => $getData[3],
                    "isBetaUser" => $getData[4],
                    "isActive" => $getData[5],
                    "activationCode" => $getData[6],
                    "activationExpiry" => $getData[7],
                    "activatedAt" => $getData[8]
                );

                // Create a new empty Account object with the user data
                $account = new Account($data);

                // Check if that accountID already exists, if true update the account, else insert a new record
                if ($accountDAO->knownAccountID($getData[0])) {
                    $accountDAO->update($account);
                    $updates += 1;
                } else {
                    $accountDAO->insert($account);
                    $inserts += 1;
                }
            }
            // Close and delete opened CSV file and redirect user with success message
            fclose($handle);
            unlink($filePath);
            header("location: ../view/admin.php?view=adminImportCSV&upload=success&updates=" . $updates . "&inserts=" . $inserts);
            exit();
        } elseif ($csvHeaders === $dbHeaders['permissions']) {
            $permissionDAO = new permissionDAO;
            $updates = 0;
            $inserts = 0;

            // Parse data from CSV file line by line        
            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                // Skip any blank lines (fgetcsv returns empty lines as an non-empty array with a NULL element inside)
                if ($getData[0] == NULL) {
                    continue;
                }

                // Generate an associative array containing the data from the csv file
                $data = array(
                    "permissionID" => $getData[0],
                    "permissionName" => $getData[1],
                    "permissionDescription" => $getData[2],
                );

                // Create a new empty Account object with the user data
                $permission = new permission($data);

                // Check if that permissionID already exists, if true update the account, else insert a new record
                if ($permissionDAO->knownPermissionID($getData[0])) {
                    $permissionDAO->update($permission);
                    $updates += 1;
                } else {
                    $permissionDAO->insertNewPermission($permission);
                    $inserts += 1;
                }
            }
            // Close and delete opened CSV file and redirect user with success message
            fclose($handle);
            unlink($filePath);
            header("location: ../view/admin.php?view=adminImportCSV&upload=success&updates=" . $updates . "&inserts=" . $inserts);
            exit();
        } elseif ($csvHeaders === $dbHeaders['roles']) {
            $roleDAO = new roleDAO;
            $updates = 0;
            $inserts = 0;

            // Parse data from CSV file line by line        
            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                // Skip any blank lines (fgetcsv returns empty lines as an non-empty array with a NULL element inside)
                if ($getData[0] == NULL) {
                    continue;
                }

                // Generate an associative array containing the data from the csv file
                $data = array(
                    "roleID" => $getData[0],
                    "roleName" => $getData[1],
                    "roleDescription" => $getData[2],
                );

                // Create a new empty Account object with the user data
                $role = new role($data);

                // Check if that permissionID already exists, if true update the account, else insert a new record
                if ($roleDAO->knownRoleID($getData[0])) {
                    $roleDAO->update($role);
                    $updates += 1;
                } else {
                    $roleDAO->insertNewRole($role);
                    $inserts += 1;
                }
            }
            // Close and delete opened CSV file and redirect user with success message
            fclose($handle);
            unlink($filePath);
            header("location: ../view/admin.php?view=adminImportCSV&upload=success&updates=" . $updates . "&inserts=" . $inserts);
            exit();
        } else {
            // Generate error message
            fclose($handle);
            unlink($filePath);
            header("location: ../view/admin.php?view=adminImportCSV&error=nomatchingheaders");
            exit();
        }
    }
}
