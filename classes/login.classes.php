<?php

class Login extends Dbh
{
    // Check database if given user credentials match database
    protected function getUser($email, $password)
    {
        // Prepared statement to prevent SQL injection
        $stmt = $this->connect()->prepare('SELECT account_password FROM accounts WHERE account_email = ?;');

        // Execute the statement with the given email value
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit;
        }

        // If query gets no result exit script and redirect user to index with error message
        if ($stmt->rowCount() == 0) {
            echo $stmt;
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        // Fetch associative array with the hashed user password from database
        $hashedPassword = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // use PHP built in method to check if the given hash matches the user given password (returns bool)
        $checkPwd = password_verify($password, $hashedPassword[0]["account_password"]);

        // If the password match
        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            // Prepared satement that selects all collums in the accounts table where user credentials match the given credentials
            $stmt = $this->connect()->prepare('SELECT * FROM accounts WHERE account_email = ? AND account_password = ?;');

            // If they do not match, set statement to null and redirect user to index with error message
            if (!$stmt->execute(array($email, $hashedPassword[0]["account_password"]))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit;
            }

            // Before logging in the user i want to check if the database query retrieves any results
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound2");
                exit();
            }

            // Log user in
            // Create a user variable with the results from the statement and return these results in an associative array
            // This user variable thus contains all data from the database belonging to the account
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Create a new session with a session super global of accountid
            session_start();
            $_SESSION["accountid"] = $user[0]["account_id"];
        }

        $stmt = null;
    }
}
