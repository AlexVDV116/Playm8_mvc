<?php

// When logging out regenerate session id, unset session variables and destroy session to prevent session-fixation by malicious user
session_start();
session_regenerate_id();
session_unset();
session_destroy();

// Redirect user back to homepage
header("location: ../index.php?error=none");
exit();
