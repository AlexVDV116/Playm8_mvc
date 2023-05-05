<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$userProfileID = $_SESSION["auth_user"]["userProfileID"];

require_once '../dao/userProfileDAO.php';

if (isset($_POST["submit"])) {

    // Grab the data of the file
    $file = $_FILES["file"];
    $fileName = $_FILES["file"]["name"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileType = $_FILES["file"]["type"];
    $fileError = $_FILES["file"]["error"];

    // Grab the extension of the file
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowedExt = ["jpg", "jpeg", "png"];
    $time = time();

    // Check if file extension is allowed else redirect with error message
    if (in_array($fileActualExt, $allowedExt)) {
        // Check if an error occuroed while uploading
        if ($fileError === 0) {
            // Check if the file size is less then 5 megabytes
            if ($fileSize < 5120000) {
                // Generate an unique file name and concat with file extentsion
                // Add time in second since 1970 to generate a unique file name in order to force browser to recache/download image
                $fileNameNew = "profilePic_" . $userProfileID . "_" . $time . "." . $fileActualExt;
                $fileDest = '../uploads/profilePictures/' . $fileNameNew;

                // Update the userProfiles.userProfilePicture collum with the new filename
                $userProfileDAO = new userProfileDAO;
                $userProfile = $userProfileDAO->get($userProfileID);

                // Check if user has a user has a record in userProfiles
                if ($userProfileDAO->checkRecordExists($userProfileID) == true) {
                    // If he has a profilePicture set other then default
                    if ($userProfile->userProfilePicture !== "default") {
                        // Grab the location, name and extension of the old userProfilePicture
                        $oldProfilePicture = "../uploads/profilePictures/" . $userProfile->userProfilePicture;
                        // Delete the old profilePicture
                        array_map('unlink', glob($oldProfilePicture));
                    }

                    // Move the file from the tmp location to the uploads folder
                    // If you run this using XAMPP make sure the Apache process owner has read/write permission to your file destination folder
                    move_uploaded_file($fileTmpName, $fileDest);

                    // Update the userProfilePicture with the new filename and extension
                    $userProfileDAO->updateUserProfilePicture($fileNameNew, $userProfileID);

                    // Redirect user with success message
                    header("location: ../view/editUserProfile.php?upload=success");
                } else {
                    header("location: ../view/editUserProfile.php?upload=fail");
                }
            } else {
                header("location: ../view/editUserProfile.php?error=filesize");
                exit();
            }
        } else {
            header("location: ../view/editUserProfile.php?error=uploaderror");
            exit();
        }
    } else {
        header("location: ../view/editUserProfile.php?error=fileextnotallowed");
        exit();
    }
}
