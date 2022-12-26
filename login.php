<?php
include_once 'header.php';
?>

<section>
    <div class="container">
        <div class="text-center mt-2">
            <h1>Log in</h1>
        </div>

        <div class="row mt-3">
            <div class="col-md-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">

                        <div class="container">
                            <form action="login.inc.php" method="post" class="needs-validation" novalidate>
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="form_email">E-mailadres:</label>
                                            <input id="form_email" type="email" name="email" class="form-control border-0" placeholder="Voer uw e-mailadres in" required>
                                            <div class="invalid-feedback">
                                                Voer een geldig email-adress in.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="form_password">Wachtwoord:</label>
                                            <input id="form_password" type="password" name="password" class="form-control border-0" placeholder="Voer een wachtwoord in" required>
                                            <div class="invalid-feedback">
                                                Voer een wachtwoord in.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="form-button-row d-flex flex-row mt-3 justify-content-end">
                        <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit">Log in</button>
                    </div>
                </div>

                </form>
            </div>

        </div>
    </div>
    </div>
    </div>
</section>


<?php
include_once 'footer.php';
?>