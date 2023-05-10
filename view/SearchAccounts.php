<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\accountDAO;

// searchAccounts class that handles the admin func search of users in the database and allows him to edit that user account

class searchAccounts extends View
{

    public function show()
    {
        $accountDAO = new accountDAO;
        if (isset($_POST['search'])) { // Check if form was submitted

            $search = $_POST['search']; // Get input text
            $accountDAO->startSearch($search);
        }
?>
        <div>
            <h4>Zoek account</h4>
            <p>
                Voer een accountnaam of email in om te zoeken:
            </p>
        </div>

        <div class="form-group d-flex justify-content-end">
            <form action="#" method="post">
                <input class="rounded form-control-sm" type="text" name="search" placeholder="Zoek Accounts">
                <button type="submit" class="btn btn-credits shadow-sm my-2">Search</button>
            </form>
        </div>

        <?php
        if ($accountDAO->hasNext()) { ?>
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
                }
                    ?>
                    <?php
                    while ($accountDAO->hasNext()) {
                        $account = $accountDAO->getNext();
                    ?>
                        <tr onclick="">
                            <!-- PHP shorthand to echo the data in the table -->
                            <td><?= "# " . "<a href ='../view/admin.php?view=adminEditAccount&account=" . $account->getEmail() . "'>" . $account->getAccountID() ?></td>
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
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    <?php
    }
}
new searchAccounts;
