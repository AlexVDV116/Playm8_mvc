<?php
require_once 'framework/View.php';
require_once 'model/Account.php';
require_once 'dao/accountDAO.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * @property Account $account
 */
class ListAccounts extends View
{

    function show()
    {
        $accountDAO = new accountDAO;
        $accountDAO->startList();
?>

        <div class="class-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Account ID</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Enabled</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($accountDAO->hasNext()) {
                        $account = $accountDAO->getNext();
                    ?>
                        <tr onclick="">
                            <!-- PHP shorthand to echo the data in the table -->
                            <td><?= $account->getAccountID() ?></td>
                            <td><?= $account->getName() ?></td>
                            <td><?= $account->getEmail() ?></td>
                            <td><?= $account->getEnabled() ?></td>
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
