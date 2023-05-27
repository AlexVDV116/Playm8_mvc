<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\accountDAO;

// listAccounts class that lists all accounts in the accounts table and gives the administrator the option to edit each one of them

class listBetaTesters extends View
{

    public function show()
    {
        $accountDAO = new accountDAO();
        $betaCount = $accountDAO->getBetaCount();
        $accountDAO->startListBeta();

        if (isset($_GET["addBeta"])) {
            if ($_GET["addBeta"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Account succesvol verwijderd.</p>';
            }
        }
        if (isset($_GET["removeBeta"])) {
            if ($_GET["removeBeta"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Account succesvol toegevoegd.</p>';
            }
        }
?>
        <div class="mb-4">
            <h4>Beta accounts</h4>
        </div>
        <div>
            <p>Total number of beta users: <?= $betaCount ?></p>
        </div>

        <div class="class-responsive">
            <table class="table table-striped table-sm table-hover">
                <thead>
                    <tr>
                        <th>Account ID</th>
                        <th>Userprofile ID</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Actief</th>
                        <th>Beta-user</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($accountDAO->hasNext()) {
                        $account = $accountDAO->getNext();
                    ?>
                        <tr onclick="">
                            <!-- PHP shorthand to echo the data in the table -->
                            <td><?= "# " . $account->get("accountID") ?></td>
                            <td><?= '# ' . $account->get("userProfileID") ?></td>
                            <td><?= $account->get("username") ?></td>
                            <td><?= $account->get("email") ?></td>
                            <td><?php if ($account->get("isActive")) {
                                    echo 'Ja';
                                } else {
                                    echo 'Nee';
                                } ?></td>
                            <td><?php if ($account->get("isBetaUser")) {
                                    echo 'Ja';
                                } else {
                                    echo 'Nee';
                                } ?>
                            <td><?= "<a href ='../view/admin.php?view=adminEditAccount&account=" . $account->get("email") . "'>Wijzig" ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <!-- form that handles the submission of the serializeAccountsArray -->
                <form method='post' action='../includes/adminExportCSV.inc.php'>
                    <input type='submit' class="btn btn-credits shadow-sm my-2" value='Exporteer CSV' name='Export'>
                    <input type="hidden" name="fileName" value="betaTesters.csv">
                </form>
            </div>
        </div>
<?php
    }
}
new listBetaTesters();
