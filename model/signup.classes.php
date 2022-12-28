<?php

// This class interacts with the database and will store the account credentials in them
// It uses prepared statements to prevent SQL injection
// It performs a check to see if the email already exists in our database
class Signup extends Dbh
{
    // Generates a password hash using the PHP in built password_hash method (bcrypt algorithm)
    protected function setUser($username, $email, $password, $enabled): void
    {
        // Prepared statement to prevent SQL injection
        $stmt = $this->connect()->prepare('INSERT INTO accounts (account_username, account_email, account_password, account_enabled) VALUES (?, ? ,?, ?);');

        // Use PHP built in method to generate a password hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Exectute prepared statement with the hashed password
        if (!$stmt->execute(array($username, $email, $hashedPassword, $enabled))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit;
        }
        $stmt = null;
    }

    // Check database for already registered email returns true or false
    protected function checkEmail($email): bool
    {
        // Prepared statement to prevent SQL injection
        $stmt = $this->connect()->prepare('SELECT account_id FROM accounts WHERE account_email = ?;');

        // Exectute prepared statement if
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit;
        }

        // If the statement returns a row from the database the email already exists in the database
        $resultCheck = null;
        if ($stmt->rowCount() > 0) {
            $resultCheck - false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}
