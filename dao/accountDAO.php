<?php

// Data Abstraction Object for an Account object
// Can access the database create, read, update, or delete data (CRUD)

require_once '../framework/DAO.php';
require_once '../model/Account.php';

class accountDAO extends DAO
{

    private static $select = 'SELECT * FROM `accounts`';

    public function __construct()
    {
        parent::__construct('Account');
    }

    // Method that checks if the account exists in our database
    // If true, check if password matches the hashed password in our database
    // If true log user in 
    public function logInUser($email, $password): void
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // If query gets no result exit script and redirect user to index with error message
        if (!$result) {
            // echo "Onbekend e-mailadres..";
            header("location: ../view/login.php?error=accountnotfound");
            exit();
        } else {
        }

        // use PHP built in method to check if the given password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($password, $result[0]["account_password"]);

        // If the password match
        if ($checkPwd == false) {
            $stmt = null;
            // echo "Onjuist wachtwoord.";
            header("location: ../view/login.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            // Prepared satement that selects all rows in the accounts table where user credentials match the given credentials
            $stmt = $this->prepare('SELECT * FROM accounts WHERE account_email = ? AND account_password = ?;');

            // If they do not match, set statement to null and redirect user to index with error message
            if (!$stmt->execute(array($email, $result[0]["account_password"]))) {
                $stmt = null;
                // echo "Onjuist wachtwoord.";
                header("location: ../view/login.php?error=wrongpassword");
                exit;
            }

            // Before logging in the user check if the database query retrieves any results
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../view/login.php?error=accountnotfound");
                exit();
            }

            // Log user in
            // Create a user variable with the results from the statement and return these results in an associative array
            // This user variable now contains all data from the database belonging to the account
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

    // Select all records from accounts table and order them by account_id
    public function startList(): void
    {
        $sql = self::$select;
        $sql .= ' ORDER BY `accounts`.`account_id`';
        $this->startListSql($sql);
    }

    // Returns a new Account object if no email provided
    // Else select all records from accounts table where the email mathes the given email
    // Returns an instance of the Account model with the property names set to the data from the selected record
    public function get(?string $account_email)
    {
        if (empty($account_email)) {
            return new Account;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `accounts`.`account_email` = ?';
            return $this->getObjectSql($sql, [$account_email]);
        }
    }

    // Deletes a the record from the accounts table where the account_id matches
    public function delete(int $account_id): void
    {
        $sql = 'DELETE FROM `accounts` '
            . ' WHERE `accounts_id` = ?';
        $args = [
            $account_id
        ];
        $this->execute($sql, $args);
    }

    // Inserts a new record into the accounts table with the data from Account object
    public function insert(Account $account): void
    {
        $sql = 'INSERT INTO `accounts` '
            . ' (account_username, account_email, account_password)'
            . ' VALUES (?, ?, ?)';
        $args = [
            $account->getName(),
            $account->getEmail(),
            $account->getPassword()
        ];
        $this->execute($sql, $args);
    }

    // Updates the record in the accounts table with the data from the Account object
    public function update(Account $account): void
    {
        $sql = 'UPDATE `accounts` '
            . ' SET account_username = ?, account_email = ?, account_enabled = ?, account_beta_user = ?'
            . ' WHERE account_id = ?';
        $args = [
            $account->getName(),
            $account->getEmail(),
            $account->getEnabled(),
            $account->getBetaUser(),
            $account->getAccountID()
        ];
        $this->execute($sql, $args);
    }

    // ...
    public function save(Account $account): void
    {
        if (empty($account->getAccountID())) {
            $this->insert($account);
        } else {
            $this->update($account);
        }
    }

    // Select all records with a matchin e-mailadress: return true if a row is returned
    public function knownEmail(string $account_email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ?");
        $stmt->execute([$account_email]);
        $result = $stmt->fetch();

        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }

    // Select all records with a matchin e-mailadress AND account_beta_user set to 1: return true if a row is returned
    public function isBeta(string $account_email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ? AND account_beta_user = 1");
        $stmt->execute([$account_email]);
        $result = $stmt->fetch();

        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }

    // Select all records with a matchin e-mailadress AND account_enabled set to 1: return true if a row is returned
    public function isEnabled(string $account_email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ? AND account_enabled = 1");
        $stmt->execute([$account_email]);
        $result = $stmt->fetch();

        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }
}
