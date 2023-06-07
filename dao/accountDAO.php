<?php

// Define the namespace of this class
namespace DAO;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import the parent class Controller 
use Framework\DAO;
use Model\Account;
use Model\Mail;
use PDO;
use Data\mailConfig;
use DateTime;

ini_set('display_errors', 1);

// Data Abstraction Object for an Account object
// Can access the database and create, read, update, or delete (CRUD) the accounts table

class accountDAO extends DAO
{

    private static $select = 'SELECT * FROM `accounts`';

    public function __construct()
    {
        parent::__construct('Model\Account');
    }

    // Select all records from accounts table and order them by accountID
    public function startList(): void
    {
        $sql = 'CALL getAllAccountsOrderByAccountID();';
        $this->startListSql($sql);
    }

    // Select all records from accounts table and order them by accountID where isBeta = 1
    public function startListBeta(): void
    {
        $sql = 'CALL getAllBetaAccounts();';
        $this->startListSql($sql);
    }

    // Get all betatesters in an assoc array
    public function getAllBetaUsers(): array
    {
        $stmt = $this->prepare('CALL getAllBetaAccounts();');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Select all records from accounts table that match search term
    public function startSearch(string $search): void
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
    // Else select all records from accounts table where the email matches the given email
    // Returns an instance of the Account model with the property names set to the data from the selected record
    public function get(?string $email): Account
    {
        if (empty($email)) {
            return new Account();
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `accounts`.`email` = ?';
            return $this->getObjectSql($sql, [$email]);
        }
    }

    // Get all accounts
    public function getAllAccounts(): array
    {
        $stmt = $this->prepare('CALL getAllAccountsOrderByAccountID();');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Deletes a the record from the accounts table where the accountID matches
    // Prepared statement that uses a stored procedure
    public function delete(string $accountID): void
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
        $sql = 'CALL insertNewAccount(?, ?, ?, ?, ?, ?);';
        $args = [
            $account->get("accountID"),
            $account->get("username"),
            $account->get("email"),
            $account->get("password"),
            $account->get("activationCode"),
            $account->get("activationExpiry")
        ];
        $this->execute($sql, $args);
    }

    // Updates the record in the accounts table with the data from the Account object
    // Prepared statement that uses a stored procedure
    public function update(Account $account): void
    {
        $sql = 'CALL updateAccount(?, ?, ?, ?, ?, ?, ?, ?);';
        $args = [
            $account->get("username"),
            $account->get("email"),
            $account->get("password"),

            // Account model isActive and isBeta property is of type boolean, which either return true or false
            // MySQL does not have a boolean type, use tinyint(1)
            // Convert value to integer to prevent MySQL invalid datetime format fatal error
            (int)$account->get("isBetaUser"),
            (int)$account->get("isActive"),
            $account->get("activationCode"),
            $account->get("activationExpiry"),
            $account->get("accountID")
        ];
        $this->execute($sql, $args);
    }

    // ...
    public function save(Account $account): void
    {
        if (empty($account->get("accountID"))) {
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

    // Select all records with a matchin accountID's: return true if a row is returned
    public function knownAccountID(string $accountID): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE accountID = ?");
        $stmt->execute([$accountID]);
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

    // Select all records with a matching table name from the database and returns the number of rows as an int
    public function getBetaCount(): int
    {
        $stmt = $this->prepare("SELECT count(*) from `accounts` WHERE `isBetaUser` = 1;");
        $stmt->execute();
        $result = $stmt->fetch();

        return $result[0];
    }

    // Set the roleID's for an account
    // Interate over the arrayRoleID, for each value exectute statement with the given value
    public function setRoleID(string $accountID, array $roleID): void
    {
        $stmt = $this->prepare("INSERT INTO `accountsRoles` (accountID, roleID) VALUES (?, ?)");

        foreach ($roleID as $role) {
            $stmt->execute([$accountID, $role]);
        }
        $stmt->closeCursor();
    }

    // Get the roleID assigned to an account 
    // Flatten the associative array to a simple array containing the differen roleID's
    public function getRoleID(string $accountID): array
    {
        $stmt = $this->prepare("SELECT `roleID` FROM `accountsRoles` WHERE `accountID` = ?");
        $stmt->execute([$accountID]);
        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        $roles = array_column($result, '0');

        return $roles;
    }

    // Generate a uniquely random activation code, random bytes converted to a hexadecimal format
    // This code will be emailed to the user, a hash of this code will be stored in the db
    public function generateActivationCode(): string
    {
        return bin2hex(random_bytes(16));
    }

    // Send the activation code to the email registered
    public function mailActivationCode(string $email, string $activationCode): void
    {
        $activationLink = mailConfig::APP_URL;
        $activationLink .= "Playm8_mvc/includes/activate.inc.php?email={$email}&activationCode={$activationCode}";

        $senderName = "Playm8 Account Activation";
        $senderEmail = mailConfig::CONFIG['email']['username'];
        $senderEmailPassword = mailConfig::CONFIG['email']['password'];

        $recieverEmail = $email;
        $subject = "Verify your email-adress.";
        $body = "<p><strong>Thank you for registering at Playm8!</strong></p>";
        $body .= "<p>Please follow this link to activate your account:<br>";
        $body .= "{$activationLink}</p>";
        $body .= "<p>This link will expire in 1 hour.</p>";

        $activationMail = new Mail($senderName, $senderEmail, $senderEmailPassword);
        $activationMail->sendMail($recieverEmail, $subject, $body);
    }

    // Delete account with matching accountID and isActive set to 0
    public function deleteInactiveUserByID(string $accountID, int $isActive = 0): void
    {
        $sql = 'DELETE FROM accounts
            WHERE accountID = ? AND isActive = ?';
        $args = [
            $accountID,
            $isActive
        ];
        $this->execute($sql, $args);
    }

    // Select accountID, username, activationCode and set expired to 1 if activationExpiry date is greater then now
    // If expiry = 1 remove the account from the DB
    // else verify if the activationCode matches the hashed activationCode in the db, if true return the $user
    public function getUnverifiedAccount(string $email, string $activationCode)
    {
        $stmt = $this->prepare("SELECT accountID, username, activationCode, activationExpiry < now() as expired
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
            if (password_verify($activationCode, $user["activationCode"])) {
                return $user;
            }
        }
        return null;
    }

    function activateAccount(string $accountID): bool
    {
        $now = date("Y-m-d H:i:s");
        $sql = 'UPDATE accounts
                    SET isActive = 1,
                        activatedAt = ? 
                    WHERE accountID = ?';
        $args = [
            $now,
            $accountID
        ];
        return $this->execute($sql, $args);
    }

    // Function that generates a selector  and a validator
    // Selector is used to select the correct user in the database
    // Token is used to validate the user
    // The user has the unhashed hexadecimal format of the token sent to him in the email aka validator
    // The hashed token is saved in the database as the passwordResetToken
    // In the updatePassword method we will check that the user's validator matches our hashed token to confirm the correct user has access to the page
    function resetPassword(string $email): void
    {
        // Check if email exists in database
        $stmt = $this->prepare('CALL getAccountMatchingEmail(?);');
        $stmt->execute([$email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        // If query gets no result exit script and redirect user to index with error message
        if (!$result) {
            // echo "Onbekend e-mailadres..";
            header("location: ../view/forgotPassword.php?error=accountnotfound");
            exit();
        };

        // We generate a selector and a token, we use both to prevent timing attacks
        $selector = bin2hex(random_bytes(16));
        $token = random_bytes(32);

        // Next we generate a resetlink that contains the selector and unhashed token
        $resetLink = mailConfig::APP_URL;
        $resetLink .= "Playm8_mvc/view/resetPassword.php?selector={$selector}&validator=" . bin2hex($token);

        // We generate a token expiry date that is now + 1 hour
        $tokenExpiryDate = date("Y-m-d H:i:s", strtotime('+1 hours')); // ExpiryDate = now + 1 hours 

        // Before adding a record into the db we 
        // remove any existing db record from previous password resets from this email
        $stmt = $this->prepare('DELETE FROM passwordReset WHERE passwordResetEmail = ?');
        $stmt->execute([$email]);
        $stmt->closeCursor();

        // Hash the token
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        // Insert the email, selector, hashedToken and expiry date into the db
        $stmt = $this->prepare('INSERT INTO passwordReset (passwordResetEmail, passwordResetSelector, passwordResetToken, passwordResetExpires) VALUES (?, ? , ?, ?)');
        $stmt->execute([$email, $selector, $hashedToken, $tokenExpiryDate]);

        // Free up the connection to the server so that other SQL statements can be issued
        $stmt->closeCursor();

        // Send e-mail to the user containing the link to reset his password
        $senderName = "Playm8 Password Reset";
        $senderEmail = mailConfig::CONFIG['email']['username'];
        $senderEmailPassword = mailConfig::CONFIG['email']['password'];

        $recieverEmail = $email;
        $subject = "Reset your password.";
        $body = "<p><strong>Playm8 has received a reset password request for your account.</strong></p>";
        $body .= "<p>If you did not make this request you can ignore this message.<br>";
        $body .= "Please follow this link to reset your password:<br>";
        $body .= '<a href="' . $resetLink . '">' . $resetLink . '</a></p>';

        $activationMail = new Mail($senderName, $senderEmail, $senderEmailPassword);
        $activationMail->sendMail($recieverEmail, $subject, $body);

        header("location: ../view/resetPassword.php?reset=success");
    }

    // Validate the user by comparing the validator from to our hashed token in the database
    // If successfull update the user account in the db with the new hashed password
    function updatePassword(string $selector, string $validator, string $hashedPassword)
    {
        $now = date("Y-m-d H:i:s");

        // Use the selector token to select the correct record from the db where the passwordResetExpires date is greater then now
        $stmt = $this->prepare('SELECT * FROM passwordReset 
                                    WHERE passwordResetSelector = ? AND passwordResetExpires >= ?');
        $stmt->execute([$selector, $now]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        // If query gets no result exit script and redirect user to index with error message
        // Else verify if the validator from the form matches the hashed token in the database
        // If true grab the email belonging to that token
        if (!$result) {
            header("location: ../view/resetPassword.php?selector=" . $selector . "&validator=" . $validator . "&reset=fail");
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $result[0]["passwordResetToken"]);

            if ($tokenCheck === false) {
                header("location: ../view/resetPassword.php?selector=" . $selector . "&validator=" . $validator . "&reset=fail");
                exit();
            } elseif ($tokenCheck === true) {

                // Use the get method to grab the account that matches the email
                $tokenEmail = $result[0]["passwordResetEmail"];
                $account = $this->get($tokenEmail);

                // If no match redirect user with error message
                if (!$account) {
                    header("location: ../view/resetPassword.php?selector=" . $selector . "&validator=" . $validator . "&reset=fail");
                    exit();
                } else {

                    // Else update the password in the database with the new hashed password
                    $stmt = $this->prepare('UPDATE accounts SET password = ? WHERE email = ?');
                    $stmt->execute([$hashedPassword, $tokenEmail]);
                    $stmt->closeCursor();

                    // Delete token after successfull password reset
                    $stmt = $this->prepare('DELETE FROM passwordReset WHERE passwordResetEmail = ?');
                    $stmt->execute([$tokenEmail]);
                    $stmt->closeCursor();
                }
                // Redirect user back to the front page when sucsessfull
                header("location: ../view/login.php?reset=success");
            }
        }
    }

    // Set the isBetaUser collum to true
    public function setBeta(string $email): void
    {
        $stmt = $this->prepare("UPDATE `accounts` 
        SET isBetaUser = 1 
        WHERE email = ?");
        $stmt->execute([$email]);
        $stmt->closeCursor();
    }

    // Set the failedLoginAttempt += 1 and return the new value
    public function addFailedLoginAttempt(string $accountID): void
    {
        $stmt = $this->prepare("SELECT * FROM loginAttempts WHERE accountID = ?");
        $stmt->execute([$accountID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $now = date("Y-m-d H:i:s");

        // Verify that at least one login attempt is in database, else insert new record
        if ($result) {
            $stmt = $this->prepare('CALL addFailedLoginAttempt(?, ?);');
            $stmt->execute([$accountID, $now]);
            $stmt->closeCursor();
        } else {
            $stmt = $this->prepare('CALL insertFailedLoginAttempt(?, ? ,?);');
            $stmt->execute([$accountID, 1, $now]);
            $stmt->closeCursor();
        }
    }

    // Set the failedLoginAttempt += 1 and return the new value
    public function getFailedLoginAttempts(string $accountID): int
    {
        $stmt = $this->prepare('CALL getFailedLoginAttempts(?);');
        $stmt->execute([$accountID]);
        $result = $stmt->fetch();
        $stmt->closeCursor();

        return $result[0];
    }

    // Set the failedLoginAttempt += 1 and return the new value
    public function resetFailedLoginAttempts(string $accountID): void
    {
        $stmt = $this->prepare('CALL resetFailedLoginAttempts(?);');
        $stmt->execute([$accountID]);
        $stmt->closeCursor();
    }

    // Get the datetime of the last login attempt
    public function getLastLoginAttempt(string $accountID): string
    {
        $stmt = $this->prepare('CALL getLastLoginAttempt(?);');
        $stmt->execute([$accountID]);
        $result = $stmt->fetch();
        $stmt->closeCursor();

        return $result[0];
    }

    // Enable an acount by setting the isActive value to true
    public function enableAccount(string $accountID): void
    {
        $stmt = $this->prepare('CALL enableAccount(?);');
        $stmt->execute([$accountID]);
        $stmt->closeCursor();
    }

    // Disable an acount by setting the isActive value to false
    public function disableAccount(string $accountID): void
    {
        $stmt = $this->prepare('CALL disableAccount(?);');
        $stmt->execute([$accountID]);
        $stmt->closeCursor();
    }
}
