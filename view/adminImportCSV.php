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

// listAccounts class that lists all accounts in the accounts table and gives the administrator the option to edit each one of them
class adminImportCSV extends View
{

    public function show()
    {

?>
        <div class="mb-4">
            <h4>Importeer CSV</h4>
        </div>
        <div>
            <p>Importeer een CSV bestand met tabel data om deze hier te weergeven. <br> Dit bestand kan vervolgens geupload worden naar ede MySQL database.</p>
        </div>
        <div class="col-4 mx-5">
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
                    <input type='submit' class="btn btn-credits shadow-sm my-2" value='Upload CSV naar Database' name='Export'>
                    <input type="hidden" name="fileName" value="<?= $fileName ?>">
                </form>
            </div>
<?php
        }
    }
}
new adminImportCSV();
