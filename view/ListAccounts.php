<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\accountDAO;

// listAccounts class that lists all accounts in the accounts table and gives the administrator the option to edit each one of them

class listAccounts extends View
{

    public function show()
    {
        $accountDAO = new accountDAO();
        $accountsCount = $accountDAO->getCount("accounts");
        $accountDAO->startList();

        if (isset($_GET["addAccount"])) {
            if ($_GET["addAccount"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Account succesvol toegevoegd.</p>';
            }
        }
        if (isset($_GET["deleteAccount"])) {
            if ($_GET["deleteAccount"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Account succesvol verwijderd.</p>';
            }
        }
        if (isset($_GET["deleteUserProfile"])) {
            if ($_GET["deleteUserProfile"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Gebruikersprofiel succesvol verwijderd.</p>';
            }
        }
?>
        <div>
            <p>Aantal gebruikersaccounts: <?= $accountsCount ?></p>
        </div>

        <div class="class-responsive">
            <table class="table table-striped table-sm">
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
                            <td><?= "# " . "<a href ='../view/admin.php?view=adminEditAccount&account=" . $account->get("email") . "'>" . $account->get("accountID") ?></td>
                            <td><?= "<a href ='../view/admin.php?view=adminEditUserProfile&userProfileID=" . $account->get("userProfileID") . "&accountID=" . $account->get("accountID") . "'>" . $account->get("userProfileID") . "</a>" ?></td>
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
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="7"><a href="../view/admin.php?view=adminAddAccount" class="no-underline"><i class="fa-solid fa-plus"></i> Voeg een account toe</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
<?php
    }
}
new listAccounts();
