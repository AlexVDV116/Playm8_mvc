<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Playm8 is a fictional company of students of the Avans Academy. Playm8 Admin Area is the administrative website for Playm8.">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Bootstrap JS Bundle -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Fontawesome Icons Kit-->
    <script src="https://kit.fontawesome.com/485b2b0d16.js" crossorigin="anonymous"></script>

    <!-- Typekit font -->
    <link rel="stylesheet" href="https://use.typekit.net/unv5bor.css">

    <!-- Custom CSS / JS -->
    <link rel="stylesheet" href="<?php echo $ROOT; ?>assets/css/style.css">

    <title>Playm8</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/Playm8_favicon_32x32.png">
</head>

<body>
    <header id="branding" class="fixed-top">
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?php echo $ROOT; ?>index.php">
                    <img src="<?php echo $ROOT; ?>/assets/images/logo.svg" alt="Logo" class="img-fluid logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <!-- If user is logged in show account name and logout button -->
                        <!-- Else show regular register and login button -->
                        <?php
                        if (isset($_SESSION["accountid"])) {
                        ?>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link btn btn-register nav-btn" href="#" role="button">
                                    <?php echo $_SESSION["accountid"]; ?>
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link btn btn-login nav-btn" href="<?php echo $ROOT; ?>includes/logout.inc.php" role="button">
                                    Log out
                                </a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link btn btn-register nav-btn" href="<?php echo $ROOT; ?>view/signup.php" role="button">
                                    Register
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link btn btn-login nav-btn" href="<?php echo $ROOT; ?>view/login.php" role="button">
                                    Log in
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>