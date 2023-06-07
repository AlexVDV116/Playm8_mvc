<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on

use Controller\CSVController;
use Framework\View;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// adminImportCSV class that uses the CSVcontroller to read the CSV and echo the data in a HTML table
class adminImportCSV extends View
{

    public function show()
    {
        // Remove any old files from previous imports
        // Get all files in the directory and iterate over them
        $files = glob('../uploads/csv/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                // If the file creation date is older then now - 1 hours
                $file_creation_date = filectime($file);
                if (time() - filemtime($file) > 3600) {
                    // Delete the file
                    unlink($file);
                }
            }
        }
?>
        <div class="mb-4">
            <h4>Importeer CSV</h4>
        </div>
        <div>
            <p>Importeer een CSV bestand met tabel data om deze hier te weergeven. <br> Dit bestand kan vervolgens worden geupload naar de MySQL database.</p>
            <p>
            <ol><strong>Upload voorwaarden:</strong>
                <li>Gebruiker dient de rol van admin te hebben;</li>
                <li>Bestand moet een .csv extensie hebben;</li>
                <li>De eerste lijn van het .csv bestand <u>moet</u> de kollom namen in de juiste volgorde bevatten van de desbetreffende tabel;</li>
                <li>Records met een nieuwe primary key worden toegevoegd;</li>
                <li>Record met een reeds bestaande primary key worden geupdate.</li>
            </ol>
            </p>
        </div>
        <div class="col-4 mx-5 mt-4">
            <form action="../includes/adminImportCSV.inc.php" method="post" enctype="multipart/form-data">
                <input type="file" class="form-control form-control-sm" id="formFile" name="file">
                <input type="submit" class="form-control form-control-sm" name="submit" value="Importeer CSV">
            </form>
        </div>

        <?php
        if (isset($_GET['file'])) { // Check if a file was submitted
            $fileName = $_GET['file']; // Get the file name

            $accountID = $_SESSION["auth_user"]["accountID"];

            $CSVController = new CSVController($accountID);
            echo $CSVController->readCSV($fileName, true); // Set $header to true if you want to include the header row

        ?>
            <div class="d-flex justify-content-end">
                <!-- form that handles the submission of the serializeAccountsArray -->
                <form method='post' action='../includes/adminUploadCSVtoDB.inc.php'>
                    <input type='submit' class="btn btn-credits shadow-sm my-2" value='Upload CSV naar Database' name='exportSubmit'>
                    <input type="hidden" name="fileName" value="<?= $fileName ?>">
                </form>
            </div>
<?php
        }
        if (isset($_GET["upload"])) {
            if ($_GET["upload"] == "success") {
                echo '<br><p class="form-success"><i class="fa-solid fa-circle-exclamation"></i>' . $_GET["updates"] . ' Updates & ' . $_GET["inserts"] . ' Inserts succesvol geupload naar de database.</p>';
            }
        }
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "nomatchingheaders") {
                echo '<br><p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Headers matchen niet met kollom namen in de database.</p>';
            }
            if ($_GET["error"] == "insuffPerm") {
                echo '<br><p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onvoldoende permissie, contacteer een administrator.</p>';
            }
        }
    }
}
new adminImportCSV();
