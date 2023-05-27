<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on

use DAO\accountDAO;
use Framework\Controller;

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

    public function uploadCSV(array $file): void
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
                // // File error is not equal to 0, redirect with role dependent error message
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

    function readCSV($fileName, $header = false): string
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

            // Close and delete the file
            fclose($handle);
            unlink($filePath);
        } else {
            $error = "File not found.";
            return $error;
        }
        return $html;
    }
}
