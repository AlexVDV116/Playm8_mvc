<?php

require_once '../framework/DAO.php';
require_once '../model/Account.php';

// This class interacts with the database to check if the given credentials match the ones in the database
// It uses prepared statements to prevent SQL injection
// After checking if the password hash and email match it logs in the user and starts a session
class loginDAO extends DAO
{
    private static $select = 'SELECT * FROM `accounts`';

    public function __construct()
    {
        parent::__construct('Account');
    }

    // Check database if given user credentials match database  
    public function getUser($email, $password): void
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // If query gets no result exit script and redirect user to index with error message
        if (!$result) {
            header("location: ../index.php?error=accountnotfound");
            exit();
        } else {
        }

        // use PHP built in method to check if the given password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($password, $result[0]["account_password"]);

        // If the password match
        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            // Prepared satement that selects all rows in the accounts table where user credentials match the given credentials
            $stmt = $this->prepare('SELECT * FROM accounts WHERE account_email = ? AND account_password = ?;');

            // If they do not match, set statement to null and redirect user to index with error message
            if (!$stmt->execute(array($email, $result[0]["account_password"]))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit;
            }

            // Before logging in the user i want to check if the database query retrieves any results
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=accountnotfound2");
                exit();
            }

            // Log user in
            // Create a user variable with the results from the statement and return these results in an associative array
            // This user variable thus contains all data from the database belonging to the account
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);


            // Create a new session with a session super global of accountid and account_username
            session_start();
            // Regenerate session id to prevent session fixation-by malicious user
            session_regenerate_id();
            $_SESSION["account_id"] = $user[0]["account_id"];
            $_SESSION["account_username"] = $user[0]["account_username"];
        }

        $stmt = null;
    }
}
