<?php

require_once 'framework/View.php';
require_once 'model/Account.php';
require_once 'dao/accountDAO.php';

class ListAccounts extends View
{

    public function show()
    {
        $accountDAO = new accountDAO;
        $result = $accountDAO->getCount("accounts");
        $accountDAO->startList();
?>
        <div>
            <p>Total number of accounts: <?= $result ?></p>
        </div>

        <div class="class-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Account ID</th>
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
                            <td><?= '# ' . $account->getAccountID() ?></td>
                            <td><?= $account->getName() ?></td>
                            <td><?= $account->getEmail() ?></td>
                            <td><?php if ($account->getEnabled()) {
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
new ListAccounts;
