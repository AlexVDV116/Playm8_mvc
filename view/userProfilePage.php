<?php
session_start();

/*
ini_set('display_errors', 1);
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0 clients (IE6 / pre 1997)
header("Expires: 0"); // HTTP 1.0 Proxies
*/

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
        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col col-lg-9 col-xl-7">

                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-row banner-top">
                                <div class="ms-4 mt-5 d-flex flex-column">
                                    <?php
                                    // If user has a default profile picture display default profile picture with his initials
                                    // Else display his own profile picture
                                    if ($userProfile->getUserProfilePicture() == "default") { ?>
                                        <img src="../uploads/profilePictures/default.png" alt="Profile picture" class="profilePicture img-fluid img-thumbnail mt-4 mb-2">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../uploads/profilePictures/<?php echo $userProfile->getUserProfilePicture() ?>" alt="Profile picture" class="profilePicture img-fluid img-thumbnail mt-4 mb-2">
                                    <?php
                                    }
                                    ?>
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
                                <div class="row d-flex justify-content-center">
                                    <div class="about-me-section">
                                        <p class="lead fw-normal mb-1"><?= $userProfile->getAboutMeTitle() ?></p>
                                        <div class="p-4" style="background-color: #f8f9fa;">
                                            <p class="font-italic mb-1"><?= $userProfile->getAboutMeText() ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <p class="lead fw-normal mb-0">Recent photos</p>
                                        <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                                    </div>
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
                <?php
                // Setting the ROOT directory for this file so the relative paths used in included pages will still work
                $ROOT = '../';
                include_once '../footer.php';
                ?>
            </div>
        </div>
<?php
    }
}
new userProfilePage;
