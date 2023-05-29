<?php

// Define the namespace of this class
namespace View;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Echo errors for development purposes */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Echo session variables for development purposes */
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
global $ROOT;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once $ROOT . 'vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use Controller\translatorController;

// header class that contains the header
class header extends View
{

    public function show()
    {
        // Setting the ROOT directory for this file so the relative paths used in included pages will still work
        global $ROOT;

        $translator = new translatorController;
        // Use the getLanguageFile method of the languageSelector and require the correct language file
        require $ROOT . $translator->getLanguageFile();

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

            <!-- Int tel input plugin -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">

            <!-- Custom CSS / JS -->
            <link rel="stylesheet" href=<?= $ROOT . "./assets/css/style.css" ?>>

            <title>Playm8</title>
            <link rel="icon" type="image/png" href=<?= $ROOT . './assets/images/Playm8_favicon_32x32.ico?1' ?>>
        </head>

        <body>
            <header id="branding" class="fixed-top">

                <nav id="top-bar" class="navbar">
                    <div class="container navbar-expand">
                        <ul class="navbar-nav align-items-center usp-nav my-0 px-0">
                            <li class="nav-item me-3">
                                <i class="fa-solid fa-map-location me-2"></i>
                                <span><?= $translator->__('Alles voor je dier op de wandelkaart') ?></span>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <ul class="navbar-nav align-items-center usp-nav my-0 px-0">
                                <li class="nav-item-lang pl-3 pr-1">
                                    <i class="fa-solid fa-earth-americas"></i>
                                    <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?= $translator->__('Taal') ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="dropdown-item" href="?lang=nl">Nederlands</a></li>
                                        <li><a class="dropdown-item" href="?lang=en">English</a></li>
                                        <li><a class="dropdown-item" href="?lang=es">Español</a></li>
                                        <li><a class="dropdown-item" href="?lang=fr">Français</a></li>
                                        <li><a class="dropdown-item" href="?lang=zh">中文</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <nav id="main-navbar" class="navbar navbar-expand-xxl">
                    <div class="container">
                        <a class="navbar-brand" href="<?= $ROOT . 'index.php' ?>">
                            <img src="<?= $ROOT . 'assets/images/logo.svg' ?>" alt="Logo" class="img-fluid logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item pt-2 px-3">
                                    <a class="nav-link active" href="<?= $ROOT ?>index.php#about-section" data-action="about-section">
                                        <?= $translator->__('Over ons') ?></a>
                                </li>
                                <li class="nav-item pt-2 px-3">
                                    <a class="nav-link" href="<?= $ROOT ?>index.php#features-section" data-action="features-section">
                                        <?= $translator->__('App Features') ?></a>
                                </li>
                                <li class="nav-item pt-2 px-3">
                                    <a class="nav-link" href="<?= $ROOT ?>index.php#impression-section" data-action="impression-section">
                                        <?= $translator->__('Impressie') ?></a>
                                </li>
                                <li class="nav-item pt-2 px-3">
                                    <a class="nav-link" href="<?= $ROOT ?>index.php#credits-section" data-action="credits-section">
                                        <?= $translator->__('Abbonementen') ?></a>
                                </li>
                                <li class="nav-item pt-2 px-3">
                                    <a class="nav-link" href="<?= $ROOT ?>index.php#tester-section" data-action="tester-section">
                                        <?= $translator->__('Betatesters') ?></a>
                                </li>
                                <!-- If user is logged in show account name and logout button -->
                                <!-- If user is logged in as admin href leads to admin panel, user leads to profile page -->
                                <!-- Else show regular register and login button -->
                                <?php
                                if (isset($_SESSION["auth_user"]) && in_array(3, $_SESSION["auth_role"])) {
                                ?>
                                    <div class="dropdown">
                                        <li class="nav-item pl-3 pr-1">
                                            <a class="nav-link btn btn-register nav-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php echo $_SESSION["auth_user"]["username"]; ?>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="<?= $ROOT ?>view/admin.php"><?= $translator->__('Admin Dashboard') ?></a></li>
                                            </ul>
                                        </li>
                                    </div>
                                    <li class="nav-item px-2">
                                        <a class="nav-link btn btn-login nav-btn" href="<?= $ROOT ?>includes/logout.inc.php" role="button">
                                            <?= $translator->__('Uitloggen') ?></a>
                                    </li>
                                <?php
                                } elseif (isset($_SESSION["auth_user"])) {
                                ?>
                                    <div class="dropdown">
                                        <li class="nav-item pl-3 pr-1">
                                            <a class="nav-link btn btn-register nav-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php echo $_SESSION["auth_user"]["username"]; ?>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="<?= $ROOT ?>view/editAccount.php"><?= $translator->__('Account') ?></a></li>
                                                <?php
                                                if (isset($_SESSION["auth_user"]["userProfileID"])) {
                                                ?>
                                                    <li><a class="dropdown-item" href="<?= $ROOT ?>view/userProfilePage.php"><?= $translator->__('Gebruikersprofiel') ?></a></li>
                                                    <li><a class="dropdown-item" href="<?= $ROOT ?>view/editUserProfile.php"><?= $translator->__('Wijzig profiel') ?></a></li>
                                                    <li><a class="dropdown-item" href="#"><?= $translator->__('Vind matches') ?></a></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><a class="dropdown-item" href="<?= $ROOT ?>includes/createUserProfile.inc.php"><?= $translator->__('Creëer gebruikersprofiel') ?></a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    </div>
                                    <li class="nav-item px-2">
                                        <a class="nav-link btn btn-login nav-btn" href="<?= $ROOT ?>includes/logout.inc.php" role="button">
                                            <?= $translator->__('Uitloggen') ?>
                                        </a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="nav-item pl-3 pr-1">
                                        <a class="nav-link btn btn-register nav-btn" href="<?= $ROOT ?>view/signup.php" role="button">
                                            <?= $translator->__('Registreren') ?>
                                        </a>
                                    </li>
                                    <li class="nav-item px-2">
                                        <a class="nav-link btn btn-login nav-btn" href="<?= $ROOT ?>view/login.php" role="button">
                                            <?= $translator->__('Inloggen') ?>
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
    <?php
    }
}
