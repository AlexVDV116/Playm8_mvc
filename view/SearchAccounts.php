<?php
require_once 'framework/View.php';
require_once 'model/Account.php';
require_once 'dao/accountDAO.php';

ini_set('display_errors', 1);


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
                            <td><?= '# ' . $account->getAccountID() ?></td>
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
