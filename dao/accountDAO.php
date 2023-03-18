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
        $stmt = $this->prepare('CALL getAccountWithEmail(?);');
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
        $checkPwd = password_verify($password, $result[0]["password"]);

        // If the password match
        if ($checkPwd == false) {
            $stmt = null;
            // echo "Onjuist wachtwoord.";
            header("location: ../view/login.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            // Prepared satement that selects all rows in the accounts table where user credentials match the given credentials
            $stmt = $this->prepare('CALL logInAccount(?, ?)');

            // If they do not match, set statement to null and redirect user to index with error message
            if (!$stmt->execute(array($email, $result[0]["password"]))) {
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


            // Create a new session with a session super global of accountid and username
            session_start();
            // Regenerate session id to prevent session fixation-by malicious user
            session_regenerate_id();
            $_SESSION["accountID"] = $user[0]["accountID"];
            $_SESSION["username"] = $user[0]["username"];
        }

        $stmt = null;
    }

    // Select all records from accounts table and order them by accountID
    public function startList(): void
    {
        $sql = 'CALL getAllAccountsOrderByAccountID();';
        $this->startListSql($sql);
    }

    // Returns a new Account object if no email provided
    // Else select all records from accounts table where the email mathes the given email
    // Returns an instance of the Account model with the property names set to the data from the selected record
    public function get(?string $email)
    {
        if (empty($email)) {
            return new Account;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `accounts`.`email` = ?';
            return $this->getObjectSql($sql, [$email]);
        }
    }

    // Deletes a the record from the accounts table where the accountID matches
    // Prepared statement that uses a stored procedure
    public function delete(int $accountID): void
    {
        $sql = 'CALL deleteAccount(?);';
        $args = [
            $accountID
        ];
        $this->execute($sql, $args);
    }

    // Inserts a new record into the accounts table with the data from Account object
    // Prepared statement that uses a stored procedure
    public function insert(Account $account): void
    {
        $sql = 'CALL insertNewAccount(?, ?, ?);';
        $args = [
            $account->getName(),
            $account->getEmail(),
            $account->getPassword()
        ];
        $this->execute($sql, $args);
    }

    // Updates the record in the accounts table with the data from the Account object
    // Prepared statement that uses a stored procedure
    public function update(Account $account): void
    {
        $sql = 'CALL updateAccount(?, ?, ?, ?, ?);';
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
    public function knownEmail(string $email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }

    // Select all records with a matchin e-mailadress AND isBetaUser set to 1: return true if a row is returned
    public function isBeta(string $email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE email = ? AND isBetaUser = 1");
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }

    // Select all records with a matchin e-mailadress AND isEnabled set to 1: return true if a row is returned
    public function isEnabled(string $email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE email = ? AND isEnabled = 1");
        $stmt->execute([$email]);
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
