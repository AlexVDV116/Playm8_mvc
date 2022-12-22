<?php

require_once 'model/Account.php';
require_once 'model/userProfile.php';
require_once 'model/roleManager.php';
require_once 'model/Role.php';
require_once 'model/Permission.php';


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
    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Playm8 Admin Area</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/Playm8_favicon_32x32.png">
</head>

<body>
    <header id="branding" class="fixed-top">
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="./index.html">
                    <img src="/assets/images/logo.svg" alt="Logo" class="img-fluid logo">
                </a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <form class="d-flex mx-2" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search account" aria-label="Search">
                        <button class="btn btn-light" type="submit">Search</button>
                    </form>
                    <button class="btn btn-dark btn-logout" type="button">Logout</button>
                </div>
            </div>
        </nav>
    </header>


    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Zoek account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                (De)blokkeer account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Verwijder account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Rollen en permissies
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="container d-flex justify-content-center">
                    <div class="row">
                        <h1>Admin Area</h1>
                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom"></div>

                <?php // require "view/{$view}.php"; 
                ?>

            </main>
        </div>
    </div>


    <section id="footer-section">
    </section>



    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/notifications.js"></script>
    <script src="assets/js/scroll.js"></script>
    <script src="assets/js/form.js"></script>
</body>

</html>