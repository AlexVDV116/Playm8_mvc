<?php
session_start();

ini_set('display_errors', 1);
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0 clients (IE6 / pre 1997)
header("Expires: 0"); // HTTP 1.0 Proxies

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');


$title = 'Eboost Manager Area';

$controller = filter_input(INPUT_GET, 'controller');
if (!empty($controller)) {
    require "controller/{$controller}.php";
    exit;
}

$view = filter_input(INPUT_GET, 'view');
if (empty($view)) {
    $view = 'Home';
}
$menu = [
    'Home' => '?view=Home',
    'UserProfiles' => '?view=UserProfileList',
];
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
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Playm8</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/Playm8_favicon_32x32.png">
</head>

<body>
    <header id="branding" class="fixed-top">

        <nav id="main-navbar" class="navbar navbar-expand-xxl">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <img src="../assets/images/logo.svg" alt="Logo" class="img-fluid logo">
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
                        if (isset($_SESSION["account_username"])) {
                        ?>
                            <li class="nav-item pl-3 pr-1">
                                <a class="nav-link btn btn-register nav-btn" href="#" role="button">
                                    <?php echo $_SESSION["account_username"]; ?>
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link btn btn-login nav-btn" href="../includes/logout.inc.php" role="button">
                                    Uitloggen
                                </a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item pl-3 pr-1">
                                <a class="nav-link btn btn-register nav-btn" href="../view/signup.php" role="button">
                                    Registreren
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link btn btn-login nav-btn" href="../view/login.php" role="button">
                                    Inloggen
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

    <div class="container">
        <div class="row">
            <nav id="sideBarNav" class=" col-4 ml-5">
                <div class="p-3" style="width: 280px;">
                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a href="?view=Home" class="nav-link">
                                <h4>Admin area</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?view=ListAccounts" class="nav-link">
                                Bekijk accounts
                            </a>
                        </li>
                        <li>
                            <a href="?view=Home" class="nav-link">
                                Betatesters
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?view=Home" class="nav-link">
                                Rollen en Permissies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?view=Home" class="nav-link">
                                Downloads
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>
            </nav>
            <div class="col-8 pt-5">
                <?php require "{$view}.php"; ?>
            </div>
        </div>




        <script src="../assets/js/scripts.js"></script>
        <!-- <script src="./assets/js/features.js"></script> -->
        <script src="../assets/js/features-new.js"></script>
        <script src="../assets/js/scroll.js"></script>
        <script src="../assets/js/form.js"></script>

</body>

</html>