<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\accountDAO;

// listAccounts class that lists all accounts in the accounts table and gives the administrator the option to edit each one of them

class listAccounts extends View
{

    public function show()
    {
        $accountDAO = new accountDAO;
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
?>
        <div>
            <p>Total number of accounts: <?= $accountsCount ?></p>
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
                            <td><?= "# " . $account->getAccountID() ?></td>
                            <td><?= '# ' . $account->getUserProfileID() ?></td>
                            <td><?= $account->getUsername() ?></td>
                            <td><?= $account->getEmail() ?></td>
                            <td><?php if ($account->getActive()) {
                                    echo 'Ja';
                                } else {
                                    echo 'Nee';
                                } ?></td>
                            <td><?php if ($account->getBetaUser()) {
                                    echo 'Ja';
                                } else {
                                    echo 'Nee';
                                } ?>
                            <td><?= "<a href ='../view/admin.php?view=adminEditAccount&account=" . $account->getEmail() . "'>Wijzig" ?></td>
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
new listAccounts;
