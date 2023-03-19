<?php
require_once 'framework/View.php';
require_once 'model/Account.php';
require_once 'dao/accountDAO.php';

ini_set('display_errors', 1);


class SearchAccounts extends View
{

    public function show()
    {
        $accountDAO = new accountDAO;
        $result = $accountDAO->getCount("accounts");
        if (isset($_POST['search'])) { // Check if form was submitted

            $search = $_POST['search']; // Get input text
            $accountDAO->startSearch($search);
        }
?>
        <form action="#" method="post">
            Search <input type="text" name="search">
            <input type="submit">
        </form>

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
                            <td><?= '# ' . $account->getAccountID() ?></td>
                            <td><?= $account->getName() ?></td>
                            <td><?= $account->getEmail() ?></td>
                            <td><?php if ($account->getEnabled()) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                } ?></td>
                            <td><?php if ($account->getBetaUser()) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
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
new SearchAccounts;
