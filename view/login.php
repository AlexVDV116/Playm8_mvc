<?php
$ROOT = '../'; // Setting the ROOT directory for this file so the relative paths used in included pages will still work
include_once '../header.php';
?>

<section>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card rounded-4">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <h2 class="text-center mb-5">Inloggen</h2>

                                <form action="../includes/login.inc.php" method="post" class="needs-validation mx-1 mx-md-4" novalidate>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input id="form_email" type="text" name="email" class="form-control">
                                            <label for="form_email" class="form-label">E-mailadres</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input id="form_password" type="password" name="password" class="form-control">
                                            <label for="form_password" class="form-label">Wachtwoord</label>
                                        </div>
                                    </div>

                                    <div class="form-button-row d-flex justify-content-center flex-row mt-3">
                                        <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit">Inloggen</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80" class="form-img img-fluid rounded-4 shadow-sm" alt="Dog image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include_once '../footer.php';
?>