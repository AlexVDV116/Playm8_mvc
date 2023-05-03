<?php
session_start();

// Check if user does not have a userProfileID and redirect to createUserProfile page else continue
if (!isset($_SESSION["auth_user"]["userProfileID"])) {
    header("location: ../view/editUserProfile.php");
    exit();
};

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
$ROOT = '../';

include_once '../header.php';
require_once 'framework/View.php';
require_once 'dao/userProfileDAO.php';

class userProfilePage extends View
{

    public function show()
    {
        $userProfileID = $_SESSION["auth_user"]["userProfileID"];
        $userProfileDAO = new userProfileDAO;
        $userProfile = $userProfileDAO->get($userProfileID);
?>
        <div class="h-100 gradient-custom-2">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-9 col-xl-7">
                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-row banner-top">
                                <div class="ms-4 mt-5 d-flex flex-column" style="width: 250px;">
                                    <img src="https://images.unsplash.com/photo-1557495235-340eb888a9fb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1713&q=80" alt="Profile picture" class="img-fluid img-thumbnail mt-4 mb-2">
                                    <button onclick="location.href='../view/editUserProfile.php'" type="button" class="btn btn-outline-dark mb-5" data-mdb-ripple-color="dark" style="z-index: 1;">
                                        Wijzig profiel
                                    </button>
                                </div>
                                <div class="ms-3" style="margin-top: 80px;">
                                    <h5 style="color: #fff"><?= $userProfile->getFirstName() ?></h5>
                                    <p><?= $userProfile->getCity() . ", " . $userProfile->getCountry() ?></p>
                                    <p><?= $userProfile->getAge() ?></p>
                                </div>
                            </div>
                            <div class="card-body p-4 text-black">
                                <div class="about-me-section">
                                    <p class="lead fw-normal mb-1"><?= $userProfile->getAboutMeTitle() ?></p>
                                    <div class="p-4" style="background-color: #f8f9fa;">
                                        <p class="font-italic mb-1"><?= $userProfile->getAboutMeText() ?></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-normal mb-0">Recent photos</p>
                                    <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-2">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp" alt="image 1" class="w-100 rounded-3">
                                    </div>
                                    <div class="col mb-2">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp" alt="image 1" class="w-100 rounded-3">
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp" alt="image 1" class="w-100 rounded-3">
                                    </div>
                                    <div class="col">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp" alt="image 1" class="w-100 rounded-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

new userProfilePage;
include_once '../footer.php';
