<?php
require_once 'framework/View.php';
require_once 'model/Account.php';
require_once 'dao/accountDAO.php';

session_start();

ini_set('display_errors', 1);
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0 clients (IE6 / pre 1997)
header("Expires: 0"); // HTTP 1.0 Proxies

/**
 * @property Account $account
 */
class ListAccounts extends View
{

    public function show()
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
                        <th>Beta</th>
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
                            <td><?= $account->getBetaUser() ?></td>
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
