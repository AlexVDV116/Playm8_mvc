<?php

// Data Abstraction Object for an Account object
// Can access the database create, read, update, or delete data (CRUD)

require_once '../framework/DAO.php';
require_once '../model/Account.php';
require_once '../data/secret.php';

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
        $stmt = $this->prepare('CALL getAccountMatchingEmail(?);');
        $stmt->execute([$email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // If query gets no result exit script and redirect user to index with error message
        if (!$result) {
            // echo "Onbekend e-mailadres..";
            header("location: ../view/login.php?error=accountnotfound");
            exit();
        };

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
            };

            // Check if the user has verified its email-adress and that his account isActive = 1
            if ($this->isActive($email) == 0) {
                // echo "Account niet geactiveerd";
                header("location: ../view/login.php?error=accountnotactivated");
                exit();
            };

            // Before logging in the user check if the database query retrieves any results
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../view/login.php?error=accountnotfound");
                exit();
            };

            // Log user in
            // Create a user variable with the results from the statement and return these results in an associative array
            // This user variable now contains all data from the database belonging to the account
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Free up the connection to the server so that other SQL statements may be issued
            $stmt->closeCursor();

            // Create a new session 
            session_start();
            // Regenerate session id to prevent session fixation-by malicious user
            session_regenerate_id();

            // Set session super global variables containing user information
            $_SESSION["auth"] = true;
            $_SESSION["auth_role"] = $this->getRoleID($user[0]["accountID"]);
            $_SESSION["auth_user"] = [
                'accountID' => $user[0]["accountID"],
                'username' => $user[0]["username"],
                'email' => $user[0]["email"],
                'isEnabled' => $user[0]["isEnabled"],
                'isBetaUser' => $user[0]["isBetaUser"],
                'userProfileID' => $user[0]["userProfileID"],
            ];
        }

        $stmt = null;
    }

    // Select all records from accounts table and order them by accountID
    public function startList(): void
    {
        $sql = 'CALL getAllAccountsOrderByAccountID();';
        $this->startListSql($sql);
    }

    // Select all records from accounts table and order them by accountID
    public function startSearch($search): void
    {
        $search = "%" . $search . "%";
        $search2 = $search;

        $sql = "SELECT * FROM accounts WHERE (`username` LIKE ?) OR (`email` LIKE ?)";
        $args = [
            $search,
            $search
        ];
        $this->startListSql($sql, $args);
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
        $sql = 'CALL insertNewAccount(?, ?, ?, ?, ?);';
        $args = [
            $account->getName(),
            $account->getEmail(),
            $account->getPassword(),
            $account->getActivationCode(),
            $account->getExpiryDate()
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

    // Select all records with a matching e-mailadress AND isActive set to 1: return true if a row is returned
    public function isActive(string $email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE email = ? AND isActive = 1");
        $stmt->closeCursor();
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

    // Select all records with a matching table name from the database and returns the number of rows as an int
    public function getCount(string $dbName): int
    {
        $stmt = $this->prepare("SELECT count(*) from $dbName");
        $stmt->execute();
        $result = $stmt->fetch();

        return $result[0];
    }

    // Get the roleID assigned to an account 
    public function getRoleID(int $accountID)
    {
        $stmt = $this->prepare("SELECT `roleID` FROM `accountsRoles` WHERE `accountID` = ?");
        $stmt->execute([$accountID]);
        $result = $stmt->fetch();

        if ($result[0]) {
            return $result[0];
        } else {
            return null;
        }
    }

    // Generate a uniquely random activation code
    public function generateActivationCode(): string
    {
        return bin2hex(random_bytes(16));
    }

    // Send the activation code to the email registered
    public function mailActivationCode($email, $activation_code): void
    {
        $activation_link = mailConfig::APP_URL;
        $activation_link .= "Playm8_mvc/includes/activate.inc.php?email=$email&activation_code=$activation_code";

        $senderName = "Playm8 Account Activation";
        $senderEmail = mailConfig::CONFIG['email']['username'];
        $senderEmailPassword = mailConfig::CONFIG['email']['password'];

        $recieverEmail = $email;
        $subject = "Verify your email-adress!";
        $body = "<p><strong>Thank you for registering at Playm8!</strong></p>";
        $body .= "<p>Please follow this link to activate your account:<br>";
        $body .= "{$activation_link}</p>";

        $playm8Mail = new Mail($senderName, $senderEmail, $senderEmailPassword);
        $playm8Mail->sendMail($recieverEmail, $subject, $body);
    }

    // Delete account with matching accountID and isActive set to 0
    public function deleteInactiveUserByID(int $accountID, int $isActive = 0): void
    {
        $sql = 'DELETE FROM accounts
            WHERE accountID = ? AND isActive = ?';
        $args = [
            $accountID,
            $isActive
        ];
        $this->execute($sql, $args);
    }

    // Select the ID, activation code from the account that matched the email
    // and set expired to true if the activation_expiry is greater then now 
    // If the account has an expired activation_expiry date remove the account from the DB
    // else return the unverified account
    public function getUnverifiedAccount(string $email, string $activationCode)
    {
        $stmt = $this->prepare("SELECT accountID, username, activation_code, activation_expiry < now() as expired
            FROM accounts WHERE isActive = 0 AND email = ?");
        $stmt->closeCursor();
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // already expired, delete the in active user with expired activation code
            if ((int)$user['expired'] === 1) {
                $this->deleteInactiveUserByID($user['accountID']);
                return null;
            }
            // verify the password
            if (($user['activation_code'] == $activationCode)) {
                return $user;
            }
        }

        return null;
    }

    function activateAccount(int $accountID): bool
    {
        $now = date("Y-m-d H:i:s");
        $sql = 'UPDATE accounts
            SET isActive = 1,
                activated_at = ? 
            WHERE accountID = ?';
        $args = [
            $now,
            $accountID
        ];
        return $this->execute($sql, $args);
    }
}
