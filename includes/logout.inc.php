<?php

session_start();
session_unset();
session_destroy();

// Redirect user back to homepage
header("location: ../index.php?error=none");
